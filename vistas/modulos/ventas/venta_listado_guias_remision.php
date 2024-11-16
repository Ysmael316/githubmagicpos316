<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">LISTADO GUIAS DE REMISIÓN</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Listado Guias de Remisión </li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">

    <div class="card card-primary card-outline card-outline-tabs">

        <div class="card-header p-0 border-bottom-0">


        </div>

        <div class="card-body py-1">

            <div class="row my-2">

                <!--LISTADO DE BOLETAS -->
                <div class="col-md-12">

                    <table id="tbl_guias_remitente" class="table table-striped  shadow border border-secondary" style="width:100%;font-size: 14px;">
                        <thead class="bg-main text-left">
                            <th></th> <!-- 0 -->
                            <th>id</th> <!-- 1 -->
                            <th>Cod Tipo Comprobante</th> <!-- 2 -->
                            <th>Tipo Comprobante</th> <!-- 3 -->
                            <th>Guía</th> <!-- 4 -->
                            <th>Fecha Emision</th> <!-- 5 -->
                            <th>Fecha Traslado</th> <!-- 6 --> 
                            <th>Id Cliente</th> <!-- 7 -->
                            <th>Cliente</th> <!-- 8 -->
                            <th>Documento Rel</th> <!-- 9 -->
                            <th>Codigo Motivo Traslado</th> <!-- 10 -->
                            <th>Motivo Traslado</th> <!-- 11 -->
                            <th>Codigo Modalidad Traslado</th> <!-- 12 -->
                            <th>Modalidad</th> <!-- 13 -->
                            <th>Peso Total</th> <!-- 14 -->
                            <th>Unidad Peso Total</th> <!-- 15 -->
                            <th>Nro Bultos</th> <!-- 16 -->
                            <th>Ubigeo Partida</th> <!-- 17 -->
                            <th>Direccion Partida</th> <!-- 18 -->
                            <th>Ubigeo Llegada</th> <!-- 19 -->
                            <th>Direccion Llegada</th> <!-- 20 -->
                            <th>Estado Sunat</th> <!-- 21 -->
                            <th>Xml Base64</th> <!-- 22 -->
                            <th>Mensaje Error Sunat</th> <!-- 22 -->
                        </thead>
                    </table>

                </div>

            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        fnc_InicializarFormulario();

        $('#tbl_guias_remitente tbody').on('click', '.btnImprimirGuiaA4', function() {
            var data = $('#tbl_guias_remitente').DataTable().row($(this).parents('tr')).data();
            $id_guia = data[1];
            fnc_ImprimirGuiaRemitente($id_guia)
        });

    })

    function fnc_InicializarFormulario() {
        fnc_CargarDataTableGuiasRemitente();
    }

    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   F A C T U R A S
    ====================================================================================== */
    function fnc_CargarDataTableGuiasRemitente() {

        if ($.fn.DataTable.isDataTable('#tbl_guias_remitente')) {
            $('#tbl_guias_remitente').DataTable().destroy();
            $('#tbl_guias_remitente tbody').empty();
        }

        $("#tbl_guias_remitente").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE GUIAS DE REMITENTE';
                    return printTitle
                }
            }, 'pageLength'],
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/ventas.ajax.php',
                data: {
                    'accion': 'obtener_listado_guias_remitente'
                },
                type: 'POST'
            },
            scrollX: true,
            // autoWidth: true,
            scrollY: "50vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [1,2,3,7,9,10,12,14,15,16,17,18,19,20,22,23],
                    visible: false
                },
                // {
                //     targets: 10,
                //     createdCell: function(td, cellData, rowData, row, col) {

                //         if (rowData[10] != 1) {
                //             $(td).parent().css('background', '#F2D7D5')
                //             $(td).parent().css('color', 'black')
                //         } else {
                //             $(td).parent().css('background', '#D4EFDF')
                //         }
                //     }
                // },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $options = `<div class="btn-group">
                        
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-list-alt"></i>
                                        </button>

                                        <div class="dropdown-menu z-3">
                                            <a class="dropdown-item btnImprimirGuiaA4" style='cursor:pointer;'><i class='px-1 fas fa-file-pdf fs-5 text-danger'></i> <span class='my-color'>Imprimir Guia (A4)</span></a>
                                        </div>
                                        
                                    </div>`;                        

                        $(td).html($options)
                    }
                },
                // {
                //     targets: 11, //ICONO DE ESTADO SUNAT
                //     orderable: false,
                //     createdCell: function(td, cellData, rowData, row, col) {

                //         if (rowData[10] == 2) {
                //             $(td).html("<center>" +
                //                 "<i style='cursor:pointer;' class='fas fa-info fs-5 text-warning' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                //                 "</center>");
                //         } else if (rowData[10] == 1) {
                //             $(td).html("<center>" +
                //                 "<i style='cursor:pointer;' class='fas fa-check-circle fs-5 text-success' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                //                 "</center>");
                //         } else if (rowData[10] == 3) {
                //             $(td).html("<center>" +
                //                 "<i style='cursor:pointer;' class='fas fa-window-close fs-5 text-danger' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                //                 "</center>");
                //         } else {
                //             $(td).html("<center>" +
                //                 "<i style='cursor:pointer;' class='fas fa-share-square fs-5 text-secondary'  data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                //                 "</center>");
                //         }

                //     }
                // },
                {
                    targets: 21, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[21] == 0) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Aceptado Sunat</span>" +
                                "</center>");
                        } else{
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[23] + "'>Enviado con errores</span>" +
                                "</center>");
                        } 

                    }
                }

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_guias_remitente"));
    }

    function fnc_ImprimirGuiaRemitente($id_guia){
        window.open($ruta+'vistas/modulos/impresiones/generar_guia_remision_a4.php?id_guia=' + $id_guia,'fullscreen=yes' +"resizable=0,");
    }
</script>