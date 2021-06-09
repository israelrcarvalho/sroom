@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('espacos.index') }}">Espaços</a></li>
            <li>Listar</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        @include('espacos.partials.success')

        <div class="card-box">
                <table id="tespacos" class="table table-striped">
                <thead>
                    <tr>
                        <th width="11"></th>
                        <th width="20">ID</th>
                        <th>Tipo de Espaço</th>
                        <th>Nome</th>
                        <th width="100">Capacidade</th>
                        <th width="50">Ativo</th>
                        <th width="35">Cor</th>
                        <th width="11"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($objModel as $espaco)
                    <tr>

                        <td align="center"><a href="{{ route('espacos.edit',['id'=>$espaco->id]) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                        <td align="center">{{ $espaco->id }}</td>
                        <td>
                            {{ $espaco->tipo->nome}}
                        </td>

                        <td>
                            <a href="{{ route('espacos.show',['id'=>$espaco->id]) }}">{{ $espaco->nome }}</a>
                            <br />
                            {{ $espaco->local}}
                        </td>
                        <td>{{ $espaco->capacidade }}</td>
                        <td>{{ iRcGetSysVal_('SimNao',$espaco->ativa) }}</td>
                        <td align="center"><div style="width: 50px;height: 25px;background-color: {{$espaco->cor }};"></div></td>
                        <td align="center"><span style="cursor:pointer;" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#modal-delete-{{$espaco->id}}"></span></td>

                            {{-- Confirm Delete --}}
                            <div class="modal fade" id="modal-delete-{{$espaco->id}}" tabIndex="-1">
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
                                                Tem certeza de que deseja excluir  {{ $espaco->id }} ?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <form method="GET" action="{{ route('espacos.destroy',['id'=>$espaco->id]) }}">
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