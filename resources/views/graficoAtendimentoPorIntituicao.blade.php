
<div class="col-lg-6 col-md-6">
    <div class="card-box">
        <div class="panel-body" style="border:solid 1px #ccc;">
            <div id="graficoAtendimentoPorIntituicao" style="height:300px; margin: 0 auto;">
                <script>
                    var d = new Date();
                    var anoAtual = d.getFullYear();

                    $(function () {
                        $('#graficoAtendimentoPorIntituicao').highcharts({
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: 'Atendimentos por Instituição neste mês'
                            },
                            subtitle: {
                                text: 'Fonte : GECEV - Scheduled Room'
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    rotation: 0,
                                    style: {
                                        fontSize: '8px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            },
                            yAxis: {
                                min: 0,
                                title: {
                                    text: 'Atendimentos'
                                }
                            },
                            legend: {
                                enabled: false
                            }                            ,
//                            tooltip: {
//                                pointFormat: 'neste mês'
//                            },
                            series: [{
                                name: 'Atendimentos',
                                colorByPoint: true,
                                data: [{!!$graficoAtendimentoPorIntituicao!!}],
                                    dataLabels: {
                                    enabled: true,
                                    rotation: 0,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    format: '{point.y:.0f}', // one decimal
                                    y: 40, // 10 pixels down from the top
                                    style: {
                                        fontSize: '8px',
                                        fontFamily: 'Verdana, sans-serif'
                                    }
                                }
                            }]
                        });
                    });
                </script>

            </div>
        </div>
    </div>


</div>
