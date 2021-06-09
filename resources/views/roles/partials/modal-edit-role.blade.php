<div class="modal fade bs-example-modal-sm" id="modal-edit-role-{{$p->id}}" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Editar Perfil {{$p->id}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::model('Role', ['route'=> ['atualizaRoleModal', $p->id ],'id'=>'frmEditRole']) !!}
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                        {!! Form::label('name', 'Nome:') !!}
                        {!! Form::text("name", $p->name, array("class" => "form-control")) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('label', 'Descrição:') !!}
                            {!! Form::text("label", $p->label, array("class" => "form-control")) !!}
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