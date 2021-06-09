@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos-solicitados') }}">Eventos</a></li>
                <li>Listar</li>
                <li>Detalhes</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <p><b>Id:</b>{{$p->id}} - <b>Titulo:</b><a href="{{ route('eventos.edit',['id'=>$p->id]) }}"> {{$p->nome}}</a></p>
            <p><b>Nome do Solicitante:</b> {!! $p->empresa_solicitante !!}</p>
            <p><b>Unidade Solicitante:</b> {{$nomeEmpresa }} / {{$nomeUnidade}}</p>
            <p><b>Telefone do Solicitante:</b> {!! $p->fone_solicitante !!}</p>
            <p><b>E-mail do Solicitante:</b> {!! $p->email_solicitante !!}</p>
            <p><b>Número de Participantes:</b> {{ $p->num_participantes }}</p>
            <p><b>Layout do espaço:</b> {{ iRcGetSysVal_('LAYOUT_ESPACO',$p->layout_espaco) }}</p>

        </div>
    </div>

    <div class="row">
        <!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Nav tabs -->

            <ul class="nav nav-tabs">
                <li id="periodo" class=""><a href="#tab-periodo" data-toggle="tab">Período / Local</a></li>
                <li id="recurso"><a href="#tab-recursos" data-toggle="tab">Recurso(s)</a></li>
                @if(!Auth::guest() && Auth::user()->grupo == 0)
                <li id="nivel"><a href="#tab-niveis" data-toggle="tab">Time sheet</a></li>
                @endif
                <li id="alimenta"><a href="#tab-alimentacao" data-toggle="tab">Alimentação</a></li>
            </ul>
            <!-- Tab panes -->

            <div class="tab-content">
                <div class="tab-pane fade" id="tab-periodo">
                    @include('eventos.partials.grid-aba-periodo-espaco')
                </div>
                <div class="tab-pane fade" id="tab-recursos">
                    @include('eventos.partials.grid-aba-recursos')
                </div>
                <div class="tab-pane fade" id="tab-niveis">
                    @include('eventos.partials.grid-aba-niveis')
                </div>
                <div class="tab-pane fade" id="tab-alimentacao">
                    @include('eventos.partials.grid-aba-periodo-alimentacao')
                </div>
</div>

</div>
<!-- /.panel-body -->
@include('eventos.partials.modal-create-periodo-espaco')
@include('eventos.partials.modal-create-recurso')
@include('eventos.partials.modal-create-nivel')

</div>
<script>
$( document ).ready(function() {
{!! $active !!}
});

</script>
@stop