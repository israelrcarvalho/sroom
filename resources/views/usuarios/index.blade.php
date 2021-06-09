@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('usuarios.index') }}">Usuários</a></li>
                <li>Listar</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                @include('tiposEspaco.partials.success')
                <table class="gotchaTable table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="sorting_disabled" width="11"></th>
                        <th width="20">ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Imagem</th>
                        <th width="11"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objModel as $usuario)
                        <tr>
                            <td align="center">
                                <a href="{{ route('usuarios.edit',['id'=>$usuario->id]) }}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </td>
                            <td align="center">{{ $usuario->id }}</td>
                            <td>
                                <a href="{{ route('usuarios.show',['id'=>$usuario->id]) }}">{{ $usuario->name }}</a>
                            </td>
                            <td>{{ $usuario->email }}</td>
                            <td align="center">
                                @if(!empty($usuario->imagem))
                                    <img  width="25" src="{{ url('public/imagens-perfil/' . $usuario->imagem) }}">
                                @endif
                            </td>
                            
                            <td align="center"><span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$usuario->id}}"></span></td>

                            {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$usuario->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir "{{ $usuario->name }}"?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET"
                                                  action="{{ route('usuarios.destroy',['id'=>$usuario->id]) }}">
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