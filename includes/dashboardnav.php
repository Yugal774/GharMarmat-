<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Gharmarmat/View/assets/css/dashboardnav.css">
    <title>dashboardnav</title>
</head>

<body>

    <nav>
        <aside class="sidebar">
            <div class="header">
                <h3>Admin</h3>
            </div>
            <ul>
                <a href="\GharMarmat\View\admindashboard\dashboard.php">
                    <li><i class="fa-solid fa-house"></i> Dashboard</li>
                </a>

                <a href="\GharMarmat\View\admindashboard\customer.php">
                    <li><i class="fa-solid fa-user"></i> Customers</li>
                </a>

                <a href="\GharMarmat\View\admindashboard\professional.php">
                    <li><i class="fa-solid fa-screwdriver-wrench"></i> Professionals</li>
                </a>

                <li><i class="fa-solid fa-calendar-days"></i> Bookings</li>
                <a href="user.php">
                    <li><i class="fa-solid fa-envelope"></i> Messages</li>
                </a>
                <li><i class="fa-solid fa-gear"></i> Settings</li>
                <li id="log-out"><i class="fa-solid fa-right-from-bracket"></i> Log Out</li>
            </ul>
        </aside>

    </nav>

</body>


</html>