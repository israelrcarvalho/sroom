@extends('layout.admin')
@section('conteudo')

    {{--<link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet"/>--}}
    {{--<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>--}}

    <link href="{{url('css/bootstrap-select.min.css')}}" rel="stylesheet"/>
    <script src="{{url('js/bootstrap-select.min.js')}}"></script>
    <div class="row">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('eventos-solicitados') }}">Eventos</a></li>
            <li>Listar</li>
        </ol>

    </div>


    <style>
        .texto-red {
            font-size: 12px;
        }
    </style>

    <div class="row">

        <form method="get" id="filtro" action="{{ action('EventosController@listEventsByStatus') }}">

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

                {!! Form::select('tipo_pb[]',listaItens('TIPO_PUBLICACAO'), Input::get('tipo_pb'), array('class' => 'form-control texto-red selectpicker','title'=>'- Publicação -','id'=>'tipo_pb','multiple')) !!}

            </div>

            <div class="form-group col-sm-2" style="width: 80px;">
                <input type="submit" value="Aplicar" class="btn btn-success">
            </div>
            {{--<div class="form-group col-sm-2" style="width: 80px;">

                <input type="button" value="Gerar mapa" id="relatorio" class="btn btn-danger">
            </div>--}}

        </form>

    </div>
    {{-- <div class="row">
        <a class="btn btn-default" tabindex="0" aria-controls="DataTables_Table_0" name="action" value="finished" title="Gerar mapa" id="relatorio"><span>Gerar mapa</span></a>
    </div> --}}

    <div class="row">
        <div class="col-sm-12">
            @include('eventos.partials.success')

            <div class="card-box" id="l-eventos">
                <div class="row form-group col-lg-12" style="display: none;">
                    <input class="form-control" type="text" name="query" placeholder="busca">
                </div>

                <table class="table table-striped dataTables-example4">
                    <thead>
                    <tr>
                        {{-- <th width="12"></th> --}}
                        <th width="2"></th>
                        <th style="width: 80px;">Horário</th>
                        <th>Evento</th>
                        <th style="width: 120px;"> Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objModel as $evento)

                        <tr>
                            <td class="text-center" style="border-left: solid 6px {{$evento->cor }};">
                                <div class="img-circle"
                                     style="color:{{$evento->cor }}; width: 25px;height: 25px; background-color: {{$evento->cor }};">{{$evento->espaco_id }}</div>
                            </td>
                            <td>
                                {{$evento->dataevento }}<br/>
                                {{nameOfDay($evento->dataevento)}}<br>
                                {{$evento->hora_inicio }} às {{$evento->hora_fim }}
                            </td>
                            <td>
                                <a href="{{ route('eventos.show',['id'=>$evento->evento_id]) }}">{{ $evento->nome }}
                                    {{$evento->nome_evento }}
                                </a>
                                <br/>
                                <span style="color: {{$evento->cor }}; font-weight: bold;">Local: {{$evento->espaco_nome }}</span><br/>
                                Solicitante: {{iRcGetSysVal_('TIPO_UNIDADE',$evento->empresa) }} / {{$evento->unidade }} / {{$evento->solicitante }}<br/>
                                Telefone: {{$evento->fone_solicitante}}
                                {{--  Solicitante: {{  $evento->empresa }} / {{$evento->unidade }} --}}
                                <br/>
                                Atendimento: {{$evento->atendente }}<br/>
                                <b>Reservado em : {{$evento->data_solicitacao }}</b><br/>
                            </td>
                            <td>{{iRcGetSysVal_('STATUS_EVENTO',$evento->pstatus)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<!-- <div class="row dataTables_paginate">{-- !! $objModel->render() !!}</div> -->--}}
            </div>
        </div>


    </div>
@stop