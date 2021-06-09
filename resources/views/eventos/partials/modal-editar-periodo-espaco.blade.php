{{-- modal para editar o periodo --}}
<div class="modal fade bs-example-modal-sm" id="modal-nova-data-{{$periodo->id}}" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Editar data</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::model('Periodo', ['id'=>'form_'.$periodo->id,'route'=> ['atualizaPeriodosModal', $periodo->id ],'id'=>'frmEditPeriodo']) !!}
                    <div class="form-group col-lg-12">
                        {!! Form::label('dt_realizacao', 'Data:') !!}
                        <div class='input-group date'>
                            {!! Form::text("dt_realizacao", $periodo->dt_realizacao, ["class" => "form-control", "id"=>"dt_realizacao_".$periodo->id,"data-mask"=>"99.99.9999"]) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    {{-- Hora Inicio --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_inicio', 'Hora Início:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_inicio", $periodo->hora_inicio, array("class" => "form-control", "id" =>"hora_inicio_".$periodo->id,"data-mask"=>"99:99")) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- Hora Fim --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                            {!! Form::label('hora_fim', 'Hora Fim:') !!}
                            <div class="input-group time cursorHand">
                                {!! Form::text("hora_fim", $periodo->hora_fim, array("class" => "form-control", "id" => "hora_fim_".$periodo->id,"data-mask"=>"99:99")) !!}
                                <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                    </div>
                    {{-- --}}
                    <div class="col-lg-12">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select('status', listaItens('STATUS_EVENTO'), $periodo->status, array('class' => 'form-control',"id"=>"status_".$periodo->id)) !!}
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('espaco_id', 'Espaço:') !!}
                            {!! Form::select("espaco_id", $listaSalas, $periodo->espaco_id, array("class" => "form-control","id"=>"sala_".$periodo->id)) !!}
                            <input type="hidden" name="idEspacoAtual_" id="idEspacoAtual_{{$periodo->id}}" value="{{$periodo->espaco_id}}">
                        </div>
                    </div>

                    <div class="form-group" id="bloco-jus_{{$periodo->id}}">
                        <div class="col-lg-12">
                            {!! Form::label('justificativa', 'Justificativa:') !!}
                            {!! Form::textarea("justificativa", $periodo->justificativa, array('style="height:60px;"','class' => 'form-control', 'id' => 'jus_'.$periodo->id)) !!}

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished" id="save">
                        <i class="fa fa-floppy-o"></i>
                        Salvar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{{-- modal para editar o periodo --}}
<script type="text/javascript">

    $(function () {

        var t = "{{$periodo->id}}" ;

      //  $("#sala_"+t).prop('disabled', 'disabled');

        $('#status_'+t).change(function () {

            var hora_i = $('#hora_inicio_'+t).val();
            var hora_f = $('#hora_fim_'+t).val();
            var data_inicio = $('#dt_realizacao_'+t).val();
            var idEspacoAtual = $('#idEspacoAtual_'+t).val();
            var valorStatus = $( "#status_"+t ).val();

            var recarrega =['1','2','6','5'];

            if(jQuery.inArray(valorStatus, recarrega )!=-1){
                var options = '<option value="" class="carregando">Carregando salas disponíveis...</option>';
            }

        // --------------------
            if(valorStatus=='1' ||valorStatus=='2' ||valorStatus=='3' ||valorStatus=='6'){
                $("#bloco-jus_"+t).removeClass('hide');
                $("#bloco-jus_"+t).fadeIn();

            } else {
                $("#bloco-jus_"+t).fadeOut();
            }

            $('#sala_'+t).html(options).show();

            if(jQuery.inArray(valorStatus, recarrega )!=-1){

                $.get('espacos/lista-espacos', {
                    hora_i: hora_i,
                    hora_f: hora_f,
                    data_inicio: data_inicio,
                    espacoAtual:idEspacoAtual
                }, function (espacos) {
                    var op = '';
                    $.each(espacos, function (key, value) {

                        op += '<optgroup label="' + key + '">';
                        $.each(value, function (k, v) {
                            op += '<option value="' + v['id'] + '">' + v['nome'] + '</option>';
                        });
                        op += '</optgroup>';
                    });

                    $('#sala_'+t).html(op).show();
                    $("#sala_"+t).removeAttr("disabled");
                    $("#hora_inicio_"+t).removeAttr("disabled");
                    $("#hora_fim_"+t).removeAttr("disabled");
                    $("#dt_realizacao_"+t).removeAttr("disabled");
                });
                // ---------------------------------------------
            }
        });
    });

//----
    $('#frmEditPeriodo').submit(function () {
        $("#save").prop('disabled',true);
        $("#save").text('Aguarde... Salvando registro !!');
    });
</script>
