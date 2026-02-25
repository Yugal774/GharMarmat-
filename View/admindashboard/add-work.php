<?php
include '../../includes/dbconnect.php';

/* To fetch professions from profession table  */
$professionResult = mysqli_query($conn, "SELECT * FROM profession");

/* Handle form submit */
if (isset($_POST['add_work'])) {
    $work_name = trim(mysqli_real_escape_string($conn, $_POST['work_name']));
    $work_price = floatval($_POST['work_price']);
    $profession_id = intval($_POST['profession_id']);

    if ($work_name && $work_price > 0 && $profession_id) {
        $query = "INSERT INTO work (work_name, work_price, profession_id)
        VALUES ('$work_name', '$work_price', '$profession_id')";

        if (mysqli_query($conn, $query)) {
            header("Location: service-list.php");
            exit;
        } else {
            $error = "Something went wrong!";
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
    <title>Add Work</title>

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
            max-width: 28rem;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
        }

        h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input,
        select,
        button {
            padding: .75rem;
            font-size: 1rem;
            border-radius: .5rem;
            border: 1px solid #ccc;
        }

        button {
            cursor: pointer;
            background: #007bff;
            color: #fff;
            border: none;
            transition: 0.3s;
        }

        button:hover {
            background: #0056b3;
        }

        .error {
            color: red;
            text-align: center;
        }

        select {
            background: #fff;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2>Add Work</h2>

        <?php if (isset($error))
            echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <input type="text" name="work_name" placeholder="Work Name" required>

            <input type="number" name="work_price" step="0.01" placeholder="Price (NPR)" required>

            <?php
            // Get profession_id from URL safely
            $selected_profession_id = isset($_GET['profession_id']) ? intval($_GET['profession_id']) : 0;

            // Fetch the profession name from the database
            $professionName = '';
            if ($selected_profession_id) {
                $query = "SELECT profession_name FROM profession WHERE profession_id = $selected_profession_id";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $professionName = mysqli_fetch_assoc($result)['profession_name'];
                }
            }
            ?>

            <!-- Show profession name as readonly text -->
            <input type="text" value="<?= htmlspecialchars($professionName); ?>" readonly>

            <!-- Hidden input to submit the profession_id -->
            <input type="hidden" name="profession_id" value="<?= $selected_profession_id; ?>">

            <button type="submit" name="add_work">Add Work</button>
        </form>
    </div>

</body>

</html>