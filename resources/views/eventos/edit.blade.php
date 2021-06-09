@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos.index') }}">Eventos</a></li>
                <li>Editar</li>
            </ol>
        </div>
    </div>

    {!! Form::model($objModel, ['route'=> ['eventos.update',$objModel['id'] ],"id"=>"frmCreateEdit"]) !!}
        @include('eventos.partials.form')
    {!! Form::close() !!}

    <script>
        $('#frmCreateEdit').submit(function () {
            $("#btnSalvar").prop('disabled',true);
            $("#btnSalvar").text('Aguarde... Salvando registro !!');
        });
    </script>

@endsection