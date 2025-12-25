<?php
session_start();

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../public/login.php");
    exit;
}

//Getting value form url.
$profession_id = $_GET['profession_id'];
$work_id = $_GET['work_id'];

// Get user_id from session.
$user_id = $_SESSION['user_id'];

echo '<pre>';
print_r($_SESSION);
echo '</pre>';
exit;
?>

