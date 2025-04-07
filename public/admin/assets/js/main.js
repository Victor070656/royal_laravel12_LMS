// PAGE LOADER
function hideLoader() {
    document.getElementById("loader").remove();
}

// ON PAGE LOADED
window.addEventListener("DOMContentLoaded", function () {
    hideLoader();

    if (this.document.getElementById("app-drawer")) {
        document
            .getElementById("app-menu-scrollbar")
            .querySelector(".scrollbar-track-x")
            .remove();
    }
});

// INTIALIZE SMOOTH SCROLLBAR
let option = {
    continuousScrolling: false,
    alwaysShowTracks: true,
};
if (document.querySelector("[data-scrollbar]")) {
    Scrollbar.initAll(option);
}

// Component accordion
const accordButtons = document.querySelectorAll(".com-accordion-button");
accordButtons.forEach((accordBtn, index) => {
    accordBtn.addEventListener("click", () => {
        accordButtons.forEach((item, i) => {
            if (index !== i) {
                item.classList.remove("open");
            }
        });
        accordBtn.classList.toggle("open");
        accordBtn.parentElement.classList.toggle("open");
    });
});

// REPLACE ALL EMPTY LINK WITH VOID
document.querySelectorAll('[href="#"]').forEach((link) => {
    let js_void = "javascript:void(0)";
    link.setAttribute("href", js_void);
});

// CHOICE EMAIL INPUT
const choiseInput = document.querySelectorAll(".choices-input");
choiseInput.forEach((input) => {
    new Choices(input, {
        removeItemButton: true,
        maxItemCount: 3,
        duplicateItemsAllowed: false,
        allowHTML: true,
    });
});

// COLOR PICKER
if (document.getElementById("color-picker")) {
    document.getElementById("color-picker").addEventListener("change", () => {
        document.querySelector(".color-value").textContent =
            document.getElementById("color-picker").value;
    });
}
if (document.querySelectorAll(".color-picker")) {
    document.querySelectorAll(".color-picker").forEach((picker) => {
        const updateColor = () => {
            const newColor = picker.value;
            picker.closest("label").style.backgroundColor = newColor;
        };

        updateColor();
        picker.addEventListener("input", updateColor);
    });
}

// FILE INPUT
function uploadFile() {
    // single image uploader
    document.querySelectorAll(".img-src").forEach(function (fileInput) {
        fileInput.onchange = function () {
            const reader = new FileReader();
            // read the image file as a data URL.
            reader.readAsDataURL(this.files[0]);

            reader.onload = (e) => {
                this.classList.add("uploaded");
                this.closest(
                    ".file-container"
                ).style.backgroundImage = `url("${e.target.result}")`;
            };
        };
    });

    // Single File Uploader
    document.querySelectorAll(".file-src").forEach(function (fileInput) {
        fileInput.onchange = function () {
            const reader = new FileReader();
            // read the file as a data URL.
            reader.readAsDataURL(this.files[0]);
            let value = this.value;

            reader.onload = () => {
                this.classList.add("uploaded");
                this.closest(".file-container").querySelector(
                    ".file-name"
                ).innerHTML = value.substring(value.lastIndexOf("\\") + 1);
            };
        };
    });
}
uploadFile();

// Initialize All Date Input Value as TODAY
const dateInput = document.querySelectorAll("[type='date']");
dateInput.forEach((input) => {
    input.valueAsDate = new Date();
});

// INITIALIZE HEADER LANGUAGE
function setLanguage(lang) {
    switch (lang) {
        case "en":
            document.getElementById("header-lang-img").src =
                "assets/images/flag/us.svg";
            document.getElementById("header-lang-img").title = "English";
            break;
        case "sp":
            document.getElementById("header-lang-img").src =
                "assets/images/flag/es.svg";
            document.getElementById("header-lang-img").title = "Spanish";
            break;
        case "fr":
            document.getElementById("header-lang-img").src =
                "assets/images/flag/fr.svg";
            document.getElementById("header-lang-img").title = "French";
            break;
        case "it":
            document.getElementById("header-lang-img").src =
                "assets/images/flag/it.svg";
            document.getElementById("header-lang-img").title = "Italy";
            break;
        case "ar":
            document.getElementById("header-lang-img").src =
                "assets/images/flag/ar.svg";
            document.getElementById("header-lang-img").title = "Arabic";
            break;
    }
}
if (document.getElementById("dropdownLanguage")) {
    document
        .getElementById("dropdownLanguage")
        .addEventListener("click", (event) => {
            setLanguage(event.target.getAttribute("data-lang"));
        });
}

