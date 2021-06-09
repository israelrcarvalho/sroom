
<b style='border-bottom:5px solid #008967;width:180px;height:24px;display:inline-block;'></b><br><br>

<h1>Informações do Evento</h1>
<strong style='font-size: 13px;font-family: verdana;'>Tipo / Característica: </strong> {{ iRcGetSysVal_('TIPOLOGIA_EVENTO', $input["tipo_evento"]) }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Evento: </strong> {{ $input["nome"] }} <br /> {!! $input["dataDoEvento"]!!}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Unidade: </strong> {{ $input["unidade"] }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Solicitante: </strong> {{ $input["empresa_solicitante"] }} - {{ implode(",", $input["email_solicitante"]) }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Telefone do Solicitante: </strong> {{ $input["fone_solicitante"] }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Número de Participantes: </strong> {{ $input["num_participantes"] }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Layout do espaço </strong>{{ iRcGetSysVal_('LAYOUT_ESPACO', $input["layout_espaco"]) }}<br/>
<strong style='font-size: 13px;font-family: verdana;'>Local:</strong> {{ $input["nomeDoEspaco"] }} <br />
<strong style='font-size: 13px;font-family: verdana;'>Observação:</strong> {{ $input["observacao"] }} <br />

<strong style='font-size: 13px;font-family: verdana;'>Recursos:</strong>
    @if(count($input["recursos"])>0)
    <ul>
        @foreach($input["recursos"] as $r)
            <li>{{  $r }}</li>
        @endforeach
    </ul>
    @endif
<hr/>
<h1>Mensagem: {{ $input["msg"] }} </h1>
<p>Clique no link abaixo para editar o registro</p>

<h3>{{ $link }} </h3>