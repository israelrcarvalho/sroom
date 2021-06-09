<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Redefinição de senha | ScheduleldRoom </title>

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
                             background-size: 100%;
                             background-repeat: no-repeat;
                             height: 100%; width: 100%; background-size: 100%; background-repeat: no-repeat;
                             -webkit-transition: background-image 0.2s ease-in-out;
                             -moz-transition: background-image 0.50s ease-in-out;
                             -ms-transition: background-image 0.50s ease-in-out;
                             -o-transition: background-image 0.50s ease-in-out;
                             transition: background-image 0.50s ease-in-out;
            }
            .login {  display: table-cell;  vertical-align: middle }
            .img-login {
                padding: 5em;
                background-size: 100%;
                background-repeat: no-repeat;
            }
            input.btn.btn-lg.btn-success.btn-block {
                background: #03a87e;
                background: -moz-linear-gradient(top,  #03a87e 0%, #6bbfa5 100%);
                background: -webkit-linear-gradient(top,  #03a87e 0%,#6bbfa5 100%);
                background: linear-gradient(to bottom,  #03a87e 0%,#6bbfa5 100%);
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#03a87e', endColorstr='#6bbfa5',GradientType=0 );
                border-radius: 0;
                border: 1px solid #0b3524;
                font-size: 14px;
                font-weight: 600;
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
            .centro-form {
                background: rgba(249, 249, 249,0.9);
                max-width: 305px;
                overflow: hidden;
                padding: 1em 2em;
                padding-bottom: 1.2em;
                box-shadow: 0px 0px 14px #888787;
                -moz-box-shadow: 0px 0px 14px #888787;
                border-radius: 30px 0px 30px;
            }
        </style>
        <script>
            setInterval(changeimg, 8000);

            function changeimg() {
                var img = new Array(
                        "../images/login.jpg",
                        "../images/image01.jpg",
                        "../images/image02.jpg",
                        "../images/image03.jpg",
                        "../images/image04.jpg",
                        "../images/image05.jpg"
                        );

                i = Math.floor(Math.random() * 6);
                document.getElementById("imd").style.backgroundImage = "url(" + img[i] + ")";
            }
        </script>
    </head>
    <body id="imd" onload="changeimg()">

        <div class="container login">
            <div class="row img-login">
                <div class="col-md-offset-5 col-md-2 centro-form">
                    <h3 class="panel-title img-responsive"><img src="../images/logo.png" style="width:100%"  alt="Logotipox"/></h3>
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

                    {!! Form::open(['url' => '/password/email', 'class' => 'form']) !!}
                    <fieldset>
                        <br>
                        {!! Form::hidden('_token', csrf_token()) !!}

                        <div class="form-group">
                            {!! Form::email('email', '', ['class'=> 'form-control','autofocus','placeholder'=> 'Digite seu email']) !!}
                        </div>
                        {!! Form::submit('Solicitar Senha',['class' => 'btn btn-lg btn-success btn-block']) !!}
                    </fieldset>
                    <span class="links" style="text-align: center; color: #FF0000;"><a href="{{route('auth/login')}}">< Voltar ao login </a></span>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="<?php echo url(); ?>/admin/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo url(); ?>/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo url(); ?>/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo url(); ?>/admin/dist/js/sb-admin-2.js"></script>

</body>

</html>