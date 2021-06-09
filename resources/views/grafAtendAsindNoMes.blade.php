<div class="col-lg-5 col-md-5">
    <div class="card-box">
        <div class="panel-body">
            <div id="grafAtendSindNoMes" style="height:300px; margin: 0 auto;">

                <table class="x">
                    <thead>
                    <tr>
                        {{-- <th width="12"></th> --}}
                        <th style="width: 80px;">sindicato</th>
                        <th>atendimentos</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drill as $e)
                        <tr>
                            <td>{{$e->sigla}}</td>
                            <td>{{$e->totalMes}}</td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>


                <script>
                    var d = new Date();
                    var anoAtual = d.getFullYear();

                    $(function () {
                        $('#grafAtendSindNoMes').highcharts({
                            chart: {
                                type: 'bar'
                            },
                            title: {
                                text: 'Atendimentos a Sindicatos em ' + anoAtual
                            },
                            subtitle: {
                                text: 'Fonte : GECEV - Scheduled Room'
                            },
                            xAxis: {
                                type: 'category',
                                labels: {
                                    rotation: 0,
                                    style: {
                                        fontSize: '13px',
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
                                {{--data: [{!!$drill!!}],--}}
//                                dataLabels: {
                                    enabled: true,
                                    rotation: 0,
                                    color: '#FFFFFF',
                                    align: 'center',
                                    format: '{point.y:.0f}', // one decimal
                                    y: 40, // 10 pixels down from the top
                                    style: {
                                        fontSize: '13px',
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
