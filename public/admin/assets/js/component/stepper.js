const stepperStepButton = document.querySelectorAll(".stepper-step-btn");
const prevStepButton = document.querySelector(".prev-step-btn");
const nextStepButton = document.querySelector(".next-step-btn");
const stepperMenu = document.querySelector(".stepper-menu");
const fieldsets = document.querySelectorAll(".fieldset");
let scrollLeftValue;
let isDragging = false;
// FOR FORM
const prevFormButton = document.querySelectorAll(".prev-form-btn");
const nextFormButton = document.querySelectorAll(".next-form-btn");
let current_fieldset, next_fieldset, previous_fieldset;

// CLICK NEXT FORM BUTTON
nextFormButton.forEach((nextBtn) => {
  nextBtn.addEventListener("click", function () {
    current_fieldset = this.closest(".fieldset");
    next_fieldset = current_fieldset.nextElementSibling;
    // Add Active Class
    stepperStepButton[
      Array.from(fieldsets).indexOf(next_fieldset)
    ].classList.add("active");

    current_fieldset.classList.remove("!block");

    next_fieldset.classList.add("!block");
  });
});

// CLICK PREVIOUS FORM BUTTON
prevFormButton.forEach((previousButton) => {
  previousButton.addEventListener("click", function () {
    current_fieldset = this.closest(".fieldset");
    previous_fieldset = current_fieldset.previousElementSibling;
    // Remove active class
    stepperStepButton[
      Array.from(fieldsets).indexOf(current_fieldset)
    ].classList.remove("active");

    current_fieldset.classList.remove("!block");

    previous_fieldset.classList.add("!block");
  });
});

// SETTING STEPPER BUTTON VISIBILITY
function buttonActivation() {
  scrollLeftValue = Math.ceil(stepperMenu.scrollLeft);
  // console.log("scrollLeftValue", scrollLeftValue);

  let scrollableWidth = stepperMenu.scrollWidth - stepperMenu.clientWidth;
  // console.log("scrollableWidth", scrollableWidth);

  prevStepButton.style.display =
    scrollableWidth > scrollLeftValue ? "block" : "none";

  nextStepButton.style.display =
    scrollableWidth > scrollLeftValue ? "block" : "none";

  prevStepButton.style.display = scrollLeftValue > 0 ? "block" : "none";
}

nextStepButton.addEventListener("click", () => {
  stepperMenu.scrollLeft += 200;
  buttonActivation();
});

prevStepButton.addEventListener("click", () => {
  stepperMenu.scrollLeft -= 200;
  buttonActivation();
});

function stepActivation(currentStepperIndex) {
  stepperStepButton.forEach((stepBtn) => {
    stepBtn.classList.remove("active");
  });

  fieldsets.forEach((fieldset) => {
    fieldset.classList.remove("!block");
  });

  stepperStepButton[currentStepperIndex].classList.add("active");
  fieldsets[currentStepperIndex].classList.add("!block");
}

stepperStepButton.forEach((stepBtn, i) => {
  stepBtn.addEventListener("click", () => {
    stepActivation(i);
  });
});

// STEPPER DRAGGING
stepperMenu.addEventListener("mousemove", (drag) => {
  if (!isDragging) return;
  stepperMenu.scrollLeft -= drag.movementX;
  stepperMenu.classList.add("dragging");
});

document.addEventListener("mouseup", () => {
  isDragging = false;
  stepperMenu.classList.remove("dragging");
});

stepperMenu.addEventListener("mousedown", () => {
  isDragging = true;
});

window.onload = function () {
  buttonActivation();
  prevStepButton.style.display = scrollLeftValue > 0 ? "block" : "none";
};

window.onresize = function () {
  buttonActivation();
  prevStepButton.style.display = scrollLeftValue > 0 ? "block" : "none";
};
