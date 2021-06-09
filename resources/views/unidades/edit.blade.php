@extends('layout.admin')
@section('conteudo')


<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('unidades.index') }}">Unidades</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
    
<!-- form aqui -->

{!! Form::model($objModel, ['route'=> ['unidades.update',$objModel->id ]]) !!}

@include('unidades.partials.form')

{!! Form::close() !!}
<!-- -->
@endsection