<!-- add-service.php -->
<?php include '../../includes/dbconnect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 5vh;
        }

        .container {
            background: #fff;
            padding: 3rem 4rem;
            border-radius: 1.2rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1);
            width: 25rem;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            font-size: 1rem;
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border-radius: 0.8rem;
            border: 0.1rem solid #ccc;
            margin-bottom: 1.5rem;
            box-sizing: border-box;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 1rem;
            background: rgb(55, 55, 195);
            color: white;
            font-size: 1rem;
            border: none;
            border-radius: 0.8rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: blue;
        }

        p {
            text-align: center;
            font-weight: bold;
            margin-top: 1rem;
            font-size: 1rem;
        }

        p.success {
            color: green;
        }

        p.error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Add New Service</h2>

        <form action="add-service.php" method="POST">
            <label for="service_name">Service Name:</label>
            <input type="text" name="service_name" id="service_name" placeholder="Enter service name" required>
            <button type="submit" name="add_service">Add Service</button>
            
            <?php
            include '../../includes/dbconnect.php';

            if (isset($_POST['add_service'])) {

                $service_name = trim($_POST['service_name']);

                if (empty($service_name)) {
                    echo "<script>
                alert('Please enter a service name.');
                window.history.back();
              </script>";
                    exit;
                }

                $service_name = mysqli_real_escape_string($conn, $service_name);

                // Check duplicate (case-insensitive)
                $checkQuery = "SELECT COUNT(*) AS total 
                   FROM profession 
                   WHERE LOWER(profession_name) = LOWER('$service_name')";

                $checkResult = mysqli_query($conn, $checkQuery);
                $row = mysqli_fetch_assoc($checkResult);

                if ($row['total'] > 0) {

                    echo "<script>
                alert('Service already exists!');
                window.history.back();
              </script>";
                    exit;

                } else {

                    $insertQuery = "INSERT INTO profession (profession_name) 
                        VALUES ('$service_name')";

                    if (mysqli_query($conn, $insertQuery)) {

                        echo "<script>
                    alert('Service added successfully!');
                    window.location.href='service-list.php';
                  </script>";
                        exit;

                    } else {

                        echo "<script>
                    alert('Error: " . mysqli_error($conn) . "');
                    window.history.back();
                  </script>";
                        exit;
                    }
                }
            }
            ?>


    </div>

</body>

</html>