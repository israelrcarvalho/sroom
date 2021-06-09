{{-- modal para editar o periodo --}}
<div class="modal fade bs-example-modal-sm" id="modal-create-recurso-alimentacao" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
                <h4 class="modal-title">Alimentação </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    {!! Form::open(['route' => ["storeModalRecursosAlimentacao"],"id"=>"formalimenta"]) !!}
                    {!! Form::hidden("evento_id", $periodo->evento_id, array("class" => "form-control", "id"=>'evento_id')) !!}
                    <div class="form-group">
                        <div class="col-lg-12">
                            {!! Form::label('periodo_id', 'Data:') !!}
                            {!! Form::select('periodo_id', $calendario, null, array('class' => 'form-control')) !!}
                        </div>
                    </div>
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
                            {!! Form::label('orcamento_id', 'Recurso:') !!}
                            {!! Form::select('orcamento_id', $allRecursosAlimentacao, null, array('class' => 'form-control','id'=>'idAlimentacao','disabled','required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group col-lg-12">
                            {!! Form::label('quantidade', 'Quantidade:') !!}
                            {!! Form::number("quantidade", 1, array("class" => "form-control", "placeholder"=>"Informe a quantidade","max"=>"1","min"=>"1","required","id"=>"quantidade")) !!}
                            {{--<input type="number" name="quantity" min="1" max="5">--}}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group col-lg-12">
                            {!! Form::label('preco', 'Valor:') !!}
                            {!! Form::text("preco", null, array("class" => "form-control text-right", "placeholder"=>"valor","id"=>"preco","required")) !!}

                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="col-lg-12 text-center">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished" id="btnSalvar" disabled>
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

    $('#formalimenta').submit(function () {
        $("#btnSalvar").prop('disabled',true);
        $("#btnSalvar").text('Aguarde... Salvando registro !!');
    });

    // --------
    $('#idUnidade').change(function () {
        var unidadeId = $('#idUnidade').val();
        var options = '<option value="" class="carregando">Carregando recursos disponíveis...</option>';
        $('#idAlimentacao').html(options).show();
        $("#btnSalvar").attr("disabled","disabled");
        $.get('../lista-recursos',  {
            unidade_id: unidadeId
        }, function (recursos) {
            var op = '<option value="">- Selecione -</option>';
            if(recursos.length > 0){
                $.each(recursos, function (key, v) {
                    if(v['disponivel'] > 0){
                        op += '<option value="' + v['orc_id'] + '">' + v['nome'] + ' ( '+v['cr']+ ' )</option>';
                    }
                });

                $('#idAlimentacao').html(op).show();
                $("#idAlimentacao").removeAttr("disabled");
                $("#btnSalvar").removeAttr("disabled");

            } else {
                $("#idAlimentacao").attr("disabled","disabled");
                $("#btnSalvar").attr("disabled","disabled");
                options = '<option value="" class="carregando">Indisponivel...</option>';
                $('#idAlimentacao').html(options).fadein();
            }
        });

    });

    // Atualizar Valor do campo preço
    $('#idAlimentacao').change(function () {
        var orcamentoId = $('#idAlimentacao').val();
        var unidadeId = $('#idUnidade').val();
        $.get('lista-recursos', {
            orcamento_id: orcamentoId,
            unidade_id: unidadeId
        }, function(recurso) {
            $.each(recurso, function (key, v) {
                if(orcamentoId == v['orc_id']){
                    $('#preco').val(v['valor']);
                    $("#quantidade").attr('max',v['disponivel']);
                }
            });

        });
    });


// -------------------------------------------------------------------------------------------------------------------

</script>