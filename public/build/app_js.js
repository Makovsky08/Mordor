"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["app_js"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./styles/app.scss */ "./assets/styles/app.scss");
/* harmony import */ var _icons_about_svg__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./icons/about.svg */ "./assets/icons/about.svg");
/* harmony import */ var _icons_add_svg__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./icons/add.svg */ "./assets/icons/add.svg");
/* harmony import */ var _icons_add_user_svg__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./icons/add-user.svg */ "./assets/icons/add-user.svg");
/* harmony import */ var _icons_articles_svg__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./icons/articles.svg */ "./assets/icons/articles.svg");
/* harmony import */ var _icons_helpdesk_svg__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./icons/helpdesk.svg */ "./assets/icons/helpdesk.svg");
/* harmony import */ var _icons_login_svg__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./icons/login.svg */ "./assets/icons/login.svg");
/* harmony import */ var _icons_logout_svg__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./icons/logout.svg */ "./assets/icons/logout.svg");
/* harmony import */ var _icons_password_svg__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./icons/password.svg */ "./assets/icons/password.svg");
/* harmony import */ var _icons_password_show_svg__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./icons/password-show.svg */ "./assets/icons/password-show.svg");
/* harmony import */ var _js_toggle_password__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! ./js/toggle-password */ "./assets/js/toggle-password.js");
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)











document.addEventListener("DOMContentLoaded", function () {
  (0,_js_toggle_password__WEBPACK_IMPORTED_MODULE_10__["default"])();
});

/***/ }),

/***/ "./assets/js/toggle-password.js":
/*!**************************************!*\
  !*** ./assets/js/toggle-password.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ initializeTogglePassword)
/* harmony export */ });
function initializeTogglePassword() {
  var togglePassword = document.getElementById("togglePassword");
  var password = document.getElementById("inputPassword");
  var passwordIcon = document.getElementById("passwordIcon");
  var passwordShowIcon = document.getElementById("passwordShowIcon");
  togglePassword.addEventListener("click", function () {
    var type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    passwordIcon.style.display = type === "password" ? "block" : "none";
    passwordShowIcon.style.display = type === "text" ? "block" : "none";
  });
}

/***/ }),

/***/ "./assets/styles/app.scss":
/*!********************************!*\
  !*** ./assets/styles/app.scss ***!
  \********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./assets/icons/about.svg":
/*!********************************!*\
  !*** ./assets/icons/about.svg ***!
  \********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/about.c59bc9f9.svg";

/***/ }),

/***/ "./assets/icons/add-user.svg":
/*!***********************************!*\
  !*** ./assets/icons/add-user.svg ***!
  \***********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/add-user.c7016e03.svg";

/***/ }),

/***/ "./assets/icons/add.svg":
/*!******************************!*\
  !*** ./assets/icons/add.svg ***!
  \******************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/add.f82755a0.svg";

/***/ }),

/***/ "./assets/icons/articles.svg":
/*!***********************************!*\
  !*** ./assets/icons/articles.svg ***!
  \***********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/articles.be23379c.svg";

/***/ }),

/***/ "./assets/icons/helpdesk.svg":
/*!***********************************!*\
  !*** ./assets/icons/helpdesk.svg ***!
  \***********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/helpdesk.3e01c130.svg";

/***/ }),

/***/ "./assets/icons/login.svg":
/*!********************************!*\
  !*** ./assets/icons/login.svg ***!
  \********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/login.5c18b2df.svg";

/***/ }),

/***/ "./assets/icons/logout.svg":
/*!*********************************!*\
  !*** ./assets/icons/logout.svg ***!
  \*********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/logout.e0b44818.svg";

/***/ }),

/***/ "./assets/icons/password-show.svg":
/*!****************************************!*\
  !*** ./assets/icons/password-show.svg ***!
  \****************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/password-show.c8c75599.svg";

/***/ }),

