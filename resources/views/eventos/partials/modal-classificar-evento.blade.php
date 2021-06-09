<div class="modal fade bs-example-modal-sm" id="modal-classificar-evento-{{$periodo->id}}" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Classificar evento</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::model('Periodo', ['id'=>'form_'.$periodo->id,'route'=> ['atualizaNivelModal', $periodo->id ],'id'=>'frmEditNivel']) !!}
                    <div class="form-group col-lg-12">
                        {!! Form::label('dt_realizacao', 'Data:') !!}
                        <div class='input-group date'>
                            {!! Form::text("dt_realizacao", $periodo->dt_realizacao, ["disabled"=>"disabled","class" => "form-control", "id"=>"dt_realizacao_".$periodo->id,"data-mask"=>"99.99.9999"]) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    {{-- Hora Inicio --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_inicio', 'Hora Início:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_inicio", $periodo->hora_inicio, array("disabled"=>"disabled","class" => "form-control", "id" =>"hora_inicio_".$periodo->id,"data-mask"=>"99:99")) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- Hora Fim --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_fim', 'Hora Fim:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_fim", $periodo->hora_fim, array("disabled"=>"disabled","class" => "form-control", "id" => "hora_fim_".$periodo->id,"data-mask"=>"99:99")) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- --}}
                    <div class="col-lg-12">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select('status', listaItens('STATUS_EVENTO'), $periodo->status, array("disabled"=>"disabled",'class' => 'form-control',"id"=>"status_".$periodo->id)) !!}
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('espaco_id', 'Espaço:') !!}
                            {!! Form::select("espaco_id", $listaSalas, $periodo->espaco_id, array("disabled"=>"disabled","class" => "form-control","id"=>"sala_".$periodo->id)) !!}
                            <input type="hidden" id="idEspacoAtual_{{$periodo->id}}" value="{{$periodo->espaco_id}}">
                        </div>
                    </div>

                    {{--<div class="form-group" id="bloco-jus_{{$periodo->id}}">--}}
                        {{--<div class="col-lg-12">--}}
                            {{--{!! Form::label('justificativa', 'Justificativa:') !!}--}}
                            {{--{!! Form::textarea("justificativa", $periodo->justificativa, array('style="height:60px;"','class' => 'form-control', 'id' => 'jus_'.$periodo->id)) !!}--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{-- combo niveis --}}

                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('nivel_id', 'Nível / Esforço:') !!}
                            {!! Form::select('nivel_id', $listaDeNiveis, $periodo->nivel_id, array('class' => 'form-control')) !!}
                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action"
                            value="finished"
                            id="btnSalvarFrmRecursosCreate">
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
    $('#frmEditNivel').submit(function () {
        $("#btnSalvarFrmRecursosCreate").prop('disabled',true);
        $("#btnSalvarFrmRecursosCreate").text('Aguarde... Salvando registro !!');
    });
</script>