@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('niveis.index') }}">Níveis</a></li>
                <li>Editar</li>
            </ol>
        </div>
    </div>


    {!! Form::model($objModel, ['route'=> ['niveis.update',$objModel['id'] ]]) !!}
    @include('niveis.partials.form')
    {!! Form::close() !!}

@endsection