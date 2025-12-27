// booking-form.js

function formValidate() {
    const dateInput = document.getElementById("date");
    const timeCategory = document.getElementById("timeCategory");
    const timeSlot = document.getElementById("timeSlot");
    const servAddress = document.querySelector("textarea[name='servAddress']");
    const note = document.querySelector("textarea[name='note']");

    let errors = [];

    // Date validation
    if (!dateInput.value) {
        errors.push("Please select a date.");
    } else {
        const selectedDate = new Date(dateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0); // ignore time
        if (selectedDate < today) {
            errors.push("Date cannot be in the past.");
        }
    }

    // Time category validation
    if (!timeCategory.value) {
        errors.push("Please select a time category.");
    }

    // Time slot validation
    if (!timeSlot.value) {
        errors.push("Please select a time slot.");
    }

    // Service address validation
    if (!servAddress.value.trim() || servAddress.value.trim().length < 10) {
        errors.push("Enter complete address @example(House No. 123, Ward No. 5, Green Park Colony, Kathmandu, Nepal) ");
    }

    // Notes validation
    if (note.value.trim().length > 200) {
        errors.push("Notes cannot exceed 200 characters.");
    }

    // Show errors if any
    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }

    return true; // form is valid
}

// Populate time slots dynamically based on selected category
document.addEventListener("DOMContentLoaded", function () {
    const timeCategory = document.getElementById("timeCategory");
    const timeSlot = document.getElementById("timeSlot");

    const slots = {
        morning: ["7:00 - 8:00", "8:00 - 9:00", "9:00 - 10:00", "10:00 - 11:00", "11:00 - 12:00"],
        afternoon: ["12:00 - 1:00", "1:00 - 2:00", "2:00 - 3:00", "3:00 - 4:00", "4:00 - 5:00"],
        evening: ["5:00 - 6:00", "6:00 - 7:00", "7:00 - 8:00", "8:00 - 9:00"]
    };

    timeCategory.addEventListener("change", function () {
        const selectedCategory = this.value;
        timeSlot.innerHTML = '<option value="">Select Time Slot</option>'; // reset

        if (selectedCategory && slots[selectedCategory]) {
            slots[selectedCategory].forEach(slot => {
                const option = document.createElement("option");
                option.value = slot;
                option.textContent = slot;
                timeSlot.appendChild(option);
            });
        }
    });
});
