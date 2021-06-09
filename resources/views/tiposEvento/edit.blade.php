@extends('layout.admin')
@section('conteudo')


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEvento.index') }}">Tipos de Evento</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
    
<!-- form aqui -->

{!! Form::model($objModel, ['route'=> ['tiposEvento.update',$objModel->id ]]) !!}

@include('tiposEvento.partials.form')

{!! Form::close() !!}
<!-- -->
@endsection