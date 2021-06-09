@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('recursos.index') }}">Recursos</a></li>
            <li>Adicionar</li>
        </ol>
    </div>
</div>

<!-- form aqui -->
    {!! Form::open(['route' => ["recursos.store"]]) !!}

        @include('recursos.partials.form')

    {!! Form::close() !!}
    <!-- Fim -->
@endsection