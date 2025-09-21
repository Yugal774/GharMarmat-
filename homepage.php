<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="homepage.css">
</head>

<body>
    <header>
        <nav>
            <div class="navbar">
                <img class="logo" src="photos/logo1.png" alt="">
                <div class="nav-item">
                    <i class="fa-solid fa-bars" id="menu"></i>
                    <li class="nav-link">
                        <ul><a href="#">Home</a></ul>
                        <ul><a href="#">Services</a></ul>
                        <ul><a href="#">About</a></ul>
                        <ul><a href="#">Contact Us</a></ul>
                    </li>
                    <li class="auth-link">
                        <ul><a href="login.php"><i class="fa-solid fa-user"></i>Login</a></ul>
                        <ul><a href="register.php">Register</a></ul>
                    </li>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="info">
                <h1>Your Trusted Partner <br>for Home Services</h1>
                <h2>Book skilled/trusted Plumber Electrician Painter Cleaner & Computer Technician online </p>
                <div id="book" class="hi">
                    <a href="#services">Book Now</a>
                </div>
            </div>

        </section>

        <p id="sev-section">Services</p>
        <section class="services">
            <div class="service">
                <div class="img" id="plumber"> </div>
                <P>Plumber</P>
                <div id="book">
                    <a href="">Book Now</a>
                </div>
            </div>
            <div class="service">
                <div class="img" id="electrician"> </div>
                <P>Electrician</P>
                <div id="book">
                    <a href="">Book Now</a>
                </div>
            </div>
            <div class="service">
                <div class="img" id="cleaner"> </div>
                <P>Cleaner</P>
                <div id="book">
                    <a href="">Book Now</a>
                </div>
            </div>
            <div class="service">
                <div class="img" id="painter"> </div>
                <P>Painter</P>
                <div id="book">
                    <a href="">Book Now</a>
                </div>
            </div>
            <div class="service">
                <div class="img" id="com-technician"></div>
                <P>Computer Technician</P>
                <div id="book">
                    <a href="">Book Now</a>
                </div>
            </div>
            </div>
        </section>
        <section class="comment">
            <p>This section is for testimonials.</p>
        </section>
    </main>

    <footer>
        <p>We are available in</p>
        <p>This is footer.</p>
    </footer>
</body>
</html>