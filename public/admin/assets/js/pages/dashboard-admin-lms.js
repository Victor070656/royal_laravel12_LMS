// Total Revenue
const revenueOptions = {
  series: [
    {
      name: "Revenue",
      data: [0, 30, 10, 35, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "area",
    height: 70,
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },

    zoom: {
      autoScaleYaxis: true,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  colors: ["#5F71FA"],
  stroke: {
    width: 1.2,
    curve: "straight",
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const revenueChart = new ApexCharts(
  document.querySelector("#admin-overall-revenue-chart"),
  revenueOptions
);
revenueChart.render();

// Total Enrollment
var enrollOptions = {
  series: [
    {
      name: "Enroll",
      data: [33, 28, 15, 30, 11, 25, 10, 30, 5],
    },
  ],
  chart: {
    type: "area",
    height: 70,
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
    zoom: {
      autoScaleYaxis: true,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  colors: ["#FF4626"],
  stroke: {
    width: 1.2,
    curve: "straight",
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};

var enrollChart = new ApexCharts(
  document.querySelector("#admin-total-registration-chart"),
  enrollOptions
);
enrollChart.render();

// Total Courses
var courseOptions = {
  series: [
    {
      name: "Course",
      data: [0, 30, 10, 35, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "area",
    height: 70,
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },

    zoom: {
      autoScaleYaxis: true,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  colors: ["#5F71FA"],
  stroke: {
    width: 1.2,
    curve: "straight",
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
var courseChart = new ApexCharts(
  document.querySelector("#admin-total-course-chart"),
  courseOptions
);
courseChart.render();

// Average Rating
const ratingOptions = {
  series: [
    {
      name: "Rating",
      data: [0, 30, 10, 35, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "area",
    width: "100%",
    height: 70,
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },

    zoom: {
      autoScaleYaxis: true,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  colors: ["#5F71FA"],
  stroke: {
    width: 1.2,
    curve: "straight",
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const ratingChart = new ApexCharts(
  document.querySelector("#admin-average-review-chart"),
  ratingOptions
);
ratingChart.render();

// Average Registration Rate Chart
const averageRegistrationOptions = {
  chart: {
    type: "line",
    height: 320,
    width: "100%",
    offsetX: -5,
    offsetY: 15,
    toolbar: {
      show: false,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  xaxis: {
    categories: [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "May",
      "Jun",
      "Jul",
      "Aug",
      "Sep",
      "Oct",
      "Nov",
      "Dec",
    ],
  },
  yaxis: {
    min: 5,
    max: 100,
    tickAmount: 5,
    // labels: {
    //   formatter: (val) => val + "k",
    // },
  },
  series: [
    {
      name: "Paid course",
      data: [73, 49, 29, 56, 99, 50, 80, 40, 90, 45, 58, 88],
    },
    {
      name: "Free course",
      data: [22, 39, 49, 73, 29, 60, 40, 55, 20, 63, 55, 65],
    },
  ],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "18%",
      endingShape: "rounded",
    },
  },
  grid: {
    borderColor: "#EEE",
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: "smooth",
    colors: ["#5F71FA", "#76D466"],
    width: 1,
  },
  // fill: {
  //   type: "gradient",
  //   gradient: {
  //     opacityFrom: 0.5,
  //     opacityTo: 0.2,
  //     stops: [0, 60],
  //   },
  // },
  legend: {
    position: "top",
    horizontalAlign: "left",
    offsetX: -30,
    offsetY: 0,
    markers: {
      width: 7,
      height: 7,
      radius: 99,
      fillColors: ["#5F71FA", "#76D466"],
      offsetX: -3,
      offsetY: -1,
    },
    itemMargin: {
      horizontal: 20,
    },
  },
  tooltip: {
    y: {
      formatter: (val) => {
        return val + "k";
      },
    },
  },
};

const averageRegistration = new ApexCharts(
  document.querySelector("#admin-average-registration-chart"),
  averageRegistrationOptions
);
averageRegistration.render();

// Trending Categories  Chart
// Chart One (Graphic Design)
const catrgoryOneOptions = {
  series: [
    {
      name: "graphic",
      data: [5, 15, 10, 25, 28, 16, 18, 28, 30],
    },
  ],
  chart: {
    type: "area",
    height: 30,
    width: "80px",
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  colors: ["#76D466"],
  stroke: {
    width: 1,
    curve: "straight",
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const categoryOneChart = new ApexCharts(
  document.querySelector("#category-one"),
  catrgoryOneOptions
);
categoryOneChart.render();

// Chart Two (UI/UX Design)
const catrgoryTwoOptions = {
  series: [
    {
      name: "ui/ux",
      data: [30, 28, 18, 16, 28, 25, 10, 15, 5],
    },
  ],
  chart: {
    type: "area",
    height: 30,
    width: "80px",
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  colors: ["#FF4626"],
  stroke: {
    width: 1,
    curve: "straight",
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const categoryTwoChart = new ApexCharts(
  document.querySelector("#category-two"),
  catrgoryTwoOptions
);
categoryTwoChart.render();

// Chart Three (Web Development)
const catrgoryThreeOptions = {
  series: [
    {
      name: "web dev",
      data: [5, 15, 10, 25, 28, 16, 18, 28, 30],
    },
  ],
  chart: {
    type: "area",
    height: 30,
    width: "80px",
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  colors: ["#76D466"],
  stroke: {
    width: 1,
    curve: "straight",
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const categoryThreeChart = new ApexCharts(
  document.querySelector("#category-three"),
  catrgoryThreeOptions
);
categoryThreeChart.render();

// Chart Four (Digital Marketing)
const catrgoryFourOptions = {
  series: [
    {
      name: "digital marketing",
      data: [5, 15, 10, 25, 28, 16, 18, 28, 30],
    },
  ],
  chart: {
    type: "area",
    height: 30,
    width: "80px",
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  colors: ["#76D466"],
  stroke: {
    width: 1,
    curve: "straight",
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const categoryFourChart = new ApexCharts(
  document.querySelector("#category-four"),
  catrgoryFourOptions
);
categoryFourChart.render();

// Chart Five (Business Development)
const catrgoryFiveOptions = {
  series: [
    {
      name: "business dev",
      data: [30, 28, 18, 16, 28, 25, 10, 15, 5],
    },
  ],
  chart: {
    type: "area",
    height: 30,
    width: "80px",
    zoom: {
      enabled: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  colors: ["#FF4626"],
  stroke: {
    width: 1,
    curve: "straight",
  },
  tooltip: {
    enabled: true,
    x: {
      show: false,
    },
    y: {
      title: {
        formatter: function (seriesName) {
          return "";
        },
      },
    },
    marker: {
      show: false,
    },
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
    },
  },
};
const categoryFiveChart = new ApexCharts(
  document.querySelector("#category-five"),
  catrgoryFiveOptions
);
categoryFiveChart.render();

// Learn Activity Chart
const learnActivityOptions = {
  series: [
    {
      name: "Paid course",
      data: [25, 15, 25, 10, 8],
    },
    {
      name: "Free course",
      data: [13, 6, 25, 3, 2],
    },
  ],
  chart: {
    type: "bar",
    height: "370",
    offsetX: -10,
    offsetY: 15,
    toolbar: {
      show: false,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "18%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  grid: {
    borderColor: "#EEE",
  },
  stroke: {
    show: false,
  },
  xaxis: {
    categories: ["Design", "Marketing", "Business", "Web Dev", "Productivity"],
  },
  yaxis: {
    min: 0,
    max: 30,
    stepSize: 5,
    tickAmount: 6,
    labels: {
      formatter: (val) => val + "h",
    },
  },
  fill: {
    colors: ["#5F71FA", "#76D466"],
    opacity: 1,
  },
  legend: {
    position: "top",
    horizontalAlign: "left",
    offsetX: -30,
    markers: {
      width: 7,
      height: 7,
      radius: 99,
      fillColors: ["#5F71FA", "#76D466"],
      offsetX: -3,
      offsetY: -1,
    },
    itemMargin: {
      horizontal: 20,
    },
  },
  tooltip: {
    y: {
      formatter: (val) => {
        return val + "h";
      },
    },
  },
};

const learnActivity = new ApexCharts(
  document.querySelector("#admin-learn-activity-chart"),
  learnActivityOptions
);
learnActivity.render();
