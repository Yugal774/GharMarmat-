<?php include "../../includes/dbconnect.php";
$id = $_GET['id'];
$query = "SELECT * FROM users where id= $id";
$data = mysqli_query($conn, $query);
$professional_info = mysqli_fetch_assoc($data);
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
        <input type="hidden" name="id" value="<?php echo $professional_info['Id']; ?>">


        <div class="details">
            <h1>Edit Your Information</h1>
            <p>Edit your details:</p>

            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" name="name" id="name" placeholder="Enter full name"
                    value="<?php echo ($professional_info['Name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact number</label>
                <input type="text" name="contact" id="contact" placeholder="98XXXXXXXX"
                    value="<?php echo ($professional_info['Contact']); ?>" required>
            </div>

            <div class="form-group">
                <label for="gmail">Gmail address</label>
                <input type="email" name="gmail" id="gmail" placeholder="example@gmail.com"
                    value="<?php echo ($professional_info['Gmail']); ?>" required>
            </div>

            <div class="form-group">
                <label for="address">Your address</label>
                <input type="text" name="address" id="address" placeholder="Enter address" autocomplete="street-address"
                    value="<?php echo ($professional_info['Address']); ?>">
            </div>

            <div class="form-group">
                <label for="profession">Choose profession</label>
                <select name="profession_id" id="profession" required>
                    <option value="">Select Profession</option>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            // Compare the profession ID from user with the profession table ID
                            if ($row['profession_id'] == $professional_info['Profession']) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            ?>
                            <option value="<?php echo $row['profession_id']; ?>" <?php echo $selected; ?>>
                                <?php echo htmlspecialchars($row['profession_name']); ?>
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>


            <div class="button-container">
                <button type="submit" name="submit">Update</button>
            </div>

            <input type="hidden" name="role" value="professional">

        </div>
    </form>

    <script src="../assets/js/professionalregister.js"></script>
</body>