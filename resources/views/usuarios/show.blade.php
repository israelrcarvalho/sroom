@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('usuarios.index') }}">Usuários</a></li>
            <li>Listar</li>
            <li>Detalhes</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p><b>Id:</b> {{$p->id}}</p>
        <p><b>Nome:</b> {!! $p->name !!}</p>
        <p><b>E-mail:</b> {!! $p->email !!}</p>
    </div>
</div>

<div class="row">
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-orcamento" data-toggle="tab">Permissões</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-orcamento">
                <div class="card-box border-top">
                    <?php
                        //echo "<pre>";
                        //print_r($p->gruposEpermissoesDoUsuario);

                        ?>

                    <table id="tdataseventosxx" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>permissoes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($p->UserGroups as $g)
                        <tr>
                            <td>{{ $g->name }}</td>
                            <td>{{ $g->label }}</td>
                            <td>
                                @foreach($g->permissions as $p)
                                    {{ $p->name }}
                                @endforeach

                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary"
                name="action" value="finished"
                onClick="location.href = '{{ route('usuarios.index') }}';">
            <i class="fa fa-backward"></i>
            Voltar à listagem
        </button>
    </div>

     --}}

</div>
@stop