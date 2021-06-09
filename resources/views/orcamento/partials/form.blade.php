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
<div class="row">
    <div class="col-sm-12">
        <div class="card-box" style="overflow: hidden">

            {{-- Sigla da Unidade --}}
            <div class="form-group col-lg-8">
                {!! Form::label('unidade_id', 'Unidade:') !!}
                {!! Form::select('unidade_id', array_merge([''=>'- Selecione uma Unidade -'],$listaDeUnidade), null, array('required','class' => 'form-control')) !!}
            </div>
            {{-- Sigla da Unidade --}}
            <div class="form-group col-lg-4">
                {!! Form::label('centro_id', 'Centro de Responsabilidade:') !!}
                {!! Form::select('centro_id', $listaCentros, null, array('required','class' => 'form-control')) !!}
            </div>

            <div class="form-group col-lg-8">
                {!! Form::label('recurso_id', 'Recurso:') !!}
                {!! Form::select('recurso_id', $listaRecursos, null, array('required','class' => 'form-control')) !!}
            </div>

            <div class="form-group col-lg-2">
                {!! Form::label('ano', 'Ano:') !!}
                {!! Form::select('ano', $listaAno, null, array('required','class' => 'form-control')) !!}
            </div>

            <div class="form-group col-lg-2">
                {!! Form::label('quantidade', 'Quantidade:') !!}
                {!! Form::text("quantidade", null, array("class" => "form-control text-right", "placeholder"=>"Informe a quantidade")) !!}
            </div>
            
        </div>
    </div>
</div>            

<div class="row">

    <div class="col-lg-6 ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('unidades.index') }}';}">
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
