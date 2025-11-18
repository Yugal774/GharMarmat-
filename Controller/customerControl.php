<?php
// Use absolute path to avoid confusion
$base_path = dirname(__DIR__); // Gets the GharMarmat directory
include $base_path . '/includes/dbconnect.php';

// SQL query
$sql = "SELECT id, name, email FROM customer_register"; 
$result = $conn->query($sql);

// store data in array
$users = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

return $users;
?>