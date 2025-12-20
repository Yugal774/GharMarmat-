<?php
session_start();

include '../includes/dbconnect.php';

if (isset($_POST['login'])) {

    $username = trim($_POST['gmail']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE Gmail = '$username'";
    $data = mysqli_query($conn, $query);

    if (mysqli_num_rows($data) > 0) {

        $row = mysqli_fetch_assoc($data);
        $hashed_password = trim($row['Password']);
        $role = $row['Role'];

        if (password_verify($password, $hashed_password) && $role == 'admin') {

            // session values
            $_SESSION['username'] = $row['Gmail'];
            $_SESSION['role'] = $role;

            header('location:../View/admindashboard/dashboard.php');
            exit;

        } else {
            echo "<script>alert('Incorrect password or not admin');</script>";
        }

    } else {
        echo "<script>alert('User not found');</script>";
    }
}
?>
