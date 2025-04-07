"use strict";
var html = document.documentElement;

// INITILIZE SIDEBAR SIZE
function setSidebarSize() {
  if (localStorage.getItem("data-sidebar-size")) {
    html.setAttribute(
      "data-sidebar-size",
      localStorage.getItem("data-sidebar-size")
    );
  } else {
    localStorage.setItem("data-sidebar-size", "lg");
  }
}
setSidebarSize();

// TOGGLE SIDEBAR SIZE
function toggleAppMenuSize() {
  if (localStorage.getItem("data-sidebar-size") != "lg") {
    localStorage.setItem("data-sidebar-size", "lg");
  } else {
    localStorage.setItem("data-sidebar-size", "sm");
  }

  // UPDATE SIDEBAR SIZE ATTRIBUTE
  setSidebarSize();

  // SET CURRENT ACTIVE MENU
  setActiveMenu();

  // DESTROY AND UPDATE SMOOTH SCROLLBAR
  if (html.getAttribute("data-sidebar-size") != "lg") {
    Scrollbar.destroy(document.querySelector("#app-menu-scrollbar"));
  } else {
    let option = {
      continuousScrolling: false,
      alwaysShowTracks: true,
    };
    Scrollbar.initAll(option);
  }
}

// SET CURRENT ACTIVE MENU
function setActiveMenu() {
  let currentPath =
    location.pathname == "/" ? "index.html" : location.pathname.substring(1);
  currentPath = currentPath.substring(currentPath.lastIndexOf("/") + 1);
  if (currentPath && document.getElementById("navbar-nav")) {
    let a = document
      .getElementById("navbar-nav")
      .querySelector(`[href="${currentPath}"]`);

    if (a) {
      a.classList.add("active");

      let dropdownButton =
        a.parentElement.parentElement.parentElement.previousElementSibling;

      let firstLayerDropdownContainer =
        a.parentElement.parentElement.parentElement;

      let dropdownContainer =
        firstLayerDropdownContainer.parentElement.parentElement.parentElement;

      if (firstLayerDropdownContainer.classList.contains("dropdown-content")) {
        firstLayerDropdownContainer.style.maxHeight =
          firstLayerDropdownContainer.scrollHeight + "px";
      }
      if (dropdownContainer.classList.contains("dropdown-content")) {
        dropdownContainer.style.maxHeight =
          firstLayerDropdownContainer.scrollHeight +
          dropdownContainer.scrollHeight +
          "px";
      }

      if (dropdownButton) {
        dropdownButton.classList.add(...["show", "active"]);
        dropdownButton.parentElement.parentElement.parentElement.previousElementSibling?.classList.add(
          ...["show", "active"]
        );
      }
    }
  }
}
setActiveMenu();

function windowResizer() {
  let windowSize = document.documentElement.clientWidth;

  // ADD FUNCTIONALITY ON WINDOW RESIZE
  if (windowSize >= 1280) {
    if (document.getElementById("app-menu-hamburger")) {
      document
        .getElementById("app-menu-hamburger")
        .addEventListener("click", toggleAppMenuSize);
    }
  } else if (windowSize < 1280 && document.getElementById("app-drawer")) {
    localStorage.setItem("data-sidebar-size", "lg");
    html.setAttribute(
      "data-sidebar-size",
      localStorage.getItem("data-sidebar-size")
    );
    document.getElementById("app-drawer").classList.remove("z-backdrop");
    document.getElementById("app-drawer").classList.add("z-[151]");
  }

  // UPDATE SCROLL BAR
  if (windowSize < 1280 && html.getAttribute("data-sidebar-size") == "lg") {
    let option = {
      continuousScrolling: false,
      alwaysShowTracks: true,
    };
    if (document.querySelector("[data-scrollbar]")) {
      Scrollbar.initAll(option);
    }
  }
}
windowResizer();

// ON WINDOW RESIZE
window.addEventListener("resize", windowResizer, true);

// INIT ALL SELECT2
// $(document).ready(function () {
//   // COMMON SINGLE SELECT WITH SEARCH
//   $(".singleSelect").select2({ width: "100%" });
//   // COMMON MULTIPLE SELECT WITH SEARCH
//   $(".multiSelect").select2({
//     width: "100%",
//     placeholder: "Select option",
//     tags: true,
//   });
//   // COMMON MULTIPLE SELECT WITH CHECKBOX
//   $(".multiSelectCheck").select2({
//     width: "100%",
//     placeholder: "Select option",
//     closeOnSelect: false,
//     tags: true,
//   });
// });

// INIT ALL SELECT2
document.addEventListener("DOMContentLoaded", () => {
  const singleSelects = document.querySelectorAll(".singleSelect");
  const multiSelects = document.querySelectorAll(".multiSelect");
  const multiSelectChecks = document.querySelectorAll(".multiSelectCheck");

  singleSelects.forEach((singleSelect) => {
    $(singleSelect).select2({
      width: "100%",
    });
  });

  multiSelects.forEach((multiSelect) => {
    $(multiSelect).select2({
      width: "100%",
      placeholder: "Select option",
      tags: true,
    });
  });

  multiSelectChecks.forEach((multiSelectCheck) => {
    $(multiSelectCheck).select2({
      width: "100%",
      placeholder: "Select option",
      closeOnSelect: false,
      tags: true,
    });
  });
});
