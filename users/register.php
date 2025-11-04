<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>

<body>

    <div class="container">
        <form action="../database/user.php" method="POST" onsubmit="return formValidate()" novalidate>
            <header>Create an account</header>

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" id="fullname">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" name="confirmpassword" id="confirmpassword">
            </div><br>

            <button type="submit" id="submit-btn" name="register_btn" value="CREATE ACCOUNT">
                CREATE ACCOUNT
            </button>
            <br><br>

            <div class="small-text">
                Already have an account? <a href="../Login/login.php">Login</a>
            </div>

        </form>
    </div>

    <script src="../assets/js/register.js"></script>
</body>

</html>