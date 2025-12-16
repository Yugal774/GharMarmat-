<?php
// Use absolute path to avoid confusion
$base_path = dirname(__DIR__); // Gets the GharMarmat directory
include $base_path . '/includes/dbconnect.php';

// SQL query
$sql = "SELECT Id, Name, Gmail FROM users WHERE Role='customer'"; 
$result = $conn->query($sql);

// store data in array
$customers = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

return $customers;
?>