<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'customer') {
    header('location:../users/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/userDashboard.css" </head>

<body>

    <div class="header">
        <h1>My Bookings</h1>
        <button onclick="logout()"> <a href="\GharMarmat\View\users\logout.php">
                Log Out
            </a></button>
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
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Basic Service</td>
                    <td>Electrician</td>
                    <td>2025-12-25</td>
                    <td>10:00 - 11:00</td>
                    <td class="status-pending">Pending</td>
                    <td><button class="cancel-btn" onclick="cancelBooking(this)">Cancel</button></td>
                </tr>
                <tr>
                    <td>002</td>
                    <td>Premium Service</td>
                    <td>Plumber</td>
                    <td>2025-12-26</td>
                    <td>12:00 - 13:00</td>
                    <td class="status-pending">Pending</td>
                    <td><button class="cancel-btn" onclick="cancelBooking(this)">Cancel</button></td>
                </tr>
                <tr>
                    <td>003</td>
                    <td>Emergency Service</td>
                    <td>Carpenter</td>
                    <td>2025-12-27</td>
                    <td>15:00 - 16:00</td>
                    <td class="status-completed">Completed</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                window.location.href = "GharMarmat/View/public/index.php";
            } else {
                
            }

        }

        function cancelBooking(button) {
            const row = button.parentElement.parentElement;
            const statusCell = row.querySelector('td:nth-child(6)');

            if (statusCell.classList.contains('status-completed') || statusCell.classList.contains('status-cancelled')) {
                alert("This booking cannot be cancelled!");
                return;
            }

            if (confirm("Are you sure you want to cancel this booking?")) {
                statusCell.textContent = "Cancelled";
                statusCell.className = "status-cancelled";
                button.remove();
            }
        }
    </script>

</body>

</html>