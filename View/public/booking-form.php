<?php
include '../../includes/dbconnect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../public/login.php");
    exit;
}

$profession_id = $_GET['profession_id'] ?? '';
$work_id = $_GET['work_id'] ?? '';
$username = $_SESSION['username'];

/* Fetch time slots grouped by category */
$timeSlots = [];
$query = "
    SELECT 
        ts.start_time,
        ts.end_time,
        tc.name AS category_name
    FROM time_slots ts
    JOIN time_categories tc ON ts.time_category = tc.id
    ORDER BY tc.id, ts.start_time ASC
";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $cat = $row['category_name'];

    if (!isset($timeSlots[$cat])) {
        $timeSlots[$cat] = [];
    }

    $start = substr($row['start_time'], 0, 5);
    $end = substr($row['end_time'], 0, 5);

    $timeSlots[$cat][$start] = $end;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Service Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/booking-form.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <div class="form-container">
        <form action="../../Model/database/serviceBooking.php" method="POST" onsubmit="return validateForm()">
            <h2>Book a Home Service</h2>

            <input type="hidden" name="profession_id" value="<?= htmlspecialchars($profession_id) ?>">
            <input type="hidden" name="work_id" value="<?= htmlspecialchars($work_id) ?>">
            <input type="hidden" name="username" value="<?= htmlspecialchars($username) ?>">

            <div class="form-group">
                <label for="date">Preferred Date</label>
                <input type="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="timeCategory">Time Category</label>
                <select id="timeCategory" name="timeCategory" required>
                    <option value="">Select</option>
                    <?php
                    $catQuery = "SELECT name FROM time_categories ORDER BY id ASC";
                    $catResult = mysqli_query($conn, $catQuery);
                    while ($row = mysqli_fetch_assoc($catResult)) {
                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="startTime">Start Time</label>
                <select id="startTime" name="start_time" required>
                    <option value="">Select Start Time</option>
                    <?php
                    foreach ($timeSlots as $cat => $slots) {
                        foreach ($slots as $start => $end) {
                            echo "<option class='slot_$cat' value='$start' style='display:none'>$start</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="endTime">End Time</label>
                <input type="text" id="endTime" name="end_time" readonly required>
            </div>

            <div class="form-group">
                <label for="servAddress">Service Address</label>
                <textarea name="servAddress" required></textarea>
            </div>

            <div class="form-group">
                <label for="note">Additional Notes</label>
                <textarea name="note"></textarea>
            </div>

            <div class="form-group" id="book">
                <a href=""><button type="submit">Book Now</button></a>
            </div>
        </form>
    </div>

    <script>
        const categorySelect = document.getElementById('timeCategory');
        const startSelect = document.getElementById('startTime');
        const endInput = document.getElementById('endTime');
        const form = document.querySelector('form');
        const dateInput = document.querySelector('input[name="date"]');
        const addressInput = document.querySelector('textarea[name="servAddress"]');

        /* End time map from PHP */
        const endTimes = {};
        <?php
        foreach ($timeSlots as $cat => $slots) {
            foreach ($slots as $start => $end) {
                echo "endTimes['$cat|$start'] = '$end';\n";
            }
        }
        ?>

        categorySelect.addEventListener('change', () => {
            const cat = categorySelect.value;

            [...startSelect.options].forEach(opt => {
                if (!opt.value) return;
                opt.style.display = opt.classList.contains('slot_' + cat) ? 'block' : 'none';
            });

            startSelect.value = '';
            endInput.value = '';
        });

        startSelect.addEventListener('change', () => {
            const key = categorySelect.value + '|' + startSelect.value;
            endInput.value = endTimes[key] || '';
        });

        // --------- Standard form validation with address length ---------
        form.onsubmit = function () {
            const today = new Date();
            const selectedDate = new Date(dateInput.value);

            // Date validation
            if (!dateInput.value) {
                alert('Please select a preferred date.');
                dateInput.focus();
                return false;
            }
            if (selectedDate < today.setHours(0, 0, 0, 0)) {
                alert('Selected date cannot be in the past.');
                dateInput.focus();
                return false;
            }

            // Time Category validation
            if (!categorySelect.value) {
                alert('Please select a time category.');
                categorySelect.focus();
                return false;
            }

            // Start Time validation
            if (!startSelect.value) {
                alert('Please select a start time.');
                startSelect.focus();
                return false;
            }

            // End Time validation
            if (!endInput.value) {
                alert('End time is missing. Please select start time again.');
                startSelect.focus();
                return false;
            }

            // Service Address validation: at least 30 characters
            if (!addressInput.value.trim()) {
                alert('Please enter the service address.');
                addressInput.focus();
                return false;
            }
            if (addressInput.value.trim().length < 15) {
                alert("Please enter a complete address.\nExample:House No. 45, Bishnudevi, Kathmandu");
                addressInput.focus();
                return false;
            }

            return true;
        };
    </script>

</body>

</html>