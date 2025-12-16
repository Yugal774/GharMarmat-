<?php include"../../includes/dbconnect.php";
$id = $_GET['id'];
$query = "SELECT * FROM users where id= $id";
$data = mysqli_query($conn, $query);
$customer_info = mysqli_fetch_assoc($data);
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
        <form action="../../Model/database/customerRegisterdb.php" method="POST" onsubmit="return formValidate()"
            novalidate>
            <header>Edit your information</header>

            <input type="hidden" name="id" value="<?php echo $customer_info['Id'];?>" >

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" value="<?php echo ($customer_info['Name'])?>" name="fullname" id="fullname" placeholder="Enter your name" ); ?>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?php echo ($customer_info['Gmail'])?>" name="email" id="email" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" value="<?php echo ($customer_info['Password'])?>" name="password" id="password" placeholder="Enter your password">
            </div>

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password" value="<?php echo ($customer_info['Password'])?>" name="confirmpassword" id="confirmpassword" placeholder="Re-enter your password">
            </div><br>

            <div class="button-container">
                <button type="submit" id="submit-btn" name="register_btn">
                    Update
                </button>
            </div>

            <input type="hidden" name="role" value="customer">

            <div class="small-text">
                Already have an account? <a href="login.php">Login</a>
            </div>

        </form>
    </div>

    <script src="../assets/js/customerRegister.js"></script>
</body>

</html>
