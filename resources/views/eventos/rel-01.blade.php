@extends('layout.admin')
@section('conteudo')

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

        <form method="get" id="filtro" action="{{ action('EventosController@rel01') }}">

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

        </form>

    </div>

    <div class="row">
        <div class="col-sm-12">

            <div class="card-box" id="l-eventos">
                <div class="row form-group col-lg-12" style="display: none;">
                    <input class="form-control" type="text" name="query" placeholder="busca">
                </div>

                <table class="table table-striped dataTables-example4">
                    <thead>
                    <tr>
                        <th width="2"></th>
                        <th style="width: 80px;">Horário</th>
                        <th>Evento</th>
                        <th style="width: 120px;"> Status</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objModel as $evento)

                        <tr>
                            <td class="text-center" style="border-left: solid 6px {{$evento->espaco->cor }};">
                                <div class="img-circle"
                                     style="color:{{$evento->espaco->cor }}; width: 25px;height: 25px; background-color: {{$evento->espaco->cor }};">{{$evento->espaco->id }}</div>
                            </td>
                            <td>
                                {{$evento->dt_realizacao }}<br/>
                                {{nameOfDay($evento->dt_realizacao)}}<br>
                                {{$evento->hora_inicio }} às {{$evento->hora_fim }}
                            </td>
                            <td>
                                <a href="{{ route('eventos.show',['id'=>$evento->evento_id]) }}">{{ $evento->eventoPeriodo->nome }}
                                    {{$evento->nome_evento }}
                                </a>
                                <br/>
                                <span style="color: {{$evento->espaco->cor }}; font-weight: bold;">Local: {{$evento->espaco->local }} - {{$evento->espaco->nome }}</span><br/>
                                Solicitante: {{iRcGetSysVal_('TIPO_UNIDADE',$evento->eventoPeriodo->unidadeEvento->tipo) }} / {{$evento->eventoPeriodo->unidadeEvento->nome }} / {{$evento->eventoPeriodo->empresa_solicitante }}<br/>
                                Telefone: {{$evento->eventoPeriodo->fone_solicitante}}
                                {{--  Solicitante: {{  $evento->empresa }} / {{$evento->unidade }} --}}
                                <br/>
                                Atendimento: {{$evento->eventoPeriodo->cadastroPor->name }}<br/>
                                <b>Recursos:</b>
                                <ul>
                                @forelse($evento->eventoPeriodo->recursos as $r)
                                    <li>{{$r->nome}}</li>
                                @empty
                                    <p>Sem recursos</p>
                                @endforelse
                                </ul>
                                <b>Alimentação:</b>
                                <ul>
                                @forelse($evento->modelPeriodoRecurso as $pr)
                                        <li>{{str_pad($pr->quantidade, 3, "0", STR_PAD_LEFT)}} - {{$pr->modelRecurso->recursos->nome}}</li>
                                @empty
                                    Não informado
                                @endforelse
                                </ul>
                            </td>
                            <td>{{iRcGetSysVal_('STATUS_EVENTO',$evento->status)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<!-- <div class="row dataTables_paginate">{-- !! $objModel->render() !!}</div> -->--}}
            </div>
        </div>


    </div>

@stop