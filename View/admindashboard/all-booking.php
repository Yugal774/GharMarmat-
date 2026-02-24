<?php
include '../../includes/dbconnect.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../users/login.php');
    exit;
}

/* ---------------- PAGINATION SETTINGS ---------------- */

$limit = 10; // bookings per page

// get current page
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

if ($page < 1) {
    $page = 1;
}

// calculate offset
$offset = ($page - 1) * $limit;


/* ---------------- GET TOTAL BOOKINGS ---------------- */

$totalQuery = "SELECT COUNT(*) AS total FROM bookings";
$totalResult = mysqli_query($conn, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);

$totalBookings = $totalRow['total'];

// calculate total pages
$totalPages = ceil($totalBookings / $limit);


/* ---------------- FETCH BOOKINGS WITH LIMIT ---------------- */

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
LIMIT $limit OFFSET $offset
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>

<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>All Bookings</title>

</head>

<body>

    <div class="container mt-4">

        <h2>All Bookings</h2>

        <a href="dashboard.php" class="btn btn-secondary mb-3">← Back to Dashboard</a>

        <table class="table table-bordered table-striped">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Service</th>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

                <?php

                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {

                        $bookingDate = date('d M Y', strtotime($row['booking_date']));
                        ?>

                        <tr>

                            <td><?= $row['booking_id'] ?></td>

                            <td><?= $row['username'] ?></td>

                            <td><?= $row['profession_name'] ?></td>

                            <td><?= $bookingDate ?></td>

                            <td><?= $row['time_category'] ?></td>

                            <td>
                                <?= date('H:i', strtotime($row['start_time'])) ?>
                                -
                                <?= date('H:i', strtotime($row['end_time'])) ?>
                            </td>

                            <td>

                                <?php
                                if ($row['status'] == 'pending')
                                    echo "<span class='badge bg-warning'>Pending</span>";
                                elseif ($row['status'] == 'confirmed')
                                    echo "<span class='badge bg-success'>Confirmed</span>";
                                elseif ($row['status'] == 'completed')
                                    echo "<span class='badge bg-primary'>Completed</span>";
                                else
                                    echo "<span class='badge bg-danger'>Cancelled</span>";
                                ?>

                            </td>

                            <td>

                                <a href="edit-booking.php?id=<?= $row['booking_id'] ?>" class="btn btn-sm btn-primary">Edit</a>

                                <a href="delete-booking.php?id=<?= $row['booking_id'] ?>" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Delete booking?')">
                                    Delete
                                </a>

                            </td>

                        </tr>

                        <?php
                    }

                } else {

                    echo "<tr><td colspan='8'>No bookings found</td></tr>";

                }
                ?>

            </tbody>

        </table>


        <!-- PAGINATION -->

        <nav>

            <ul class="pagination">

                <?php if ($page > 1): ?>

                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            Previous
                        </a>
                    </li>

                <?php endif; ?>


                <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">

                        <a class="page-link" href="?page=<?= $i ?>">
                            <?= $i ?>
                        </a>

                    </li>

                <?php endfor; ?>


                <?php if ($page < $totalPages): ?>

                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            Next
                        </a>
                    </li>

                <?php endif; ?>


            </ul>

        </nav>


    </div>

</body>

</html>