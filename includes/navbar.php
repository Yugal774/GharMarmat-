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
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../View/assets/css/index.css">
</head>

<body>

    <header>
        <nav>
            <div class="navbar">
                <img class="logo" src="../assets/images/logo1.png" alt="">
                <div class="nav-item">
                    <i class="fa-solid fa-bars" id="menu"></i>
                    <li class="nav-link">
                        <ul><a href="#">Home</a></ul>
                        <ul><a href="#">Services</a></ul>
                        <ul><a href="#">About</a></ul>
                        <ul><a href="#">Contact Us</a></ul>
                    </li>
                    <li class="auth-link">
                        <ul><a href="../users/login.php"><i class="fa-solid fa-user"></i>Login</a></ul>
                        <ul><a href="../users/registerType.php" onclick="return confirm('Are you sure you want to logout?');">Register</a></ul>
                    </li>
                </div>
            </div>
        </nav>
    </header>

</body>

</html>


