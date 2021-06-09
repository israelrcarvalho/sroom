{{-- modal para editar o periodo --}}
<div class="modal fade bs-example-modal-sm" id="modal-nova-data-new" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Adicionar nova data</h4>
            </div>
            <div class="modal-body">

                <div class="row">
                    {!! Form::open(['route' => ["periodos.store"],'id'=>'frmCreatePeriodo']) !!}
                    {!! Form::hidden("evento_id", $p->id, array("class" => "form-control", "id"=>'evento_id')) !!}
                    <div class="form-group col-lg-12">
                        {!! Form::label('dt_realizacao', 'Data:') !!}
                        <div class='input-group date'>
                            {!! Form::text("dt_realizacao", null, ["class" => "form-control", "id"=>"dt_realizacao_c","data-mask"=>"99.99.9999"]) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i
                                        class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    {{-- Hora Inicio --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_inicio', 'Hora Início:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_inicio", null, array('class' => 'form-control', 'id' => 'hora_inicio_c','data-mask'=>'99:99')) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- Hora Fim --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_fim', 'Hora Fim:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_fim", null, array('class' => 'form-control', 'id' => 'hora_fim_c','data-mask'=>'99:99')) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- --}}
                    <div class="col-lg-12">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select('status', listaItens('STATUS_EVENTO'), null, ['disable'=>'disable','class' => 'form-control','id'=>'status_c']) !!}
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('espaco_id', 'Espaço:') !!}
                            {!! Form::select('espaco_id', $listaSalas, null, array('class' => 'form-control','id'=>'sala_c','disabled'=>'disabled')) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group hide" id="bloco-jus">
                        <div class="col-lg-12">

                            {!! Form::label('justificativa', 'Justificativa:') !!}
                            {!! Form::textarea("justificativa", null, array('style="height:60px;"','class' => 'form-control', 'id' => 'jus_c')) !!}

                        </div>
                    </div>

                </div>
            </div>


            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished" id="btnSalvarFrmPeriodoCreate">
                        <i class="fa fa-floppy-o"></i>
                        Salvar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<script>
    $('#frmCreatePeriodo').submit(function () {
        $("#btnSalvarFrmPeriodoCreate").prop('disabled',true);
        $("#btnSalvarFrmPeriodoCreate").text('Aguarde... Salvando registro !!');
    });
</script>
{{-- modal para editar o periodo --}}