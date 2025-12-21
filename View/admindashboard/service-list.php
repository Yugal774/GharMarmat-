<?php
include '../../includes/dbconnect.php'; // to connect database

// Fetch all professions
$professionQuery = "SELECT * FROM profession";
$professionResult = mysqli_query($conn, $professionQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Service Dashboard</title>
    <link rel="stylesheet" href="../assets/css/service-list.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="dashboard">

        <!-- Header section -->
        <div class="header">
            <h2>Services</h2>
            <a href="add-service.php" class="add-btn">
                <i class="fa-solid fa-plus"></i> Add Service
            </a>
        </div>

        <!-- Service displaying part -->
        <?php while ($profession = mysqli_fetch_assoc($professionResult)):
            // Fetch works for this profession
            $profession_id = $profession['profession_id'];
            $workQuery = "SELECT * FROM work WHERE profession_id = $profession_id";
            $workResult = mysqli_query($conn, $workQuery);
            ?>
            <div class="service-card">
                <div class="service-header">
                    <h4><?php echo htmlspecialchars($profession['profession_name']); ?></h4>
                    <div class="service-actions">
                        <a href="edit-service.php?id=<?php echo $profession_id; ?>" class="edit">
                            Edit
                        </a>
                        <a href="delete-service.php?id=<?php echo $profession_id; ?>" class="edit">
                            Delete
                        </a>
                    </div>
                </div>

                <!-- Work displaying part -->
                <table class="sub-services-table">
                    <thead>
                        <tr>
                            <th>Work</th>
                            <th>Price (NPR)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($workResult) > 0): ?>
                            <?php while ($work = mysqli_fetch_assoc($workResult)): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($work['work_name']); ?></td>
                                    <td><?php echo number_format($work['work_price'], 2); ?></td>
                                    <td>
                                        <?php
                                        echo '<a href="edit-work.php?id=' . $work['id'] . '" class="edit">Edit</a> ';
                                        echo '<a href="delete-work.php?id=' . $work['id'] . '" class="delete">Delete</a>';
                                        ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No works added yet</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                <a href="add-work.php?profession_id=<?php echo $profession_id; ?>" class="add-sub-service">
                    <i class="fa-solid fa-plus"></i> Add Work
                </a>

            </div>
        <?php endwhile; ?>

    </div>

</body>
</html>