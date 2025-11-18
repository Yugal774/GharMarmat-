<?php

include '../../includes/dbconnect.php';

$name = $email = $password = $confirmpassword = "";
$errors = [];

//taking input from form
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_btn'])) {

    $name = trim($_POST['fullname']);
    if ($name == "") {
        $errors['name'] = "Please enter your name.";
    } elseif (strlen($name) < 3) {
        $errors['name'] = "Fullname is too short.";
    }

    $email = trim($_POST['email']);
    if ($email == "") {
        $errors['email'] = "Please enter your email id.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email!";
    } 

    $password = trim($_POST['password']);
    $confirmpassword = trim($_POST['confirmpassword']);

    if ($password == "") {
        $errors['password'] = "Please enter your password.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    if ($confirmpassword == "") {
        $errors['confirmpassword'] = "Please enter confirm password.";
    } elseif ($confirmpassword != $password) {
        $errors['confirmpassword'] = "Passwords do not match.";
    }

    if (!empty($errors)) {
        foreach ($errors as $key => $error) {
            echo "<p>$error</p>";
        }
    }
}

//inserting data into database
if (empty($errors)) {
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $password = password_hash(password: $password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO customer_register (name, email, password) 
    VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Id created sucessfully.')</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}

?>