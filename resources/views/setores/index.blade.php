@extends('layout.admin')
@section('conteudo')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Setores</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="dataTable_wrapper">
        <div class="panel-body">
            <table class="table table-striped table-bordered table-hover gotchaTable">
                <thead>
                    <tr>
                        <th width="20">#</th>
                        <th>Nome</th>
                        <th>Unidade</th>
                        <th width="45">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($objModel as $setor)
                    <tr>
                        <td>{{ $setor->id }}</td>
                        <td>{{ $setor->nome_setor }}</td>
                        <td>{{ $setor->id_unidade }}</td>
                        <td width="3">
                            <a href="<?php echo url(); ?>/setores/<?php echo $setor->id; ?>/show">
                                <span class="glyphicon glyphicon-search"></span>
                            </a>
                            <a href="{{ route('setores.destroy',['id'=>$setor->id]) }}">    
                                
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                       
                            <a href="<?php echo url(); ?>/setores/<?php echo $setor->id; ?>/edit">  
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>                
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
</div>
@stop