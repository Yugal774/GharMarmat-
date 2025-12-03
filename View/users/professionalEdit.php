<?php include"../../includes/dbconnect.php";
$id = $_GET['id'];
$query = "SELECT * FROM professional_register where id= $id";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
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
    <form action="../../Model/database/professionalRegisterdb.php" method="POST" onsubmit="return formValidate()">
        <input type="hidden" name="id" value="<?php echo $result['Id']; ?>">

        <div class="details">
            <heading>Edit Your Information</heading>

            <p>Enter your details:</p>

            <div class="name" id="style">
                <label for="name">Full name:</label>
                <input type="text" value="<?php echo ($result['Name']); ?>" name="name" id="name" required>
            </div>

            <div class="contact" id="style">
                <label for="contact">Contact number:</label>
                <input type="text" value="<?php echo ($result['Contact']); ?>" name="contact" id="contact" required>
            </div>

            <div class="gmail" id="style">
                <label for="gmail">Gmail address:</label>
                <input type="gmail" value="<?php echo ($result['Gmail']); ?>" name="gmail" id="gmail" required>
            </div>

            <div class="address" id="style">
                <label for="address">Your address:</label>
                <input type="text" value="<?php echo ($result['Address']); ?>" name="address" id="address" autocomplete="street-address">
            </div>

            <div class="password" id="style">
                <label for="password">Password:</label>
                <input type="password" value="<?php echo ($result['Password']); ?>" name="password" id="password" required>
            </div>

            <div class="Cpassword" id="style">
                <label for="Cpassword">Confirm Password:</label>
                <input type="password" value="<?php echo ($result['Password']); ?>" name="Cpassword" id="Cpassword" required>
            </div>

            <div class="profession">
                <label>Choose your service:</label>

                <div class="option">
                    <input type="radio" id="plumber" name="profession" value="plumber"
                    <?php 
                        if ($result['Profession'] == "plumber"){
                            echo"checked";
                        }
                    ?>>
                    <label for="plumber">Plumber</label>
                </div>

                <div class="option">
                    <input type="radio" id="electrician" name="profession" value="electrician"
                    <?php 
                        if ($result['Profession'] == "electrician"){
                            echo"checked";
                        }
                    ?>>
                    <label for="electrician">Electrician</label>
                </div>

                <div class="option">
                    <input type="radio" id="cleaner" name="profession" value="cleaner"
                    <?php 
                        if ($result['Profession'] == "cleaner"){
                            echo"checked";
                        }
                    ?>>
                    <label for="cleaner">Cleaner</label>
                </div>

                <div class="option">
                    <input type="radio" id="painter" name="profession" value="painter"
                    <?php 
                        if ($result['Profession'] == "painter"){
                            echo"checked";
                        }
                    ?>>
                    <label for="painter">Painter</label>
                </div>
                
                <div class="option">
                    <input type="radio" id="computer-technician" name="profession" value="computer-technician"
                    <?php 
                        if ($result['Profession'] == "computer-technician"){
                            echo"checked";
                        }
                    ?>>
                    <label for="computer-technician">Computer Technician</label>
                </div>
            </div>

            <button type="submit" name="submit">Update</button>
        </div>
    </form>

<script src="../assets/js/professionalregister.js"></script>
</body>

</html>