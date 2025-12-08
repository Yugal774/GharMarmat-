function formValidate() {
    // Get input values
    let name = document.getElementById("name").value.trim();
    let contact = document.getElementById("contact").value.trim();
    let gmail = document.getElementById("gmail").value.trim();
    let address = document.getElementById("address").value.trim();
    let password = document.getElementById("password").value.trim();
    let Cpassword = document.getElementById("Cpassword").value.trim();
    let profession = document.getElementById("profession").value;

    // Clear all previous errors
    document.querySelectorAll(".error-message").forEach(span => span.innerText = "");

    let isValid = true;

    // Name validation
    if (name === "") {
        document.getElementById("nameError").innerText = "Please enter your full name.";
        isValid = false;
    }

    // Contact validation
    const contactPattern = /^(98|97)\d{8}$/;
    if (!contactPattern.test(contact)) {
        document.getElementById("contactError").innerText = "Enter a valid contact number (98XXXXXXXX or 97XXXXXXXX).";
        isValid = false;
    }

    // Gmail validation
    const gmailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    if (!gmailPattern.test(gmail)) {
        document.getElementById("gmailError").innerText = "Enter a valid Gmail (must end with @gmail.com).";
        isValid = false;
    }

    // Address validation
    if (address === "") {
        document.getElementById("addressError").innerText = "Please enter your address.";
        isValid = false;
    }

    // Password validation
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/;
    if (!passwordPattern.test(password)) {
        document.getElementById("passwordError").innerText = "Password must be at least 6 characters and include: One uppercase, One lowercase, One number.";
        isValid = false;
    }

    // Confirm password
    if (password !== Cpassword) {
        document.getElementById("CpasswordError").innerText = "Passwords do not match.";
        isValid = false;
    }

    // Profession dropdown validation
    if (profession === "") {
        document.getElementById("professionError").innerText = "Please select a profession.";
        isValid = false;
    }

    return isValid; // Submit only if all fields are valid
}
