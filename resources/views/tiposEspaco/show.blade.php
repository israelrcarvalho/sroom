@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEspaco.index') }}">Tipos de Espaço</a></li>
            <li>Listar</li>
            <li>Detalhes</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p><b>Id:</b> {{$p->id}}</p>
        <p><b>Nome:</b> {!! $p->nome !!}</p>
    </div>
    <div class="col-lg-12">
        <button type="button" class="btn btn-primary"
                name="action" value="finished"
                onClick="location.href = '{{ route('tiposEspaco.index') }}';">
            <i class="fa fa-backward"></i>
            Voltar à listagem
        </button>
    </div>
</div>
@stop