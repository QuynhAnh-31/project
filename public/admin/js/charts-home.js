$(document).ready(function () {

'use strict';

Chart.defaults.global.defaultFontColor = '#6a517d'; // tím đậm nhẹ, dịu mắt

// ------------------------------------------------------- //
// Line Chart - Khách ghé thăm homestay
// ------------------------------------------------------- //
var legendState = true;
if ($(window).outerWidth() < 576) {
    legendState = false;
}

var LINECHART = $('#lineCahrt');
var myLineChart = new Chart(LINECHART, {
    type: 'line',
    options: {
        scales: {
            xAxes: [{
                display: true,
                gridLines: {
                    color: '#f3e8f5' // lưới nhẹ màu tím nhạt
                }
            }],
            yAxes: [{
                ticks: {
                    max: 60,
                    min: 10
                },
                display: true,
                gridLines: {
                    color: '#f3e8f5' // lưới nhẹ màu tím nhạt
                }
            }]
        },
        legend: {
            display: legendState,
            labels: {
                fontColor: '#6a517d'
            }
        }
    },
    data: {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9"],
        datasets: [
            {
                label: "Khách Đặt Phòng",
                fill: true,
                lineTension: 0.2,
                backgroundColor: "rgba(186, 85, 211, 0.2)", // tím nhạt trong suốt
                borderColor: '#BA55D3', // màu tím medium orchid
                pointBorderColor: '#BA55D3',
                pointHoverBackgroundColor: '#BA55D3',
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                borderWidth: 3,
                pointBackgroundColor: "#fff",
                pointBorderWidth: 5,
                pointHoverRadius: 6,
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 3,
                pointRadius: 3,
                pointHitRadius: 10,
                data: [18, 25, 22, 30, 27, 35, 28, 24, 32],
                spanGaps: false
            },
            {
                label: "Lượt Truy Cập Website",
                fill: true,
                lineTension: 0.2,
                backgroundColor: "rgba(255, 182, 193, 0.2)", // hồng nhạt trong suốt
                borderColor: "#FF69B4", // hot pink
                pointBorderColor: '#FF69B4',
                pointHoverBackgroundColor: "#FF69B4",
                borderCapStyle: 'butt',
                borderDash: [],
                borderDashOffset: 0.0,
                borderJoinStyle: 'miter',
                borderWidth: 3,
                pointBackgroundColor: "#fff",
                pointBorderWidth: 5,
                pointHoverRadius: 6,
                pointHoverBorderColor: "#fff",
                pointHoverBorderWidth: 3,
                pointRadius: 3,
                pointHitRadius: 10,
                data: [28, 20, 30, 26, 33, 29, 32, 34, 28],
                spanGaps: false
            }
        ]
    }
});

// ------------------------------------------------------- //
// Bar Chart - Doanh thu homestay từng tháng
// ------------------------------------------------------- //
var BARCHARTEXMPLE    = $('#barChartExample1');
var barChartExample = new Chart(BARCHARTEXMPLE, {
    type: 'bar',
    options: {
        scales: {
            xAxes: [{
                display: false,
                gridLines: {
                    color: '#f3e8f5'
                }
            }],
            yAxes: [{
                display: false,
                gridLines: {
                    color: '#f3e8f5'
                }
            }]
        },
    },
    data: {
        labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7"],
        datasets: [
            {
                label: "Doanh thu Phòng",
                backgroundColor: [
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)",
                    "rgba(186, 85, 211, 0.7)"
                ],
                hoverBackgroundColor: [
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)",
                    "rgba(186, 85, 211, 0.9)"
                ],
                borderColor: [
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)",
                    "rgba(186, 85, 211, 1)"
                ],
                borderWidth: 1,
                data: [550, 620, 720, 680, 590, 620, 710],
            },
            {
                label: "Doanh thu Dịch vụ",
                backgroundColor: [
                    "rgba(255, 105, 180, 0.7)", 
                    "rgba(255, 105, 180, 0.7)",
                    "rgba(255, 105, 180, 0.7)",
                    "rgba(255, 105, 180, 0.7)",
                    "rgba(255, 105, 180, 0.7)",
                    "rgba(255, 105, 180, 0.7)",
                    "rgba(255, 105, 180, 0.7)"
                ],
                hoverBackgroundColor: [
                    "rgba(255, 105, 180, 0.9)", 
                    "rgba(255, 105, 180, 0.9)",
                    "rgba(255, 105, 180, 0.9)",
                    "rgba(255, 105, 180, 0.9)",
                    "rgba(255, 105, 180, 0.9)",
                    "rgba(255, 105, 180, 0.9)",
                    "rgba(255, 105, 180, 0.9)"
                ],
                borderColor: [
                    "rgba(255, 105, 180, 1)", 
                    "rgba(255, 105, 180, 1)",
                    "rgba(255, 105, 180, 1)",
                    "rgba(255, 105, 180, 1)",
                    "rgba(255, 105, 180, 1)",
                    "rgba(255, 105, 180, 1)",
                    "rgba(255, 105, 180, 1)"
                ],
                borderWidth: 1,
                data: [320, 360, 410, 390, 480, 350, 400],
            }
        ]
    }
});

// ------------------------------------------------------- //
// Pie Chart - Tỉ lệ loại phòng homestay
// ------------------------------------------------------- //
var PIECHART = $('#pieChartHome1');
var myPieChart = new Chart(PIECHART, {
    type: 'doughnut',
    options: {
        cutoutPercentage: 80,
        legend: {
            display: true,
            position: 'bottom',
            labels: {
                fontColor: '#6a517d'
            }
        }
    },
    data: {
        labels: [
            "Phòng Đơn",
            "Phòng Đôi",
            "Phòng Gia Đình",
            "Phòng VIP"
        ],
        datasets: [
            {
                data: [120, 80, 60, 40],
                borderWidth: 0,
                backgroundColor: [
                    '#BA55D3', // medium orchid
                    "#DA70D6", // orchid
                    "#D8BFD8", // thistle
                    "#8A2BE2"  // blue violet
                ],
                hoverBackgroundColor: [
                    '#BA55D3',
                    "#DA70D6",
                    "#D8BFD8",
                    "#8A2BE2"
                ]
            }]
    }
});

});
