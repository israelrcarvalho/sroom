@extends('layout.admin')
@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos-solicitados') }}">Eventos</a></li>
                <li>Listar</li>
            </ol>
        </div>
    </div>
    <style>
        .texto-red {
            font-size: 12px;
        }
    </style>
    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>


        <div class="row">

            <form method="get" id="filtro" action="{{ action('RelatoriosController@whatsUp') }}">

                <div class="form-group col-sm-2" style="width: 160px;">
                    <div class='input-group date_c cursorHand'>
                        <input class="form-control texto-red"
                               type="text"
                               name="data_i"
                               value="{{$data_i}}"
                               placeholder="data inicial"
                               data-mask="99.99.9999">
                        <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="form-group col-lg-2" style="width: 160px;">
                    <div class='input-group date_c cursorHand'>
                        <input class="form-control texto-red"
                               type="text"
                               name="data_f"
                               value="{{$data_f}}"
                               placeholder="data final">
                        <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::select('unidade_id[]', $listaUnidades, Input::get('unidade_id'), array('class' => 'form-control texto-red selectpicker','multiple','title'=>'- Unidades -')) !!}
                </div>

                <div class="form-group col-sm-2">

                    {!! Form::select('espaco_id[]', $listaSalas, Input::get('espaco_id'), array('class' => 'form-control texto-red selectpicker','title'=>'- Espaços -','id'=>'espaco_id','multiple')) !!}
                </div>

                <div class="form-group col-sm-2">
                    {!! Form::select('status', listaItens('STATUS_EVENTO','- Status -'), $status, array('class' => 'form-control texto-red','id'=>'status')) !!}
                </div>

                <div class="form-group col-sm-2">

                    {!! Form::select('tipo_pb',array_merge([''=>'- Selecione -'],listaItens('TIPO_PUBLICACAO','Publicação')), $tipo_pb, array('class' => 'form-control texto-red')) !!}

                </div>

                <div class="form-group col-sm-2" style="width: 80px;">
                    <input type="submit" value="Aplicar" class="btn btn-success">
                </div>
            </form>

        </div>

    <div class="row">
        <div class="col-sm-12">
            @include('eventos.partials.success')
            <div class="card-box">
                <div class="row form-group col-lg-12" style="display: none;">
                    <input class="form-control" type="text" name="query" placeholder="busca">
                </div>

                <table class="table table-striped table-bordered dataTables-example4">
                    <thead>

                    <tr>
                        <th>DATA</th>
                        <th>EVENTO</th>
                        <th width="150">HOR&Aacute;RIO</th>
                        <th>SOLICITANTE</th>
                        <th>ESPAÇO</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objModel as $evento)
                        <tr>
                            <td>{{$evento->dataevento }}</td>
                            <td>{{ $evento->nome_evento }}</td>
                            <td>{{$evento->hora_inicio }} às {{$evento->hora_fim }}</td>
                            <td>{{iRcGetSysVal_('TIPO_UNIDADE',$evento->empresa) }} / {{$evento->unidade }} / {{$evento->solicitante }}</td>
                            <td>{{$evento->espaco_nome }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<!-- <div class="row dataTables_paginate">{-- !! $objModel->render() !!}</div> -->--}}
            </div>
        </div>


    </div>
@stop