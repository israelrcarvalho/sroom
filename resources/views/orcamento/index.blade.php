@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('unidades.index') }}">Unidades</a></li>
                <li>Orçamento</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box" id="c-orcamento">
               {{-- @include('unidades.partials.success') --}}
                <table class="table table-striped grid-orcamento">
                    <thead>
                    <tr>
                        <th>UNIDADE</th>
                        <th></th>
                        <th>RECURSO</th>
                        <th>QUANT</th>
                        <th>USADO</th>
                        <th>SALDO</th>
                        <th style="width: 10px;">-</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($objModel as $orc)
                            <tr>
                                <td>
                                    UNIDADE: {{ $orc->unidades->nome }} - {{ $orc->unidades->cod }} - {{ iRcGetSysVal_('TIPO_UNIDADE',$orc->unidades->tipo) }}
                                </td>
                                <td><p style="margin-left: 50px;">
                                    <b>CR:</b> {{ $orc->centros->nome }} - ({{ $orc->centros->codigo }})
                                    </p>
                                </td>
                                <td>
                                    {{ $orc->recursos->nome}} <br />
                                </td>
                                <td class="text-center">
                                    {{ $orc->quantidade }}
                                </td>
                                <td class="text-center">
                                    {{$orc->recursoAlimentacao->sum('quantidade')}}
                                </td>
                                <td class="text-center">
                                    {{ $orc->quantidade - $orc->recursoAlimentacao->sum('quantidade') }}
                                </td>
                                <td>
                                    <span style="cursor:pointer;"
                                          class="glyphicon glyphicon-trash"
                                          data-toggle="modal"
                                          data-target="#modal-delete-{{$orc->id}}"
                                          title="Excluir"></span>
                                </td>
                            </tr>

                            {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$orc->id}}" tabIndex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                            <h4 class="modal-title">Por favor Confirmar</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p class="lead">
                                                <i class="fa fa-question-circle fa-lg"></i> &nbsp;
                                                Tem certeza de que deseja excluir  {{ $orc->id }} ?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="{{ route('orcamento.destroy',['id'=>$orc->id]) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle"></i> Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- --}}
                        @endforeach
                    </tbody>
                </table>
            </div></div>
    </div>

    @include('orcamento.partials.modal-create-orcamento-alimentacao')
@stop