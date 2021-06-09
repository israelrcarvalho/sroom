<div class="modal fade bs-example-modal-sm" id="modal-create-nivel" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Classificar Eventozxx </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => ["storeModalNivel"],'id'=>'frmEditNivel']) !!}
                    {!! Form::hidden("evento_id", $p->id, array("class" => "form-control", "id"=>'evento_id')) !!}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('nivel_id', 'Nível:') !!}
                            {!! Form::select('nivel_id', $listaDeNiveis, null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished"
                            id="btnSalvarFrmRecursosCreate">
                        <i class="fa fa-floppy-o"></i>
                        Salvar
                    </button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
    $('#frmEditNivel').submit(function () {
        $("#btnSalvarFrmRecursosCreate").prop('disabled',true);
        $("#btnSalvarFrmRecursosCreate").text('Aguarde... Salvando registro !!');
    });
</script>