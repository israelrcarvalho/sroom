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
        <h1 class="page-header">Detalhes do produtos -  {{$p->nome}}</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
<ul>
  <li>
    <b>Valor:</b> R$ {{$p->valor}} 
  </li>
  <li>
    <b>Descrição:</b> {!! $p->descricao or 'nenhuma descrição informada' !!} 
  </li>
  <li>
    <b>Quantidade em estoque:</b> {{$p->quantidade}}
  </li>
</ul>    
    
</div>
@stop