<?php
include '../../includes/dbconnect.php'; // $conn must be initialized

$message = "";

// Only process if form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category = trim($_POST['category']); // numeric id from select
    $start_time = trim($_POST['start_time']);
    $end_time = trim($_POST['end_time']);

    if ($category && $start_time && $end_time) {

        // Add seconds for MySQL TIME comparison
        $start_time .= ':00';
        $end_time .= ':00';

        // Check for overlapping time slots
        $checkQuery = "
            SELECT * FROM time_slots 
            WHERE time_category = $category
            AND start_time < '$end_time'
            AND end_time > '$start_time'
        ";
        $result = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($result) > 0) {
            $message = "This time slot overlaps with an existing slot.";
        } else {
            // Insert new time slot
            $insertQuery = "
                INSERT INTO time_slots (time_category, start_time, end_time)
                VALUES ($category, '$start_time', '$end_time')
            ";
            if (mysqli_query($conn, $insertQuery)) {
                $message = "New time slot added sucessfully.";
            } else {
                $message = "Database error: " . mysqli_error($conn);
            }
        }

    } else {
        $message = "Please fill all the fields.";
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
    <div>
        <?php include '../../includes/dashboardnav.php'; ?>
    </div>

    <div class="service-time-container">
        <div class="page-top">
            <p>Add Time Slot (1 Hour Only)</p>
        </div>

        <div class="card">
            <?php if ($message): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <label>Select Time Category</label>
                <select name="category" id="category" required>
                    <option value=""> Select Category </option>
                    <?php
                    $query = "SELECT id, name FROM time_categories ORDER BY id ASC";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }
                    } else {
                        echo "<option value=''>No categories found</option>";
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

            </form>
        </div>
    </div>

    <script>
        const startTime = document.getElementById("startTime");
        const endTime = document.getElementById("endTime");
        const category = document.getElementById("category");

        // Set start time ranges based on category name
        category.addEventListener("change", () => {
            const catText = category.options[category.selectedIndex].text;
            switch (catText) {
                case "Morning":
                    startTime.min = "06:00"; startTime.max = "11:59"; startTime.value = "06:00"; break;
                case "Afternoon":
                    startTime.min = "12:00"; startTime.max = "16:59"; startTime.value = "12:00"; break;
                case "Evening":
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