<!doctype html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{url()}}/front-end/"/>
    <title>Scheduled Room</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{url()}}/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url()}}/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link href="{{ url()}}/assets/selectize/css/selectize.css" rel="stylesheet">
    <link href="{{ url()}}/assets/selectize/css/selectize.bootstrap3.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet" type="text/css"/>


    <script src="{{ url()}}/admin/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{url()}}/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="{{url()}}/js/bootstrap-inputmask.min.js" type="text/javascript"></script>
    <script src="{{url()}}/js/moment-with-locales.js"></script>
    <script type="text/javascript"
            src="{{url()}}/assets/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"></script>


    {{--<script src="js/jquery.min.js" type="text/javascript"></script>--}}
    <script src="js/jquery.validate.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <!-- DataTables JavaScript -->
    <script src="{{ url()}}/assets/selectize/selectize.min.js"></script>

    <link rel="stylesheet"
          href="{{url()}}/assets/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css">

    <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
          rel="stylesheet"/>

</head>

<body>
<!-- Cabeçalho -->
<div class="col-lg-12 blue-dark pad-0-6 navbar-fixed-top">
    <div class="container">
        <div class="col-lg-offset-4 col-lg-4 img-responsive">
            <div class="container-fluid" id="logotipo">
                <img src="images/Logo.png" alt="" class="img-responsive"/>
            </div>
        </div>
    </div>
</div>

