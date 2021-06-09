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

            {{-- Nome da Unidade --}}
            <div class="form-group col-lg-12">
                {!! Form::label('nome', 'Nome da Unidade:') !!}
                {!! Form::text("nome", null, array("class" => "form-control", "placeholder"=>"Preencha um nome para a Unidade")) !!}
            </div>
            
            {{-- Sigla da Unidade --}}
            <div class="form-group col-lg-3">
                {!! Form::label('sigla', 'Sigla:') !!}
                {!! Form::text("sigla", null, array("class" => "form-control", "placeholder"=>"Preencha uma Sigla")) !!}
            </div>
            {{-- Sigla da Unidade --}}
            <div class="form-group col-lg-3">
                {!! Form::label('cod', 'COD UO:') !!}
                {!! Form::text("cod", null, array("class" => "form-control", "placeholder"=>"Insira o codigo da unidade")) !!}
            </div>
            {{-- Tipo de Unidade --}}
            <div class="form-group col-lg-3">
                {!! Form::label('tipo', 'Tipo da Unidade:') !!}
                {!! Form::select('tipo', listaItens('TIPO_UNIDADE','- Tipo Unidade -'), null, array('class' => 'form-control')) !!}
            </div>

            {{-- É Corporativo --}}
            <div class="form-group col-lg-3">
                {!! Form::label('exibir_agendamento', 'Exibir no agendamento:') !!}
                {!! Form::select('exibir_agendamento', array('0'=>'Não','1'=>'Sim'), null, array('class' => 'form-control')) !!}
            </div>


            {{-- Razão Social --}}
            <div class="form-group col-lg-12">
                {!! Form::label('razao_social', 'Razão Social:') !!}
                {!! Form::text("razao_social", null, array("class" => "form-control", "placeholder"=>"Razão Social")) !!}
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
