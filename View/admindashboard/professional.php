<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('location:../users/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
include '../../includes/dbconnect.php';

//Pagination setup
$limit = 10; // Users per page
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

//Fetch users with profession name 
$sql = "SELECT u.Id, u.Name, u.Contact, u.Gmail, u.Address, p.profession_name
        FROM users u
        LEFT JOIN profession p ON u.Profession = p.profession_id
        WHERE u.Role = 'professional'
        ORDER BY u.Id ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Store users in array
$professionals = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $professionals[] = $row;
    }
}

//Total users for pagination
$total_sql = "SELECT COUNT(*) AS total FROM users WHERE Role='professional'";
$total_result = $conn->query($total_sql);
$total_users = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_users / $limit);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" 
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/professional.css">
</head>

<body>
<div>
    <?php include '../../includes/dashboardnav.php'; ?>
</div>

<div class="professional-container">
    <div class="page-top">
        <div class="professional-icon">
            <i class="fa-solid fa-circle-user"></i>
            <p>Professional</p>
        </div>
        <div class="page-title">
            <p>Professional management</p>
        </div>
    </div>

    <div class="professional-content">
        <div class="content-top">
            <div class="search">
                <input type="search" placeholder="🔍 Search">
            </div>
            <div class="status">
                <select name="status" id="Status">
                    <option value="" disabled selected>Status</option>
                    <option value="Booked">Booked</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Cancelled</option>
                </select>
            </div>
            <div class="add-professional">
                <button onclick="window.location.href='../../View/users/professionalRegister.php'">
                    <i class="fa-solid fa-plus"></i> Add professional
                </button>
            </div>
        </div>

        <div class="professional-table">
            <table>
                <thead>
                    <tr id="heading">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Gmail</th>
                        <th>Address</th>
                        <th>Profession</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $id = $offset + 1; ?>
                    <?php if (!empty($professionals)): ?>
                        <?php foreach ($professionals as $professional): ?>
                            <tr>
                                <td><?php echo $id++; ?></td>
                                <td><?php echo htmlspecialchars($professional['Name']); ?></td>
                                <td><?php echo htmlspecialchars($professional['Contact']); ?></td>
                                <td><?php echo htmlspecialchars($professional['Gmail']); ?></td>
                                <td><?php echo htmlspecialchars($professional['Address']); ?></td>
                                <td><?php echo htmlspecialchars($professional['profession_name'] ?? ''); ?></td>
                                <td>
                                    <a href="../users/professionalEdit.php?id=<?php echo $professional['Id']; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="<?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>
