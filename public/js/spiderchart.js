var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(".getResult").click(function(){
    $.ajax ({
        url: "reports/result",
        type: "get",
        dataType: 'json',
        delay: 250,
        data: function () {
            return {
                _token: CSRF_TOKEN,
                // search: params.term, // search term 
            };
        },
        processResults: function (response) {
            return {
                results: $.map(response, function (item) {
                    console.log(item);
                    return {
                        name: item.name,
                        data: item.data,
                        pointPlacement: item.pointPlacement
                    }
                })
            };
        },
        cache: true
    })
});

Highcharts.chart('container', {

    chart: {
        polar: true,
        type: 'line'
    },

    accessibility: {
        description: 'A spiderweb chart shows the test results of the Emotional-Wellbeing Profiling (EWP) test that has been answered by users (student/staffs).'
    },

    title: {
        text: 'Emotional-Wellbeing Profling Result',
        x: -70
    },

    pane: {
        size: '80%'
    },

    xAxis: {
        categories: ['Anxiety', 'Depression', 'Stress'],
        tickmarkPlacement: 'on',
        lineWidth: 0
    },

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0
    },

    tooltip: {
        shared: true,
        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}%</b><br/>'
    },

    legend: {
        align: 'right',
        verticalAlign: 'middle',
        layout: 'vertical'
    },

    series: [{
        name: '2022 1',
        data: [65, 24, 11],
        pointPlacement: 'INTERVENSI UMUM'
    },{
        name: '2022/2023 2',
        data: [24, 35, 12],
        pointPlacement: 'INTERVENSI KHUSUS'
    },],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                pane: {
                    size: '70%'
                }
            }
        }]
    }
});