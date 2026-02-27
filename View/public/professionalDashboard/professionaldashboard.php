<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/GharMarmat/includes/dbconnect.php';

// Check if logged in as professional
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'professional') {
    header('Location: ../../users/login.php');
    exit;
}

$professional_gmail = $_SESSION['username'];

// Get professional's profession ID
$prof_res = mysqli_query($conn, "SELECT Profession FROM users WHERE Gmail='$professional_gmail'");
$prof_row = mysqli_fetch_assoc($prof_res);
$professional_profession_id = $prof_row ? (int) $prof_row['Profession'] : 0;

// Handle AJAX Confirm request
if (isset($_POST['action']) && $_POST['action'] === 'confirm' && isset($_POST['booking_id'])) {
    $booking_id = (int) $_POST['booking_id'];

    // Update booking status to confirmed
    $update_res = mysqli_query($conn, "UPDATE bookings 
        SET status='confirmed' 
        WHERE booking_id=$booking_id AND profession_id=$professional_profession_id");

    if ($update_res) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}

// Fetch all bookings for this professional
$booking_res = mysqli_query($conn, "SELECT * FROM bookings WHERE profession_id='$professional_profession_id' ORDER BY booking_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Dashboard</title>
    <link rel="stylesheet" href="\GharMarmat\View\assets\css\professionaldashboard.css">
    <style>
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/GharMarmat/includes/navbar.php'; ?>

    <div class="header">
        <h1>My Bookings Information</h1>
        <button onclick="logout()">Log Out</button>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Gmail</th>
                    <th>Contact No</th>
                    <th>Booking Date</th>
                    <th>Time Category</th>
                    <th>Time Slot</th>
                    <th>Profession Name</th>
                    <th>Work Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($booking = mysqli_fetch_assoc($booking_res)): ?>
                    <?php
                    // Customer info
                    $customer_res = mysqli_query($conn, "SELECT * FROM users WHERE Gmail='{$booking['username']}'");
                    $customer = mysqli_fetch_assoc($customer_res);
                    if (!$customer)
                        continue;

                    // Profession
                    $profession_res = mysqli_query($conn, "SELECT profession_name FROM profession WHERE profession_id='{$booking['profession_id']}'");
                    $profession_row = mysqli_fetch_assoc($profession_res);
                    $profession_name = $profession_row ? $profession_row['profession_name'] : 'N/A';

                    // Work info
                    $work_res = mysqli_query($conn, "SELECT work_name, work_price FROM work WHERE work_id='{$booking['work_id']}'");
                    $work_row = mysqli_fetch_assoc($work_res);
                    $work_name = $work_row ? $work_row['work_name'] : 'N/A';
                    $price = $work_row ? $work_row['work_price'] : 'N/A';

                    // Time slot info
                    $time_res = mysqli_query($conn, "SELECT start_time, end_time, time_category FROM time_slots WHERE id='{$booking['time_slot_id']}'");
                    $time_row = mysqli_fetch_assoc($time_res);
                    $time_category = $time_row ? $time_row['time_category'] : 'N/A';
                    $time_range = $time_row ? $time_row['start_time'] . ' - ' . $time_row['end_time'] : 'N/A';
                    ?>
                    <tr id="row-<?= $booking['booking_id'] ?>">
                        <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                        <td><?= htmlspecialchars($customer['Gmail']) ?></td>
                        <td><?= htmlspecialchars($customer['Contact']) ?></td>
                        <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                        <td><?= htmlspecialchars($time_category) ?></td>
                        <td><?= htmlspecialchars($time_range) ?></td>
                        <td><?= htmlspecialchars($profession_name) ?></td>
                        <td><?= htmlspecialchars($work_name) ?></td>
                        <td><?= htmlspecialchars($price) ?></td>
                        <td class="status" id="status-<?= $booking['booking_id'] ?>"><?= ucfirst($booking['status']) ?></td>
                        <td>
                            <?php if ($booking['status'] !== 'confirmed'): ?>
                                <form method="post" action="confirm-booking.php">
                                    <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
                                    <button type="submit" name="confirm_booking">Confirm</button>
                                </form>
                            <?php else: ?>
                                Confirmed
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
                window.location.href = "../../users/logout.php";
            }
        }

        function confirmBooking(bookingId) {
            if (!confirm('Are you sure you want to confirm this booking?')) return;

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.responseText.trim() === 'success') {
                    // Update status text
                    const statusCell = document.getElementById('status-' + bookingId);
                    statusCell.textContent = 'Confirmed';
                    statusCell.className = 'status status-confirmed';

                    // Hide the Confirm button
                    const row = document.getElementById('row-' + bookingId);
                    const button = row.querySelector('.action-btn');
                    if (button) button.style.display = 'none';

                    // Optional: show JS alert
                    alert('Booking confirmed successfully');
                } else {
                    alert('Something went wrong!');
                }
            };
            xhr.send('action=confirm&booking_id=' + bookingId);
        }
    </script>

</body>

</html>