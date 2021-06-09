{{-- modal para editar o periodo --}}
<div class="modal fade bs-example-modal-sm" id="modal-create-recurso" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Adicionar Recurso no Evento </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => ["storeModal"],'id'=>'frmCreateRecurso']) !!}
                    {!! Form::hidden("evento_id", $p->id, array("class" => "form-control", "id"=>'evento_id')) !!}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('recurso_id', 'Recurso:') !!}
                            {!! Form::select('recurso_id', $listaDeRecursos, null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished"
                            id="btnSalvarFrmRecursos">
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
    $('#frmCreateRecurso').submit(function () {
        $("#btnSalvarFrmRecursos").prop('disabled',true);
        $("#btnSalvarFrmRecursos").text('Aguarde... Salvando registro !!');
    });
</script>