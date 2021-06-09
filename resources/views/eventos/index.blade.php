@extends('layout.admin')
@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('eventos.index') }}">Eventos</a></li>
                <li>Listar</li>
            </ol>
        </div>
    </div>
    <div class="row">

        <form method="get" action="{{ action('EventosController@basicData') }}">

            <div class="form-group col-sm-2">
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

            <div class="form-group col-sm-2">
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
                {!! Form::select('status', listaItens('STATUS_EVENTO','- Status -'), $status, array('class' => 'form-control texto-red')) !!}
            </div>

            <div class="form-group col-sm-2">

                {!! Form::select('tipo_pb',array_merge([''=>'- Selecione -'],listaItens('TIPO_PUBLICACAO','Publicação')), $tipo_pb, array('class' => 'form-control texto-red')) !!}

            </div>


            <div class="form-group col-sm-2">
                <input type="submit" value="Aplicar" class="btn btn-success">
            </div>

        </form>

    </div>
    <div class="row">
        <div class="col-sm-12">

            @include('eventos.partials.success')

            <div class="card-box">

                <table id="teventosxxc" class="table">
                    <thead>
                    <tr>
                        <th width="30">id</th>
                        <th>xxxx</th>
                        <th>nome</th>
                    </tr>
                    </thead>
                </table>
            </div>

            {{--</div>--}}
        </div>
    </div>
@stop