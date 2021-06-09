@if ($errors->any())

    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif
{{-- --}}

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <div class="form-group  col-lg-6">
                {!! Form::label('nome', 'Nome do Espaço:') !!}
                {!! Form::text("nome", null, array("class" => "form-control", "placeholder"=>"Preencha um nome para o Espaço")) !!}
            </div>

            {{-- --}}
            <div class="form-group  col-lg-6">
                {!! Form::label('espaco_tipo', 'Tipo de Espaço:') !!}
                {!! Form::select('espaco_tipo', $listTipos, null, array('class' => 'form-control')) !!}
            </div>

            {{-- --}}
            <div class="form-group  col-lg-2">
                {!! Form::label('local', 'Local:') !!}
                {!! Form::text("local", null, array("class" => "form-control", "placeholder"=>"Onde fica")) !!}
            </div>

            <div class="form-group  col-lg-2">
                {!! Form::label('cod', 'Cod:') !!}
                {!! Form::text("cod", null, array("class" => "form-control", "placeholder"=>"Crie um código")) !!}
            </div>

            <div class="form-group  col-lg-2">
                {!! Form::label('capacidade', 'Capacidade:') !!}
                {!! Form::text("capacidade", null, array("class" => "form-control", "placeholder"=>"Capacidade")) !!}
            </div>

            <div class="form-group  col-lg-6">

                <div class="form-group  col-lg-1 col-xs-2" style="padding: 0; display: none;">
                    <!-- Mostra a cor escolhida -->
                    <label style="visibility: hidden"></label>

                    <div class="color" style="background: @if(isset($objModel['cor'])){{ $objModel['cor'] }} @endif;
                            border: 1px solid #333;
                            padding: 1em;
                            width: 10px;
                            height: 10px;
                            box-sizing: border-box;">
                    </div>
                </div>

                <label for="cor">Cor:</label>

                <div class="input-group  col-lg-11 col-xs-10" style="padding: 0;">
                    <select id="colorselector_1" name="cor">
                        @foreach(iRcGetSysValArray('COR_SALA') as $k => $v)
                            @if(isset($objModel['cor']))
                                <option @if($k==$objModel['cor'])  selected @endif value="{{$k}}"
                                        data-color="{{$k}}">{{$v}}</option>
                            @else
                                <option value="{{$k}}" data-color="{{$k}}">{{$v}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- --}}
            <div class="form-group  col-lg-12">
                {!! Form::label('recursos', 'Recursos:') !!}
                <select name="recursos[]" id="recursos" class="form-control" multiple
                        placeholder="Selecione qual (is) Recurso (s) será (ão) utilizado (s)">
                    @foreach ($allRecursos as $rec)
                        <option @if (in_array($rec, $recursos)) selected @endif value="{{ $rec }}">
                            {{ $rec }}
                        </option>
                    @endforeach
                </select>

            </div>
            {{-- --}}
            <div class="row">
                <div class="form-group  col-lg-1">
                    <div class="checkbox-ajeitar-isso">
                        <label>
                            <input {{ checked($ativa) }} type="checkbox" name="ativa">
                            ativa?
                        </label>
                    </div>
                </div>
            </div>
            {{-- --}}


        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 text-left ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('espacos.index') }}';}">
            Cancelar
        </button>
    </div>

    <div class="col-lg-6 text-right ajuste-btn-salvar">
        <button type="submit" class="btn btn-success"
                name="action" value="finished">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>
</div>