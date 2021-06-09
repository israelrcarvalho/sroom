@extends('layout.admin')
@section('conteudo')

<div class="row">
    <div class="col-sm-12">
        <ol class="breadcrumb page-header">
            <li><a href="{{ route('tiposEspaco.index') }}">Unidades</a></li>
            <li>Listar</li>
            <li>Detalhes</li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <p><b>Id:</b> {{$p->id}}</p>
        <p><b>Nome:</b> {!! $p->nome !!}</p>
        <p><b>Sigla:</b> {!! $p->sigla !!}</p>
        <p><b>Razão Social:</b> {!! $p->razao_social !!}</p>
        <p><b>Tipo de Unidade:</b> {{ iRcGetSysVal_('TIPO_UNIDADE',$p->tipo) }}</p>
    </div>
</div>
<div class="row">

    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-orcamento" data-toggle="tab">Orçamento</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab-orcamento">
                <div class="card-box border-top">
                    dfsdfsdfsd
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <button type="button" class="btn btn-primary"
                name="action" value="finished"
                onClick="location.href = '{{ route('unidades.index') }}';">
            <i class="fa fa-backward"></i>
            Voltar à listagem
        </button>
    </div>
</div>
@stop