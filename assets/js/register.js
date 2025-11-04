function formValidate() {
    const fullname = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmpassword = document.getElementById("confirmpassword").value.trim();

    if (fullname === "") {
        alert("Please enter your full name.");
        return false;
    }
    if (fullname.length < 3) {
        alert("Full name must be at least 3 characters long.");
        return false;
    }

    if (email === "") {
        alert("Please enter your email address.");
        return false;
    }
    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    if (password === "") {
        alert("Please enter your password.");
        return false;
    }
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    if (confirmpassword === "") {
        alert("Please confirm your password.");
        return false;
    }
    if (password !== confirmpassword) {
        alert("Passwords do not match.");
        return false;
    }

    return true;
}

function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}