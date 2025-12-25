<?php 
include "../../includes/dbconnect.php";

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE Id = $id";
$data = mysqli_query($conn, $query);
$customer_info = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer Information</title>
    <link rel="stylesheet" href="../assets/css/customer-register.css">
</head>

<body>

    <div class="container">
        <form action="../../Model/database/customerRegisterdb.php" method="POST" onsubmit="return formValidate()" novalidate>
            <header>Edit your information</header>

            <input type="hidden" name="id" value="<?php echo $customer_info['Id']; ?>">

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" value="<?php echo htmlspecialchars($customer_info['Name']); ?>" name="fullname" id="fullname" placeholder="Enter your name">
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" value="<?php echo htmlspecialchars($customer_info['Contact']); ?>" name="contact" id="contact" placeholder="Enter your contact number">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" value="<?php echo htmlspecialchars($customer_info['Address']); ?>" name="address" id="address" placeholder="Enter your address">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" value="<?php echo htmlspecialchars($customer_info['Gmail']); ?>" name="email" id="email" placeholder="Enter your email">
            </div>

            <div class="button-container">
                <button type="submit" id="submit-btn" name="register_btn">
                    Update
                </button>
            </div>

            <input type="hidden" name="role" value="customer">

        </form>
    </div>

    <script src="../assets/js/customerRegister.js"></script>
</body>

</html>
