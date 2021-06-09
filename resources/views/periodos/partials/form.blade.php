
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

<div class="form-group">
    {{-- Editar Data --}}
    <div class="col-lg-3">
        {!! Form::label('dt_realizacao', 'Data:') !!}
        {!! Form::text("dt_realizacao", null, array("class" => "form-control", "id"=>"dt_realizacao")) !!}
    </div>
    
    @if(isset($idEvento))
        {!! Form::hidden("evento_id", $idEvento, array("class" => "form-control", "id"=>"evento_id")) !!}
    @else
        {!! Form::hidden("evento_id", null, array("class" => "form-control", "id"=>"evento_id")) !!}
    @endif
    
    {{-- Hora Início --}}
    <div class="col-lg-3">
        {!! Form::label('hora_inicio', 'Hora Início:') !!}
        {!! Form::text("hora_inicio", null, array('class' => 'form-control', 'id' => 'hora_inicio')) !!}
    </div>
    
    {{-- Hora Fim --}}
    <div class="col-lg-3">
        {!! Form::label('hora_fim', 'Hora Fim:') !!}
        {!! Form::text("hora_fim", null, array('class' => 'form-control', 'id' => 'hora_fim')) !!}
    </div>    
    
    <div class="col-lg-3">
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', listaItens('STATUS_EVENTO'), null, array('class' => 'form-control')) !!}
    </div>
    <div class="col-lg-12">
        {!! Form::label('espaco_id', 'Espaço:') !!}
        {!! Form::select('espaco_id', $listaSalas, null, array('class' => 'form-control')) !!}
    </div>
</div>

<!--Botões do formulário-->
<div class="row">
    <div class="col-lg-12">
        <hr style="margin-top:20px; border-top: 1px solid #eee;"/>
    </div>
    <!-- /.col-lg-12 -->
</div>


<div class="form-group col-lg-12">
    <div class="col-lg-6 ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){document.location.replace(document.referrer);}">
            Cancelar
        </button>
    </div>

    <div class="col-lg-6 text-right">
        <button type="submit" class="btn btn-success"
                name="action" value="finished">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>
</div>