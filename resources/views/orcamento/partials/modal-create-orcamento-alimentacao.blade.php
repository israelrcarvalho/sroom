<div class="modal fade bs-example-modal-sm" id="modal-create-orcamento-alimentacao" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Adicionar Orçamento </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => ["store"]]) !!}
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('unidade_id', 'Unidade:') !!}
                            {!! Form::select('unidade_id', array_merge([''=>'- Selecione uma Unidade -'],$listaDeUnidade),null, array('required','class' => 'form-control','id'=>'idUnidade')) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                        {!! Form::label('centro_id', 'Centro de Responsabilidade:') !!}
                        {!! Form::select('centro_id', $listaCentros, null, array('required','class' => 'form-control')) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-12">
                        {!! Form::label('recurso_id', 'Recurso:') !!}
                        {!! Form::select('recurso_id', $listaRecursos, null, array('required','class' => 'form-control')) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                        {!! Form::label('ano', 'Ano:') !!}
                        {!! Form::select('ano', $listaAno, null, array('required','class' => 'form-control')) !!}
                        </div>
                    </div>
                    {{-- --}}
                    <div class="form-group">
                        <div class="col-lg-6">
                        {!! Form::label('quantidade', 'Quantidade:') !!}
                        {!! Form::text("quantidade", null, array("class" => "form-control text-right", "placeholder"=>"Informe a quantidade")) !!}
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