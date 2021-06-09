@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('recursos.index') }}">Recursos</a></li>
                <li>Listar</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                @include('recursos.partials.success')
                    <table id="t-recursos" class="table table-striped" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th width="11"></th>
                        <th width="20">ID</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Sigla</th>
                        <th>Custo</th>
                        <th width="11"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($objModel as $recurso)
                        <tr>
                            <td align="center">
                                @can('edit',$recurso)
                                <a href="{{ route('recursos.edit',['id'=>$recurso->id]) }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                @endcan
                            </td>
                            <td align="center">{{ $recurso->id }}</td>
                            <td>{{iRcGetSysVal_('TIPO_RECURSO',$recurso->tipo_recurso)}}</td>
                            <td><a href="{{ route('recursos.show',['id'=>$recurso->id]) }}">{{ $recurso->nome }}</a></td>
                            <td>{{ $recurso->sigla }}</td>
                            <td class="text-right">{{ $recurso->valor }}</td>
                            <td align="center"><span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$recurso->id}}"></span></td>

                            {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$recurso->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir "{{ $recurso->nome }}"?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET"
                                                  action="{{ route('recursos.destroy',['id'=>$recurso->id]) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-danger"><i
                                                            class="fa fa-times-circle"></i> Sim
                                                </button>
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
            </div>
        </div>
    </div>
@stop