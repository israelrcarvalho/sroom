
    $(function () {
    $('.date_ano_mes').datetimepicker({
        viewMode: 'years',
        format: 'MM/YYYY'
    });
});
    $(function () {
        $('.date_c').datetimepicker({
            format: "L",
            locale: 'pt-br'
        });
    });

    $(function () {
        var dataAtual = new Date();
        $('.date').datetimepicker({
            format: "L",
            locale: 'pt-br'
            ,defaultDate: dataAtual
        });
    });

    $(function () {
        var dataAtual = new Date();
        $('.time').datetimepicker({
            format: "LT",
            locale: 'pt-br'
           ,defaultDate: dataAtual
        });
    });

$(document).ready(function() {

    // tabela recursos
    $('#t-recursos').DataTable({

        responsive: true,
        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "pageLength": 100,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
            //  {"bVisible": true}
        ],
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        //  "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

    $('#teventosxxc').DataTable(

        {
            "processing": true,
            "serverSide": true,
            "ajax": 'eventos/teste',
            columns:[
                { data: 'evento_id', name: 'evento_id' },
                { data: 'dataevento', name: 'dataevento' },
                // { data: 'dt_solicitacao', name: 'dt_solicitacao' }
                { data: 'nome_evento', name: 'nome_evento' }
            ]
        }
    );

    $('#colorselector_1').colorselector(); //Paleta de Cores

    // $(document).ready(function() {

        $('.dataTables-example2').DataTable( {
            dom: 'Bfrtip',
         //  dom: '<"html5buttons"B>lTfgitp',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        } );

// --------------------------------------------------------------------------
        $('.dataTables-example3').dataTable( {
            "dom": 'T<"clear">lfrtip',
            "tableTools": { "sSwfPath": "/swf/copy_csv_xls_pdf.swf"}
        } );
// --------------------------------------------------------------------------

    $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Listagem'},
                    {extend: 'pdf', title: 'Listagem'}  ,
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }

                ]
            });

// --------------------------------------------------------------------------

    $('.atendimento_sindicato').DataTable({
           // responsive: true ,
            dom: '<"html5buttons"B>lTfgitp', buttons: ['copy','pdf', 'print'],
            "oLanguage": {
                'sInfo': "_TOTAL_ registros"
            },
            'bInfo': true,
            'bPaginate': false,
            'filter':false
        })


// --------------------------------------------------------------------------
    $('.dataTables-example4').DataTable({
        responsive: true ,
        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        }

    });

// adiciona
    var btnGerarMapa = '<a class="btn btn-danger" id="relatorio">Gerar Mapa</a>';
    $("#l-eventos").find(".dt-buttons.btn-group").prepend(btnGerarMapa);
// --------------------------------------------------------------------------

    $("#relatorio").on("click", function() {

            console.log('teste');

             var f = document.getElementById('filtro');
             var data_i = $("input[type=text][name=data_i]").val();
             var data_f = $("input[type=text][name=data_f]").val();
             var status = $('#status').val();
             var espaco = $('#espaco_id').val();
             var tipo_pb = $('#tipo_pb').val();
             var url = 'mapa-de-eventos?data_i='+data_i +'&data_f='+data_f+'&espaco_id='+espaco+'&status='+status+'&tipo_pb='+tipo_pb ;
             window.open(url);

        });

//----
    $('.gotchaTable').DataTable({ responsive: true }); // classe para datatables

    $('.gotchaTableX').DataTable({
        responsive: true,
        'bInfo': false,
        'bPaginate': false,
        "aaSorting": [[ 3, "desc" ]]
    });
