// Toggle password visibility
const userPasswordEl = document.querySelector("#password");
const togglePasswordEl = document.querySelector("#togglePassword");

togglePasswordEl.addEventListener("click", function () {
  if (this.checked === true) {
    userPasswordEl.setAttribute("type", "text");
  } else {
    userPasswordEl.setAttribute("type", "password");
  }
});
