@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('recursos.index') }}">Recursos</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
    
<!-- form aqui -->
{!! Form::model($objModel, ['route'=> ['recursos.update',$objModel->id ]]) !!}

@include('recursos.partials.form')

{!! Form::close() !!}
<!-- -->
@endsection