<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/GharMarmat/includes/dbconnect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header('location:../users/login.php');
    exit;
}

$username = $_SESSION['username'];

// Handle Cancel Booking submission
if (isset($_POST['cancel_booking'])) {
    $booking_id = intval($_POST['booking_id']);
    $update_query = "UPDATE bookings SET status='cancelled' WHERE booking_id = $booking_id";

    if (mysqli_query($conn, $update_query)) {
        // Redirect to refresh table after update
        header("Location: userdashboard.php");
        exit;
    } else {
        die("Error updating booking: " . mysqli_error($conn));
    }
}

// Fetch all bookings for the logged-in user
$booking_query = "SELECT * FROM bookings WHERE username = '$username' ORDER BY booking_date DESC";
$booking_result = mysqli_query($conn, $booking_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/userDashboard.css">
</head>
<body>
    <?php include '../../includes/navbar.php'; ?>

    <div class="header">
        <h1>My Bookings</h1>
        <button onclick="logout()">
            <a href="\GharMarmat\View\users\logout.php">Log Out</a>
        </button>
    </div>

    <div class="table-container">
        <table id="bookingTable">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Service</th>
                    <th>Profession</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Professional Contact</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = mysqli_fetch_assoc($booking_result)):

                    // Fetch work name
                    $work_result = mysqli_query($conn, "SELECT work_name FROM work WHERE work_id = '{$booking['work_id']}'");
                    $work_name = mysqli_fetch_assoc($work_result)['work_name'];

                    // Fetch profession name
                    $profession_result = mysqli_query($conn, "SELECT profession_name FROM profession WHERE profession_id = '{$booking['profession_id']}'");
                    $profession_name = mysqli_fetch_assoc($profession_result)['profession_name'];

                    // Fetch time slot
                    $time_result = mysqli_query($conn, "SELECT start_time, end_time FROM time_slots WHERE id = '{$booking['time_slot_id']}'");
                    $time_slot = mysqli_fetch_assoc($time_result);
                    $time_range = $time_slot['start_time'] . ' - ' . $time_slot['end_time'];

                    // Professional contact
                    $professional_contact = isset($booking['professional_id']) ? $booking['professional_id'] : '-';

                ?>
                    <tr>
                        <td><?= $booking['booking_id'] ?></td>
                        <td><?= $work_name ?></td>
                        <td><?= $profession_name ?></td>
                        <td><?= $booking['booking_date'] ?></td>
                        <td><?= $time_range ?></td>
                        <td><?= $professional_contact ?></td>
                        <td class="status-<?= strtolower($booking['status']) ?>"><?= ucfirst($booking['status']) ?></td>
                        <td>
                            <?php if (strtolower($booking['status']) == 'pending'): ?>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                    <button type="submit" name="cancel_booking" class="cancel-btn">Cancel</button>
                                </form>
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = "GharMarmat/View/public/index.php";
            }
        }
    </script>
</body>
</html>
