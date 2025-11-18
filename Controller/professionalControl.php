<?php
// Use absolute path to avoid confusion
$base_path = dirname(__DIR__); // Gets the GharMarmat directory
include $base_path . '/includes/dbconnect.php';

// SQL query
$sql = "SELECT id, name, contact, gmail, address, profession FROM professional_register"; 
$result = $conn->query($sql);

// store data in array
$professionals = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $professionals[] = $row;
    }
}

return $professionals;
?>