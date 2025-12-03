<!DOCTYPE html>
<html lang="en">
<?php 
// Include and capture the returned users array
$users = include '../../Controller/customerControl.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/customer.css">
</head>

<div>
    <?php include '../../includes/dashboardnav.php' ?>
</div>

<body>
    <div class="user-container">
        <div class="page-top">
            <div class="user-icon">
                <i class="fa-solid fa-circle-user"></i>
                <p> Customer</p>
            </div>
            <div class="page-title">
                <p>Customer management</p>
            </div>
        </div>

        <div class="user-content">
            <div class="content-top">
                <div class="search">
                    <input type="search" placeholder="🔍search">
                </div>
                <div class="status">
                    <select name="status" id="Status">
                        <option value="" disabled selected>Status</option>
                        <option value="Booked">Booked</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Cancelled</option>
                    </select>
                </div>
                <div class="add-user">
                    <button onclick="window.location.href='../../View/users/customerRegister.php'"><i class="fa-solid fa-plus"></i>Add Customer</button>
                </div>
            </div>

            <div class="user-table">
                <table>
                    <thead>
                        <tr id="heading">
                            <th>ID</th>
                            <th>FullName</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (!empty($users)):
                            foreach ($users as $user): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    <td class="edit">
                                        <a href="../users/customeredit.php?id=<?=$user['id']?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else: ?>
                            <tr>
                                <td colspan="4">No users found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>