<?php
include '../../includes/dbconnect.php';
session_start();

// Get booking id from URL safely
$booking_id = isset($_GET['booking_id']) ? intval($_GET['booking_id']) : 0;

if ($booking_id == 0) {
    echo "Invalid booking ID";
    exit;
}

// Fetch booking details
$query = "SELECT 
    b.booking_id,
    b.username,
    b.booking_date,
    b.status,
    b.service_address,

    p.profession_id,
    p.profession_name,

    ts.id AS time_slot_id,
    ts.start_time,
    ts.end_time,
    ts.time_category,

    tc.id AS time_category_id,
    tc.name AS time_category_name

FROM bookings b

JOIN profession p 
ON b.profession_id = p.profession_id

JOIN time_slots ts 
ON b.time_slot_id = ts.id

JOIN time_categories tc 
ON ts.time_category = tc.id

WHERE b.booking_id = $booking_id";

$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Booking not found";
    exit;
}

$booking = mysqli_fetch_assoc($result);
$currentCategoryId = $booking['time_category_id'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Booking</title>
    <link rel="stylesheet" href="../assets/css/booking-form.css">
</head>

<body>

    <div class="form-container">

        <form action="../../Model/database/booking-editdb.php" method="POST"
            onsubmit="return confirm('Are you sure you want to update booking information?');">
            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

            <h2>Edit Booking</h2>

            <!-- Service -->
            <div class="form-group">
                <label>Service</label>
                <select name="profession_id" required>
                    <option value="">Select Service</option>
                    <?php
                    $professionResult = mysqli_query($conn, "SELECT * FROM profession ORDER BY profession_name ASC");
                    while ($prof = mysqli_fetch_assoc($professionResult)) {
                        $selected = ($prof['profession_id'] == $booking['profession_id']) ? 'selected' : '';
                        echo "<option value='{$prof['profession_id']}' $selected>{$prof['profession_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Date -->
            <div class="form-group">
                <label>Preferred Date</label>
                <input type="date" name="date" value="<?= $booking['booking_date'] ?>" required>
            </div>

            <!-- Time Category -->
            <div class="form-group">
                <label>Time Category</label>
                <select id="timeCategory" required>
                    <option value="">Select Category</option>
                    <?php
                    $categories = mysqli_query($conn, "SELECT DISTINCT time_category FROM time_slots ORDER BY time_category ASC");
                    while ($cat = mysqli_fetch_assoc($categories)) {
                        $selected = ($cat['time_category'] == $booking['time_category']) ? 'selected' : '';
                        echo "<option value='{$cat['time_category']}' $selected>{$cat['time_category']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Start Time -->
            <div class="form-group">
                <label>Start Time</label>
                <select id="startTime" name="start_time" required>
                    <option value="">Select Start Time</option>
                    <?php
                    $slots = mysqli_query($conn, "SELECT id, start_time, ADDTIME(start_time, '01:00:00') AS end_time, time_category FROM time_slots ORDER BY start_time ASC");
                    while ($slot = mysqli_fetch_assoc($slots)) {
                        $selected = ($slot['id'] == $booking['time_slot_id']) ? 'selected' : '';
                        echo "<option value='{$slot['id']}' data-end='{$slot['end_time']}' data-category='{$slot['time_category']}' $selected>{$slot['start_time']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- End Time -->
            <div class="form-group">
                <label>End Time</label>
                <input type="text" id="endTime" value="<?= $booking['end_time'] ?>" readonly>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>

                <?php
                // Define all possible statuses
                $statuses = ["Pending", "Confirmed", "Completed", "Cancelled"];

                // Get the database value
                $dbStatus = $booking['status'];

                // Normalize it (trim spaces, make first letter uppercase)
                $currentStatus = ucfirst(trim(strtolower($dbStatus)));
                ?>

                <select name="status" required <?= ($currentStatus === "Completed") ? "disabled" : "" ?>>
                    <?php foreach ($statuses as $status): ?>
                        <option value="<?= $status ?>" <?= ($status === $currentStatus) ? "selected" : "" ?>>
                            <?= $status ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <?php if ($currentStatus === "Completed"): ?>
                    <input type="hidden" name="status" value="Completed">
                <?php endif; ?>
            </div>
            <button type="submit" class="booking-update">Update Booking</button>

        </form>

    </div>

    <script>
        const categorySelect = document.getElementById('timeCategory');
        const startSelect = document.getElementById('startTime');
        const endInput = document.getElementById('endTime');

        // Function to filter slots based on category
        function filterSlots(category) {

            Array.from(startSelect.options).forEach(option => {

                if (!option.value) return; // skip default option

                if (option.dataset.category === category) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }

            });

            // If current selected option doesn't match category, reset it
            const selectedOption = startSelect.selectedOptions[0];

            if (selectedOption && selectedOption.dataset.category !== category) {
                startSelect.value = '';
                endInput.value = '';
            }

            // Otherwise update end time correctly
            if (selectedOption && selectedOption.dataset.category === category) {
                endInput.value = selectedOption.dataset.end;
            }
        }

        // Run when category changes
        categorySelect.addEventListener('change', function () {
            filterSlots(this.value);
        });

        // Run automatically on page load (IMPORTANT FIX)
        window.addEventListener('DOMContentLoaded', function () {
            const currentCategory = categorySelect.value;
            if (currentCategory) {
                filterSlots(currentCategory);
            }
        });

        // Update end time when start time changes
        startSelect.addEventListener('change', function () {
            const selected = this.selectedOptions[0];
            endInput.value = selected ? selected.dataset.end : '';
        });

    </script>

</body>

</html>