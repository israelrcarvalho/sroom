@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('eventos.index') }}">Eventos</a></li>
            <li>Adicionar</li>
        </ol>
    </div>
</div>



    <!-- form aqui -->
    {!! Form::open(['route' => ["eventos.store"],"id"=>"frmCreateEdit"]) !!}
        @include('eventos.partials.form')
    {!! Form::close() !!}
    <!-- Fim -->
    <script>
        $('#frmCreateEdit').submit(function () {
            $("#btnSalvar").prop('disabled',true);
            $("#btnSalvar").text('Aguarde... Salvando registro !!');
        });
    </script>
@endsection