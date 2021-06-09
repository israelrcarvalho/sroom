<div class="card-box border-top">
    <table id="tdataseventosxx" class="table table-striped">
        <thead>
        <tr>
            <th style="width: 10px;"></th>
            <th class="text-center" style="width: 11%;">Data</th>
            <th class="text-center" style="width: 10%;">Hora Início</th>
            <th class="text-center" style="width: 10%;">Hora Final</th>
            <th class="text-left">Espaco</th>
            <th class="text-left">Justificativa</th>
            {{--<th class="text-center" style="width: 10%;">Nível</th>--}}
            <th class="text-center" style="width: 10%;">Status</th>
            <th class="text-center" style="width: 100px;">-</th>
        </tr>
        </thead>
        <tbody>

        @foreach($p->periodos as $periodo)

            <tr>
                <td class="text-center">
                    <span class="glyphicon glyphicon-edit" style="cursor:pointer;"
                          data-toggle="modal" data-target="#modal-nova-data-{{$periodo->id}}"/>
                </td>
                <td class="text-left">
                    {{ $periodo->dt_realizacao }} <br/>
                    {{nameOfDay($periodo->dt_realizacao )}}
                </td>
                <td class="text-center">{{ $periodo->hora_inicio }}</td>
                <td class="text-center">{{ $periodo->hora_fim }}</td>
                <td class="text-left">
                    @if($periodo->espaco_id)
                        {{ $periodo->nomeDoespacoPorId($periodo->espaco_id)->nome }} |
                        {{ $periodo->nomeDoespacoPorId($periodo->espaco_id)->local }}
                    @endif
                </td>
                <td>{{$periodo->justificativa}}</td>
                <td class="text-center">{{ iRcGetSysVal_('STATUS_EVENTO',$periodo->status) }}</td>
                <td class="text-center">
                <span style="cursor:pointer;" class="glyphicon glyphicon-trash"
                      data-toggle="modal" data-target="#modal-delete-{{$periodo->id}}"/>
                </td>
                @include('eventos.partials.modal-deletar-periodo-espaco')
                @include('eventos.partials.modal-editar-periodo-espaco')
            </tr>
        @endforeach
        </tbody>
    </table>


    <div class="row">
        <div class="col-sm-12 text-right">

            <button type="button" class="btn btn-success text-right"
                    data-toggle="modal" data-target="#modal-nova-data-new"
                    name="action" value="finished">
                <i class="fa fa-calendar"></i>
                Nova data
            </button>
        </div>
    </div>

</div>
