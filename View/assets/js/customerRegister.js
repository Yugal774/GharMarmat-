function formValidate() {
    // Get values from user//
    const fullname = document.getElementById("fullname").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmpassword = document.getElementById("confirmpassword").value.trim();

    // Regular expressions//
    const namePattern = /^[a-zA-Z\s]{3,30}$/; 
    const emailPattern = /^[a-zA-Z0-9._%+-]+@gmail\.com$/; 
    const passPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    // name validation //
    if (fullname === "") {
        alert("Please enter your name.");
        return false;
    }
    if (!namePattern.test(fullname)) {
        alert("Full name must be at least 3 character long.");
        return false;
    }

    //Email validation//
    if (email === "") {
        alert("Please enter your email.");
        return false;
    }
    if (!emailPattern.test(email)) {
        alert("Please enter a valid Gmail address.");
        return false;
    }

    //Password validation//
    if (password === "") {
        alert("Please enter your password.");
        return false;
    }
    if (!passPattern.test(password)) {
        alert("Password must be 8 character long with special characters and one capital letter.");
        return false;
    }

    //Confirm Password validation//
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