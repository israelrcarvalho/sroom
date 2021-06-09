@extends('layout.admin')
@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('espacos.index') }}">Espaços</a></li>
                <li>Editar</li>
            </ol>
        </div>
    </div>
    {!! Form::model($objModel, ['route'=> ['espacos.update',$objModel['id'] ]]) !!}
    @include('espacos.partials.form')
    {!! Form::close() !!}

@endsection