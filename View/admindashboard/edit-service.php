<?php
include '../../includes/dbconnect.php';

if (!isset($_GET['id']))
    exit("No service selected!");

$service_id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM profession WHERE profession_id = $service_id");
if (mysqli_num_rows($result) == 0)
    exit("Service not found!");

$service = mysqli_fetch_assoc($result);

if (isset($_POST['update_service'])) {
    $service_name = trim(mysqli_real_escape_string($conn, $_POST['service_name']));
    if ($service_name) {
        mysqli_query($conn, "UPDATE profession SET profession_name='$service_name' WHERE profession_id=$service_id");
        header("Location: service-list.php");
        exit;
    } else
        $error = "Service name cannot be empty.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding-top: 5vh;
            margin: 0;
        }

        .container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            width: 90vw;
            max-width: 25rem;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1rem;
            font-size: 2rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.5rem;
            border: 0.1rem solid #ccc;
            margin-bottom: 1.5rem;
            font-size: 1rem;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: rgb(55, 55, 195);
            color: #fff;
            font-size: 1rem;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: blue;
        }

        p {
            text-align: center;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        p.error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Edit Service</h2>

        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <label for="service_name">Service Name:</label>
            <input type="text" id="service_name" name="service_name"
                value="<?php echo htmlspecialchars($service['profession_name']); ?>" required>
            <button type="submit" name="update_service">Update Service</button>
        </form>
    </div>

</body>

</html>