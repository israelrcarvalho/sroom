@extends('layout.admin')
@section('conteudo')

<div class="row">

    <h1>Editar {{ $objModel->modelName }} </h1>

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
    {!! Form::open(array('url'=>"$objModel->pathModule/$objModel->id/update", 'method'=>'put')) !!}

    <!-- Nome Form Input -->

    <div class="form-group">
        {!! Form::label('nome', 'Nome:') !!}
        {!! Form::text("nome_setor", $objModel->nome_setor, array("class" => "form-control", "placeholder"=>"Digite o nome")) !!}
    </div>
<?php  
$models = App\Unidade::all()->lists('nome_breve', 'id')  ;
$array1 = array("1" => "- Selecione -");
 
// $models =  array_merge($array1, $models->toArray());

?>
   
    <!-- Descricao Form Input -->    
    <div class="form-group">
        <?php
        echo Form::select('id_unidade', $models, $objModel->id_unidade, array('class'=>'form-control')) ;
        ?>        
    </div>
    <div class="form-group">
        {!! Form::submit('Salvar', array('class'=>'btn btn-primary')) !!}
    </div>

    {!! Form::close() !!}
    <!-- -->

</div>
@endsection