var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

console.log();

$(".getResult").ready(function(){
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
        success: function (response) {
            var users = response;
            console.log(users);

            Highcharts.chart('container', {

                chart: {
                    polar: true,
                    type: 'line'
                },
            
                // accessibility: {
                //     description: 'A spiderweb chart shows the test results of the Emotional-Wellbeing Profiling (EWP) test that has been answered by users (student/staffs).'
                // },
            
                title: {
                    text: '',
                    // x: -70
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
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'vertical'
                },
            
                series: users,
            
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
        },
        cache: true
    })
});