<!DOCTYPE html>
<html lang="en">
<?php
// Include and capture the returned users array
$users = include '../../Controller/professionalControl.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>users</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/professional.css">
</head>

<div>
    <?php include '../../includes/dashboardnav.php' ?>
</div>

<body>
    <div class="professional-container">
        <div class="page-top">
            <div class="professional-icon">
                <i class="fa-solid fa-circle-user"></i>
                <p> Professional</p>
            </div>
            <div class="page-title">
                <p>Professional management</p>
            </div>
        </div>

        <div class="professional-content">
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
                            <th>FullName</th>
                            <th>Contact</th>
                            <th>Gmail</th>
                            <th>Address</th>
                            <th>Profession</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (!empty($professionals)):
                            foreach ($professionals as $professional): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($professional['id']); ?></td>
                                    <td><?php echo htmlspecialchars(string: $professional['name']); ?></td>
                                    <td><?php echo htmlspecialchars($professional['contact']); ?></td>
                                    <td><?php echo htmlspecialchars($professional['gmail']); ?></td>
                                    <td><?php echo htmlspecialchars($professional['address']); ?></td>
                                    <td><?php echo htmlspecialchars($professional['profession']); ?></td>
                                    <td class="edit">
                                        <a href="../users/professionalEdit.php?id=<?= $professional['id'] ?>">
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