<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Register</title>
    <link rel="stylesheet" href="../assets/css/professional-register.css">
</head>

<body>
    <div class="container">

    </div>
    <form action="../../Model/database/professionalRegisterdb.php" method="POST" onsubmit="return formValidate()">

        <div class="details">
            <heading>Register as a Professional</heading>

            <p>Enter your details:</p>

            <div class="name" id="style">
                <label for="name">Full name:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="contact" id="style">
                <label for="contact">Contact number:</label>
                <input type="text" name="contact" id="contact" required>
            </div>

            <div class="gmail" id="style">
                <label for="gmail">Gmail address:</label>
                <input type="gmail" name="gmail" id="gmail" required>
            </div>

            <div class="address" id="style">
                <label for="address">Your address:</label>
                <input type="text" name="address" id="address" autocomplete="street-address">
            </div>

            <div class="password" id="style">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <div class="Cpassword" id="style">
                <label for="Cpassword">Confirm Password:</label>
                <input type="password" name="Cpassword" id="Cpassword" required>
            </div>

            <div class="profession">
                <label>Choose your service:</label>
                <div class="option">
                    <input type="radio" id="plumber" name="profession" value="plumber">
                    <label for="plumber">Plumber</label>
                </div>
                <div class="option">
                    <input type="radio" id="electrician" name="profession" value="electrician">
                    <label for="electrician">Electrician</label>
                </div>
                <div class="option">
                    <input type="radio" id="cleaner" name="profession" value="cleaner">
                    <label for="cleaner">Cleaner</label>
                </div>
                <div class="option">
                    <input type="radio" id="painter" name="profession" value="painter">
                    <label for="painter">Painter</label>
                </div>
                <div class="option">
                    <input type="radio" id="computer-technician" name="profession" value="computer-technician">
                    <label for="computer-technician">Computer Technician</label>
                </div>
            </div>

            <button type="submit" name="submit">Submit</button>
        </div>
    </form>

<script src="../assets/js/professionalregister.js"></script>
</body>

</html>