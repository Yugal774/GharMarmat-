<?php
include '../../includes/dbconnect.php';
$sql = "SELECT profession_id, profession_name FROM profession";
$result = $conn->query(query: $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Register</title>
    <link rel="stylesheet" href="../assets/css/professional-register.css">
</head>

<body>
    <form action="../../Model/database/professionalRegisterdb.php" method="POST" onsubmit="return formValidate()"
        autocomplete="off">

        <div class="details">
            <h1>Register as a Professional</h1>
            <p>Enter your details:</p>

            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact number</label>
                <input type="text" name="contact" id="contact" placeholder="98XXXXXXXX" required>
            </div>

            <div class="form-group">
                <label for="gmail">Gmail address</label>
                <input type="email" name="gmail" id="gmail" placeholder="example@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="address">Your address</label>
                <input type="text" name="address" id="address" placeholder="Enter address"
                    autocomplete="street-address">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter password" required>
            </div>

            <div class="form-group">
                <label for="Cpassword">Confirm Password</label>
                <input type="password" name="Cpassword" id="Cpassword" placeholder="Re-enter password" required>
            </div>

            <div class="form-group">
                <label for="profession">Choose profession</label>
                <select name="profession_id" id="profession" required>
                    <option value="">Select Profession</option>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <option value="<?php echo $row['profession_id']; ?>">
                            <?php echo $row['profession_name']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="button-container">
                <button type="submit" name="submit">Submit</button>
            </div>

            <input type = "hidden" name="role" value="professional">
            
        </div>
    </form>

    <script src="../assets/js/professionalregister.js"></script>
</body>

</html>