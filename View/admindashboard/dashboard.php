<?php
include '../../includes/dbconnect.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../users/login.php');
    exit;
}

//Customers count
$customerQuery = "SELECT COUNT(*) AS total_customers FROM users WHERE role = 'customer'";
$customerResult = mysqli_query($conn, $customerQuery);
$customerCount = mysqli_fetch_assoc($customerResult)['total_customers'];


//Professional count
$professionalQuery = "SELECT COUNT(*) AS total_professionals FROM users where role = 'professional'";
$professionaResult = mysqli_query($conn, $professionalQuery);
$professionalCount = mysqli_fetch_assoc($professionaResult)['total_professionals'];

//pending booking
$pbookingQuerry = "SELECT COUNT(*) AS total_pbookings FROM bookings WHERE status = 'pending'";
$pbookingResult = mysqli_query($conn, $pbookingQuerry);
$pbookingCount = mysqli_fetch_assoc($pbookingResult)['total_pbookings'];

//confirmed booking
$cbookingQuerry = "SELECT COUNT(*) AS total_cbookings FROM bookings WHERE status = 'confirmed'";
$cbookingResult = mysqli_query($conn, $cbookingQuerry);
$cbookingCount = mysqli_fetch_assoc($cbookingResult)['total_cbookings'];

// Fetch recent bookings (latest 5)
// Fetch recent bookings
$query = "
    SELECT 
        bookings.booking_id,
        bookings.username,
        bookings.booking_date,
        bookings.status,
        profession.profession_name,
        time_slots.start_time,
        time_slots.end_time,
        time_slots.time_category
    FROM bookings
    LEFT JOIN profession 
        ON bookings.profession_id = profession.profession_id
    LEFT JOIN time_slots 
        ON bookings.time_slot_id = time_slots.id
    ORDER BY bookings.booking_date DESC
    LIMIT 5
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
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
                    <span><?= $customerCount; ?></span>
                    <p>Customers</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <div class="ser-provider" id="cont-box">
                <div class="data">
                    <span><?= $professionalCount ?></span>
                    <p>Service Providers</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                </div>
            </div>

            <div class="pending" id="cont-box">
                <div class="data">
                    <span><?= $pbookingCount ?></span>
                    <p>Pending Booking</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>

            <div class="Confirmed" id="cont-box">
                <div class="data">
                    <span><?= $cbookingCount ?></span>
                    <p>Confirmed Booking</p>
                </div>
                <div class="icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
        </div>

        <!-- Recent Bookings Table -->
        <div class="dash-data">
            <!-- Recent Bookings Table -->
            <div class="dash-data">
                <div class="recent-book">
                    <div class="top">
                        <h3>Recent Bookings</h3>
                        <a href="all-booking.php"><button class="btn btn-primary btn-sm">View All</button></a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Service</th>
                                <th>Booking Date</th>
                                <th>Time Category</th>
                                <th>Booking Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {

                                    // Format booking date
                                    $bookingDate = date('d M Y', strtotime($row['booking_date']));

                                    ?>

                                    <tr>
                                        <td><?= $row['booking_id']; ?></td>
                                        <td><?= $row['username']; ?></td>
                                        <td><?= $row['profession_name']; ?></td>
                                        <td><?=$bookingDate?></td>
                                        <td><?= $row['time_category'] ?></td>
                                        <td>
                                            <?=
                                                isset($row['start_time'])
                                                ? date('H:i', strtotime($row['start_time']))
                                                : '-';
                                            ?> -
                                            <?=
                                                isset($row['end_time'])
                                                ? date('H:i', strtotime($row['end_time']))
                                                : '-';
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($row['status'] == 'pending') {
                                                echo "<span class='badge bg-warning text-dark'>Pending</span>";
                                            } elseif ($row['status'] == 'confirmed') {
                                                echo "<span class='badge bg-success'>Confirmed</span>";
                                            } elseif ($row['status'] == 'completed') {
                                                echo "<span class='badge bg-primary'>Completed</span>";
                                            } elseif ($row['status'] == 'cancelled') {
                                                echo "<span class='badge bg-danger'>Cancelled</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button class="editButton">
                                                <a href="edit-booking.php?id=<?= $row['booking_id']; ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </button>
                                            <button class="deleteButton">
                                                <a href="delete-booking.php?id=<?= $row['booking_id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this booking?');">
                                                    <i class="fas fa-trash-can"></i>
                                                </a>
                                            </button>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No recent bookings found</td></tr>";
                            }
                            ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>