<!DOCTYPE html>
<html lang="en">

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
                <p> Admin</p>
            </div>
            <div class="page-title">
                <p>User management</p>
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
                    <button><i class="fa-solid fa-plus"></i>Add User</button>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><i class="fa-solid fa-trash"></i>
                                Edit
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>

        </div>

    </div>
</body>

</html>