<!-- Formulários -->
<div class="container validate bloco">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

            <ul class="alert">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @include('eventos.partials.success')
                <!-- form aqui -->
        {!! Form::open(['route' => ["frontendbbb"], 'enctype'=> "multipart/form-data"]) !!}
                <!-- Descrição do Evento -->
        <div class="row">
            <h3 class="text-center"><b class="glyphicon glyphicon-paperclip" aria-hidden="true"></b> Solicitação de
                Reserva </h3>
            <hr>

            <!-- Primeira coluna -->
            <div class="col-sm-6">
                <label class="control-label" for="tipo_evento">Caracteristica do evento </label>
                {!! Form::select('tipo_evento', listaItens('TIPOLOGIA_EVENTO','- Selecione -'), null, array('required','class' => 'form-control')) !!}
                <label class="control-label" for="evento">Nome do Evento </label>
                <input type="text"
                       class="form-control"
                       id="evento"
                       name="nome"
                       required
                       placeholder="Digite o nome do evento"/>

                <label class="control-label" for="solicitante">Nome do Solicitante</label>
                <input type="text" class="form-control" id="solicitante" name="empresa_solicitante" required
                       placeholder="Digite o nome do solicitante"/>

                <label class="control-label" for="descricao">Descrição do Evento</label>
                    <textarea class="form-control text-desc-evento" id="ccomment" name="descricao" required
                              placeholder="Escreva uma descri&ccedil;&atilde;o para o evento" name="descricao" cols="50"
                              rows="4" id="descricao"></textarea>


            </div>

            <!-- Segunda coluna -->
            <div class="col-sm-6">

                <label class="control-label" for="num_participantes">N&uacute;mero de Participantes:</label>
                <input class="form-control required numeric" id="h_fim" name="num_participantes" type="number" required>
                {{-- Instituição
                {!! Form::label('unidade_id', 'Entidade / Sindicato / Gerência Solicitante:') !!}
                {!! Form::select('unidade_id', $listaDeUnidade, null, array('required'=>'required','class' => 'form-control','id'=>'unidade_id')) !!}

                  Formato --}}
                {!! Form::label('layout_espaco', 'Layout do espaço:') !!}
                {!! Form::select('layout_espaco', listaItens('LAYOUT_ESPACO'), null, array('class' => 'form-control')) !!}


                <label class="control-label" for="telefone">Telefone</label>

                <div class="input-group">
                    <input type="text"
                           class="form-control fone"
                           id="telefone"
                           name="fone_solicitante"
                           required
                           placeholder="Digite seu telefone"
                           data-mask="(99) 99999-999?9"/>
                    <b class="input-group-addon bg-custom b-0 text-white"><i
                                class="glyphicon glyphicon-phone-alt"></i></b>
                </div>
                <label class="control-label" for="email">Email</label>

                <div class="input-group">
                    <input type="email"
                           class="form-control"
                           id="email"
                           name="email_solicitante"
                           required
                           placeholder="Digite seu email"/>
                        <span class="input-group-addon bg-custom b-0 text-white"><i
                                    class="glyphicon glyphicon-envelope"></i></span>
                </div>

            </div>
        </div>
        <div class="row">
            <label class="control-label" for="obs">Observações:</label>
                <textarea class="form-control text-desc-evento" id="obs" name="obs" required
                          placeholder="Escreva observações para o evento" cols="50"
                          rows="3" id="obs"></textarea>
        </div>
        <div class="row">
            {{-- Recursos --}}
            <label class="control-label" for="recursos">Recursos</label>
            {!! Form::select('recursos[]', $allRecursos_, null, array('required','class' => 'form-control selectpicker','multiple','title'=>'Selecione um ou mais recursos')) !!}
            <input class="form-control" name="cadastrado_por" type="hidden" value="24">
            <input class="form-control" name="tipo_pb" type="hidden" value="1">
        </div>
        <!-- Período  -->

        <div class="row" style="margin-top: 3%">
            <h3 class="text-center"><b class="glyphicon glyphicon-calendar" aria-hidden="true"></b> Período</h3>
            <hr>
            <div class="col-sm-1"></div>
            <div class="form-group col-sm-2">
                <label for="dt_realizar_inicio">Data Início:</label>

                <div class="input-group date">
                    <input class="form-control"
                           id="dt_realizar_inicio"
                           data-mask="99.99.9999"
                           name="dt_realizar_inicio" required
                           value="{{$dt_realizar_inicio}}"
                           type="text">
                    <b class="input-group-addon bg-custom b-0 text-white date_c"><i class="fa fa-calendar"></i></b>
                </div>
            </div>
            <div class="col-sm-1"></div>
            <div class="form-group col-sm-2">
                <label for="dt_realizar_inicio">Data Fim:</label>

                <div class="input-group date">
                    <input class="form-control" id="dt_realizar_fim" data-mask="99.99.9999" name="dt_realizar_fim"
                           required
                           type="text" value="{{$dt_realizar_fim}}">
                    <b class="input-group-addon bg-custom b-0 text-white date_c"><i class="fa fa-calendar"></i></b>
                </div>
            </div>

            <div class="col-sm-1"></div>

            <div class="form-group col-sm-2">
                <label for="h_inicio">Hora Início:</label>

                <div class="input-group time cursorHand">
                    <input class="form-control" id="h_inicio" data-mask="99:99" name="h_inicio" type="text" required
                           value="{{$h_inicio}}">
                    <b class="input-group-addon bg-custom b-0 text-white"><i
                                class="glyphicon glyphicon-time"></i></b>
                </div>
            </div>
            <div class="col-sm-1"></div>

            <input name="dt_solicitacao" type="hidden">


            <div class="form-group col-sm-2">
                <label for="h_fim">Hora Fim:</label>

                <div class="input-group time cursorHand">
                    <input class="form-control" id="h_fim" data-mask="99:99" name="h_fim" type="text"
                           value="{{$h_fim}}">
                    <b class="input-group-addon bg-custom b-0 text-white"><i
                                class="glyphicon glyphicon-time"></i></b>
                </div>
            </div>
            <span style="margin: 35px;"></span>
            <!-- Solicitações de alimentos ////////////////-->
            <h3 class="text-center"><b class="glyphicon glyphicon-calendar" aria-hidden="true"></b> Alimentação</h3>
            <hr>

            <div id="form">
                {{-- Instituição --}}
                {!! Form::label('unidade_id', 'Entidade / Sindicato / Gerência Solicitante:') !!}
                {!! Form::select('unidade_id', $listaDeUnidade, null, array('required'=>'required','class' => 'form-control','id'=>'unidade_id')) !!}

                <div class="col-sm-12">
                    <div class="quantidade"><b>Total de Dias : </b><span id="dias" class="badge badge-danger"></span>
                    </div>
                    <br>
                </div>

                <div class="form-group col-sm-2">
                    <label for="dt_realizar_inicio">Data Inicial:</label>

                    <div class="input-group date">
                        <input class="form-control"
                               id="datainicial"
                               data-mask="99.99.9999"
                               name="dt_realizar_inicio" required
                               value="{{$dt_realizar_inicio}}"
                               type="text">
                        <b class="input-group-addon bg-custom b-0 text-white date_c"><i class="fa fa-calendar"></i></b>
                    </div>
                </div>
                <div class="form-group col-sm-4">
                    <label>Recursos de Alimentação:</label>
                    {!! Form::select('checkListItem', $allRecursosAlimentacao, null, array('required','id'=>'sala','class' => 'form-control','title'=>'Selecione um ou mais recursos')) !!}
                </div>
                <div class="form-group col-sm-1">
                    <label>Qtde:</label>
                    <input type="text" name="quantidade" size="5" class="form-control">
                </div>
                <div class="form-group col-sm-3"><br>
                    <button id="button" class="btn btn-default" style="margin-top: 6px;"><i
                                class="glyphicon glyphicon-plus" style="color:#949494"></i> Adicionar
                    </button>
                    <button id="limpar" class="btn btn-default" style="margin-top: 6px;"><i
                                class="glyphicon glyphicon-remove" style="color:#949494"></i> Limpar
                    </button>
                </div>
                <div class="col-sm-12">
                    <div class="lista"></div>
                </div>
            </div>


            <!-- Fim Solicitações de alimentos -->

            <div class="form-group col-sm-12" style="padding: 10px;">
                <fieldset>
                    <legend><span style="font-size:15px;">Selecione os dias que o evento se repetirá :</span></legend>
                    <input type="checkbox" name="diasSelecionados[]" value="0"> Domingo
                    <input type="checkbox" name="diasSelecionados[]" value="1"> Segunda
                    <input type="checkbox" name="diasSelecionados[]" value="2"> Terça
                    <input type="checkbox" name="diasSelecionados[]" value="3"> Quarta
                    <input type="checkbox" name="diasSelecionados[]" value="4"> Quinta
                    <input type="checkbox" name="diasSelecionados[]" value="5"> Sexta
                    <input type="checkbox" name="diasSelecionados[]" value="6"> Sábado
                </fieldset>

            </div>

            <div class="form-group col-sm-12">
                <a class='btn btn-primary' href='javascript:;' style="margin-left: 10px;">
                    Anexar arquivo ...
                    <input type="file"
                           style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'
                           name="imagem" size="40" onchange='$("#upload-file-info").html($(this).val());'>
                </a>
                <span class='label label-info' id="upload-file-info" style="font-size: 14px;"></span>
            </div>

        </div>
        <hr>
        <!-- buttons -->
        <div class="col-md-12 proximo3">
            <button class="submit btn btn-primary pull-right">Concluir <b
                        class="glyphicon glyphicon glyphicon-check"></b></button>
        </div>

        <!-- buttons -->


        <script>

