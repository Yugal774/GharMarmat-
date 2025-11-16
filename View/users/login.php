<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <header>Login</header>
            <form action="login.php" method="POST">
                <div class="field-input">
                    <label for="username">Username </label>
                    <input type="text" name="username" id="username" value="Yugal rai" required>
                </div><br>

                <div class="field-input">
                    <label for="passowrd">Password</label>
                    <input type="password" name="passowrd" id="password" required>
                </div><br><br>

                <div id="submit">
                    <button type="submit" value="Submit" class="button">Login</button>
                </div>

                <div class="links">
                    Don't have an account? <a href="customer-register.php">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>