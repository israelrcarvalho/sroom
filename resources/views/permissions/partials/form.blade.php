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
        <div class="card-box">
            <div class="row">

                <div class="form-group col-lg-4">
                    {!! Form::label('nome', 'Nome do Recurso:') !!}
                    {!! Form::text("nome", null, array("class" => "form-control")) !!}
                </div>

                <div class="form-group col-lg-3">
                    {!! Form::label('sigla', 'Sigla do Recurso:') !!}
                    {!! Form::text("sigla", null, array("class" => "form-control")) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('tipo_recurso', 'Tipo de Serviço:') !!}
                    {!! Form::select('tipo_recurso', listaItens('TIPO_RECURSO'), null, array('class' => 'form-control')) !!}
                </div>
                <div class="form-group col-lg-2">
                    {!! Form::label('valor', 'Valor do Recurso:') !!}
                    {!! Form::text("valor", null, array("class" => "form-control real text-right")) !!}
                </div>
                <div class="form-group col-lg-12">
                    {!! Form::label('descricao', 'Descrição:') !!}
                    {!! Form::textarea("descricao", null, array("class" => "form-control")) !!}
                </div>

            </div>
        </div>
    </div>
</div>            

<div class="form-group col-12">

    <div class="col-lg-6 ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('tiposEspaco.index') }}';}">             
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



              
