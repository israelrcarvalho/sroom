@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEspaco.index') }}">Tipos de Espaço</a></li>
            <li>Adicionar</li>
        </ol>
    </div>
</div>

    <!-- form aqui -->
    {!! Form::open(['route' => ["tiposEspaco.store"]]) !!}
    
        @include('tiposEspaco.partials.form')

    {!! Form::close() !!}
    <!-- Fim -->
@endsection