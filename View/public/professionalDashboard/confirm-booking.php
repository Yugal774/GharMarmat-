<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/GharMarmat/includes/dbconnect.php';

// Check if logged in as professional
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'professional') {
    header('Location: ../../users/login.php');
    exit;
}

// Get professional info
$professional_gmail = $_SESSION['username'];
$prof_res = mysqli_query($conn, "SELECT id, name, Profession FROM users WHERE Gmail='$professional_gmail'");
$prof_row = mysqli_fetch_assoc($prof_res);
$professional_name = $prof_row ? $prof_row['name'] : '';
$professional_profession_id = $prof_row ? (int) $prof_row['Profession'] : 0;

// Handle Confirm form submission
if (isset($_POST['confirm_booking']) && isset($_POST['booking_id'])) {
    $booking_id = (int) $_POST['booking_id'];

    // Update booking with professional_name and status
    $stmt = $conn->prepare("UPDATE bookings SET status='confirmed', professional_name=? WHERE booking_id=? AND profession_id=?");
    $stmt->bind_param("sii", $professional_name, $booking_id, $professional_profession_id);
    $stmt->execute();
    $stmt->close();

    // Show simple success alert
    echo "<script>
    alert('Booking confirmed');
    window.location.href = 'professionaldashboard.php';
    </script>";
    exit;
}
?>