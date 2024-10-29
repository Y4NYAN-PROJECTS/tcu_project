var div_total_logs = document.querySelector("#total_logs_chart");
var value_total_logs = parseInt(div_total_logs.getAttribute("value"));

var total_logsOption = {
series: [value_total_logs],
chart: {
    height: 250,
    type: "radialBar",
    toolbar: {
    show: false,
    },
},
plotOptions: {
    radialBar: {
    startAngle: -135,
    endAngle: 225,
    hollow: {
        margin: 0,
        size: "70%",
        background: "#fff",
        image: undefined,
        imageOffsetX: 0,
        imageOffsetY: 0,
        position: "front",
        dropShadow: {
        enabled: true,
        top: 3,
        left: 0,
        blur: 4,
        opacity: 0.24,
        },
    },
    track: {
        background: "#fff",
        strokeWidth: "67%",
        margin: 0,
        dropShadow: {
        enabled: true,
        top: -3,
        left: 0,
        blur: 4,
        opacity: 0.35,
        },
    },

    dataLabels: {
        show: true,
        name: {
        offsetY: -10,
        show: true,
        color: "#888",
        fontSize: "17px",
        },
        value: {
        formatter: function (val) {
            return parseInt(val);
        },
        color: "#111",
        fontSize: "36px",
        show: true,
        },
    },
    },
},
fill: {
    type: "gradient",
    gradient: {
    shade: "dark",
    type: "horizontal",
    shadeIntensity: 0.5,
    gradientToColors: ["#ABE5A1"],
    inverseColors: true,
    opacityFrom: 1,
    opacityTo: 1,
    stops: [0, 100],
    },
},
stroke: {
    lineCap: "round",
},
labels: ["Total"],
};

var total_logsQueueChart = new ApexCharts(div_total_logs, total_logsOption);
total_logsQueueChart.render();




var div_student_total_logs = document.querySelector("#student_total_logs_chart");
var value_student_total_logs = parseInt(div_student_total_logs.getAttribute("value"));

var student_total_logsOption = {
series: [value_student_total_logs],
chart: {
    height: 250,
    type: "radialBar",
    toolbar: {
    show: false,
    },
},
plotOptions: {
    radialBar: {
    startAngle: -135,
    endAngle: 225,
    hollow: {
        margin: 0,
        size: "70%",
        background: "#fff",
        image: undefined,
        imageOffsetX: 0,
        imageOffsetY: 0,
        position: "front",
        dropShadow: {
        enabled: true,
        top: 3,
        left: 0,
        blur: 4,
        opacity: 0.24,
        },
    },
    track: {
        background: "#fff",
        strokeWidth: "67%",
        margin: 0,
        dropShadow: {
        enabled: true,
        top: -3,
        left: 0,
        blur: 4,
        opacity: 0.35,
        },
    },

    dataLabels: {
        show: true,
        name: {
        offsetY: -10,
        show: true,
        color: "#888",
        fontSize: "17px",
        },
        value: {
        formatter: function (val) {
            return parseInt(val);
        },
        color: "#111",
        fontSize: "36px",
        show: true,
        },
    },
    },
},
fill: {
    type: "gradient",
    gradient: {
    shade: "dark",
    type: "horizontal",
    shadeIntensity: 0.5,
    gradientToColors: ["#ABE5A1"],
    inverseColors: true,
    opacityFrom: 1,
    opacityTo: 1,
    stops: [0, 100],
    },
},
stroke: {
    lineCap: "round",
},
labels: ["Total"],
};

var student_total_logsQueueChart = new ApexCharts(div_student_total_logs, student_total_logsOption);
student_total_logsQueueChart.render();




var div_visitor_total_logs = document.querySelector("#visitor_total_logs_chart");
var value_visitor_total_logs = parseInt(div_visitor_total_logs.getAttribute("value"));

var visitor_total_logsOption = {
series: [value_visitor_total_logs],
chart: {
    height: 250,
    type: "radialBar",
    toolbar: {
    show: false,
    },
},
plotOptions: {
    radialBar: {
    startAngle: -135,
    endAngle: 225,
    hollow: {
        margin: 0,
        size: "70%",
        background: "#fff",
        image: undefined,
        imageOffsetX: 0,
        imageOffsetY: 0,
        position: "front",
        dropShadow: {
        enabled: true,
        top: 3,
        left: 0,
        blur: 4,
        opacity: 0.24,
        },
    },
    track: {
        background: "#fff",
        strokeWidth: "67%",
        margin: 0,
        dropShadow: {
        enabled: true,
        top: -3,
        left: 0,
        blur: 4,
        opacity: 0.35,
        },
    },

    dataLabels: {
        show: true,
        name: {
        offsetY: -10,
        show: true,
        color: "#888",
        fontSize: "17px",
        },
        value: {
        formatter: function (val) {
            return parseInt(val);
        },
        color: "#111",
        fontSize: "36px",
        show: true,
        },
    },
    },
},
fill: {
    type: "gradient",
    gradient: {
    shade: "dark",
    type: "horizontal",
    shadeIntensity: 0.5,
    gradientToColors: ["#ABE5A1"],
    inverseColors: true,
    opacityFrom: 1,
    opacityTo: 1,
    stops: [0, 100],
    },
},
stroke: {
    lineCap: "round",
},
labels: ["Total"],
};

var visitor_total_logsQueueChart = new ApexCharts(div_visitor_total_logs, visitor_total_logsOption);
visitor_total_logsQueueChart.render();