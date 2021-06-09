{{-- modal para editar o periodo --}}
<div class="modal fade bs-example-modal-sm" id="modal-editar-recurso-{{$recurso->id}}" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Editar Recurso do Evento </h4>
            </div>
            <div class="modal-body">
               <div class="row">
                    {!! Form::model('Recurso', ['route'=> ['atualizaRecursosModal', $recurso->id ],'id'=>'frmEditRecurso']) !!}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('recurso_id', 'Recurso:') !!}
                            {!! Form::select('recurso_id', $listaDeRecursos, $recurso->recurso_id, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished" id="btnSalvarFrmRecursosEdit">
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

<script>
    $('#frmEditRecurso').submit(function () {
        $("#btnSalvarFrmRecursosEdit").prop('disabled',true);
        $("#btnSalvarFrmRecursosEdit").text('Aguarde... Salvando registro !!');
    });
</script>