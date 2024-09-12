'use strict';



/**
 * add event on element
 */

const addEventOnElem = function (elem, type, callback) {
  if (elem.length > 1) {
    for (let i = 0; i < elem.length; i++) {
      elem[i].addEventListener(type, callback);
    }
  } else {
    elem.addEventListener(type, callback);
  }
}



/**
 * navbar toggle
 */

const navbar = document.querySelector("[data-navbar]");
const navTogglers = document.querySelectorAll("[data-nav-toggler]");
const navLinks = document.querySelectorAll("[data-nav-link]");
const overlay = document.querySelector("[data-overlay]");

const toggleNavbar = function () {
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
}

addEventOnElem(navTogglers, "click", toggleNavbar);

const closeNavbar = function () {
  navbar.classList.remove("active");
  overlay.classList.remove("active");
}

addEventOnElem(navLinks, "click", closeNavbar);



/**
 * header active when scroll down to 100px
 */

const header = document.querySelector("[data-header]");
const backTopBtn = document.querySelector("[data-back-top-btn]");

const activeElem = function () {
  if (window.scrollY > 100) {
    header.classList.add("active");
    backTopBtn.classList.add("active");
  } else {
    header.classList.remove("active");
    backTopBtn.classList.remove("active");
  }
}
addEventOnElem(window, "scroll", activeElem);

// هلأ هون مشان الزرار تسجيل الدخول وانشاء الحساب والموديل 
var modal = document.getElementById("loginModal");
var loginBtn = document.getElementById("loginBtn");
var closeModal = document.getElementsByClassName("close")[0];

// عند الضغط على زر تسجيل الدخول
loginBtn.onclick = function() {
  modal.style.display = "block";
}

// عند الضغط على X لإغلاق النافذة
closeModal.onclick = function() {
  modal.style.display = "none";
}

// عند الضغط خارج النافذة لإغلاقها
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

var registerModalWindow = document.getElementById("registerModalWindow");
var openRegisterModal = document.getElementById("openRegisterModal");
var closeRegisterModal = document.getElementsByClassName("close-register")[0];

// عند الضغط على زر تسجيل حساب
openRegisterModal.onclick = function() {
  registerModalWindow.style.display = "block";
}

// عند الضغط على X لإغلاق النافذة
closeRegisterModal.onclick = function() {
  registerModalWindow.style.display = "none";
}

// عند الضغط خارج النافذة لإغلاقها
window.onclick = function(event) {
  if (event.target == registerModalWindow) {
    registerModalWindow.style.display = "none";
  }
}
