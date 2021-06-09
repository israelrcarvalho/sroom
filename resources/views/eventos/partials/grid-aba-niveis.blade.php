<div class="card-box border-top">
    <table id="tdataseventosxx" class="table table-striped">
        <thead>
        <tr>
            {{--<th style="width: 10px;"></th>--}}
            <th style="width: 50%">Detalhes</th>
            <th></th>
            <th class="text-center" style="width: 5%;">valor</th>
            <th class="text-center" style="width: 15px;"></th>
        </tr>
        </thead>
        <tbody>
        <span class="hide">{{ $t=0 }}</span>
        @foreach($p->periodos as $periodo)
            <tr>
                <td class="">
                    <i class="fa fa-calendar"></i>&nbsp;&nbsp;{{$periodo->dt_realizacao }}&nbsp;&nbsp;<i
                            class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $periodo->hora_inicio }}
                    às {{ $periodo->hora_fim }}<br/>
                    @if($periodo->espaco_id)
                        <i class="fa fa-globe"></i>&nbsp;
                        &nbsp;{{ $periodo->nomeDoespacoPorId($periodo->espaco_id)->nome }}&nbsp;
                        <i class="fa fa-angle-double-right"></i>
                        &nbsp;{{ $periodo->nomeDoespacoPorId($periodo->espaco_id)->local }}
                    @endif
                    <br/><i class="fa fa-hand-o-right"></i>&nbsp;&nbsp;<b>Situação:</b> {{iRcGetSysVal_('STATUS_EVENTO',$periodo->status) }}
                    @if(!empty($periodo->justificativa))
                        <br/><br/>
                        <b>Justificativa:</b><br/>
                        {{$periodo->justificativa}}
                    @endif
                </td>
                <td>
                    @if($periodo->nivel_id)
                        {{$periodo->valorDoNivelById($periodo->nivel_id)->nome}}
                    @endif
                </td>
                <td class="text-center">
                    @if($periodo->nivel_id)
                        {{$periodo->valorDoNivelById($periodo->nivel_id)->valor}}
                    @endif
                </td>
                <td>
                    <span class="glyphicon glyphicon-signal" style="cursor:pointer;" data-toggle="modal" data-target="#modal-classificar-evento-{{$periodo->id}}"/>
                </td>
            </tr>
            @if($periodo->nivel_id)
                <span class="hide"> {{ $t+= $periodo->valorDoNivelById($periodo->nivel_id)->valor }}</span>
            @endif
                @include('eventos.partials.modal-classificar-evento')

        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th class="text-right"></th>
            <th class="text-right">Esforço total</th>
            <th class="text-center">{{$t}}</th>
            <th class="text-right"><i class="fa fa-bar-chart-o"></i></th>
        </tr>
        </tfoot>
    </table>
</div>
