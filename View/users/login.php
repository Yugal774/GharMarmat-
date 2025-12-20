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
            <form action="../../Controller/loginControl.php" method="POST" onsubmit="return formvalidation()" autocomplete="off">
                <div class="field-input">
                    <label for="gmail">Email </label>
                    <input type="text" name="gmail" id="gmail" placeholder="Enter full name" required>
                </div><br>

                <div class="field-input">
                    <label for="passowrd">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                </div><br><br>

                <div id="submit">
                    <button type="submit" value="login" name ="login"class="button">Login</button>
                </div>

                <div class="links">
                    Don't have an account? <a href="registerType.php">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>

<script src="../login.js"></script>

</html>