function formvalidation() {
    const gmail = document.getElementById("gmail").value.trim();
    const password = document.getElementById("password").value.trim();

    document.getElementById("gmailError").textContent = "";
    document.getElementById("passwordError").textContent = "";

    if (gmail === "") {
        document.getElementById("gmailError").textContent = " Please enter your email";
        return false; 
    }

    if (password === "") {
        document.getElementById("passwordError").textContent = " Please enter your password";
        return false;
    }

    return true; 
}
