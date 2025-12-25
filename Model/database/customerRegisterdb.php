<?php
include '../../includes/dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_btn'])) {

    $id = $_POST['id'] ?? ''; 

    // Trim and get input values
    $name = trim($_POST['fullname']);
    $contact = trim($_POST['contact']);
    $gmail = trim($_POST['email']);
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['confirmpassword']);
    $role = $_POST['role'];

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
    } elseif (strlen($address) < 5) {
        $errors[] = "Address is too short.";
    }

    // Password validation
    if (empty($id)) { // for new customer
        if ($password == "") {
            $errors[] = "Please enter a password.";
        }
    }

    if (!empty($password)) {
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters long!";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must contain at least one uppercase letter!";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Password must contain at least one lowercase letter!";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Password must contain at least one number!";
        }
        if (!preg_match("/[\W]/", $password)) {
            $errors[] = "Password must contain at least one special character!";
        }

        // Confirm password
        if ($cpassword == "") {
            $errors[] = "Please enter confirm password.";
        } elseif ($cpassword != $password) {
            $errors[] = "Confirm password must match password.";
        }
    }

    // Display errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<script>alert('Error: " . $error . "');</script>";
        }
        exit;
    }

    // For insertion of new customer
    if (empty($id)) {

        $check_sql = "SELECT * FROM users WHERE Gmail='$gmail' OR Contact='$contact'";
        $check_result = $conn->query($check_sql);

        if ($check_result && $check_result->num_rows > 0) {
            echo "<script>
                alert('User with this Gmail or Contact already exists.');
                window.location.href='../../View/users/customerRegister.php';
            </script>";
            exit;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (Name, Contact, Gmail, Address, Password, Profession, Role)
                VALUES ('$name', '$contact', '$gmail', '$address', '$password', NULL, '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Id created successfully');
                window.location.href='../../View/public/index.php';
            </script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }

    } else { // Update existing customer

        $sql = "UPDATE users SET
            Name='$name',
            Contact='$contact',
            Gmail='$gmail',
            Address='$address'";

        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $sql .= ", Password='$password'";
        }

        $sql .= " WHERE Id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Information updated successfully');
                window.location.href='../../View/admindashboard/customer.php';
            </script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
}
?>