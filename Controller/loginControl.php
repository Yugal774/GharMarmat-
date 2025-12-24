<?php
session_start();
include '../includes/dbconnect.php';

if (isset($_POST['login'])) {

    $username = trim($_POST['gmail']);
    $password = trim($_POST['password']);

    // Query to fetch user
    $query = "SELECT * FROM users WHERE Gmail = '$username'";
    $data = mysqli_query($conn, $query);

    $login_failed = "<script>
                        alert('Invalid email or password');
                        window.location.href='../View/users/login.php';
                     </script>";

    if ($data && mysqli_num_rows($data) > 0) {

        $row = mysqli_fetch_assoc($data);
        $hashed_password = trim($row['Password']);
        $role = trim($row['Role']);

        if (password_verify($password, $hashed_password)) {

            // Password correct, set session
            $_SESSION['username'] = $row['Gmail'];
            $_SESSION['role'] = $role;

            // Redirect based on role
            if ($role == 'admin') {
                header('Location: ../View/admindashboard/dashboard.php');
            } elseif ($role == 'customer') {
                header('Location: ../View/userDashboard/userdashboard.php');
            } elseif ($role == 'professional') {
                header('Location: ../View/professionalDashboard/professionaldashboard.php');
            } else {
                // Unknown role
                echo $login_failed;
            }
            exit;

        } else {
            // Password incorrect
            echo $login_failed;
            exit;
        }

    } else {
        // User not found
        echo $login_failed;
        exit;
    }
}
?>
