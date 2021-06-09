/*
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Comparativo Mensal de Atendimentos'
        },
        subtitle: {
            text: 'Fonte: Schedule Room'
        },
        xAxis: {
            categories: [
                'Jan','Fev','Mar','Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {text: 'Atendimentos '}
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {

            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }

        },
        series: [{
            name: 'Corporativo',
            data: [10, 20, 25, 30, 33, 13, 13, 14, 21, 19, 9, 5]

        }, {
            name: 'FIEC',
            data: [20, 30, 13, 14, 15, 16, 11, 20, 22,23, 14, 11]

        }, {
            name: 'SESI',
            data: [33, 40, 13, 14, 15, 16, 11, 20, 22,23, 14, 11]

        }, {
            name: 'SENAI',
            data: [40, 50, 13, 14, 15, 16, 11, 20, 22,23, 14, 11]
        },
            {
                name: 'IEL',
                data: [50, 60, 13, 14, 15, 16, 11, 20, 22,23, 14, 11]

            }

        ]
    });
});

$(function () {

    $(document).ready(function () {

        // Build the chart
        $('#container-pie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Atendimentos por Sala'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Eventos',
                colorByPoint: true,
                data: [
                    {name: 'Sala 01', y: 56.33},
                    {name: 'Sala 02', y: 24.03,

                    sliced: true,
                    selected: true
                }, {
                    name: 'Sala 03',
                    y: 10.38
                }, {
                    name: 'Sala 04',
                    y: 4.0
                }, {
                    name: 'Sala 05',
                    y: 1.68
                }, {
                    name: 'Outras',
                    y: 3.58
                }]
            }]
        });
    });
});


*/