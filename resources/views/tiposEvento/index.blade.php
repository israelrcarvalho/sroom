@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEvento.index') }}">Tipos de Evento</a></li>
            <li>Listar</li>
        </ol>
    </div>
</div>

<div class="row">
        <div class="col-sm-12">
            <div class="card-box">
            
            @include('tiposEvento.partials.success')
            
            <!--<table id="ttipoespacos" class="table table-striped table-bordered table-hover gotchaTable">-->
                <table id="ttipoeventos" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="sorting_disabled" width="11"></th>
                        <th width="20">ID</th>
                        <th>Nome/Descrição</th>
                        <th width="11"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objModel as $tiposEvento)
                    <tr>
                        <td align="center">
                            <a href="{{ route('tiposEvento.edit',['id'=>$tiposEvento->id]) }}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </td>
                        <td align="center">{{ $tiposEvento->id }}</td>
                        <td>
                            <a href="{{ route('tiposEvento.show',['id'=>$tiposEvento->id]) }}">
                                {{ $tiposEvento->nome }}
                            </a><br>
                            <hr>
                            {{ $tiposEvento->descricao}}
                        </td>
                        <td align="center">
                            <span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$tiposEvento->id}}"></span>
                        </td>
                        
                        {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$tiposEvento->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir "{{ $tiposEvento->nome }}"?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="{{ route('tiposEvento.destroy',['id'=>$tiposEvento->id]) }}">
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