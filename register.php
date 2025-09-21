<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register page</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <div class="container">
        <form action="register.php" method="post">
            <header>Create an account</header> 

            <div class="form-group">
                <label for="fullname">Full name</label>
                <input type="text" name="fullname" id="fullname" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required minlength="6">
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm password</label>
                <input type="password" name="confirmpassword" id="confirmpassword" required minlength="6">
            </div><br>

            <div class="form-group">
                <input type="submit" id="submit-btn" value="CREATE ACCOUNT">
            </div><br><br><br>

            <div class="small-text">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>
    </div>
</body>

</html>