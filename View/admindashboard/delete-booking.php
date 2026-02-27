<?php
include '../../includes/dbconnect.php';
session_start();

// Get booking id safely
$booking_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if valid ID
if ($booking_id == 0) {
    echo "Invalid booking ID";
    exit;
}

// Check if the booking exists
$check = mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id = $booking_id");
if (mysqli_num_rows($check) == 0) {
    echo "Booking not found";
    exit;
}

// Delete the booking
$delete = mysqli_query($conn, "DELETE FROM bookings WHERE booking_id = $booking_id");

if ($delete) {
    // Redirect back to bookings page with a success message
    header("Location: dashboard.php?msg=Booking deleted successfully");
    exit;
} else {
    echo "Error deleting booking: " . mysqli_error($conn);
}
?>