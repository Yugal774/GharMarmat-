<?php
session_start();

// Check if user is logged in and role is customer
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
    <title>Electrician</title>
    <!-- Link to external CSS -->
    <link rel="stylesheet" href="../assets/css/book.css">
</head>

<body>

    <?php
    include '../../includes/servicenav.php';
    include '../../includes/dbconnect.php';

    $professionId = isset($_GET['profession_id']) ? intval($_GET['profession_id']) : 0;

    // Get profession name
    $professionQuery = "SELECT profession_name FROM profession WHERE profession_id = $professionId";
    $professionResult = mysqli_query($conn, $professionQuery);
    $profession = mysqli_fetch_assoc($professionResult);

    // Get works for this profession
    $workQuery = "SELECT work_id, work_name, work_price FROM work WHERE profession_id = $professionId";
    $workResult = mysqli_query($conn, $workQuery);
    ?>

    <!-- Heading with profession name -->
    <h2><?php echo htmlspecialchars($profession['profession_name']); ?></h2>

    <!-- Work cards -->
    <div class="work-container">
        <?php while ($work = mysqli_fetch_assoc($workResult)) { ?>
            <div class="work">
                <h4><?php echo htmlspecialchars($work['work_name']); ?></h4>
                <p>NPR <?php echo htmlspecialchars($work['work_price']); ?>/hour</p>
                <a href="booking-form.php?profession_id=<?php echo $professionId; ?>&work_id=<?php echo $work['work_id']; ?>">Book</a>
            </div>
        <?php } ?>
    </div>

    <!-- Back arrow at bottom -->
    <div class="back-container">
        <a href="javascript:history.back()" class="back-arrow">← Back</a>
    </div>

</body>

</html>