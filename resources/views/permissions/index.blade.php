@extends('layout.admin')
@section('conteudo')

<div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('permission.index') }}">Permissoes</a></li>
                <li>dfsdfs</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <div class="row">
                    <div class="col-sm-12 text-right">
                        <button type="button" class="btn btn-success text-right"
                                data-toggle="modal"
                                data-target="#modal-create-permission"
                                name="action" value="finished">
                            <i class="fa fa-money"></i>
                            [ + ]
                        </button>
                    </div>
                </div>

                @include('recursos.partials.success')
                    <table class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="11"></th>
                                <th width="20">ID</th>
                                <th>Nome</th>
                                <th>Sigla</th>
                                <th width="11"></th>
                            </tr>
                        </thead>
                    <tbody>
                    @foreach($objModel as $p)
                        <tr>
                            <td align="center">

                      <span class="glyphicon glyphicon-edit" style="cursor:pointer;"
                            data-toggle="modal"
                            data-target="#modal-edit-permission-{{$p->id}}"/>

                            </td>
                            <td align="center">{{ $p->id }}</td>
                            <td><a href="{{ route('recursos.show',['id'=>$p->id]) }}">{{ $p->name }}</a></td>
                            <td>{{ $p->label }}</td>
                            <td align="center">
                                <span style="cursor:pointer;"
                                      class="glyphicon glyphicon-trash"
                                      data-toggle="modal"
                                      data-target="#modal-delete-permission-{{$p->id}}"></span>
                            </td>
                        </tr>
                        {{-- Confirm Delete --}}
                        <div class="modal fade" id="modal-delete-permission-{{$p->id}}" tabIndex="-1">
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
                                            Tem certeza de que deseja excluir  {{ $p->id }} ?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="GET" action="{{ route('permission.destroy',['id'=>$p->id]) }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-times-circle"></i> Sim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- --}}

                        @include('permissions.partials.modal-edit-permission')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('permissions.partials.modal-create-permission')
@endsection