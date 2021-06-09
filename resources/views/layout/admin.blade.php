<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="{{ url() }}/"/>

    <title>Scheduled Room</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="inspinia/style.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- para tabelas -->
    <!-- DataTables CSS -->
    {{--<link href="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet"> --}}

    <!-- DataTables Responsive CSS -->
    {{--<link href="admin/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">--}}
    <!-- -->

    <link href="dataTables/datatables.min.css" rel="stylesheet">

    <link href="css/components.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="admin/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <link href="assets/selectize/css/selectize.css" rel="stylesheet">
    <link href="assets/selectize/css/selectize.bootstrap3.css" rel="stylesheet">


    <!-- Estilo -->
    <link href="css/estilo.css" rel="stylesheet">
    <link href="assets/bootstrap-colorselector-master/lib/bootstrap-colorselector-0.2.0/css/bootstrap-colorselector.css" rel="stylesheet"/>



    <!-- Morris Charts CSS -->
    {{--<link href="public/admin/bower_components/morrisjs/morris.css" rel="stylesheet">--}}

    {{--<link href="public/ubold/core.css" rel="stylesheet">--}}

    <style>
        .dropdown-colorselector > .dropdown-menu {
            max-width: 250px;
        }

        .btn-colorselector {
            width: 34px;
            height: 34px;
        }

        tr.group td {
            font-weight: bold;
        }

        tr.group,
        tr.group:hover {
            /*background-color: #ddd !important;*/
        }
    </style>

</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border-bottom:solid 3px #016701; z-index: 20;">
        <!-- menu horizontal -->
        @include('layout.navbar-header')
                <!-- menu horizontal -->
        @include('layout.sideBar')
    </nav>

    <!-- jQuery -->
    <script src="{{ url()}}/admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Page Content -->
    <div id="page-wrapper" style="padding-bottom: 0px;">
        @yield('conteudo')
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- Bootstrap Core JavaScript -->
<script src="{{url()}}/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<script src="dataTables/datatables.min.js"></script>

{{--<script src="admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>--}}


<!-- Custom Theme JavaScript -->
<script src="admin/dist/js/sb-admin-2.js"></script>

<!-- DataTables JavaScript -->
<script src="assets/selectize/selectize.min.js"></script>

<script src="js/app.js"></script>

<!--colorselector-->
<script src="assets/bootstrap-colorselector-master/lib/bootstrap-colorselector-0.2.0/js/bootstrap-colorselector.js"></script>


<script src="js/highcharts.js"></script>
<script src="js/exporting.js"></script>

<script src="js/grafico.js"></script>


<script type="text/javascript">

    $("#sala_c").prop('disabled', 'disabled');
    $('#sala_c').empty();

    $('#status_c').change(function () {

        var hora_i = $('#hora_inicio_c').val();
        var hora_f = $('#hora_fim_c').val();
        var data_inicio = $('#dt_realizacao_c').val();
        var options = '<option value="" class="carregando">Carregando salas disponíveis...</option>';
        var valorStatus = $( "#status_c" ).val();

        if(valorStatus=='1' ||valorStatus=='2' ||valorStatus=='3' ||valorStatus=='6'){
            $("#bloco-jus").removeClass('hide');
            $("#bloco-jus").fadeIn();

        } else {
            $("#bloco-jus").fadeOut();
        }

        $('#sala_c').html(options).show();
        // ---------------------------------------------
        $.get('espacos/lista-espacos', {
            hora_i: hora_i,
            hora_f: hora_f,
            data_inicio: data_inicio
        }, function (espacos) {
            var op = '';
            $.each(espacos, function (key, value) {

                op += '<optgroup label="' + key + '">';
                $.each(value, function (k, v) {
                    op += '<option value="' + v['id'] + '">' + v['nome'] + '</option>';
                });
                op += '</optgroup>';
            });

            $('#sala_c').html(op).show();
            $("#sala_c").removeAttr("disabled");

        });
    });

</script>

<script src="js/bootstrap-inputmask.min.js" type="text/javascript"></script>

<script src="js/moment-with-locales.js"></script>

<link rel="stylesheet" href="assets/bootstrap-datetimepicker-master/build/css/bootstrap-datetimepicker.min.css" />
<script type="text/javascript" src="assets/bootstrap-datetimepicker-master/build/js/bootstrap-datetimepicker.min.js"></script>

<script src="js/componentes.js"></script>
<script src="js/jquery.maskMoney.js"></script>
<script src="js/mascara.js"></script>






</body>

</html>