// Input range slide
document.querySelectorAll(".range-wrapper").forEach((rangeWrapper) => {
    const rangeInput = rangeWrapper.querySelector(".range-input");
    const rangeLine = rangeWrapper.querySelector(".range-line");
    const rangeHandler = rangeWrapper.querySelector(".range-handler");
    const rangeNumber = rangeWrapper.querySelectorAll(".range-number");
    const incrementButton =
        rangeWrapper.parentElement.querySelector(".range-increment");
    const decrementButton =
        rangeWrapper.parentElement.querySelector(".range-decrement");

    // price range
    const minVal = document.querySelector(".min-val");
    const maxVal = document.querySelector(".max-val");
    const minTooltip = document.querySelector(".min-tooltip");
    const maxTooltip = document.querySelector(".max-tooltip");
    const minGap = 0;
    const range = document.querySelector(".slider-line");
    const sliderMinValue = parseInt(minVal.min);
    const sliderMaxValue = parseInt(maxVal.max);

    const rangeInputSlider = () => {
        if (rangeNumber.length) {
            rangeNumber.forEach(
                (number) => (number.textContent = rangeInput.value)
            );
        }

        const tooltipPosition = rangeInput.value / rangeInput.max;
        const space = rangeInput.offsetWidth - rangeHandler.offsetWidth;

        rangeHandler.style.left = tooltipPosition * space + "px";
        rangeLine.style.width = rangeInput.value + "%";
    };

    if (incrementButton) {
        incrementButton.addEventListener("click", function () {
            rangeInput.value = Math.min(
                parseInt(rangeInput.value) + 1,
                parseInt(rangeInput.max)
            );
            rangeInput.dispatchEvent(new Event("input"));
        });
    }

    if (decrementButton) {
        decrementButton.addEventListener("click", function () {
            rangeInput.value = Math.max(
                parseInt(rangeInput.value) - 1,
                parseInt(rangeInput.min)
            );
            rangeInput.dispatchEvent(new Event("input"));
        });
    }

    rangeInput.addEventListener("input", rangeInputSlider);
    rangeInputSlider();

    // price range
    function slideMin() {
        let gap = parseInt(maxVal.value) - parseInt(minVal.value);
        if (gap <= minGap) {
            minVal.value = parseInt(maxVal.value) - minGap;
        }
        minTooltip.innerHTML = "$" + minVal.value;
        setArea();
    }

    function slideMax() {
        let gap = parseInt(maxVal.value) - parseInt(minVal.value);
        if (gap <= minGap) {
            maxVal.value = parseInt(minVal.value) + minGap;
        }
        maxTooltip.innerHTML = "$" + maxVal.value;
        setArea();
    }

    function setArea() {
        const minPercentage = (minVal.value / sliderMaxValue) * 100;
        const maxPercentage = (maxVal.value / sliderMaxValue) * 100;

        range.style.left = minPercentage + "%";
        range.style.right = 100 - maxPercentage + "%";

        minTooltip.style.left = minPercentage + "%";
        maxTooltip.style.left = maxPercentage + "%";
    }

    minVal.addEventListener("input", slideMin);
    maxVal.addEventListener("input", slideMax);

    slideMin();
    slideMax();
});

// Side Of Canvas
function toggleLeftSideCanvas() {
    var ofOverlay = document.getElementById("ofcanvasOverlay");
    var leftSidebar = document.getElementById("toggleLeftSideCanvas");
    leftSidebar.classList.remove("-");
    ofOverlay.classList.add("opacity-50");
    ofOverlay.classList.remove("invisible");
}
function toggleRightSideCanvas() {
    var ofOverlay = document.getElementById("ofcanvasOverlay");
    var rightSidebar = document.getElementById("toggleRightSideCanvas");
    rightSidebar.classList.remove("");
    ofOverlay.classList.add("opacity-50");
    ofOverlay.classList.remove("invisible");
}

function closeSideCanvas() {
    var ofOverlay = document.getElementById("ofcanvasOverlay");
    var leftSidebar = document.getElementById("toggleLeftSideCanvas");
    var rightSidebar = document.getElementById("toggleRightSideCanvas");
    leftSidebar.classList.add("-");
    rightSidebar.classList.add("");
    ofOverlay.classList.remove("opacity-50");
    ofOverlay.classList.add("invisible");
}

