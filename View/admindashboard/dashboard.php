<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../users/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dashboard.css">

    <title>Admin Dashboard</title>
</head>

<body>

    <div>
        <?php include '../../includes/dashboardnav.php'; ?>
    </div>

    <div class="dashboard">

        <!-- Top Bar -->
        <div class="top-bar">
            <div class="search-bar">
                <input type="search" placeholder="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>

            <div class="top-right">
                <span class="me-2 fw-bold">
                    100
                </span>
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-circle-user"></i>
            </div>
        </div>

        <div class="content">
            <div class="customers" id="cont-box">
                <div class="data">
                    <span>1000</span>
                    <p>Customers</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="ser-provider" id="cont-box">
                <div class="data">
                    <span>100</span>
                    <p>Service Providers</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
            </div>

            <div class="bookings" id="cont-box">
                <div class="data">
                    <span>100</span>
                    <p>Bookings</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-calendar-days"></i>
                </div>
            </div>

            <div class="income" id="cont-box">
                <div class="data">
                    <span>$1000</span>
                    <p>Total Income</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="dash-data">
            <div class="recent-book">
                <div class="top">
                    <h3>Recent Bookings</h3>
                    <button class="btn btn-primary btn-sm">View All</button>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Booking Date</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Yugal</td>
                            <td>2025/07/15</td>
                            <td>Plumber</td>
                            <td>$1000</td>
                            <td>Pending</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Yugal</td>
                            <td>2025/07/15</td>
                            <td>Electrician</td>
                            <td>$500</td>
                            <td>Completed</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
