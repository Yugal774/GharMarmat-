<?php include"../../includes/dbconnect.php";
$id = $_GET['id'];
$query = "SELECT * FROM customer_register where id= $id";
$data = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="../assets/css/customer-register.css">
</head>

<body>

    <div class="container">
        <form action="../../Model/database/customerRegisterdb.php" method="POST" onsubmit="return formValidate()" novalidate>
            <header>Edit your information</header>

            <input type="hidden" name="id" value="<?php echo $result['id'];?>" >

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" value="<?php echo ($result['name']); ?>" name="fullname" id="fullname">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?php echo ($result['email']);?>"  name="email" id="email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" value="<?php echo($result['password']); ?>" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" value="<?php echo($result['password']);?>" name="Cpassword" id="confirmpassword">
            </div><br>

            <button type="submit" id="submit-btn" name="register_btn" value="CREATE ACCOUNT">
                Update
            </button>
            <br><br>

            <div class="small-text">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>
    </div>

    <script src="../assets/js/register.js"></script>
</body>

</html>