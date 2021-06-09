@extends('layout.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Eventos </h2>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="dataTable_wrapper">
        <div class="panel-body">
            
            @include('eventos.partials.success')
            
            <table id="teventos" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="11"></th>
                        <th width="20">ID</th>
                        <th>Nome</th>
                        <th>Espaço</th>
                        <th>Status</th>
                        <th width="11"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objModel as $evento)

                    <tr>
                        <td align="center"><a href="{{ route('eventos.edit',['id'=>$evento->id]) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td>{{ $evento->id }}</td>
                        <td><a href="{{ route('eventos.show',['id'=>$evento->id]) }}">{{ $evento->nome }}</a></td>
                        <td>
                            @foreach($evento->espacos as $espaco)                         
                                {{ $espaco->nome }},
                            @endforeach 
                        </td>
                        <td>
                            {{ iRcGetSysVal_('STATUS_EVENTO',$evento->status) }}
                        </td>
                        <td align="center">
                            <span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$evento->id}}"></span>
                        </td>
                        
                        {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$evento->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir  {{ $evento->nome }} ?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="{{ route('eventos.destroy',['id'=>$evento->id]) }}">
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
        </div>
    </div>
</div>
@stop