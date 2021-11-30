// show password
function showPassword() {
    const password = document.querySelector("#password");
    if (password.getAttribute("type") === "password") {
        password.setAttribute("type", "text");
    } else {
        password.setAttribute("type", "password");
    }
}