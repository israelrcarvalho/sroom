<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<div class="col-lg-6 col-md-6">
    <div class="card-box">
        <div class="panel-body" style="border:solid 1px #ccc;">
            <div id="graficoPorStatus" style="height:300px; margin: 0 auto;">
                <script>
                    // var d = new Date();
                   // var anoAtual = d.getFullYear();

                    $(function () {
                        $('#graficoPorStatus').highcharts({
                            chart: {
                                type: 'pie',
                                options3d: {
                                    enabled: false,
                                    alpha: 45,
                                    beta: 0
                                }
                            },
                            title: {
                                text: 'Atendimento por Status no mês'
                            },
//                            subtitle: {
//                                text: 'Fonte : GECEV - Scheduled Room'
//                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    depth: 35,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.name}'
                                    }
                                }
                            },
                            series: [{
                                name: 'Total de Atendimentos',
                                data: [{!!$graficoPorStatusNoMes!!}]

                            }]
                        });
                    });
                </script>

            </div>
        </div>
    </div>


</div>
