@if ($errors->any())

    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
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
                    {!! Form::label('nivel_tipo', 'Tipo:') !!}
                    {!! Form::select('nivel_tipo', iRcGetSysValArray('TIPO_NIVEL'), null, array('id'=>'nivel_tipo','class' => 'form-control')) !!}
                </div>
                {{-- --}}
                <div class="form-group  col-lg-4">
                    {!! Form::label('nome', 'Nome do Nivel:') !!}
                    {!! Form::text("nome", null, array("class" => "form-control", "placeholder"=>"Nome do Espaço")) !!}
                </div>
                {{-- --}}
                <div class="form-group  col-lg-4">
                    {!! Form::label('valor', 'Valor:') !!}
                    {!! Form::text("valor", null, array("class" => "form-control", "placeholder"=>"Informe qual o andar do espaço")) !!}
                </div>

            {{-- --}}
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-6 text-left ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('niveis.index') }}';}">
            Cancelar
        </button>
    </div>
    <div class="col-lg-6 text-right ajuste-btn-salvar">
        <button type="submit" class="btn btn-success"
                name="action" value="finished">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>    
</div>
