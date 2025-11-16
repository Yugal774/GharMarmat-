<?php
include '../includes/dbconnect.php';

// SQL query
$sql = "SELECT id, name, email FROM user"; 
$result = $conn->query($sql);

// store data in array
$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

return $users;
?>
