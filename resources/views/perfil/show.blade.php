@extends('layout.admin')
@section('conteudo')

    <div class="row">
        <div class="col-sm-12">
            <ol class="breadcrumb page-header">
                <li>Perfil do Usuário</li>
                <li>Exibir</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-12 card-box">
        <div class="row">
            @if ($errors->has('imagem'))
                <span class="help-block alert alert-danger">
                    <strong>{{ $errors->first('imagem') }}</strong>
                </span>
            @endif
            
            @if($p->imagem == NULL)
                <img style="margin-left: 1%; max-width: 100px;" class="col-lg-4 img-thumbnail img-responsive pull-left" src="imagens-perfil/foto-perfil.png">
            @else
                <img style="margin-left: 1%; max-width: 100px;"  class="img-thumbnail img-responsive pull-left" src="imagens-perfil/{{ $p->imagem}}">
            @endif
            
            {!! Form::model($p, ['route'=> ['perfil.updateImagem',$p->id ],  'enctype'=> "multipart/form-data"]) !!}

                <div style="position:relative; float: left; margin-top: 10%; margin-left: -11%;">
                        <a class='btn btn-primary' href='javascript:;' style="margin-left: 10px;">
                                Alterar imagem...
                                <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="imagem" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                        </a>
                    <span class='label label-info' id="upload-file-info" style="font-size: 14px;"></span>
                </div>
                

            <div class="form-group col-12">
                <div class="col-lg-6  text-right ajuste-btn-salvar">
                    <button type="submit" class="btn btn-success"
                            name="action" value="finished">
                        <i class="fa fa-floppy-o"></i>
                        Salvar
                    </button>
                </div>
            </div>


            {!! Form::close() !!}
            
            <div class="col-lg-8">
                <p><b>Id do Usuário:</b> {{$p->id}} </p>
                <p><b>Nome Completo:</b> {!! $p->name !!} </p>
                <p><b>E-mail:</b> {!! $p->email !!}</p>
            </div>
        </div>
    </div>

            <div class="row">
                <div class="col-lg-6 ajuste-btn-cancelar">        
                    <button type="button" class="btn btn-primary"
                            name="action" value="finished"
                            onClick="location.href = '{{ url('/') }}';">
                        <i class="fa fa-backward"></i>
                        Voltar
                    </button>
                </div>
                <div class="col-lg-6  text-right ajuste-btn-salvar">        
                    <button type="button" class="btn btn-success text-right"
                            name="action" value="finished"
                            onClick="location.href = '{{ url('perfil/' . Auth::user()->id . '/edit') }}';">
                        <i class="fa fa-edit"></i>
                        Alterar Senha
                    </button>
                </div>
            </div>
@stop