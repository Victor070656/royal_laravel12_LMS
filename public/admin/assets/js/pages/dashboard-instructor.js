// Total Revenue
const instructorRevenueOptions = {
  series: [
    {
      name: "Revenue",
      data: [5, 30, 10, 25, 11, 15, 28, 33],
    },
  ],
  chart: {
    type: "area",
    height: 50,
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
  colors: ["#5F71FA"],
  stroke: {
    width: 1,
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
  responsive: [
    {
      breakpoint: 1440,
      options: {
        chart: {
          height: 45,
        },
      },
    },
  ],
};
const instructorRevenueChart = new ApexCharts(
  document.querySelector("#instructor-total-revenue-chart"),
  instructorRevenueOptions
);
instructorRevenueChart.render();

// Total Enrollments
const totalEnrollOptions = {
  series: [
    {
      name: "Enroll",
      data: [33, 28, 15, 11, 25, 10, 30, 5],
    },
  ],
  chart: {
    type: "area",
    height: 50,
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
  colors: ["#FF4626"],
  stroke: {
    width: 1,
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
  responsive: [
    {
      breakpoint: 1440,
      options: {
        chart: {
          height: 45,
        },
      },
    },
  ],
};
const totalEnrollChart = new ApexCharts(
  document.querySelector("#instructor-total-student-enroll-chart"),
  totalEnrollOptions
);
totalEnrollChart.render();

// Total Rating
const courseRatingOptions = {
  series: [
    {
      name: "Rating",
      data: [33, 28, 15, 11, 25, 10, 30, 5],
    },
  ],
  chart: {
    type: "area",
    height: 50,
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
  colors: ["#76D466"],
  stroke: {
    width: 1,
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
  responsive: [
    {
      breakpoint: 1440,
      options: {
        chart: {
          height: 45,
        },
      },
    },
  ],
};
const courseRatingChart = new ApexCharts(
  document.querySelector("#instructor-average-course-rating-chart"),
  courseRatingOptions
);
courseRatingChart.render();

// Insturctor Earning Chart
const instructorEarningOptions = {
  chart: {
    type: "area",
    height: 250,
    toolbar: {
      show: false,
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
  series: [
    {
      name: "Current month",
      data: [
        {
          x: "01",
          y: 34,
        },
        {
          x: "02",
          y: 70,
        },
        {
          x: "03",
          y: 31,
        },
        {
          x: "04",
          y: 60,
        },
        {
          x: "05",
          y: 40,
        },
        {
          x: "06",
          y: 80,
        },
        {
          x: "07",
          y: 60,
        },
        {
          x: "08",
          y: 60,
        },
        {
          x: "09",
          y: 60,
        },
        {
          x: "10",
          y: 60,
        },
        {
          x: "11",
          y: 60,
        },
        {
          x: "12",
          y: 60,
        },
        {
          x: "13",
          y: 60,
        },
        {
          x: "14",
          y: 60,
        },
        {
          x: "15",
          y: 60,
        },
        {
          x: "16",
          y: 60,
        },
        {
          x: "17",
          y: 60,
        },
        {
          x: "18",
          y: 60,
        },
        {
          x: "19",
          y: 60,
        },
        {
          x: "20",
          y: 60,
        },
        {
          x: "21",
          y: 60,
        },
        {
          x: "22",
          y: 60,
        },
        {
          x: "23",
          y: 60,
        },
        {
          x: "24",
          y: 60,
        },
        {
          x: "25",
          y: 60,
        },
        {
          x: "26",
          y: 60,
        },
        {
          x: "27",
          y: 60,
        },
        {
          x: "28",
          y: 60,
        },
        {
          x: "29",
          y: 60,
        },
        {
          x: "30",
          y: 60,
        },
      ],
    },
  ],
  yaxis: {
    min: 5,
    max: 90,
    tickAmount: 5,
    decimalsInFloat: false,
    labels: {
      formatter: (val) => val + "k",
    },
  },
  grid: {
    borderColor: "#EEE",
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    colors: ["#5F71FA"],
    width: 1,
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.2,
      stops: [0, 60],
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

const instructorEaringChart = new ApexCharts(
  document.querySelector("#instructor-monthly-earning-chart"),
  instructorEarningOptions
);
instructorEaringChart.render();

// Instructor Course Order Chart
const courseOrderOption = {
  series: [
    {
      name: "Current month",
      data: [25, 15, 25, 10, 8],
    },
  ],
  chart: {
    type: "bar",
    height: 450,
    offsetY: 20,
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
      borderRadius: 10,
      borderRadiusApplication: "end",
      columnWidth: "40%",
      colors: {
        backgroundBarColors: ["#F9F6FF"],
        backgroundBarRadius: 10,
      },
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
    categories: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5"],
  },
  yaxis: {
    min: 0,
    max: 30,
    stepSize: 5,
    tickAmount: 6,
    labels: {
      formatter: (val) => val + "k",
    },
  },
  fill: {
    colors: ["#5F71FA"],
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: (val) => {
        return val + "k";
      },
    },
  },
};

const courseOrderChart = new ApexCharts(
  document.querySelector("#instructorCourseOrder"),
  courseOrderOption
);
courseOrderChart.render();
