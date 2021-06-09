<div class="modal fade bs-example-modal-sm" id="modal-create-orcamento-alimentacao" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Adicionar Perfil </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => ["role.store"]]) !!}
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                        {!! Form::label('name', 'Nome:') !!}
                        {!! Form::text("name", null, array("class" => "form-control")) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('label', 'Descrição:') !!}
                            {!! Form::text("label", null, array("class" => "form-control")) !!}
                        </div>
                    </div>
                    {{-- --}}
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished">
                        <i class="fa fa-floppy-o"></i>
                        Salvar
                    </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>