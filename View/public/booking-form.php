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

        <form action="" >

            <!-- User details inserting section -->
            <div class="section">
                <h3>User Details</h3>

                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" name="fullname" id="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone-number" id="phone" placeholder="98XXXXXXXX" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="abc@gmail.com" required>
                </div>
            </div>

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
                    <label for="timeSlot">Time slot (1 Hour)</label>
                    <select id="timeSlot" name="timeSlot"required>
                        <option value="">Select Time Slot</option>
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
                <button type="submit" class="btn">Book Now</button>
            </div>
        </form>
    </div>
    <script src="../assets/js/booking-form.js"></script>
</body>

</html>