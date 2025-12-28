<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/GharMarmat/View/assets/css/style.css">
    <link rel="stylesheet" href="/GharMarmat/View/assets/css/index.css">
</head>

<body>

    <header>
        <nav>
            <div class="navbar">
                <img class="logo" src="\GharMarmat\View\assets\images\logo1.png" alt="">
                <div class="nav-item">
                    <i class="fa-solid fa-bars" id="menu"></i>
                    <li class="nav-link">
                        <ul><a href="\GharMarmat\View\public\index.php">Home</a></ul>
                        <ul><a href="\GharMarmat\View\public\services.php">Services</a></ul>
                    </li>
                    <ul class="auth-link">
                        <?php
                        if (isset($_SESSION['role']) && isset($_SESSION['username'])) {
                            $username = htmlspecialchars($_SESSION['username']);

                            if ($_SESSION['role'] === 'customer') {
                                echo '<li><a href="/GharMarmat/View/userDashboard/userdashboard.php"><i class="fa-solid fa-user"></i> ' . $username . '</a></li>';
                            } elseif ($_SESSION['role'] === 'professional') {
                                echo '<li><a href="/GharMarmat/View/public/professionalDashboard/professionaldashboard.php"><i class="fa-solid fa-user"></i> ' . $username . '</a></li>';
                            } else {
                                echo '<li><a href="#"><i class="fa-solid fa-user"></i> ' . $username . '</a></li>';
                            }
                        } else {
                            echo '<li><a href="/GharMarmat/View/users/login.php"><i class="fa-solid fa-user"></i> Login</a></li>';
                            echo '<li><a href="/GharMarmat/View/users/registerType.php">Register</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    </header>

</body>

</html>