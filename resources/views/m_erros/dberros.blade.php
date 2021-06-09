@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb page-header">
            <li><a href="#">Espaços</a></li>
            <li>Error</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">


        <div class="card-box">

            @if ($errors->any())

                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{!! $error !!}</li>
                        @endforeach
                    </ul>
                </div>

            @endif

        </div>

    </div>

</div>
@stop