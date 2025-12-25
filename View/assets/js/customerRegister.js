function formValidate() {
    // Get values from user
    const fullname = document.getElementById("fullname").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const address = document.getElementById("address").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmpassword = document.getElementById("confirmpassword").value.trim();

    // Regular expressions
    const namePattern = /^[a-zA-Z\s]{3,30}$/;
    const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
    const passPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    const contactPattern = /^(98|97)[0-9]{8}$/;

    // Full Name validation
    if (fullname === "") {
        alert("Please enter your name.");
        return false;
    }
    if (!namePattern.test(fullname)) {
        alert("Full name must be at least 3 characters long and contain only letters.");
        return false;
    }

    // Contact number validation
    if (contact === "") {
        alert("Please enter your contact number.");
        return false;
    }
    if (!contactPattern.test(contact)) {
        alert("Please enter valid contact number.");
        return false;
    }

    // Address validation
    if (address === "") {
        alert("Please enter your address.");
        return false;
    }

    // Email validation
    if (email === "") {
        alert("Please enter your email.");
        return false;
    }
    if (!emailPattern.test(email)) {
        alert("Please enter a valid Gmail address.");
        return false;
    }

    // Password validation
    if (password === "") {
        alert("Please enter your password.");
        return false;
    }
    if (!passPattern.test(password)) {
        alert("Password must be 8 characters long, include a capital letter, a number, and a special character.");
        return false;
    }

    // Confirm Password validation
    if (confirmpassword === "") {
        alert("Please re-enter your password!");
        return false;
    }
    if (password !== confirmpassword) {
        alert("Passwords do not match!");
        return false;
    }

    return true;
}