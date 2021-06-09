
    <div class="col-lg-12 col-md-12">
    <div class="card-box">
        <div class="panel-body" style="border:solid 1px #ccc;">
            <div id="graf-tres" style="height:300px; margin: 0 auto;">
                <script>
                    var d = new Date();
                    var anoAtual = d.getFullYear();

                    $(function () {
                        $('#graf-tres').highcharts({
                            chart: {
                                type: 'column'
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
                                data: [{!!$atenSindMes!!}],
                                dataLabels: {
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
{{--<div class="col-lg-6 col-md-6">--}}
    {{--<div class="card-box">--}}
        {{--<div class="panel-body" style="border:solid 1px #ccc;">--}}
            {{--graficoAtendimentoPorIntituicao--}}

    {{--<table class="table">--}}
        {{--<thead>--}}
        {{--<tr>--}}
            {{-- <th width="12"></th> --}}
            {{--<th style="width: 80px;">sindicato</th>--}}
            {{--<th>atendimentos</th>--}}
        {{--</tr>--}}
        {{--</thead>--}}
        {{--<tbody>--}}
        {{--@foreach($drill as $e)--}}
            {{--<tr>--}}
                {{--<td>{{$e->sigla}}</td>--}}
                {{--<td>{{$e->totalMes}}</td>--}}
            {{--</tr>--}}

        {{--@endforeach--}}
        {{--</tbody>--}}
    {{--</table>--}}
            {{----}}
        {{--</div>--}}
    {{--</div></div>--}}