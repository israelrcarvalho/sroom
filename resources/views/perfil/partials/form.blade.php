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
{{-- --}}

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <div class="form-group  col-lg-6">
                {!! Form::label('name', 'Nome do Usuário:') !!}
                {!! Form::text("name", null, array("class" => "form-control", "placeholder"=>"Preencha um nome para o Espaço")) !!}
            </div>

            {{-- --}}
            <div class="form-group  col-lg-6">
                {!! Form::label('espaco_tipo', 'Tipo de Espaço:') !!}
                {!! Form::select('espaco_tipo', $listTipos, null, array('class' => 'form-control')) !!}
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 text-left ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('espacos.index') }}';}">
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