// COUNTER NUMBER
(function counter() {
    const counters = document.querySelectorAll(".counter-value");

    if (counters.length) {
        counters.forEach((counter) => {
            const value = counter.getAttribute("data-value");
            const inc = value / 300;
            let count = 0;
            function pad(toPad, padChar, length) {
                return String(toPad).length < length
                    ? new Array(length - String(toPad).length + 1).join(
                          padChar
                      ) + String(toPad)
                    : toPad;
            }
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
            const updateCount = () => {
                count += inc;
                if (count < value) {
                    counter.innerText = pad(
                        numberWithCommas(count.toFixed(0)),
                        "0",
                        "2"
                    );
                    setTimeout(updateCount, 1);
                } else {
                    counter.innerText = pad(numberWithCommas(value), "0", "2");
                }
            };
            updateCount();
        });
    }
})();

// INITIALIZE CURRENT DATE
(function getCurrentTime() {
    const date = new Date();
    const day = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Sunday",
    ];
    const month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sept",
        "Oct",
        "Nov",
        "Dec",
    ];
    const dayName = date.getDay();
    const todayDate = date.getDate();
    const monthName = date.getMonth();
    const year = date.getFullYear();
    document
        .querySelectorAll(".today")
        .forEach(
            (date) =>
                (date.innerHTML = `Today is ${day[dayName]}, ${todayDate} ${month[monthName]} ${year}`)
        );
})();

// INITIALIZE SUMMERNOTE
document.addEventListener("DOMContentLoaded", function () {
    const customTextArea = document.querySelectorAll(".summernote");
    customTextArea.forEach((textarea) => {
        $(textarea).summernote({
            placeholder: "Write your description here...",
            tabsize: 2,
            height: 200,
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["height", ["height"]],
                ["table", ["table"]],
                ["insert", ["link", "picture", "video"]],
                ["view", ["fullscreen", "codeview", "help"]],
            ],
        });
    });
});

// TOGGLE PASSWORD
const inputTypeToggler = document.querySelectorAll(".inputTypeToggle");
inputTypeToggler.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        let passwordInput = this.parentElement.parentElement.children[0];

        passwordInput.type = this.checked ? "text" : "password";
    });
});

const inputTypeToggler2 = document.querySelectorAll(".inputTypeToggler");
inputTypeToggler2.forEach(function (checkbox) {
    checkbox.addEventListener("change", function () {
        let passwordInput = this.parentElement.parentElement.children[0];

        passwordInput.type = this.checked ? "text" : "password";
    });
});

// ADD AND REMOVE FAQ INPUT
function addCourseFaq() {
    const courseFaqContainer = document.querySelector(".faq-container");
    const newChild = `
  <div class="flex gap-4 removeable-parent">
    <div class="grow flex flex-col gap-2">
      <input type="text" placeholder="Faq question" class="form-input">
      <textarea  class="form-input h-auto" rows="2"></textarea>
    </div>
    <button type="button" class="btn-icon btn-danger-icon-light shrink-0 remove-parent-button">
      <i class="ri-delete-bin-line text-inherit"></i>
    </button>
  <div/>
  `;
    courseFaqContainer.insertAdjacentHTML("beforeend", newChild);
    removeInfoItem();
}

function addCourseRequirement() {
    const CourseRequirementContainer = document.querySelector(
        ".requirement-container"
    );
    const newChild = `
  <div class="flex gap-4 removeable-parent">
    <div class="grow flex flex-col gap-2">
      <input type="text" placeholder="Course Requirement" class="form-input">
    </div>
    <button type="button" class="btn-icon btn-danger-icon-light shrink-0 remove-parent-button">
      <i class="ri-delete-bin-line text-inherit"></i>
    </button>
  <div/>
  `;
    CourseRequirementContainer.insertAdjacentHTML("beforeend", newChild);
    removeInfoItem();
}

function addCourseOutcome() {
    const courseOutcomeContainer = document.querySelector(".outcome-container");
    const newChild = `
  <div class="flex gap-4 removeable-parent">
    <div class="grow flex flex-col gap-2">
      <input type="text" placeholder="Course Outcome" class="form-input">
    </div>
    <button type="button" class="btn-icon btn-danger-icon-light shrink-0 remove-parent-button">
      <i class="ri-delete-bin-line text-inherit"></i>
    </button>
  <div/>
  `;

    courseOutcomeContainer.insertAdjacentHTML("beforeend", newChild);
    removeInfoItem();
}

