@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('niveis.index') }}">Níveis</a></li>
            <li>Listar</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        @include('niveis.partials.success')

        <div class="card-box">
                
                <table id="tnivel" class="table table-striped" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th width="11"></th>
                    <th width="20">ID</th>
                    <th>Tipo</th>
                    <th>Nome</th>
                    <th width="50">Valor</th>
                    <th width="11"></th>
                </tr>
                </thead>
                <tbody>

                @foreach($objModel as $obj)
                    <tr>

                        <td align="center"><a href="{{ route('niveis.edit',['id'=>$obj->id]) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td align="center">{{ $obj->id }}</td>
                        <td>{{ iRcGetSysVal_('TIPO_NIVEL',$obj->nivel_tipo) }}</td>
                        <td><a href="{{ route('niveis.show',['id'=>$obj->id]) }}">{{ $obj->nome }}</a></td>
                        <td align="center">{{ $obj->valor}}</td>
                        <td align="center">
                            <span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$obj->id}}"></span>
                        </td>

                        {{-- Confirm Delete --}}
                        <div class="modal fade" id="modal-delete-{{$obj->id}}" tabIndex="-1">
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
                                            Tem certeza de que deseja excluir  {{ $obj->nome }} ?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="GET" action="{{ route('niveis.destroy',['id'=>$obj->id]) }}">
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
</div>



@stop