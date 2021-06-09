{{$p->teste}}
<div class="card-box border-top">
    <div class="row">
        <div class="col-sm-12 text-right">
            <button type="button" class="btn btn-success text-right"
                    data-toggle="modal"
                    data-target="#modal-create-recurso-alimentacao"
                    name="action" value="finished">
                <i class="fa fa-cutlery"></i>
                Novo recurso
            </button>
        </div>
    </div>


    <table class="table table-striped col3 table-responsive" width="100%">
        <thead>
        <tr>
            <th class="text-center" style="width: 200px;">Data</th>
            <th>unidade</th>
            <th  style="max-width: 200px;">Recurso</th>
            <th style="width: 40px;" class="text-right">Quant</th>
            <th class="text-right" style="width: 100px;">Valor</th>
            <th class="text-right" style="width: 100px;">Sub Total</th>
            <th class="text-center" style="width: 10px;">-</th>
        </tr>
        </thead>
        <tbody>
        <span class="hide">
        {{ $tg = 0 }}
        {{ $tq = 0 }}
        {{ $tp = 0 }}
            </span>
            @foreach($p->periodos as $periodo)

                @foreach($periodo->modelPeriodoRecurso as $pr)
                    <tr>
                        <td>
                            {{$pr->periodosDeste->dt_realizacao}} - {{nameOfDay($pr->periodosDeste->dt_realizacao )}}
                        </td>
                        <td>
                            {{ $pr->unidade->nome }} <br/>
                            <b>CR:</b> {{$pr->modelRecurso->centros->nome}} - {{$pr->modelRecurso->centros->codigo}}
                        </td>
                        <td>{{ $pr->modelRecurso->recursos->nome }}</td>
                        <td class="text-right">{{ $pr->quantidade }}</td>
                        <td class="text-right">{{format_number($pr->preco,2,',','.')}}</td>
                        <td class="text-right">
                            {{ format_number($pr->quantidade * $pr->preco,2,',','.')}}
                        </td>
                        <td>
                         <span style="cursor:pointer;"
                               class="glyphicon glyphicon-trash"
                               data-toggle="modal"
                               data-target="#modal-delete-alimentacao-recurso-{{$pr->id}}"></span>
                        </td>
                    </tr>
                    <span class="hide">
                        {{ $tg+= ($pr->quantidade * $pr->preco) }}
                        {{ $tq+= $pr->quantidade }}
                        {{ $tp+= $pr->preco }}
                    </span>
                    @include('eventos.partials.modal-deletar-recurso-alimentacao')
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th></th>
            <th></th>
            <th class="text-right">Total</th>
            <th class="text-right">{{$tq}}</th>
            <th class="text-right">{{format_number($tp,2,',','.')}}</th>
            <th class="text-right">{{ format_number($tg,2,',','.')}}</th>
            <th></th>
        </tr>
        </tfoot>
    </table>

</div>
@if(count($p->periodos) > 0)
    @include('eventos.partials.modal-create-recurso-alimentacao')
@endif