/*
    oTable = jQuery('.gotchaTable_').dataTable({
        'bLengthChange': false,
        'bPaginate': false,
        'sPaginationType': 'full_numbers',
        'iDisplayLength': 1, //Número de Registros
        'bInfo': false, "sDom": 'tfpli<"clear">', "bSort": true,
        responsive: true,
        "aaSorting": [[ 1, "desc" ]]
        //  'sSortDesc':'sorting_desc'
    });
*/
    // dataTables com agrupamento
    $('#tnivel').DataTable({

        responsive: true,
        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "pageLength": 100,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false}
        ],
        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
        //  "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );
    // --------------------------

    // Espaços
    // --------------------------
    $('#tespacos').DataTable({

        responsive: true,
        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "language": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}

           //  {"bVisible": true}
        ],

        "columnDefs": [
            { "visible": false, "targets": 2 }
        ],
        "order": [[ 2, 'asc' ]],
         "displayLength": 100,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;

            api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="8">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );
    // --------------------------

    // Tipos de Espaço
    // --------------------------
    $('#ttipoespacos').DataTable({

        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 2, 'asc' ]]

    } );
    // --------------------------

    // Tipos de Evento
    // --------------------------
    $('#ttipoeventos').DataTable({

        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 2, 'asc' ]]

    } );
    // --------------------------

    // Unidades
    // --------------------------
    $('#tunidades').DataTable({

        responsive: true,
        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },
        // 'bInfo': true,
        'bPaginate': true,
        "searching": true,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ],

        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "order": [[ 1, 'asc' ]],
        "displayLength": 100,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );
                    last = group;
                }
            } );
        }
    } );

    // --------------------------

    // usuários
    // --------------------------
    $('#tusuarios').DataTable({

        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 2, 'asc' ]]

    } );
    // --------------------------

    // Recursos
    // --------------------------
    $('#trecursos').DataTable({

        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 2, 'asc' ]]

    } );
    // --------------------------

    // Eventos
    // --------------------------
    $('#teventos').DataTable({

        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 2, 'asc' ]]

    } );
    // --------------------------
    //
    // Periodos
    // --------------------------
    $('#tdataseventos').DataTable({



        "aoColumns":[
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
           //  {"bVisible": true}
        ],

        "order": [[ 1, 'asc' ]]

    } );
    // --------------------------

    $('.grid-orcamento-unidade').DataTable({

        responsive: true,
        'bInfo': false,
        'bPaginate': false,
        "searching": false,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ],

        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="4">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }

    });
    // --

    $('.grid-timesheet').DataTable({

        dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf','print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },

        'bInfo': true,
        'bPaginate': true,
        "searching": true,
        "displayLength": 100



    });
    // --------------------------


    $('.grid-orcamento').DataTable({

        // responsive: true,
         dom: '<"html5buttons"B>lTfgitp', buttons: ['copy', 'csv', 'excel', 'pdf','print'],
        "oLanguage": {
            "sEmptyTable": "Nenhum registro encontrado",
            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "_MENU_ registros por página",
            "sLoadingRecords": "Carregando...",
            "sProcessing": "Processando...",
            "sZeroRecords": "Nenhum registro encontrado",
            "sSearch": "Pesquisar",
            "oPaginate": {
                "sNext": "Próximo",
                "sPrevious": "Anterior",
                "sFirst": "Primeiro",
                "sLast": "Último"
            },
            "oAria": {
                "sSortAscending": ": Ordenar colunas de forma ascendente",
                "sSortDescending": ": Ordenar colunas de forma descendente"
            }
        },

        'bInfo': true,
        'bPaginate': true,
        "searching": true,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ],

        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        // "order": [[ 1, 'desc' ]],
        "displayLength": 100,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="7">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

// adiciona o botão novo orcamento
    var btnTeste = '<a class="btn btn-danger" ' +
        'tabindex="0" ' +
        'aria-controls="DataTables_Table_0" ' +
        'data-toggle="modal" ' +
        'data-target="#modal-create-orcamento-alimentacao" ' +
        'name="action" ' +
        'value="finished" ' +
        'title="Novo Orçamento"><span><i class="fa fa-money"></i> &nbsp;[ + ]</span></a>';

    $("#c-orcamento").find(".dt-buttons.btn-group").prepend(btnTeste);

    // --------------------------------------------------------------
    $('.col3').DataTable({

        responsive: true,
        'bInfo': false,
        'bPaginate': false,
        "searching": false,
        "aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": false}
        ],

        "columnDefs": [
            { "visible": false, "targets": 0 }
        ],
        // "order": [[ 1, 'desc' ]],
        // "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
            api.column(0, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="6">'+group+'</td></tr>'
                    );

                    last = group;
                }
            } );
        }
    } );

    // ----------------
});