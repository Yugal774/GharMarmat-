<?php
include '../../includes/dbconnect.php';

// Check work id
if (!isset($_GET['id']))
    exit("No work selected!");

$work_id = intval($_GET['id']);

// Delete work when clicking confirm
if (isset($_POST['delete_work'])) {
    $delete = "DELETE FROM work WHERE Id = $work_id";
    if (mysqli_query($conn, $delete)) {
        header("Location: service-list.php");
        exit;
    } else {
        $error = "Delete failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Work</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .box {
            background: #fff;
            width: 90vw;
            max-width: 26rem;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
            text-align: center;
        }

        h2 {
            margin-bottom: 1rem
        }

        .actions {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        button,
        a {
            flex: 1;
            padding: .75rem;
            border-radius: .5rem;
            font-size: 1rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            color: #fff;
        }

        .delete {
            background: rgb(55, 55, 195);
        }

        .delete:hover {
            background: blue;
        }

        .cancel {
            background: rgb(55, 55, 195);
        }

        .cancel:hover {
            background: blue;
        }

        .error {
            color: red;
            margin-top: .5rem;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2>Delete Work</h2>

        <p>Are you sure you want to delete this work?</p>

        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <form method="POST" class="actions">
            <button type="submit" name="delete_work" class="delete">Delete</button>
            <a href="service-list.php" class="cancel">Cancel</a>
        </form>
    </div>

</body>
</html>