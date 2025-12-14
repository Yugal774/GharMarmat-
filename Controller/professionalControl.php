<?php
$base_path = dirname(__DIR__); // GharMarmat directory
include $base_path . '/includes/dbconnect.php';

$sql = "SELECT 
            u.Id,
            u.Name,
            u.Contact,
            u.Gmail,
            u.Address,
            p.profession_name
        FROM users u
        LEFT JOIN profession p
        ON u.Profession = p.profession_id
        WHERE u.Role = 'professional'";

$result = $conn->query($sql);

$professionals = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $professionals[] = $row;
    }
}

return $professionals;
?>