function addMultipleQuizField() {
    const quizAnsContainer = document.querySelector(".multiple-quiz-container");
    const newChild = `
  <li class="border border-input-border dark:border-dark-border-four rounded-lg p-2 removeable-parent dk-theme-card-square">
    <div class="flex gap-2">
      <textarea placeholder="Option" class="form-input h-auto" rows="1"></textarea>
      <button type="button" class="btn b-outline btn-danger-outline btn-sm max-h-10 remove-parent-button">
        <i class="ri-close-line text-inherit"></i>
      </button>
    </div>
    <div class="leading-none flex items-center gap-2 mt-2">
      <label class="inline-flex items-center cursor-pointer">
        <input type="checkbox" class="appearance-none peer">
        <span class="switcher switcher-primary-solid"></span>
      </label>
      <div class="text-gray-500 dark:text-dark-text-two font-medium">Check if this is Correct</div>
    </div>
  </li>
  `;
    quizAnsContainer.insertAdjacentHTML("beforeend", newChild);
    removeInfoItem();
}

let singleQuizFieldId = 0;
function addSingleQuizField() {
    singleQuizFieldId++;
    const quizAnsContainer = document.querySelector(".single-quiz-container");
    const newChild = `
  <li class="border border-input-border dark:border-dark-border-four rounded-lg p-2 removeable-parent dk-theme-card-square">
    <div class="flex gap-2">
      <textarea placeholder="Option" class="form-input h-auto" rows="1"></textarea>
      <button type="button" class="btn b-outline btn-danger-outline btn-sm max-h-10 remove-parent-button">
        <i class="ri-close-line text-inherit"></i>
      </button>
    </div>
    <div class="leading-none flex items-center gap-2 mt-2">
      <div class="flex items-center gap-2">
        <input type="radio" name="singleOption" id="s-${singleQuizFieldId}" class="radio radio-primary">
        <label for="s-${singleQuizFieldId}" class="dark:text-dark-text-two">Check if this is Correct</label>
      </div>
    </div>
  </li>
  `;
    quizAnsContainer.insertAdjacentHTML("beforeend", newChild);
    removeInfoItem();
}

function removeInfoItem() {
    document.querySelectorAll(".remove-parent-button").forEach((removeBtn) => {
        removeBtn.addEventListener("click", function () {
            this.closest(".removeable-parent").remove();
        });
    });
}
removeInfoItem();

// INIT SORTABLE JS
const courseChapter = document.querySelectorAll(".sortCourseChapter");
courseChapter.forEach(function (topic) {
    new Sortable(topic, {
        animation: 150,
        ghostClass: "invisible",
        handle: ".sortCourseChapterHandler",
    });
});
const sortCourseTopic = document.querySelectorAll(".sortCourseTopic");
sortCourseTopic.forEach(function (topic) {
    new Sortable(topic, {
        animation: 150,
        ghostClass: "invisible",
        handle: ".sortCourseTopicHandler",
    });
});

// GET COURSE TOPIC TYPE
function getTopicType() {
    const topicType = document.querySelector("select#courseTopic").value;

    document.querySelectorAll(".topicTypeField").forEach(function (field) {
        if (field.classList.contains(`${topicType}`)) {
            field.classList.remove("hidden");
        } else {
            field.classList.add("hidden");
        }
    });
}

// GET QUIZ TYPE
function getQuizType() {
    const quizType = document.querySelector("select#quizType").value;

    document.querySelectorAll(".quizTypeField").forEach(function (field) {
        if (field.classList.contains(`${quizType}`)) {
            field.classList.remove("hidden");
        } else {
            field.classList.add("hidden");
        }
    });
}

// GET COUPON TYPE
function getCouponType() {
    const couponType = document.querySelector("select#couponType").value;

    document.querySelectorAll(".couponTypeField").forEach(function (field) {
        if (field.classList.contains(`${couponType}`)) {
            field.classList.remove("hidden");
        } else {
            field.classList.add("hidden");
        }
    });
}

// GET COUPON DISCOUNT TYPE
function getCouponDiscountType() {
    const couponDiscountType = document.querySelector(
        "select#couponDiscountType"
    ).value;

    document
        .querySelectorAll(".couponDiscountTypeField")
        .forEach(function (field) {
            if (field.classList.contains(`${couponDiscountType}`)) {
                field.classList.remove("hidden");
            } else {
                field.classList.add("hidden");
            }
        });
}
