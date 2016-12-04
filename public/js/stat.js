$(document).ready(function () {
    $('ul.tabs').tabs();
    initViewTab();
    loadMonthStepStat();
});

function initViewTab() {
    $('#day-tab').on('click', changeTab.bind(null, '#day-tab', loadDayStepStat));
    $('#week-tab').on('click', changeTab.bind(null, '#week-tab', loadWeekStepStat));
    $('#month-tab').on('click', changeTab.bind(null, '#month-tab', loadMonthStepStat));
}

function changeTab(tabName, loadFunction) {
    $('.view-tab a').removeClass('active');
    $(tabName+" a").addClass('active');
    loadFunction();
}

function loadWeekStepStat() {
    $.ajax({
        url: '/api/health/stat/step/week/' + username,
        success: function ($stat) {
            var weeks = [];
            var steps = [];
            $stat.forEach(function (data) {
                weeks.push("第"+data.week+"周");
                steps.push(data.step_sum);
            });
            stepStatChart(weeks.reverse(),steps.reverse());
        }
    })
}

function loadDayStepStat() {
    var weekday = ['星期天','星期一','星期二','星期三','星期四','星期五','星期六'];

    $.ajax({
        url: '/api/health/stat/step/day/' + username,
        success: function ($stat) {
            var days = [];
            var steps = []
            $stat.forEach(function (data) {
                days.push(weekday[data.weekday]);
                steps.push(data.steps);
            });
            stepStatChart(days.reverse(),steps.reverse());
        }
    })
}

function loadMonthStepStat() {
    var month = ['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月'];

    $.ajax({
        url: '/api/health/stat/step/month/' + username,
        success: function ($stat) {
            var steps = [];
            $stat.forEach(function (data) {
                steps.push(data.step_sum);
            });
            stepStatChart(month,steps);
        }
    })
}

function stepStatChart(axisX, axisY) {
    var myChart = echarts.init(document.getElementById('step-stat-chart'));
    option = {
        color: ['#3398DB'],
        tooltip: {
            trigger: 'axis',
            axisPointer: { // 坐标轴指示器，坐标轴触发有效
                type: 'shadow' // 默认为直线，可选为：'line' | 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        itemStyle: {
            normal: {
                color: '#f09886'
            }
        },
        xAxis: [{
            type: 'category',
            data: axisX,
            axisTick: {
                alignWithLabel: true
            }
        }],
        yAxis: [{
            type: 'value'
        }],
        series: [{
            name: '步数',
            type: 'bar',
            barWidth: '60%',
            data: axisY
        }]
    };
    myChart.setOption(option);
}
