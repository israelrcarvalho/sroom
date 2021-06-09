@extends('layout.admin')
@section('conteudo')

<div class="row">

    <h1>Editar Setor </h1>

    @if ($errors->any())    
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

        <ul class="alert">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>    
    @endif 

    <!-- form aqui -->
    {!! Form::open(array('url'=>"setores/store")) !!}
    <!-- Nome Form Input -->

    <div class="form-group">
        {!! Form::label('nome', 'Nome:') !!}
        {!! Form::text("nome_setor", null, array("class" => "form-control", "placeholder"=>"Digite o nome")) !!}
    </div>

    <!-- Descricao Form Input -->

    <div class="form-group">
        <select id="id_unidade" name="id_unidade" class="form-control">
            <option value="null">Selecione</option>

            @foreach (App\Unidade::all() as $unidade)
            <option value="{{ $unidade->id }}">{{ $unidade->nome_breve }}</option>
            @endforeach

        </select>        

        
    </div>
    <div class="form-group">
        {!! Form::submit('Salvar', array('class'=>'btn btn-primary')) !!}
    </div>

    {!! Form::close() !!}
    <!-- -->

</div>
@endsection