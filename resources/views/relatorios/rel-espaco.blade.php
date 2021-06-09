@extends('layout.admin')
@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos-solicitados') }}">Relatório</a></li>
                <li>Por Espaço</li>
            </ol>
        </div>
    </div>

    <div class="row">

        <form method="get" id="filtro" action="{{ action('RelatoriosController@whatsUp') }}">

            <div class="form-group col-sm-2" style="width: 160px;">
                <div class='input-group date_c cursorHand'>
                    <input class="form-control texto-red"
                           type="text"
                           name="data_i"
                           value="{{$data_i}}"
                           placeholder="data inicial"
                           data-mask="99.99.9999">
                    <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                </div>
            </div>

            <div class="form-group col-lg-2" style="width: 160px;">
                <div class='input-group date_c cursorHand'>
                    <input class="form-control texto-red"
                           type="text"
                           name="data_f"
                           value="{{$data_f}}"
                           placeholder="data final">
                    <span class="input-group-addon bg-custom b-0 text-white"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group col-sm-2">
                {!! Form::select('status', listaItens('STATUS_EVENTO','- Status -'), $status, array('class' => 'form-control texto-red','id'=>'status')) !!}
            </div>

            <div class="form-group col-sm-2">

                {!! Form::select('tipo_pb',array_merge([''=>'- Selecione -'],listaItens('TIPO_PUBLICACAO','Publicação')), $tipo_pb, array('class' => 'form-control texto-red')) !!}

            </div>

            <div class="form-group col-sm-2">
                {!! Form::select('espaco_id', $listaSalas, $espaco, array('class' => 'form-control texto-red','id'=>'espaco_id')) !!}
            </div>

            <div class="form-group col-sm-2">
                {!! Form::select('unidade_id', $listaUnidades, $unidade, array('class' => 'form-control texto-red')) !!}
            </div>

            <div class="form-group col-sm-2"  style="width: 80px;">
                <input type="submit" value="Aplicar" class="btn btn-success">
            </div>
        </form>

    </div>
    <hr/>
    <div class="row">

        <?php
       //  print_r($arrSalas)
        ?>

        @foreach($arrSalas as $e)

            <div class="col-lg-4">
                <div class="panel panel-default" style=" box-shadow: 0px 0px 2px {{$e->cor}};">
                    <div class="panel-heading" style="background-color:{{$e->cor}}; font-weight: bold; color: #fff; text-shadow: 1px 1px 5px #929292 ">
                        {{$e->nome}}
                    </div>
                    <div class="panel-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tincidunt est vitae ultrices accumsan. Aliquam ornare lacus adipiscing, posuere lectus et, fringilla augue.</p>
                    </div>
                    <div class="panel-footer" >
                        {{$e->local}}
                    </div>
                </div>
            </div>

        @endforeach



    </div>




@stop