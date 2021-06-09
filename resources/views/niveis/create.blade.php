@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('niveis.index') }}">Níveis</a></li>
                <li>Adicionar</li>
            </ol>
        </div>
    </div>


    <!-- form aqui -->
    {!! Form::open(['route' => ["niveis.store"]]) !!}
        @include('niveis.partials.form')
    {!! Form::close() !!}
    <!-- Fim -->
@endsection