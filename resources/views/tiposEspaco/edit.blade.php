@extends('layout.admin')
@section('conteudo')


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEspaco.index') }}">Tipos de Espaço</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
    
<!-- form aqui -->

{!! Form::model($objModel, ['route'=> ['tiposEspaco.update',$objModel->id ]]) !!}

@include('tiposEspaco.partials.form')

{!! Form::close() !!}
<!-- -->
@endsection