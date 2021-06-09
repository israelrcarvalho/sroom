@extends('layout.admin')
@section('conteudo')
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb page-header">
                <li><a href="{{ route('unidades.index') }}">Relatório</a></li>
                <li>TimeSheet</li>
            </ol>
        </div>
    </div>

    <div class="row">



        <form method="get" action="{{ action('RelatoriosController@timeSheet') }}">
            <div class="form-group col-sm-5">
                {!! Form::select('ano',$ano, null, array('class' => 'form-control texto-red')) !!}
            </div>

            <div class="form-group col-sm-5">
                {!! Form::select('mes',$mes, null, array('class' => 'form-control texto-red')) !!}
            </div>

            <div class="form-group col-sm-2 text-right">
                <input type="submit" value="Aplicar" class="btn btn-success">
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box" id="t-timesheet">
                <table class="table table-striped grid-timesheet">
                    <thead>
                    <tr>
                        <th>UNIDADE</th>
                        <th>N</th>
                        <th>ESFORÇO</th>
                        <th style="width: 30px">%</th>
                        <th>Ano</th>
                        <th>Mês</th>

                    </tr>
                    </thead>
                    <tbody>
                        {{--*/  $tp = 0 /*--}}
                        @foreach($objModel as $objx)
                            <tr>
                                <td>{{$objx->nome}}</td>
                                <td>{{$objx->snivel}}</td>
                                <td>{{$objx->esforco}}</td>
                                <td class="text-right">{{round(($objx->esforco / $objModel->sum('esforco')) * 100,2)}}%</td>
                                <td>{{$objx->ano}}</td>
                                <td>{{$objx->mes}}</td>
                                <span style="display: none;">
                                {{$tp+= round(($objx->esforco / $objModel->sum('esforco')) * 100,2)}}
                                </span>
                            </tr>
                        @endforeach
                        <tfoot>
                            <tr>
                                <td></td>
                                <td>{{$objModel->sum('snivel')}}</td>
                                <td>{{$objModel->sum('esforco')}}</td>
                                <td class="text-right">{{$tp}}.00%</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop