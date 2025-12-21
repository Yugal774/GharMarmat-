<?php
include '../../includes/dbconnect.php'; // Connect to DB

// Check if service ID is provided
if (!isset($_GET['id']))
    exit("No service selected!");

$service_id = intval($_GET['id']);

// Handle deletion after confirmation
if (isset($_POST['confirm_delete'])) {
    $query = "DELETE FROM profession WHERE profession_id = $service_id";
    if (mysqli_query($conn, $query)) {
        header("Location: service-list.php");
        exit;
    } else {
        $error = "Error deleting service: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 3rem 4rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            width: 90vw;
            max-width: 25rem;
            text-align: center;
        }

        h2 {
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        p {
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        p.error {
            color: red;
        }

        form {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        button,
        .cancel {
            display: inline-block;
            padding: 1rem 2rem;
            margin: 0.5rem;
            font-size: 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            color: #fff;
            transition: 0.3s;
        }

        .confirm {
            background: rgb(55, 55, 195);
        }

        .confirm:hover {
            background: blue;
        }

        .cancel {
            background: rgb(55, 55, 195);
        }

        .cancel:hover {
            background: blue;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Delete Service</h2>
        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>
        <p>Are you sure you want to delete this service?</p>

        <form method="POST">
            <button type="submit" name="confirm_delete" class="confirm">Yes, Delete</button>
            <a href="service-list.php" class="cancel">Cancel</a>
        </form>
    </div>

</body>

</html>