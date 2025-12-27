<?php
include '../../dbconnect.php';

session_start();

// Make sure user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../public/login.php");
    exit;
}

$profession_id = $_GET['profession_id'] ;
$work_id = $_GET['work_id'] ;
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Service Booking</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/booking-form.css">
</head>

<body>

    <div class="booking-container">
        <h2>Book a Home Service</h2>

        <form action="../../Model/database/serviceBooking.php" method="POST" onsubmit="return formValidate()">

            <!-- Hidden inputs for profession_id, work_id, and user info -->
            <input type="hidden" name="profession_id" value="<?php echo htmlspecialchars($profession_id); ?>">
            <input type="hidden" name="work_id" value="<?php echo htmlspecialchars($work_id); ?>">
            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">

            <!-- Booking Details Section -->
            <div class="section">
                <h3>Booking Details</h3>

                <div class="form-group">
                    <label for="date">Preferred Date</label>
                    <input type="date" name="date" id="date" required>
                </div>

                <div class="form-group">
                    <label for="timeCategory">Time Category</label>
                    <select id="timeCategory" name="timeCategory" required>
                        <option value="">Select your time</option>
                        <option value="morning">Morning</option>
                        <option value="afternoon">Afternoon</option>
                        <option value="evening">Evening</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="timeSlot">Time Slot (1 Hour)</label>
                    <select id="timeSlot" name="timeSlot" required>
                        <option value="">Select Time Slot</option>
                        <!-- Populate dynamically with JS if needed -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="servAddress">Service Address</label>
                    <textarea rows="3" name="servAddress" placeholder="Enter full address" required></textarea>
                </div>

                <div class="form-group">
                    <label for="note">Additional Notes</label>
                    <textarea rows="3" name="note" placeholder="Any extra instructions"></textarea>
                </div>
            </div>

            <div class="book-btn">
                <button type="submit" class="btn" name="book_btn">Book Now</button>
            </div>
        </form>
    </div>

    <script src="../assets/js/booking-form.js"></script>
</body>

</html>