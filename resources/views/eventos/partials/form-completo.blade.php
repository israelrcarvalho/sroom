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
                    {{-- Prioridade --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('prioridade', 'Prioridade:') !!}
                        {!! Form::select('prioridade', listaItens('PRIORIDADE'), null, array('class' => 'form-control')) !!}
                    </div>

                    {{-- Status --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select('status', listaItens('STATUS_EVENTO'), null, array('class' => 'form-control')) !!}
                    </div>

                    {{-- Tipo de publicação --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('tipo_pb', 'Tipo de Publicação:') !!}
                        {!! Form::select('tipo_pb', listaItens('TIPO_PUBLICACAO'), null, array('class' => 'form-control')) !!}
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

                    {{-- Espaço --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('espacos', 'Espaços:') !!}
                        <select name="espacos[]" id="espacos" class="form-control" multiple>
                            @foreach ($allEspacos as $espaco)
                                <option @if (in_array($espaco, $espacos)) selected @endif value="{{ $espaco }}">
                                    {{ $espaco }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Observação --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('obs', 'Observação:') !!}
                        {!! Form::textarea("obs", null, array("class" => "form-control text-obs-evento", "placeholder"=>"Caso exista alguma observação, escreva aqui.")) !!}
                    </div>

                    {{-- Pago --}}
                    <div class="form-group col-sm-4 ajuste-check">
                        <label>
                            <input {{ checked($pago) }} type="checkbox" name="pago">
                            Pago?
                        </label>
                    </div>

                    {{-- Público --}}
                    <div class="form-group col-sm-4 ajuste-check">
                        <label>
                            <input {{ checked($publicado) }} type="checkbox" name="publicado">
                            Público?
                        </label>
                    </div>

                    {{-- Externo --}}
                    <div class="form-group col-sm-4 ajuste-check">
                        <label>
                            <input {{ checked($externo) }} type="checkbox" name="externo">
                            Externo?
                        </label>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('eventos.index') }}';}">
            Cancelar
        </button>
    </div>
    <div class="col-sm-6 text-right">
        <button type="submit" class="btn btn-success"
                name="action" value="finished">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>
</div>