// update-year.js
export default function updateYear() {
  const yearSpan = document.querySelector(".footer__right span");
  const currentYear = new Date().getFullYear();

  if (yearSpan) {
    yearSpan.textContent = currentYear;
  }
}
