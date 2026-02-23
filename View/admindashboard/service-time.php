<?php
include '../../includes/dbconnect.php'; // $conn must be initialized

$message = "";

// Only process if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle deletion
    if (isset($_POST['delete_id'])) {
        $delete_id = intval($_POST['delete_id']);

        // Check if there are bookings for this slot
        $stmtCheck = $conn->prepare("SELECT COUNT(*) as count FROM bookings WHERE time_slot_id = ?");
        $stmtCheck->bind_param("i", $delete_id);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();
        $row = $resultCheck->fetch_assoc();

        if ($row['count'] > 0) {
            $message = "Cannot delete this time slot. It is assigned to existing bookings.";
        } else {
            $stmt = $conn->prepare("DELETE FROM time_slots WHERE id = ?");
            $stmt->bind_param("i", $delete_id);
            if ($stmt->execute()) {
                $message = "Time slot deleted successfully.";
            } else {
                $message = "Database error: " . $stmt->error;
            }
            $stmt->close();
        }

        $stmtCheck->close();
    }

    // Handle adding new time slot
    elseif (isset($_POST['category'], $_POST['start_time'], $_POST['end_time'])) {

        $category = strtolower(trim($_POST['category'])); // store as lowercase
        $start_time = trim($_POST['start_time']) . ':00';
        $end_time = trim($_POST['end_time']) . ':00';

        if ($category && $start_time && $end_time) {

            // Check for overlapping time slots
            $stmt = $conn->prepare("
                SELECT COUNT(*) as count FROM time_slots 
                WHERE time_category = ? 
                AND start_time < ? 
                AND end_time > ?
            ");
            $stmt->bind_param("sss", $category, $end_time, $start_time);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                $message = "This time slot overlaps with an existing slot.";
            } else {
                // Insert new time slot
                $insertStmt = $conn->prepare("
                    INSERT INTO time_slots (time_category, start_time, end_time)
                    VALUES (?, ?, ?)
                ");
                $insertStmt->bind_param("sss", $category, $start_time, $end_time);
                if ($insertStmt->execute()) {
                    $message = "New time slot added successfully.";
                } else {
                    $message = "Database error: " . $insertStmt->error;
                }
                $insertStmt->close();
            }

            $stmt->close();

        } else {
            $message = "Please fill all the fields.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Time Slot</title>
    <link rel="stylesheet" href="../assets/css/service-time.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php include '../../includes/dashboardnav.php'; ?>

    <div class="service-time-container">
        <div class="page-top">
            <p>Service Time Management</p>
        </div>

        <div class="card">
            <h3>Add New Time Slot(1 hour)</h3>

            <!-- Add Time Slot Form -->
            <form method="POST">
                <label>Select Time Category</label>
                <select name="category" id="category" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = ["morning", "afternoon", "evening"];
                    foreach ($categories as $cat) {
                        $display = ucfirst($cat);
                        echo "<option value='{$cat}'>{$display}</option>";
                    }
                    ?>
                </select>

                <div class="time-field">
                    <label for="startTime">Start Time</label>
                    <input type="time" id="startTime" name="start_time" required>
                </div>

                <div class="time-field">
                    <label for="endTime">End Time</label>
                    <input type="time" id="endTime" name="end_time" readonly required>
                </div>

                <div class="time-field">
                    <button type="submit">Add Time Slot</button>
                </div>

                <?php if ($message): ?>
                    <script>
                        alert("<?php echo addslashes($message); ?>");
                    </script>
                <?php endif; ?>

            </form>

            <hr class="section-divider">

            <!-- Existing Time Slots -->
            <h3 class="section-title">Existing Time Slots</h3>
            <div class="slots-wrapper">
                <?php
                foreach ($categories as $catName) {
                    $slotQuery = "SELECT id, start_time, end_time FROM time_slots WHERE time_category = ? ORDER BY start_time ASC";
                    $stmt = $conn->prepare($slotQuery);
                    $stmt->bind_param("s", $catName);
                    $stmt->execute();
                    $slotResult = $stmt->get_result();
                    $count = $slotResult ? $slotResult->num_rows : 0;
                    ?>

                    <div class="slot-card">
                        <div class="card-header">
                            <h4><?php echo ucfirst($catName); ?></h4>
                            <span class="slot-count"><?php echo $count; ?></span>
                        </div>

                        <table class="slot-table">
                            <thead>
                                <tr>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($count > 0) {
                                    while ($slot = $slotResult->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('h:i A', strtotime($slot['start_time'])); ?></td>
                                            <td><?php echo date('h:i A', strtotime($slot['end_time'])); ?></td>
                                            <td class="action-cell">
                                                <form method="POST" class="delete-form">
                                                    <input type="hidden" name="delete_id" value="<?php echo $slot['id']; ?>">
                                                    <button type="submit" class="delete-btn">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='no-data'>No Slots Available</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <?php $stmt->close();
                } ?>
            </div>
        </div>
    </div>

    <script>
        const startTime = document.getElementById("startTime");
        const endTime = document.getElementById("endTime");
        const category = document.getElementById("category");

        // Set start time ranges based on category
        category.addEventListener("change", () => {
            const catText = category.value;
            switch (catText) {
                case "morning":
                    startTime.min = "06:00"; startTime.max = "11:59"; startTime.value = "06:00"; break;
                case "afternoon":
                    startTime.min = "12:00"; startTime.max = "16:59"; startTime.value = "12:00"; break;
                case "evening":
                    startTime.min = "17:00"; startTime.max = "20:59"; startTime.value = "17:00"; break;
            }
            calculateEndTime();
        });

        // Calculate end time +1 hour
        function calculateEndTime() {
            if (!startTime.value) return;
            let [h, m] = startTime.value.split(":").map(Number);
            let endH = h + 1;
            let maxH = parseInt(startTime.max.split(":")[0]);
            if (endH > maxH) endH = maxH;
            endTime.value = String(endH).padStart(2, "0") + ":" + String(m).padStart(2, "0");
        }

        startTime.addEventListener("change", calculateEndTime);
        category.dispatchEvent(new Event("change"));
    </script>
</body>

</html>