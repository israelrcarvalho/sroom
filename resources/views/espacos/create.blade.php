@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('espacos.index') }}">Espaços</a></li>
                <li>Adicionar</li>
            </ol>
        </div>
    </div>

    <!-- form aqui -->
    {!! Form::open(['route' => ["espacos.store"]]) !!}
    @include('espacos.partials.form')
    {!! Form::close() !!}
            <!-- Fim -->
@endsection