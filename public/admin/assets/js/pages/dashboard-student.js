// Average Learning Chart
const averageLearningOptions = {
  chart: {
    type: "line",
    height: 250,
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
    labels: {
      formatter: (val) => val + "h",
    },
  },
  series: [
    {
      name: "Learning",
      data: [73, 49, 29, 56, 89, 50, 80, 40, 85, 45, 58, 88],
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
        return val + "h";
      },
    },
  },
};

const averageLearningChart = new ApexCharts(
  document.querySelector("#student-average-learning-chart"),
  averageLearningOptions
);
averageLearningChart.render();
