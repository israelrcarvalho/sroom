@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Dashboard</h3>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="lnr lnr-flag icon-grande"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"> {{$solicitado}}</div>
                            <div>Novas Solicitações</div>
                        </div>
                    </div>
                </div>
                <a href="eventos/lista-eventos-solicitados?status=8&amp;data_i={{date('01.m.Y')}}&amp;data_f={{date('30.m.Y')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="lnr lnr-calendar-full icon-grande"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$agendado}}</div>
                            <div>Eventos Agendados</div>
                        </div>
                    </div>
                </div>
                <a href="eventos/lista-eventos-solicitados?status=5&amp;data_i={{date('01.m.Y')}}&amp;data_f={{date('30.m.Y')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="lnr lnr-cross-circle icon-grande"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$cancelado}}</div>
                            <div>Eventos Cancelados!</div>
                        </div>
                    </div>
                </div>
                <a href="eventos/lista-eventos-solicitados?status=3&amp;data_i={{date('01.m.Y')}}&amp;data_f={{date('30.m.Y')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <span class="lnr lnr-checkmark-circle icon-grande"></span>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$concluido}}</div>
                            <div>Eventos Concluidos</div>
                        </div>
                    </div>
                </div>
                <a href="eventos/lista-eventos-solicitados?status=4&amp;data_i={{date('01.m.Y')}}&amp;data_f={{date('30.m.Y')}}">
                    <div class="panel-footer">
                        <span class="pull-left">Detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right fa-2x"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- --}}
        @include('graficoAtendimentoPorIntituicao')
        @include('graficoPorStatus')
        @include('grafAtendAsindicatos')

        {{--
        @include('grafAtendAsindNoMes')--}}

    </div>


@stop