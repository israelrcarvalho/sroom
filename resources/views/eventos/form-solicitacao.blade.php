<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ url() }}/"/>

    <title>Schedule Room</title>

    <!-- Bootstrap Core CSS -->
    <link href="public/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
SOLICITAÇÃO DE EVENTOS
    <!-- form aqui -->
    {!! Form::open(['route' => ["eventos.store"]]) !!}

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

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-sm-6">
                        {{-- Nome do Evento --}}
                        <div class="form-group col-sm-12">
                            {!! Form::label('nome', 'Nome do Evento:') !!}
                            {!! Form::text("nome", null, array("class" => "form-control", "placeholder"=>"Preencha um nome para o evento")) !!}
                        </div>

                        {{-- Descrição do Evento --}}
                        <div class="form-group col-sm-12">
                            {!! Form::label('descricao', 'Descrição:') !!}
                            {!! Form::textarea("descricao", null, array("class" => "form-control text-desc-evento", "placeholder"=>"Escreva uma descrição para o evento")) !!}
                        </div>

                        {{-- Nome do Solicitante --}}
                        <div class="form-group col-sm-12">
                            {!! Form::label('empresa_solicitante', 'Nome do Solicitante:') !!}
                            {!! Form::text("empresa_solicitante", null, array("class" => "form-control", "placeholder"=>"Quem está solicitando o evento")) !!}
                        </div>

                        {{-- Telefone do Solicitante --}}
                        <div class="form-group col-sm-12">
                            {!! Form::label('fone_solicitante', 'Telefone do Solicitante:') !!}
                            {!! Form::text("fone_solicitante", null, array("class" => "form-control", "placeholder"=>"Telefone de contato do solicitante")) !!}
                        </div>

                        {{-- E-mail do Solicitante --}}
                        <div class="form-group col-sm-12">
                            {!! Form::label('email_solicitante', 'E-mail do Solicitante:') !!}
                            {!! Form::text("email_solicitante", null, array("class" => "form-control", "placeholder"=>"E-mail de contato do solicitante")) !!}
                        </div>
                    </div>

                    {!! Form::hidden("cadastrado_por", Auth::user()->id , array("class" => "form-control", "placeholder"=>"id do user")) !!}

                    <div class="col-sm-6">
                        <div class="form-group col-sm-6">
                            {{-- Data Início --}}
                            {!! Form::label('dt_realizar_inicio', 'Data Início:') !!}
                            {!! Form::text("dt_realizar_inicio", null, array("class" => "form-control", "id"=>"dt_realizar_inicio")) !!}
                        </div>

                        {{-- Hora Início --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('h_inicio', 'Hora Início:') !!}
                            {!! Form::text("h_inicio", null, array('class' => 'form-control', 'id' => 'h_inicio')) !!}
                        </div>

                        {{-- Data da solicitação - campo escondido --}}
                        {!! Form::hidden("dt_solicitacao") !!}

                        {{-- Data Fim --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('dt_realizar_fim', 'Data Fim:') !!}
                            {!! Form::text("dt_realizar_fim", null, array('class' => 'form-control', 'id'=>'dt_realizar_fim')) !!}
                        </div>

                        {{-- Hora Fim --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('h_fim', 'Hora Fim:') !!}
                            {!! Form::text("h_fim", null, array('class' => 'form-control', 'id' => 'h_fim')) !!}
                        </div>




                        {{-- Formato --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('layout_espaco', 'Formato:') !!}
                            {!! Form::select('layout_espaco', listaItens('LAYOUT_ESPACO'), null, array('class' => 'form-control')) !!}
                        </div>

                        {{-- Recursos --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('recursos', 'Recursos:') !!}
                            <select name="recursos[]" id="recursos" class="form-control" multiple>
                                @foreach ($allRecursos as $rec)
                                    <option @if (in_array($rec, $recursos)) selected @endif value="{{ $rec }}">
                                        {{ $rec }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Hora Fim --}}
                        <div class="form-group col-sm-6">
                            {!! Form::label('num_participantes', 'Número de Participantes:') !!}
                            {!! Form::text("num_participantes", null, array('class' => 'form-control', 'id' => 'h_fim')) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="layout_espaco">Instituicao:</label>
                            <select class="form-control" id="instituicao" name="instituicao">
                                <option value="">- Selecione -</option>
                                <option value="1">FIEC</option>
                                <option value="2">SESI</option>
                                <option value="3">SENAI</option>
                                <option value="4">IEL</option>
                                <option value="5">SINDICATO</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="layout_espaco">Unidade / Sindicato:</label>
                            <select class="form-control" id="instituicao" name="instituicao">
                                <option value="">- Selecione -</option>
                                <option value="1">GETIC</option>
                                <option value="2">GERHU</option>
                            </select>
                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-success"
                    name="action" value="finished">
                <i class="fa fa-floppy-o"></i>
                Salvar
            </button>
        </div>
    </div>

    {!! Form::close() !!}
            <!-- Fim -->

</body>

</html>
