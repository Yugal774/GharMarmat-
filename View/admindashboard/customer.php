<!DOCTYPE html>
<html lang="en">
<?php
include '../../includes/dbconnect.php';

// Pagination setup
$limit = 10; // customers per page
$page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Fetch customers
$sql = "SELECT Id, Name, Gmail 
        FROM users 
        WHERE Role = 'customer'
        ORDER BY Id ASC
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

// Store customers in array
$customers = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
}

// Total customers for pagination
$total_sql = "SELECT COUNT(*) AS total FROM users WHERE Role='customer'";
$total_result = $conn->query($total_sql);
$total_customers = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_customers / $limit);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/customer.css">
</head>

<body>
<div>
    <?php include '../../includes/dashboardnav.php'; ?>
</div>

<div class="user-container">
    <div class="page-top">
        <div class="user-icon">
            <i class="fa-solid fa-circle-user"></i>
            <p>Customer</p>
        </div>
        <div class="page-title">
            <p>Customer management</p>
        </div>
    </div>

    <div class="user-content">
        <div class="content-top">
            <div class="search">
                <input type="search" placeholder="🔍 Search">
            </div>

            <div class="status">
                <select>
                    <option disabled selected>Status</option>
                    <option>Active</option>
                    <option>Blocked</option>
                </select>
            </div>

            <div class="add-user">
                <button onclick="window.location.href='../../View/users/customerRegister.php'">
                    <i class="fa-solid fa-plus"></i> Add Customer
                </button>
            </div>
        </div>

        <div class="user-table">
            <table>
                <thead>
                    <tr id="heading">
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php $id = $offset + 1; ?>
                <?php if (!empty($customers)): ?>
                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo $id++; ?></td>
                            <td><?= htmlspecialchars($customer['Name']); ?></td>
                            <td><?= htmlspecialchars($customer['Gmail']); ?></td>
                            <td>
                                <a href="../users/customeredit.php?id=<?= $customer['Id']; ?>">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No customers found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?= $page - 1 ?>">&laquo; Prev</a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>
</body>
</html>
