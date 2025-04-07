// Analytic Total User
const totalUserOption = {
  series: [
    {
      name: "Total User",
      data: [5, 30, 10, 25, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "line",
    height: 70,
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
  // fill: {
  //   type: "gradient",
  //   gradient: {
  //     opacityFrom: 0.5,
  //     opacityTo: 0.2,
  //     stops: [0, 60],
  //   },
  // },
};
const totalUserChart = new ApexCharts(
  document.querySelector("#analytic-total-user-chart"),
  totalUserOption
);
totalUserChart.render();

// Analytic Live Visitor
var liveVisitorOption = {
  series: [
    {
      name: "Live Visitor",
      data: [5, 30, 10, 25, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "line",
    height: 70,
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
  // fill: {
  //   type: "gradient",
  //   gradient: {
  //     opacityFrom: 0.5,
  //     opacityTo: 0.2,
  //     stops: [0, 60],
  //   },
  // },
};
var liveVisitorChart = new ApexCharts(
  document.querySelector("#analytic-live-visitor-chart"),
  liveVisitorOption
);
liveVisitorChart.render();

// Analytic Bounce Rate
var bounceRateOption = {
  series: [
    {
      name: "Bounce Rate",
      data: [5, 30, 10, 25, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "line",
    height: 70,
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
  // fill: {
  //   type: "gradient",
  //   gradient: {
  //     opacityFrom: 0.5,
  //     opacityTo: 0.2,
  //     stops: [0, 60],
  //   },
  // },
};
var bounceRateChart = new ApexCharts(
  document.querySelector("#analytic-bounce-rate-chart"),
  bounceRateOption
);
bounceRateChart.render();

// Analytic Average Visit
var averageVisitOption = {
  series: [
    {
      name: "Average Visitor",
      data: [5, 30, 10, 25, 11, 30, 15, 28, 33],
    },
  ],
  chart: {
    type: "line",
    height: 70,
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
  // fill: {
  //   type: "gradient",
  //   gradient: {
  //     opacityFrom: 0.5,
  //     opacityTo: 0.2,
  //     stops: [0, 60],
  //   },
  // },
};
var averageVisitChart = new ApexCharts(
  document.querySelector("#analytic-average-visit-chart"),
  averageVisitOption
);
averageVisitChart.render();

// Analytic Overview Chart
const analyticOverviewOptions = {
  chart: {
    height: 400,
    width: "100%",
    stacked: true,
    toolbar: {
      show: false,
    },
    theme: {
      mode: "dark", // enables dark mode in ApexCharts
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
      name: "Total Visitor",
      type: "area",
      color: "#DFE3FE",
      data: [
        {
          x: "01-01-2024 GMT",
          y: 34,
        },
        {
          x: "01-05-2024 GMT",
          y: 70,
        },
        {
          x: "01-10-2024 GMT",
          y: 31,
        },
        {
          x: "01-15-2024 GMT",
          y: 60,
        },
        {
          x: "01-20-2024 GMT",
          y: 40,
        },
        {
          x: "01-25-2024 GMT",
          y: 80,
        },
        {
          x: "01-30-2024 GMT",
          y: 60,
        },
      ],
      zIndex: 300,
    },
    {
      name: "Impression",
      type: "line",
      data: [
        {
          x: "01-01-2024 GMT",
          y: 0,
        },
        {
          x: "01-05-2024 GMT",
          y: 60,
        },
        {
          x: "01-10-2024 GMT",
          y: 21,
        },
        {
          x: "01-15-2024 GMT",
          y: 50,
        },
        {
          x: "01-20-2024 GMT",
          y: 30,
        },
        {
          x: "01-25-2024 GMT",
          y: 70,
        },
        {
          x: "01-30-2024 GMT",
          y: 50,
        },
      ],
      zIndex: 100,
    },
  ],
  xaxis: {
    type: "datetime",
    min: new Date("01 Jan 2024").getTime(),
  },
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
    curve: "smooth",
    colors: ["none", "#5F71FA"],
    width: 2,
  },
  markers: {
    size: 5,
    colors: ["transparent", "#5F71FA"],
    strokeColors: "transparent",
    hover: {
      sizeOffset: 0,
    },
  },
  legend: {
    position: "top",
    horizontalAlign: "left",
    offsetY: 0,
    markers: {
      width: 7,
      height: 7,
      radius: 99,
      fillColors: ["#DFE3FE", "#5F71FA"],
      offsetX: -3,
      offsetY: -1,
    },
    itemMargin: {
      horizontal: 10,
    },
  },
  tooltip: {
    y: {
      formatter: (val) => {
        return val + "k";
      },
      title: {
        formatter: (sn) => "",
      },
    },
    marker: {
      show: false,
    },
  },
};

const analyticOverviewChart = new ApexCharts(
  document.querySelector("#analytic-session-overview-chart"),
  analyticOverviewOptions
);
analyticOverviewChart.render();

/* Sessions By Device Chart */
const deviceSessionOption = {
  series: [1754, 1234, 878, 270],
  labels: ["Mobile", "Tablet", "Desktop", "Others"],
  chart: {
    height: 270,
    type: "donut",
  },
  dataLabels: {
    enabled: false,
  },
  legend: {
    show: false,
  },
  stroke: {
    show: false,
  },
  plotOptions: {
    pie: {
      donut: {
        size: "80%",
        background: "transparent",
        labels: {
          show: true,
          name: {
            show: true,
            fontSize: "20px",
            color: "#495057",
            offsetY: -4,
          },
          value: {
            show: true,
            fontSize: "18px",
            color: undefined,
            offsetY: 8,
            formatter: function (val) {
              return val + "%";
            },
          },
          total: {
            show: true,
            showAlways: true,
            label: "Total",
            fontSize: "22px",
            fontWeight: 600,
            color: "#474747",
          },
        },
      },
    },
  },
  colors: ["#5F71FA", "#66CC33", "#76D466", "#FFA305"],
};
const deviceSessionChart = new ApexCharts(
  document.querySelector("#analytic-device-session-chart"),
  deviceSessionOption
);
deviceSessionChart.render();

// Browser Session Chart
const browserSessionOptions = {
  series: [55, 40, 5],
  chart: {
    height: 320,
    type: "pie",
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  labels: ["Chrome", "Mozilla", "Other"],
  colors: ["#5F71FA", "#B39EF9", "#DFE3FE"],
  legend: {
    position: "bottom",
    offsetY: 0,
    markers: {
      width: 7,
      height: 7,
      radius: 99,
      offsetX: -3,
      offsetY: -1,
    },
    itemMargin: {
      horizontal: 10,
    },
  },
  theme: {
    monochrome: {
      enabled: false,
    },
  },
  plotOptions: {
    pie: {
      expandOnClick: false,
      dataLabels: {
        offset: -10,
        minAngleToShowLabel: 10,
      },
    },
  },
  stroke: {
    show: false,
  },
};

const browserSessionChart = new ApexCharts(
  document.querySelector("#browser-session-chart"),
  browserSessionOptions
);
browserSessionChart.render();

// Views Per Minutes Chart
const viewsBrowserOption = {
  chart: {
    height: 150,
    type: "bar",
    toolbar: {
      show: false,
    },
    events: {
      mounted: (chart) => {
        chart.windowResizeHandler();
      },
    },
  },
  series: [
    {
      name: "views per minute",
      data: [55, 30, 70, 45, 25, 30, 50, 82, 30],
      color: "#5F71FA",
    },
  ],
  grid: {
    show: false,
  },
  plotOptions: {
    bar: {
      borderRadius: 10,
      columnWidth: "80%",
      barHeight: "100%",
      dataLabels: {
        position: "top",
      },
      colors: {
        backgroundBarColors: ["#DFE3FE"],
        backgroundBarRadius: 10,
      },
    },
  },
  dataLabels: {
    enabled: false,
    offsetY: "100%",
    style: {
      fontSize: "12px",
      colors: ["#999"],
    },
  },
  xaxis: {
    categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"],
    labels: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
  },
  yaxis: {},
  yaxis: {
    min: 0,
    max: 100,
    tickAmount: 5,
    decimalsInFloat: false,
    labels: {
      show: false,
      formatter: (val) => val + "k",
    },
  },
  tooltip: {
    y: {
      formatter: (val) => {
        return val + "k";
      },
      title: {
        formatter: (sn) => "",
      },
    },
    marker: {
      show: false,
    },
  },
};

const viewsBrowserChart = new ApexCharts(
  document.querySelector("#views-browser-perminute-chart"),
  viewsBrowserOption
);
viewsBrowserChart.render();

// Users By Country
const markers = [
  {
    name: "Russia",
    coords: [55.75, 37.61],
  },
  {
    name: "Canada",
    coords: [56.1304, -106.3468],
  },
  {
    name: "Singapore",
    coords: [1.3, 103.8],
  },
];
new jsVectorMap({
  selector: "#customer-country-chart",
  map: "world_merc",
  markersSelectable: true,
  // zoomOnScroll: false,
  zoomButtons: false,
  labels: {
    markers: {
      render: function (marker) {
        return marker.name;
      },
    },
  },
  markers: markers,
  markerStyle: {
    initial: {
      image: "assets/images/icons/location.svg",
    },
  },
  regionStyle: {
    initial: {
      fill: "#F4ECFF",
      stroke: "#B39EF9",
      strokeWidth: 1,
      fillOpacity: 1,
    },
  },
  onMarkerSelected(index, isSelected, selectedMarkers) {
    console.log(index, isSelected, selectedMarkers);
  },
});
