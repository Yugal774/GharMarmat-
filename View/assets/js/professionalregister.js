function formValidate() {
    // To get input from user
    const name = document.getElementById("name").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const gmail = document.getElementById("gmail").value.trim();
    const address = document.getElementById("address").value.trim();
    const password = document.getElementById("password").value.trim();
    const cpassword = document.getElementById("Cpassword").value.trim();
    const profession = document.getElementById("profession").value;

    // Name Validation
    if (name.length < 3) {
        alert("Full name must be at least 3 characters long.");
        return false;
    }

    // Contact Validation
    const contactPattern = /^(98|97)\d{8}$/;
    if (!contactPattern.test(contact)) {
        alert("Contact number must be 10 digits.");
        return false;
    }

    // Gmail Validation
    const gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!gmailPattern.test(gmail)) {
        alert("Please enter a valid Gmail address.");
        return false;
    }

    // Address Validation
    if (address.length < 3) {
        alert("Address must be at least 3 characters long.");
        return false;
    }

    // Password Strength Validation
    const passPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    if (!passPattern.test(password)) {
        alert("Password must be at least 6 characters, contain one uppercase letter, one number, and one special character.");
        return false;
    }

    // Confirm Password Validation
    if (password !== cpassword) {
        alert("Passwords do not match.");
        return false;
    }

    // Profession Validation
    if (profession === "") {
        alert("Please choose your profession.");
        return false;
    }

    return true;
}