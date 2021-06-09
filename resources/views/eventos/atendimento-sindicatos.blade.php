@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos-solicitados')}}">Eventos</a></li>
                <li>Atendimento a Sindicatos</li>
            </ol>
        </div>
    </div>

    <div class="row" style="border:solid 1px red;">
        <form method="get" action="{{ action('EventosController@atendimentoSindicatos') }}">
            <div class="form-group col-sm-3">
                {!! Form::select('data_i',$meses, $auxData_i, array('class' => 'form-control texto-red')) !!}
            </div>
            <div class="form-group col-sm-1 text-right">
                <input type="submit" value="Aplicar" class="btn btn-success">
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="card-box">
                <table class="table table-striped  atendimento_sindicato" style="border-top: solid 1px #c8e5bc;">
                    <thead>
                        <tr>
                            <th>sigla</th>
                            <th width="2">Atendimentos</th>
                        </tr>
                    </thead>
                    <tbody>
                    <span class="hide">{{ $t=0 }}</span>
                    @foreach($sindicatos as $e)
                        <tr>
                            <td>{{ $e->sigla }}</td>
                            <td class="text-center">{{ str_pad($e->totalMes, 2, "0", STR_PAD_LEFT) }}</td>
                        </tr>
                        <span class="hide">{{ $t+= $e->totalMes}}</span>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td>Total</td>
                        <td class="text-center">{{str_pad($t, 2, "0", STR_PAD_LEFT)}}</td>
                    </tr>
                    </tfoot>
                </tbody>
                </table>
            </div>
        </div>
        {{-- --}}
        <div class="col-sm-6">
            <div class="card-box">
                <table class="table table-striped  atendimento_sindicato" style="border-top: solid 1px #c8e5bc;">
                    <thead>
                    <tr>
                        <th>sigla</th>
                        <th width="2">Atendimentos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <span class="hide">{{ $t=0 }}</span>
                    @foreach($instituicoes as $e)
                        <tr>
                            <td>{{ iRcGetSysVal_('TIPO_UNIDADE',$e->sigla) }}</td>
                            <td class="text-center">{{ str_pad($e->totalMes, 2, "0", STR_PAD_LEFT) }}</td>
                        </tr>
                        <span class="hide">{{ $t+= $e->totalMes}}</span>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td>Total</td>
                        <td class="text-center">{{str_pad($t, 2, "0", STR_PAD_LEFT)}}</td>
                    </tr>
                    </tfoot>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@stop