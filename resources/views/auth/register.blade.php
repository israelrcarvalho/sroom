<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Registro | ScheduledRoom</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo url(); ?>/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo url(); ?>/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo url(); ?>/admin/dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo url(); ?>/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Pesonalização Login -->
        <style>
            html, body {     height: 100%;
                             width: 100%;
                             display: table;
                             background-image: url("../images/login.jpg");
                             background-size: 100%;
                             background-repeat: no-repeat; }
            .login {  display: table-cell;  vertical-align: middle;     background: rgba(95, 190, 170,0.6); }
            .img-login {
                padding: 5em;
                background-size: 100%;
                background-repeat: no-repeat;
            }
            input.btn.btn-lg.btn-success.btn-block {
                background: red;
                border-radius: 0;
                border: 2px solid #BF0202;
            }
            .label-login {     
                font-size: 12px;
                color: white;
                font-weight: 300!important;
                color: white!important;
            }
            .links a {
                color: #525252;
                text-decoration: none;
                font-size: 11px;
                font-weight: lighter;
                text-align: center;
                transition: all cubic-bezier(0.8, -0.24, 0, 1.68) .9s;
            }
            .links a:hover{
                color: #fff;
                transition: all cubic-bezier(0.8, -0.24, 0, 1.68) .9s;
            }
            .checkbox {
                color: #E2FFFA;
            }
        </style>
    </head>
    <body>

        <div class="container login">
            <div class="row img-login">
                <div class="col-md-offset-5 col-md-2">
                    <h3 class="panel-title img-responsive"><img src="../images/logo.png" style="width:100%"  alt="Logotipo"/></h3>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        
                    {!! Form::open(['route' => 'auth/register', 'class' => 'form']) !!}

                    <br>
                        <div class="form-group">
                            {!! Form::input('text', 'name', '', ['class'=> 'form-control', 'placeholder'=> 'Digite seu Nome']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::email('email', '', ['class'=> 'form-control', 'placeholder'=> 'Digite seu E-mail']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::password('password', ['class'=> 'form-control', 'placeholder'=> 'Digite sua Senha']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::password('password_confirmation', ['class'=> 'form-control','placeholder'=> 'Confirme sua Senha']) !!}
                        </div>

                        <div>
                            {!! Form::submit('Registrar',['class' => 'btn btn-lg btn-success btn-block']) !!}
                        </div>
                                        <span class="links" style="text-align: center; color: #FF0000;"><a href="{{route('auth/login')}}">< Voltar ao login </a></span>
                    {!! Form::close() !!}
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
