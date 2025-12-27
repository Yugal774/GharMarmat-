<?php
include '../../includes/dbconnect.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../public/login.php");
    exit;
}

// Get form data and trim
$username        = trim($_POST['username'] ?? '');
$profession_id   = trim($_POST['profession_id'] ?? '');
$work_id         = trim($_POST['work_id'] ?? '');
$booking_date    = trim($_POST['date'] ?? '');
$category        = trim($_POST['timeCategory'] ?? '');
$start_time      = trim($_POST['start_time'] ?? '');
$end_time        = trim($_POST['end_time'] ?? '');
$service_address = trim($_POST['servAddress'] ?? '');
$notes           = trim($_POST['note'] ?? '');

// Backend validation
$errors = [];

if (empty($username)) $errors[] = "Username is required.";
if (empty($profession_id)) $errors[] = "Profession ID is required.";
if (empty($work_id)) $errors[] = "Work ID is required.";
if (empty($booking_date)) $errors[] = "Booking date is required.";
if (empty($category)) $errors[] = "Time category is required.";
if (empty($start_time) || empty($end_time)) $errors[] = "Start and End time are required.";
if (empty($service_address)) $errors[] = "Service address is required.";
if (strlen($service_address) < 15) $errors[] = "Add complete address.";


if (!empty($errors)) {
    echo "<script>";
    foreach ($errors as $err) {
        $err = addslashes($err);
        echo "alert('{$err}');";
    }
    echo "window.location.href = '../public/book.php';";
    echo "</script>";
    exit;
}


// Convert start and end time to HH:MM:SS
$start_time_db = $start_time . ":00";
$end_time_db   = $end_time . ":00";

// Get time_slot_id from time_slots table
$timeSlotQuery = "SELECT id FROM time_slots WHERE time_category='$category' AND start_time='$start_time_db' AND end_time='$end_time_db' LIMIT 1";
$timeSlotResult = mysqli_query($conn, $timeSlotQuery);

if ($timeSlotResult && mysqli_num_rows($timeSlotResult) > 0) {
    $timeSlotRow = mysqli_fetch_assoc($timeSlotResult);
    $time_slot_id = $timeSlotRow['id'];
} else {
    die("Selected time slot is invalid. Please try again.");
}

// Check if the same user has already booked this service at this date and time slot
$checkQuery = "
    SELECT * FROM bookings 
    WHERE username='$username' 
      AND profession_id='$profession_id' 
      AND booking_date='$booking_date' 
      AND time_slot_id='$time_slot_id'
    LIMIT 1
";

$checkResult = mysqli_query($conn, $checkQuery);

if ($checkResult && mysqli_num_rows($checkResult) > 0) {
    echo "<script>
        alert('You have already booked this service at the selected date and time slot.');
        window.location.href = '../../public/booking-form.php';
    </script>";
    exit;
}


// Set default status
$status = 'pending';

// Insert booking into booking table
$insertQuery = "
    INSERT INTO bookings (username, profession_id, work_id, booking_date, time_slot_id, service_address, notes, status)
    VALUES ('$username', '$profession_id', '$work_id', '$booking_date', '$time_slot_id', '$service_address', '$notes', '$status')
";

if (mysqli_query($conn, $insertQuery)) {
    echo "<script>
        alert('Service booking requested. Your booking has been submitted successfully!');
        window.location.href = '../../View/public/index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: " . addslashes(mysqli_error($conn)) . "');
        window.location.href = '../../View/public/index.php';
    </script>";
}


?>
