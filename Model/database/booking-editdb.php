<?php
include '../../includes/dbconnect.php';
session_start();

// Get POST data safely
$booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
$profession_id = isset($_POST['profession_id']) ? intval($_POST['profession_id']) : 0;
$booking_date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';
$time_slot_id = isset($_POST['start_time']) ? intval($_POST['start_time']) : 0;
$status = isset($_POST['status']) ? mysqli_real_escape_string($conn, $_POST['status']) : '';

// Validate all fields
if ($booking_id == 0 || $profession_id == 0 || $time_slot_id == 0 || empty($booking_date) || empty($status)) {
    echo "<script>
            alert('All fields are required!');
            window.history.back();
          </script>";
    exit;
}

// Update query
$query = "UPDATE bookings SET 
            profession_id = $profession_id,
            booking_date = '$booking_date',
            time_slot_id = $time_slot_id,
            status = '$status'
          WHERE booking_id = $booking_id";

// Execute update
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Booking updated successfully!');
            window.location.href = '../../View/admindashboard/dashboard.php';
          </script>";
} else {
    echo "<script>
            alert('Error updating booking: " . mysqli_error($conn) . "');
            window.history.back();
          </script>";
}
?>