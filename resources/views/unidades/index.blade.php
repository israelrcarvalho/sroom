@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('unidades.index') }}">Unidades</a></li>
            <li>Listar</li>
        </ol>
    </div>
</div>

<div class="row">
        <div class="col-sm-12">
            <div class="card-box">
            
            @include('unidades.partials.success')

                <table id="tunidades" class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th class="sorting_disabled" width="11"></th>
                        <th width="20">ID</th>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>UO</th>
                        <th>Exibir</th>
                        <th width="11"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objModel as $unidades)
                    <tr>
                        <td>{{ iRcGetSysVal_('TIPO_UNIDADE',$unidades->tipo) }}</td>
                        <td align="center">
                            <a href="{{ route('unidades.edit',['id'=>$unidades->id]) }}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </td>
                        <td align="center">{{ $unidades->id }}</td>
                        <td>
                            <a href="{{ route('unidades.show',['id'=>$unidades->id]) }}">
                                {{ $unidades->nome }}
                            </a>
                        </td>
                        <td>{{ $unidades->sigla }}</td>
                        <td>{{ $unidades->cod }}</td>
                        <td>{{ iRcGetSysVal_('SimNao',$unidades->exibir_agendamento) }}</td>
                        <td align="center">
                            <span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$unidades->id}}"></span>
                        </td>
                        
                        {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$unidades->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir "{{ $unidades->nome }}"?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="{{ route('unidades.destroy',['id'=>$unidades->id]) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle"></i> Sim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
</div>
@stop