export default function initializeTogglePassword() {
  // Přihlášení
  const togglePassword = document.getElementById("togglePassword");
  const password = document.getElementById("inputPassword");
  const passwordIcon = document.getElementById("passwordIcon");
  const passwordShowIcon = document.getElementById("passwordShowIcon");

  // Registrace
  const toggleRegistrationPassword = document.getElementById(
    "toggleRegistrationPassword"
  );
  const registrationPassword = document.getElementById(
    "registration_form_password_first"
  );
  const registrationPasswordIcon = document.getElementById(
    "registrationPasswordIcon"
  );
  const registrationPasswordShowIcon = document.getElementById(
    "registrationPasswordShowIcon"
  );

  // Potvrzení hesla registrace
  const toggleRegistrationPasswordConfirm = document.getElementById(
    "toggleRegistrationPasswordConfirm"
  );
  const registrationPasswordConfirm = document.getElementById(
    "registration_form_password_second"
  );
  const registrationPasswordConfirmIcon = document.getElementById(
    "registrationPasswordConfirmIcon"
  );
  const registrationPasswordConfirmShowIcon = document.getElementById(
    "registrationPasswordConfirmShowIcon"
  );

  if (togglePassword && password && passwordIcon && passwordShowIcon) {
    // Přihlášení: Přepínání hesla
    togglePassword.addEventListener("click", () => {
      const type =
        password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      passwordIcon.style.display = type === "password" ? "block" : "none";
      passwordShowIcon.style.display = type === "text" ? "block" : "none";
    });
  }

  if (
    toggleRegistrationPassword &&
    registrationPassword &&
    registrationPasswordIcon &&
    registrationPasswordShowIcon
  ) {
    // Registrace: Přepínání hesla
    toggleRegistrationPassword.addEventListener("click", () => {
      const type =
        registrationPassword.getAttribute("type") === "password"
          ? "text"
          : "password";
      registrationPassword.setAttribute("type", type);
      registrationPasswordIcon.style.display =
        type === "password" ? "block" : "none";
      registrationPasswordShowIcon.style.display =
        type === "text" ? "block" : "none";
    });
  }

  if (
    toggleRegistrationPasswordConfirm &&
    registrationPasswordConfirm &&
    registrationPasswordConfirmIcon &&
    registrationPasswordConfirmShowIcon
  ) {
    // Registrace: Přepínání potvrzení hesla
    toggleRegistrationPasswordConfirm.addEventListener("click", () => {
      const type =
        registrationPasswordConfirm.getAttribute("type") === "password"
          ? "text"
          : "password";
      registrationPasswordConfirm.setAttribute("type", type);
      registrationPasswordConfirmIcon.style.display =
        type === "password" ? "block" : "none";
      registrationPasswordConfirmShowIcon.style.display =
        type === "text" ? "block" : "none";
    });
  }
}
