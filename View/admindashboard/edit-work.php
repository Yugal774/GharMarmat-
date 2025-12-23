<?php
include '../../includes/dbconnect.php';

/* Check work id */
if (!isset($_GET['id'])) exit("No work selected!");

$work_id = intval($_GET['id']);

/* Fetch work */
$workQuery = "SELECT * FROM work WHERE work_id = $work_id";
$workResult = mysqli_query($conn, $workQuery);

if (mysqli_num_rows($workResult) == 0) exit("Work not found!");

$work = mysqli_fetch_assoc($workResult);

/* Fetch professions */
$professionResult = mysqli_query($conn, "SELECT * FROM profession");

/* Update work */
if (isset($_POST['update_work'])) {
    $work_name = trim(mysqli_real_escape_string($conn, $_POST['work_name']));
    $work_price = floatval($_POST['work_price']);
    $profession_id = intval($_POST['profession_id']);

    if ($work_name && $work_price > 0 && $profession_id) {
        $update = "UPDATE work 
                   SET work_name='$work_name',
                       work_price='$work_price',
                       profession_id='$profession_id'
                   WHERE work_id=$work_id";

        if (mysqli_query($conn, $update)) {
            header("Location: service-list.php");
            exit;
        } else {
            $error = "Update failed!";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Work</title>

<style>
body{
    margin:0;
    font-family:Arial, sans-serif;
    background:#f4f6f9;
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.box{
    background:#fff;
    width:90vw;
    max-width:28rem;
    padding:2rem;
    border-radius:1rem;
    box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
}

h2{
    text-align:center;
    margin-bottom:1.5rem;
}

form{
    display:flex;
    flex-direction:column;
    gap:1rem;
}

input,
select,
button{
    padding:.75rem;
    font-size:1rem;
    border-radius:.5rem;
    border:1px solid #ccc;
}

button{
    background: rgb(55, 55, 195);
    color:#fff;
    border:none;
    cursor:pointer;
}

button:hover{
    background: blue;
}

.error{
    color:red;
    text-align:center;
}
</style>
</head>

<body>

<div class="box">
    <h2>Edit Work</h2>

    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="POST">
        <input type="text" name="work_name"
               value="<?= htmlspecialchars($work['work_name']); ?>" required>

        <input type="number" name="work_price" step="0.01"
               value="<?= $work['work_price']; ?>" required>

        <select name="profession_id" required>
            <?php while($row = mysqli_fetch_assoc($professionResult)): ?>
                <option value="<?= $row['profession_id']; ?>"
                    <?= ($row['profession_id'] == $work['profession_id']) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($row['profession_name']); ?>
                </option>
            <?php endwhile; ?>
        </select>

        <button type="submit" name="update_work">Update Work</button>
    </form>
</div>

</body>
</html>