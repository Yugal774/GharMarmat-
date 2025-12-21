<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>elctrician</title>
    <link rel="stylesheet" href="../assets/css/book.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php
    include '../../includes/servicenav.php';

    include '../../includes/dbconnect.php';
    $professionId = $_GET['profession_id'];
    //profession part
    $professionQuery = "SELECT profession_name FROM profession WHERE profession_id = $professionId";
    $professionResult = mysqli_query($conn,$professionQuery);
    $profession = mysqli_fetch_assoc($professionResult);

    //work part
    $workQuery = "SELECT work_name, work_price FROM work WHERE profession_id = $professionId";
    $workResult = mysqli_query($conn,$workQuery);
    ?>

<h2><?php echo $profession['profession_name']; ?></h2>

<div class="work-container">
<?php while($work = mysqli_fetch_assoc($workResult)) { ?>
    <div class="work">
        <h4><?php echo $work['work_name']; ?></h4>
        <p>NPR <?php echo $work['work_price']; ?>/hour</p>
        <a href="book.php?profession_id=<?php echo $professionId; ?>&work=<?php echo urlencode($work['work_name']); ?>">Book</a>
    </div>
<?php } ?>
</div>
</body>

</html>