//---
/* Formulário Alimentação */
$(document).ready(function ()
{
    var dias = 0; $('#dias').html(dias);

    //Verificação de data
    function verificaData()
    {
        if (start < end)
        {
        } else {
            $('#erro').html("Data final menor do que a inicial!");
            $('#datainicial').val("");
            $('#datafinal').val("");
            $('#dias').val("");
        }
    }

    //Criar o elemento
    function addElement(){
        datainicial = $('#datainicial').val();
        dias++;
        $('#dias').each(function(){
            $('#dias').html(dias);
        });
        var recurso = $('select[name=checkListItem]').val();
        var quanto = $('input[name=quantidade]').val();
        $('.lista').append('<div class="well">Alimentação: ' + recurso + '<div class="quanto">Quantidade: <input type="text" value=" ' + quanto+'" class="edit form-control" size="2"/></div><div class="quanto"> Data: <input type="text" value=" '+ datainicial+ '" class="edit form-control" size="9"/></div></div>');
        $('#form').children().val(" ");
    }

    //Remove elementos
    function removeElement(){
    }
    //Eventos
    $('#button').click(function (e) {
        e.preventDefault();
        addElement();
    });
    $('#datafinal').change(function () {
        verificaData();
    });
    $('#limpar').on('click',function(e){
        e.preventDefault();
        $('.lista').empty();
        dias = 0;
        $('#dias').html(dias);
    });

}); //Fim do carregamento
//-------------Alimentação fim

//---

            //-----
            $('#unidade_id').change(function () {

                var unidadeId = $('#unidade_id').val();
                $.get('../lista-recursos',  {
                    unidade_id: unidadeId
                }, function (espacos) {
                    var op = '';
                    //alert(espacos);
                    $.each(espacos, function (key, v) {
                        console.log(v['valor']);
                       // $.each(value, function (k, v) {
                            op += '<option value="' + v['recurso_id'] + '">' + v['nome'] + v['valor'] + '</option>';
                       // });
                    });

                    $('#sala').html(op).show();
                });

            });

               /* Chamada para o calendário */
            $(function () {
                $('.date').datetimepicker({
                    format: "L",
                    locale: 'pt-br'
                });
            });
            ///
            $(function () {
                var dataAtual = new Date();
                $('.time').datetimepicker({
                    format: "LT",
                    locale: 'pt-br'
                    , defaultDate: dataAtual
                });
            });


            // $('.selectpicker').selectpicker();

        </script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
</body>

</html>
