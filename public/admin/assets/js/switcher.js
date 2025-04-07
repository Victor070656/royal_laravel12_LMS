var html = document.documentElement;
const switchRadioLight = document.getElementById("radioThemeLight");
const switchRadioDark = document.getElementById("radioThemeDark");
const switchRadioSquare = document.getElementById("radioThemeCardSquare");
const switchRadioRound = document.getElementById("radioThemeCardRound");
const switchRadioFluid = document.getElementById("radioThemeWidthFluid");
const switchRadioBox = document.getElementById("radioThemeWidthBox");
let themeMode, cardStyle, themeWidth;

// TOGGLE LIGHT AND DARK MOOD
// themeMode = html.getAttribute("data-theme-mode");
themeMode = "light";
if (localStorage.getItem("theme-mode")) {
  themeMode = localStorage.getItem("theme-mode");
  html.setAttribute("data-theme-mode", themeMode);
} else if (html.hasAttribute("data-theme-mode")) {
  themeMode = html.getAttribute("data-theme-mode");
}
html.classList.add(themeMode);
function toggleThemeMode() {
  themeMode = themeMode === "light" ? "dark" : "light";
  html.setAttribute("data-theme-mode", themeMode);
  html.classList.remove("light", "dark");
  html.classList.add(themeMode);
  localStorage.setItem("theme-mode", themeMode);
  checker();
}

// TOGGLE THEME CARD STYLE
cardStyle = "square";
if (localStorage.getItem("card-style")) {
  cardStyle = localStorage.getItem("card-style");
  html.setAttribute("data-card-style", cardStyle);
} else if (html.hasAttribute("data-card-style")) {
  cardStyle = html.getAttribute("data-card-style");
}
function toggleCardStyle() {
  cardStyle = cardStyle === "square" ? "round" : "square";
  html.setAttribute("data-card-style", cardStyle);
  localStorage.setItem("card-style", cardStyle);
  checker();
}

// TOGGLE THEME WIDTH STYLE
themeWidth = "fluid";
if (localStorage.getItem("theme-width")) {
  themeWidth = localStorage.getItem("theme-width");
  html.setAttribute("data-theme-width", themeWidth);
} else if (html.hasAttribute("data-theme-width")) {
  themeWidth = html.getAttribute("data-theme-width");
}
function settingThemeWidth() {
  themeWidth = themeWidth === "fluid" ? "box" : "fluid";
  html.setAttribute("data-theme-width", themeWidth);
  localStorage.setItem("theme-width", themeWidth);
  checker();
}

// CHECKER FUNCTION
function checker() {
  if (switchRadioLight && switchRadioDark) {
    switchRadioLight.checked = themeMode == "light";
    switchRadioDark.checked = themeMode == "dark";
  }
  if (switchRadioSquare && switchRadioRound) {
    switchRadioSquare.checked = cardStyle == "square";
    switchRadioRound.checked = cardStyle == "round";
  }
  if (switchRadioFluid && switchRadioBox) {
    switchRadioFluid.checked = themeWidth == "fluid";
    switchRadioBox.checked = themeWidth == "box";
  }
}
checker();

// RESET BUTTON
function resetThemeConfig() {
  if (localStorage.getItem("theme-mode")) {
    localStorage.removeItem("theme-mode");
  }
  if (localStorage.getItem("card-style")) {
    localStorage.removeItem("card-style");
  }
  if (localStorage.getItem("theme-width")) {
    localStorage.removeItem("theme-width");
  }
  location.reload();
}
