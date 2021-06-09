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
                    {{-- Instituição --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('tipo_evento', '* Tipologia:') !!}
                        {!! Form::select('tipo_evento', listaItens('TIPOLOGIA_EVENTO','- Selecione -'), null, array("required",'class' => 'form-control')) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('magnitude', 'Magnitude:') !!}
                        {!! Form::select('magnitude', array_merge(array('' => '- Selecione -'), listaItens('MAGNITUDE_EVENTO')), null, array('required','class' => 'form-control')) !!}
                    </div>

                    {{-- Nome do Evento --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('nome', 'Nome do Evento:') !!}
                        <div class="input-group m-b-15">
                            {!! Form::text("nome", null, array("required","class" => "form-control", "placeholder"=>"Preencha um nome para o evento")) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i
                                        class="glyphicon  glyphicon-asterisk"></i></span>
                        </div>
                    </div>

                    {{-- Descrição do Evento --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('descricao', 'Descrição:') !!}
                        {!! Form::textarea("descricao", null, array("required","class" => "form-control text-desc-evento", "placeholder"=>"Escreva uma descrição para o evento")) !!}
                    </div>
                    {{-- --}}
                    <div class="form-group col-sm-6">
                        {{-- Data Início --}}
                        {!! Form::label('dt_realizar_inicio', 'Data Início:') !!}
                        <div class='input-group date'>
                            <input class="form-control"
                                   id="dt_realizar_inicio"
                                   data-mask="99.99.9999"
                                   name="dt_realizar_inicio"
                                   type="text"
                                   @if($id) disabled="disabled" @endif
                                   value="{{$dt_realizar_inicio}}">

                            <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    {{-- Hora Início --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('h_inicio', 'Hora Início:') !!}
                        <div class="input-group time cursorHand">
                            <input
                                    class="form-control"
                                    id="h_inicio"
                                    data-mask="99:99"
                                    name="h_inicio"
                                    type="text"
                                    @if($id) disabled="disabled" @endif
                                    value="{{$h_inicio}}">

                            <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
                        </div>
                    </div>

                    {{-- Data da solicitação - campo escondido --}}
                    {!! Form::hidden("dt_solicitacao") !!}

                    {{-- Data Fim --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('dt_realizar_fim', 'Data Fim:') !!}
                        <div class="input-group date">
                            <input class="form-control"
                                   id="dt_realizar_fim"
                                   data-mask="99.99.9999"
                                   name="dt_realizar_fim"
                                   type="text"
                                   @if($id) disabled="disabled" @endif
                                   value="{{$dt_realizar_fim}}">
                            <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    {{-- Hora Fim --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('h_fim', 'Hora Fim:') !!}
                        <div class="input-group time cursorHand" >
                            <input
                                    class="form-control"
                                    id="h_fim"
                                    data-mask="99:99"
                                    name="h_fim"
                                    type="text"
                                    @if($id) disabled="disabled" @endif
                                    value="{{$h_fim}}">

                            <span class="input-group-addon bg-custom b-0 text-white"><i
                                        class="glyphicon glyphicon-time"></i></span>
                        </div>
                    </div>
                    {{-- --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-12">
                                {!! Form::label('diasSelecionados', 'Selecione os dias da semana que o evento se repetirá:') !!}
                                <select @if($id) disabled="disabled" @endif  name="diasSelecionados[]" id="diasSelecionados" class="form-control" multiple>
                                        @foreach ($allDays as $d=>$k)
                                            <option @if (in_array($k, $diasSelecionados)) selected @endif value="{{ $d }}">
                                                {{ $k }}
                                            </option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- evento pago ou com onus --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('vlr_onus', 'Valor do ônus:') !!}
                        <div class="input-group">
                            <span class="input-group-addon bg-custom b-0 text-white"><i>R$</i></span>
                            {!! Form::text("vlr_onus", null, ['class' => 'real text-right form-control', 'id'=>'vlr_onus',"placeholder"=>"Custo do evento"]) !!}
                        </div>
                    </div>

                    {{-- num_participantes --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('num_participantes', 'Nº Participantes:') !!}
                        {!! Form::text("num_participantes", null, array("class" => "form-control", "placeholder"=>"Qtd de participantes")) !!}
                    </div>

                </div>

                {!! Form::hidden("cadastrado_por", Auth::user()->id , array("class" => "form-control", "placeholder"=>"id do user")) !!}

                <div class="col-sm-6">
                    {{-- Prioridade --}}
                    <div class="form-group col-sm-3">
                        {!! Form::label('prioridade', 'Prioridade:') !!}
                        {!! Form::select('prioridade', listaItens('PRIORIDADE',''), null, array('class' => 'form-control')) !!}
                    </div>
                    {{-- Formato --}}

                    <div class="form-group col-sm-3">
                        {!! Form::label('layout_espaco', 'Formato:') !!}
                        {!! Form::select('layout_espaco', listaItens('LAYOUT_ESPACO','- Layout-'), null, array('required','class' => 'form-control')) !!}
                    </div>
                    {{-- Tipo de publicação --}}
                    <div class="form-group col-sm-6">
                        {!! Form::label('tipo_pb', 'Tipo de Publicação:') !!}
                        {!! Form::select('tipo_pb', listaItens('TIPO_PUBLICACAO','- Publicação -'), null, array('required','class' => 'form-control')) !!}
                    </div>

                    {{-- Instituição --}}
                    <div class="form-group col-lg-12">
                        {!! Form::label('unidade_id', 'Entidade Solicitante:') !!}
                        {!! Form::select('unidade_id', array_merge([''=>'- Selecione uma Unidade -'],$listaDeUnidade), null, array('required','class' => 'form-control')) !!}
                    </div>

                    {{-- Nome do Solicitante --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('empresa_solicitante', 'Nome do Solicitante:') !!}
                        {!! Form::text("empresa_solicitante", null, array("class" => "form-control", "placeholder"=>"Quem está solicitando o evento")) !!}
                    </div>

                    {{-- Telefone do Solicitante --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('fone_solicitante', 'Telefone do Solicitante:') !!}
                        <div class="input-group">
                            {!! Form::text("fone_solicitante", null, ["class" => "form-control","placeholder"=>"Telefone de contato do solicitante","data-mask"=>"(99) 99999-999?9"]) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-phone-alt"></i></span>
                        </div>
                    </div>

                    {{-- E-mail do Solicitante --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('email_solicitante', 'E-mail do Solicitante:') !!}
                        <div class="input-group">
                            {!! Form::text("email_solicitante", null, array("class" => "form-control", "placeholder"=>"E-mail de contato do solicitante")) !!}
                            <span class="input-group-addon bg-custom b-0 text-white"><i
                                        class="glyphicon glyphicon-envelope"></i></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- Recursos --}}
                            <div class="form-group col-sm-12">
                                {!! Form::label('recursos', 'Recursos:') !!}
                                <select name="recursos[]" id="recursos" class="form-control" multiple>
                                    @foreach ($allRecursos as $rec)
                                        <option @if (in_array($rec, $recursos)) selected @endif value="{{ $rec }}">
                                            {{ $rec }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Observação --}}
                    <div class="form-group col-sm-12">
                        {!! Form::label('obs', 'Observação:') !!}
                        {!! Form::textarea("obs", null, array("class" => "form-control text-obs-evento", "placeholder"=>"Caso exista alguma observação, escreva aqui.")) !!}
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
                name="action" value="finished"
                id="btnSalvar">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>
</div>