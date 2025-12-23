document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const timeCategory = document.getElementById("timeCategory");
    const timeSlot = document.getElementById("timeSlot");

    // Time slots based on category
    const slots = {
        morning: ["7:00 - 8:00", "8:00 - 9:00", "9:00 - 10:00"],
        afternoon: ["12:00 - 1:00", "1:00 - 2:00", "2:00 - 3:00"],
        evening: ["5:00 - 6:00", "6:00 - 7:00", "7:00 - 8:00"]
    };

    // Populate time slots
    timeCategory.addEventListener("change", function () {
        timeSlot.innerHTML = '<option value="">Select Time Slot</option>';

        if (slots[this.value]) {
            slots[this.value].forEach(slot => {
                const option = document.createElement("option");
                option.value = slot;
                option.textContent = slot;
                timeSlot.appendChild(option);
            });
        }
    });

    // Form validation
    form.addEventListener("submit", function (e) {
        const name = document.getElementById("name").value.trim();
        const phone = document.getElementById("phone").value.trim();
        const email = document.getElementById("email").value.trim();
        const date = document.getElementById("date").value;
        const address = document.querySelector("textarea[name='servAddress']").value.trim();

        const phoneRegex = /^(97|98)\d{8}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (name.length < 3) {
            alert("Full name must be at least 3 characters.");
            e.preventDefault();
            return;
        }

        if (!phoneRegex.test(phone)) {
            alert("Enter a valid phone number (98XXXXXXXX).");
            e.preventDefault();
            return;
        }

        if (!emailRegex.test(email)) {
            alert("Enter a valid email address.");
            e.preventDefault();
            return;
        }

        if (!date) {
            alert("Please select a date.");
            e.preventDefault();
            return;
        }

        const selectedDate = new Date(date);
        const today = new Date();
        today.setHours(0,0,0,0);

        if (selectedDate < today) {
            alert("Date cannot be in the past.");
            e.preventDefault();
            return;
        }

        if (!timeCategory.value) {
            alert("Please select a time category.");
            e.preventDefault();
            return;
        }

        if (!timeSlot.value) {
            alert("Please select a time slot.");
            e.preventDefault();
            return;
        }

        if (address.length < 5) {
            alert("Please enter a valid service address.");
            e.preventDefault();
            return;
        }

        alert("Booking submitted successfully!");
    });
});
