export default function initializeTogglePassword() {
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("inputPassword");
  const passwordIcon = document.getElementById("passwordIcon");
  const passwordShowIcon = document.getElementById("passwordShowIcon");

  togglePassword.addEventListener("click", () => {
    const type =
      password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    passwordIcon.style.display = type === "password" ? "block" : "none";
    passwordShowIcon.style.display = type === "text" ? "block" : "none";
  });
}
