@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Adicionar Evento </h3>
    </div>
</div>

<div class="row">
  
    <!-- form aqui -->
    {!! Form::open(['route' => ["periodos.store"]]) !!}
    
        @include('periodos.partials.form')

    {!! Form::close() !!}
    <!-- Fim -->
</div>
@endsection