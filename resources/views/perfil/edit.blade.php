@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li>Perfil do Usuário</li>
            <li>Editar</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">

    <!-- form aqui -->

                {!! Form::model($objModel, ['route'=> ['perfil.update',$objModel->id ]]) !!}

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <div class="form-group col-lg-6">
                    {!! Form::label('password', 'Nova Senha:') !!}
                    {!! Form::password("password", array("class" => "form-control")) !!}
                </div>

                <div class="form-group col-lg-6">
                    {!! Form::label('password', 'Confirmar Nova Senha:') !!}
                    {!! Form::password("password_confirmation", array("class" => "form-control password")) !!}
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row form-group col-12">

        <div class="col-lg-6 ajuste-btn-cancelar">
            <button type="button" class="btn btn-danger"
                    name="action" value="finished"
                    onClick="javascript:if (confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ url('/') }}'; }">             
                Cancelar
            </button>
        </div>
        <div class="col-lg-6  text-right ajuste-btn-salvar">
            <button type="submit" class="btn btn-success"
                    name="action" value="finished">
                <i class="fa fa-floppy-o"></i>
                Salvar
            </button>
        </div>
    </div>


    {!! Form::close() !!}
    <!-- -->

</div>
@endsection