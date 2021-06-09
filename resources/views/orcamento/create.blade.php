@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('unidades.index') }}">Unidade</a></li>
            <li><a href="{{ route('lista-orcamento') }}">Orçamento</a></li>
            <li>Adicionar</li>
        </ol>
    </div>
</div>

    <!-- form aqui -->
    {!! Form::open(['route' => ["store"]]) !!}
        @include('orcamento.partials.form')
    {!! Form::close() !!}
    <!-- Fim -->
@endsection