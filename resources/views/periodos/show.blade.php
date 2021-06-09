@extends('layout.admin')
@section('conteudo')

<?php
// Using facade
// (string) Format::number((float) $number, (int) $precision = 0, (string) $decimal = ',', (string) $thousand = '.')
/*Format::number(1000); // output: '1.000'
Format::number(123456.76,1); // output: '123.456,8'
Format::number(123456.76,1, ",", "."); // output: '123,456.8
*/
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Detalhes do Evento -  {{$p->nome}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<ul>
    @foreach($periodos as $periodo)
        <li>{{ $periodo->id }}</li>
    @endforeach
</ul>


<div class="row">
    <ul>
      <li>
        <b>Id:</b> {{$p->id}} 
      </li>
      <li>
        <b>Nome:</b> {!! $p->nome !!} 
      </li>
    </ul>   
</div>

<div class="dataTable_wrapper">
        <div class="panel-body">
            
            @include('eventos.partials.success')
            
            <table id="tdataseventos" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Data</th>
                        <th>Hora Início</th>
                        <th>Hora Final</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    

                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
<button type="button" class="btn btn-success"
        name="action" value="finished"
        onClick="location.href = 'eventos-fiec/eventos';">
    <i class="fa fa-backward"></i>
    Voltar
</button>
@stop