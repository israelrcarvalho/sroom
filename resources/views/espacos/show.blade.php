@extends('layout.admin')
@section('conteudo')


    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('espacos.index') }}">Espaços</a></li>
                <li>Listar</li>
                <li>Detalhes</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <p><b>Nome do Espaço: </b>{!! $p->nome !!}</p>
            <p><b>Local: </b>{!! $p->local !!}</p>
            <p><b>Tipo de Espaço: </b>{!! $p->tipo->nome !!}</p>
            <p><b>Código: </b>{!! $p->cod !!}</p>
            <p><b>Capacidade: </b>{!! $p->capacidade !!}</p>
            <p><b>Ativo: </b> @if($p->ativa == 1) Sim @else Não @endif </p>
            <b>Cor: </b><div style="display: inline-block; width: 15px;height: 15px;background-color: {{$p->cor }};" class="img-circle"></div>
        </div>
    </div>





    <div class="row">
        <div class="col-sm-12">
            <ul>
            @foreach($p->eventos as $evento)
                <li>{{ $evento->nome }} </li>
            @endforeach
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
        <button type="button" class="btn btn-primary"
                name="action" value="finished"
                onClick="location.href = '{{ route('espacos.index') }}';">
            <i class="fa fa-backward"></i>
            Voltar à listagem
        </button>
        </div>
    </div>

@stop