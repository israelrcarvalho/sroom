@if ($errors->any())    
<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>

    <ul class="alert">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>    
@endif 

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="form-group col-lg-6">
                    {!! Form::label('name', 'Nome:') !!}
                    {!! Form::text("name", null, array("class" => "form-control")) !!}
                </div>

                <div class="form-group col-lg-6">
                    {!! Form::label('email', 'E-mail:') !!}
                    {!! Form::email("email", null, array("class" => "form-control")) !!}
                </div>
                
                <div class="form-group col-lg-6">
                    {!! Form::label('password', 'Senha:') !!}
                    {!! Form::password("password", array("class" => "form-control")) !!}
                </div>

                <div class="form-group col-lg-6">
                    {!! Form::label('password', 'Confirmar Senha:') !!}
                    {!! Form::password("password_confirmation", array("class" => "form-control password")) !!}
                </div>

                <div class="form-group  col-lg-12">


                 {!! Form::label('roles', 'Grupos:') !!}
                    <select name="roles[]" id="recursos" class="form-control" multiple
                            placeholder="Selecione um ou mais grupos">
                        @foreach ($allRoles as $rol)
                            <option @if (in_array($rol, $roles)) selected @endif value="{{ $rol }}">
                                {{ $rol}}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>
    </div>
</div>            

<div class="form-group col-12">

    <div class="col-lg-6 ajuste-btn-cancelar">
        <button type="button" class="btn btn-danger"
                name="action" value="finished"
                onClick="javascript:if(confirm('Você tem certeza que deseja cancelar?.')){location.href = '{{ route('tiposEspaco.index') }}';}">             
            Cancelar
        </button>
    </div>
    <div class="col-lg-6  text-right ajuste-btn-salvar">
        <button type="submit" class="btn btn-success"
                name="action" value="finished">
            <i class="fa fa-floppy-o"></i>
            Salvar
        </button>
    </div>
</div>



              