/***/ "./assets/icons/password.svg":
/*!***********************************!*\
  !*** ./assets/icons/password.svg ***!
  \***********************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

module.exports = __webpack_require__.p + "images/password.787793f0.svg";

/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["assets_styles_app_scss"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiYXBwX2pzLmpzIiwibWFwcGluZ3MiOiI7Ozs7Ozs7Ozs7Ozs7Ozs7Ozs7OztBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUFFQTtBQUMyQjtBQUNBO0FBQ0Y7QUFDSztBQUNBO0FBQ0E7QUFDSDtBQUNDO0FBQ0U7QUFDSztBQUV5QjtBQUU1REMsUUFBUSxDQUFDQyxnQkFBZ0IsQ0FBQyxrQkFBa0IsRUFBRSxZQUFNO0VBQ2xERixnRUFBd0IsQ0FBQyxDQUFDO0FBQzVCLENBQUMsQ0FBQzs7Ozs7Ozs7Ozs7Ozs7QUN2QmEsU0FBU0Esd0JBQXdCQSxDQUFBLEVBQUc7RUFDakQsSUFBTUcsY0FBYyxHQUFHRixRQUFRLENBQUNHLGNBQWMsQ0FBQyxnQkFBZ0IsQ0FBQztFQUNoRSxJQUFNQyxRQUFRLEdBQUdKLFFBQVEsQ0FBQ0csY0FBYyxDQUFDLGVBQWUsQ0FBQztFQUN6RCxJQUFNRSxZQUFZLEdBQUdMLFFBQVEsQ0FBQ0csY0FBYyxDQUFDLGNBQWMsQ0FBQztFQUM1RCxJQUFNRyxnQkFBZ0IsR0FBR04sUUFBUSxDQUFDRyxjQUFjLENBQUMsa0JBQWtCLENBQUM7RUFFcEVELGNBQWMsQ0FBQ0QsZ0JBQWdCLENBQUMsT0FBTyxFQUFFLFlBQU07SUFDN0MsSUFBTU0sSUFBSSxHQUNSSCxRQUFRLENBQUNJLFlBQVksQ0FBQyxNQUFNLENBQUMsS0FBSyxVQUFVLEdBQUcsTUFBTSxHQUFHLFVBQVU7SUFDcEVKLFFBQVEsQ0FBQ0ssWUFBWSxDQUFDLE1BQU0sRUFBRUYsSUFBSSxDQUFDO0lBQ25DRixZQUFZLENBQUNLLEtBQUssQ0FBQ0MsT0FBTyxHQUFHSixJQUFJLEtBQUssVUFBVSxHQUFHLE9BQU8sR0FBRyxNQUFNO0lBQ25FRCxnQkFBZ0IsQ0FBQ0ksS0FBSyxDQUFDQyxPQUFPLEdBQUdKLElBQUksS0FBSyxNQUFNLEdBQUcsT0FBTyxHQUFHLE1BQU07RUFDckUsQ0FBQyxDQUFDO0FBQ0o7Ozs7Ozs7Ozs7O0FDYkEiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9hc3NldHMvYXBwLmpzIiwid2VicGFjazovLy8uL2Fzc2V0cy9qcy90b2dnbGUtcGFzc3dvcmQuanMiLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0eWxlcy9hcHAuc2Nzcz84ZjU5Il0sInNvdXJjZXNDb250ZW50IjpbIi8qXG4gKiBXZWxjb21lIHRvIHlvdXIgYXBwJ3MgbWFpbiBKYXZhU2NyaXB0IGZpbGUhXG4gKlxuICogV2UgcmVjb21tZW5kIGluY2x1ZGluZyB0aGUgYnVpbHQgdmVyc2lvbiBvZiB0aGlzIEphdmFTY3JpcHQgZmlsZVxuICogKGFuZCBpdHMgQ1NTIGZpbGUpIGluIHlvdXIgYmFzZSBsYXlvdXQgKGJhc2UuaHRtbC50d2lnKS5cbiAqL1xuXG4vLyBhbnkgQ1NTIHlvdSBpbXBvcnQgd2lsbCBvdXRwdXQgaW50byBhIHNpbmdsZSBjc3MgZmlsZSAoYXBwLmNzcyBpbiB0aGlzIGNhc2UpXG5pbXBvcnQgXCIuL3N0eWxlcy9hcHAuc2Nzc1wiO1xuaW1wb3J0IFwiLi9pY29ucy9hYm91dC5zdmdcIjtcbmltcG9ydCBcIi4vaWNvbnMvYWRkLnN2Z1wiO1xuaW1wb3J0IFwiLi9pY29ucy9hZGQtdXNlci5zdmdcIjtcbmltcG9ydCBcIi4vaWNvbnMvYXJ0aWNsZXMuc3ZnXCI7XG5pbXBvcnQgXCIuL2ljb25zL2hlbHBkZXNrLnN2Z1wiO1xuaW1wb3J0IFwiLi9pY29ucy9sb2dpbi5zdmdcIjtcbmltcG9ydCBcIi4vaWNvbnMvbG9nb3V0LnN2Z1wiO1xuaW1wb3J0IFwiLi9pY29ucy9wYXNzd29yZC5zdmdcIjtcbmltcG9ydCBcIi4vaWNvbnMvcGFzc3dvcmQtc2hvdy5zdmdcIjtcblxuaW1wb3J0IGluaXRpYWxpemVUb2dnbGVQYXNzd29yZCBmcm9tIFwiLi9qcy90b2dnbGUtcGFzc3dvcmRcIjtcblxuZG9jdW1lbnQuYWRkRXZlbnRMaXN0ZW5lcihcIkRPTUNvbnRlbnRMb2FkZWRcIiwgKCkgPT4ge1xuICBpbml0aWFsaXplVG9nZ2xlUGFzc3dvcmQoKTtcbn0pO1xuIiwiZXhwb3J0IGRlZmF1bHQgZnVuY3Rpb24gaW5pdGlhbGl6ZVRvZ2dsZVBhc3N3b3JkKCkge1xuICBjb25zdCB0b2dnbGVQYXNzd29yZCA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwidG9nZ2xlUGFzc3dvcmRcIik7XG4gIGNvbnN0IHBhc3N3b3JkID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoXCJpbnB1dFBhc3N3b3JkXCIpO1xuICBjb25zdCBwYXNzd29yZEljb24gPSBkb2N1bWVudC5nZXRFbGVtZW50QnlJZChcInBhc3N3b3JkSWNvblwiKTtcbiAgY29uc3QgcGFzc3dvcmRTaG93SWNvbiA9IGRvY3VtZW50LmdldEVsZW1lbnRCeUlkKFwicGFzc3dvcmRTaG93SWNvblwiKTtcblxuICB0b2dnbGVQYXNzd29yZC5hZGRFdmVudExpc3RlbmVyKFwiY2xpY2tcIiwgKCkgPT4ge1xuICAgIGNvbnN0IHR5cGUgPVxuICAgICAgcGFzc3dvcmQuZ2V0QXR0cmlidXRlKFwidHlwZVwiKSA9PT0gXCJwYXNzd29yZFwiID8gXCJ0ZXh0XCIgOiBcInBhc3N3b3JkXCI7XG4gICAgcGFzc3dvcmQuc2V0QXR0cmlidXRlKFwidHlwZVwiLCB0eXBlKTtcbiAgICBwYXNzd29yZEljb24uc3R5bGUuZGlzcGxheSA9IHR5cGUgPT09IFwicGFzc3dvcmRcIiA/IFwiYmxvY2tcIiA6IFwibm9uZVwiO1xuICAgIHBhc3N3b3JkU2hvd0ljb24uc3R5bGUuZGlzcGxheSA9IHR5cGUgPT09IFwidGV4dFwiID8gXCJibG9ja1wiIDogXCJub25lXCI7XG4gIH0pO1xufVxuIiwiLy8gZXh0cmFjdGVkIGJ5IG1pbmktY3NzLWV4dHJhY3QtcGx1Z2luXG5leHBvcnQge307Il0sIm5hbWVzIjpbImluaXRpYWxpemVUb2dnbGVQYXNzd29yZCIsImRvY3VtZW50IiwiYWRkRXZlbnRMaXN0ZW5lciIsInRvZ2dsZVBhc3N3b3JkIiwiZ2V0RWxlbWVudEJ5SWQiLCJwYXNzd29yZCIsInBhc3N3b3JkSWNvbiIsInBhc3N3b3JkU2hvd0ljb24iLCJ0eXBlIiwiZ2V0QXR0cmlidXRlIiwic2V0QXR0cmlidXRlIiwic3R5bGUiLCJkaXNwbGF5Il0sInNvdXJjZVJvb3QiOiIifQ==