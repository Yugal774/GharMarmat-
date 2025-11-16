<?php
include '../../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $gmail = trim($_POST['gmail']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['Cpassword']);
    $profession = $_POST['profession'] ?? '';

    $errors = [];

    // Name validation
    if ($name == "") {
        $errors[] = "Please enter your name.";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name is too short.";
    }

    // Contact validation
    if ($contact == "") {
        $errors[] = "Please enter your contact number.";
    } elseif (!is_numeric($contact) || strlen($contact) != 10) {
        $errors[] = "Contact number must be 10 digits.";
    }

    // Gmail validation
    if ($gmail == "") {
        $errors[] = "Please enter your Gmail ID.";
    } elseif (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format!";
    } elseif (!preg_match("/@gmail\.com$/", $gmail)) {
        $errors[] = "Email must be a Gmail address!";
    }

    // Address validation
    if ($address == "") {
        $errors[] = "Please enter your address.";
    }

    // Password validation
    if ($password == "") {
        $errors[] = "Please enter a password.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long!";
    } elseif (!preg_match("/[A-Z]/", $password)) {
        $errors[] = "Password must contain at least one uppercase letter!";
    } elseif (!preg_match("/[a-z]/", $password)) {
        $errors[] = "Password must contain at least one lowercase letter!";
    } elseif (!preg_match("/[0-9]/", $password)) {
        $errors[] = "Password must contain at least one number!";
    } elseif (!preg_match("/[\W]/", $password)) {
        $errors[] = "Password must contain at least one special character!";
    }

    // Confirm password
    if ($cpassword == "") {
        $errors[] = "Please enter confirm password.";
    } elseif ($cpassword != $password) {
        $errors[] = "Confirm password must match password.";
    }

    // Profession validation
    if ($profession == "") {
        $errors[] = "Please select your profession.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('Error: " . $error . "');</script>";
        }
        exit;
    }

    // Hash password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO professional_register(Name, Contact, Gmail, Address, Password, Profession)
    VALUES('$name', '$contact', '$gmail', '$address', '$password', '$profession')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('ID created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
    $conn->close();
}
?>