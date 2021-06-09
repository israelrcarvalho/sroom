@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEvento.index') }}">Tipos de Evento</a></li>
            <li>Adicionar</li>
        </ol>
    </div>
</div>

    <!-- form aqui -->
    {!! Form::open(['route' => ["tiposEvento.store"]]) !!}
    
        @include('tiposEvento.partials.form')

    {!! Form::close() !!}
    <!-- Fim -->
@endsection