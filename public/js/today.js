$(document).ready(function () {
    $('ul.tabs').tabs();
    loadTodayChart();
});

function loadTodayChart() {
    (function (username) {
        $.ajax({
            url: '/api/health/today/'+username,
            type: "GET",
            success: function (data) {
                stepChart(data.step.steps, data.step.goal);
                sleepChart(data.sleep.sleep_hour, data.sleep.goal)
            }
        })
    })(username);
}

function stepChart(steps, goal) {
    // 基于准备好的dom，初始化echarts实例
    var myChart = echarts.init(document.getElementById('step-data'));

    // 指定图表的配置项和数据
    var option = {
        tooltip: {
            show: false
        },
        series: [{
            type: 'pie',
            radius: ['80%', '90%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'inside',
                },
                emphasis: {
                    show: false,
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data: [{
                value: steps,
                name: '已完成',
                itemStyle: {
                    normal: {
                        color: '#f09886',
                    }
                }
            }, {
                value: goal - steps > 0 ? steps : 0,
                itemStyle: {
                    normal: {
                        color: '#fafafa',
                    }
                }
            }]
        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
}

function sleepChart(sleep, goal) {
    var myChart = echarts.init(document.getElementById('sleep-data'));

    // 指定图表的配置项和数据
    var option = {
        tooltip: {
            show: false
        },
        series: [{
            type: 'pie',
            radius: ['80%', '90%'],
            avoidLabelOverlap: false,
            label: {
                normal: {
                    show: false,
                    position: 'center',
                },
                emphasis: {
                    show: true,
                    textStyle: {
                        fontSize: '30',
                        fontWeight: 'bold'
                    }
                }
            },
            labelLine: {
                normal: {
                    show: false
                }
            },
            data: [{
                value: sleep,
                itemStyle: {
                    normal: {
                        color: '#f09886',
                    }
                }
            }, {
                value: goal-sleep,
                itemStyle: {
                    normal: {
                        color: '#fafafa',
                    }
                }
            }]
        }]
    };
    // 使用刚指定的配置项和数据显示图表。
    myChart.setOption(option);
}
