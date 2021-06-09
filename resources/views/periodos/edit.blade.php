@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Editar Data </h3>
    </div>
</div>

<div class="row">

    {!! Form::model($objModel, ['route'=> ['periodos.update', $objModel ]]) !!}

    
    @include('periodos.partials.form')

    {!! Form::close() !!}
    <!-- -->
   
</div>

@endsection