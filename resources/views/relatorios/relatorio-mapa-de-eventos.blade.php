<script src="{{ url()}}/admin/bower_components/jquery/dist/jquery.min.js"></script>
<script src="admin/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="admin/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tmapa').DataTable({

            responsive: true,
            "paging":   false,
            "ordering": false,
            "info":     false ,
            "columnDefs": [
                { "visible": false, "targets": 2 }
            ],

             "order": [[ 3, 'asc' ]],
            //  "displayLength": 25,
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;

                api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                                '<tr class="group"><td colspan="6">'+group+'</td></tr>'
                        );
                        last = group;
                    }
                } );
            }
            //---

        });
    });

</script>


<style>

    body {
        color: #333;
        background-color:#FFFFFF;
        font-family: "Lucida Sans Unicode", "Lucida Sans", Arial, Helvetica, Monaco, monospace;
    }

    #tmapa_filter{
    display: none;
        /* #1F5C36 */
    }
    #tmapa{
        border: solid 1px #000;
        width: 100%;
        border-collapse: collapse;
        padding: 10px;
    }
    #tmapa td {
        padding: 5px;

    }
    .group{
        background-color: #1F5C36 !important;
        color:#FFF;
        text-align: center;
        font-weight: bold;
        font-size: 16pt;
    }
</style>
<div style="padding: 15px;">

<?php
//echo "<pre>";
  //  print_r($objModel);
      //  exit;
    ?>

<table id="tmapa" class="table table-striped table-bordered" width="100%" border="1">
    <thead>
    <tr>
        <th>DESCRI&Ccedil;&Atilde;O DO EVENTO</th>
        <th>DIA</th>
        <th>EMPRESA</th>
        <th>INSTITUIÇÃO</th>
        <th width="150">HOR&Aacute;RIO</th>
        <th>LOCAL</th>
        <th>CONTATO</th>
    </tr>
    </thead>
    <tbody>
    @foreach($objModel as $or)
        <tr>
            <td>{{$or->nome_evento}} </td>
            <td>{{$or->dataevento}}</td>
            <td>{{iRcGetSysVal_('TIPO_UNIDADE',$or->empresa)}} &nbsp;</td>
            <td>{{$or->unidade}} &nbsp;</td>
            <td align="center">{{$or->hora_inicio}} às {{$or->hora_fim}}</td>
            <td>{{$or->espaco_nome}}</td>
            <td>{{$or->solicitante}} {{$or->fone_solicitante}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>