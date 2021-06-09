@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('usuarios.index') }}">Usuários</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
    
<!-- form aqui -->
{!! Form::model($objModel, ['route'=> ['usuarios.update',$objModel->id ]]) !!}

@include('usuarios.partials.form')

{!! Form::close() !!}
<!-- -->
@endsection