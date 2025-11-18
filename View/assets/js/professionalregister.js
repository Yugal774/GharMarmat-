function formValidate() {
    // Get all input values
    const name = document.getElementById("name").value.trim();
    const contact = document.getElementById("contact").value.trim();
    const gmail = document.getElementById("gmail").value.trim();
    const address = document.getElementById("address").value.trim();
    const password = document.getElementById("password").value.trim();
    const cpassword = document.getElementById("Cpassword").value.trim();
    const profession = document.querySelector('input[name="profession"]:checked');

    if (name === "" || !/^[A-Za-z ]{3,}$/.test(name)) {
        alert("Please enter a valid name (only letters, min 3 characters).");
        return false;
    }

    if (contact === "" || !/^[0-9]{10}$/.test(contact)) {
        alert("Please enter a valid 10-digit contact number.");
        return false;
    }

    if (gmail === "" || !/^[a-zA-Z0-9._%+-]+@gmail\.com$/.test(gmail)) {
        alert("Please enter a valid Gmail address (example@gmail.com).");
        return false;
    }

    if (address.length < 3) {
        alert("Please enter a valid address (min 3 characters).");
        return false;
    }

    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    if (password !== cpassword) {
        alert("Passwords do not match.");
        return false;
    }

    if (!profession) {
        alert("Please select a profession.");
        return false;
    }

    return true;
}
