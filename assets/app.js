/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.scss";
import "./icons/about.svg";
import "./icons/add.svg";
import "./icons/add-user.svg";
import "./icons/articles.svg";
import "./icons/helpdesk.svg";
import "./icons/login.svg";
import "./icons/logout.svg";
import "./icons/password.svg";
import "./icons/password-show.svg";

import initializeTogglePassword from "./js/toggle-password";
import updateYear from "./js/update-year";

document.addEventListener("DOMContentLoaded", () => {
  initializeTogglePassword();
  updateYear();
});
