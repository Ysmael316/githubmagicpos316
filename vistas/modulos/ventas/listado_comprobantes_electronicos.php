<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">COMPROBANTES ELECTRÓNICOS</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Comprobantes Electrónicos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content" style="position: relative;">

    <div class="row">

        <div class="col-12 ">

            <div class="card card-primary card-outline card-outline-tabs">

                <div class="card-header p-0 border-bottom-0">

                    <ul class="nav nav-tabs" id="custom-tabs-comprobantes" role="tablist">

                        <!-- TAB LISTADO BOLETAS -->
                        <li class="nav-item">
                            <a class="nav-link active my-0" id="listado-boletas-tab" data-toggle="pill" href="#listado-boletas" role="tab" aria-controls="listado-boletas" aria-selected="false"><i class="fas fa-list"></i> Boletas</a>
                        </li>

                        <!-- TAB LISTADO FACTURAS -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="listado-facturas-tab" data-toggle="pill" href="#listado-facturas" role="tab" aria-controls="listado-facturas" aria-selected="true"><i class="fas fa-list"></i> Facturas</a>
                        </li>

                        <!-- TAB LISTADO NOTAS DE CREDITO -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="listado-notas-credito-tab" data-toggle="pill" href="#listado-notas-credito" role="tab" aria-controls="listado-notas-credito" aria-selected="false"><i class="fas fa-list"></i> Notas de Crédito</a>
                        </li>

                        <!-- TAB LISTADO NOTAS DE DEBITO -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="listado-notas-debito-tab" data-toggle="pill" href="#listado-notas-debito" role="tab" aria-controls="listado-notas-debito" aria-selected="true"><i class="fas fa-list"></i> Notas de Débito</a>
                        </li>

                        <!-- TAB LISTADO NOTAS DE VENTA -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="listado-notas-venta-tab" data-toggle="pill" href="#listado-notas-venta" role="tab" aria-controls="listado-notas-venta" aria-selected="true"><i class="fas fa-list"></i> Notas de Venta</a>
                        </li>



                        <!-- TAB RESUMENES DE BOLETAS -->
                        <!-- <li class="nav-item">
                            <a class="nav-link my-0" id="listado-resumenes-boletas-tab" data-toggle="pill" href="#listado-resumenes-boletas" role="tab" aria-controls="listado-resumenes-boletas" aria-selected="false"><i class="fas fa-list"></i> Resúmenes de Boletas</a>
                        </li> -->

                        <!-- TAB RESUMENES DE ANULACIONES -->
                        <!-- <li class="nav-item">
                            <a class="nav-link my-0" id="listado-resumenes-anulaciones-tab" data-toggle="pill" href="#listado-resumenes-anulaciones" role="tab" aria-controls="listado-resumenes-anulaciones" aria-selected="true"><i class="fas fa-list"></i> Resúmenes de Anulaciones</a>
                        </li> -->

                    </ul>
                </div>

                <div class="card-body py-1">

                    <div class="tab-content" id="custom-tabs-comprobantesContent">

                        <!-- TAB CONTENT BOLETAS -->
                        <div class="tab-pane fade active show" id="listado-boletas" role="tabpanel" aria-labelledby="listado-boletas-tab">

                            <div class="row my-2">

                                <!--LISTADO DE BOLETAS -->
                                <div class="col-md-12">

                                    <table id="tbl_boletas" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Forma Pago</th>
                                            <th>Ope. Grav.</th>
                                            <th>Ope. Exo.</th>
                                            <th>Ope. Ina.</th>
                                            <th>IGV</th>
                                            <th>Total</th>
                                            <th>Cod. Est. Sunat</th>
                                            <th>SUNAT</th>
                                            <th>Nombre Xml</th>
                                            <th>Estado</th>
                                            <th>Mensaje Sunat</th>
                                        </thead>
                                    </table>

                                </div>

                            </div>

                        </div>

                        <!-- TAB CONTENT FACTURAS -->
                        <div class="tab-pane fade" id="listado-facturas" role="tabpanel" aria-labelledby="listado-facturas-tab">

                            <div class="row my-2">

                                <!--LISTADO DE BOLETAS -->
                                <div class="col-md-12">
                                    <table id="tbl_facturas" class="table  w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Forma Pago</th>
                                            <th>Ope. Grav.</th>
                                            <th>Ope. Exo.</th>
                                            <th>Ope. Ina.</th>
                                            <th>IGV</th>
                                            <th>Total</th>
                                            <th>Estado Resp. Sunat</th>
                                            <th>Estado Sunat</th>
                                            <th>Nombre Xml</th>
                                            <th>Estado</th>
                                            <th>Mensaje Sunat</th>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <!-- TAB CONTENT NOTAS DE CREDITO -->
                        <div class="tab-pane fade" id="listado-notas-credito" role="tabpanel" aria-labelledby="listado-notas-credito-tab">

                            <div class="row my-2">

                                <!--LISTADO DE NOTAS DE CREDITO -->
                                <div class="col-md-12">
                                    <table id="tbl_notas_credito" class="table  w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Comprob. Modif.</th>
                                            <th>Motivo Nota Cred.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Ope. Grav.</th>
                                            <th>Ope. Exo.</th>
                                            <th>Ope. Ina.</th>
                                            <th>IGV</th>
                                            <th>Total</th>
                                            <th>Importe Ref.</th>
                                            <th>Estado Resp. Sunat</th>
                                            <th>Estado Sunat</th>
                                            <th>Nombre Xml</th>
                                            <th>Estado</th>
                                            <th>Mensaje Sunat</th>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <!-- TAB CONTENT NOTAS DE CREDITO -->
                        <div class="tab-pane fade" id="listado-notas-debito" role="tabpanel" aria-labelledby="listado-notas-debito-tab">

                            <div class="row my-2">

                                <!--LISTADO DE NOTAS DE DEBITO -->
                                <div class="col-md-12">
                                    <table id="tbl_notas_debito" class="table  w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Comprob. Modif.</th>
                                            <th>Motivo Nota Cred.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Ope. Grav.</th>
                                            <th>Ope. Exo.</th>
                                            <th>Ope. Ina.</th>
                                            <th>IGV</th>
                                            <th>Total</th>
                                            <th>Importe Ref.</th>
                                            <th>Estado Resp. Sunat</th>
                                            <th>Estado Sunat</th>
                                            <th>Nombre Xml</th>
                                            <th>Estado</th>
                                            <th>Mensaje Sunat</th>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <!-- TAB CONTENT NOTAS DE VENTA -->
                        <div class="tab-pane fade" id="listado-notas-venta" role="tabpanel" aria-labelledby="listado-notas-venta-tab">
                            <div class="row my-2">

                                <!--LISTADO DE NOTAS DE VENTA -->
                                <div class="col-md-12">
                                    <table id="tbl_notas_venta" class="table  w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Id</th>
                                            <th>Comprob.</th>
                                            <th>Fec. Emisión</th>
                                            <th>Ope. Grav.</th>
                                            <th>Ope. Exo.</th>
                                            <th>Ope. Ina.</th>
                                            <th>Igv</th>
                                            <th>Total</th>
                                            <!-- <th>Estado Resp. Sunat</th>
                                            <th>Estado Sunat</th>
                                            <th>Nombre Xml</th> -->
                                            <th>Estado</th>
                                            <!-- <th>Mensaje Sunat</th> -->
                                        </thead>
                                    </table>
                                </div>

                            </div>
                        </div>

                        <!-- TAB CONTENT RESUMENES DE BOLETAS -->
                        <div class="tab-pane fade" id="listado-resumenes-boletas" role="tabpanel" aria-labelledby="listado-notas-credito-tab">
                            RESUMENES DE BOLETAS
                        </div>

                        <!-- TAB CONTENT RESUMENES -->
                        <div class="tab-pane fade" id="listado-resumenes-anulaciones" role="tabpanel" aria-labelledby="listado-resumenes-anulaciones-tab">
                            RESUMENES DE ANULACIONES
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

</div>


<!-- =============================================================================================================================
M O D A L   E N V I A R   C O R R E O
===============================================================================================================================-->
<div class="modal fade" id="mdlEnviarComprobanteCorreo" role="dialog" tabindex="-1">

    <div class="modal-dialog modal-md" role="document">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Enviar comprobante a:</h5>

                <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times text-sm m-0 p-0"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <div class="row mb-2">

                    <!-- EMAIL -->
                    <div class="col-12 mb-2">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Email</label>
                        <input type="email" style="border-radius: 20px;" class="form-control form-control-sm" id="email" name="email" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-12 text-center">

                        <a class="btn btn-sm btn-success fw-bold " id="btnEnviarComprobanteCorreo" style="position: relative; width: 200px;">
                            <span class="text-button">ENVIAR CORREO</span>
                            <span class="btn fw-bold icon-btn-success ">
                                <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

<script>
    var $id_venta_para_correo;

    var $today = new Date();
    var $date = $today.getFullYear() + '-0' + ($today.getMonth() + 1) + '-' + $today.getDate();

    $(document).ready(function() {


        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();

        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   B O L E T A S
        ====================================================================================== */
        $('#tbl_boletas tbody').on('click', '.btnEnviarBoletaSunat', function() {
            var data = $('#tbl_boletas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            $fecha_emision = data[3];
            fnc_EnviarBoletaSunat($id_venta, $fecha_emision)
        })

        $('#tbl_boletas tbody').on('click', '.btnImprimirBoleta', function() {
            var data = $('#tbl_boletas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            fnc_ImprimirBoleta($id_venta)
        });

        $('#tbl_boletas tbody').on('click', '.btnAnularBoleta', function() {
            var data = $('#tbl_boletas').DataTable().row($(this).parents('tr')).data();

            $id_venta = data[1];
            $fecha_emision = data[3];
            fnc_AnularBoleta($id_venta, $fecha_emision)
        });

        $('#tbl_boletas tbody').on('click', '.btnEnviarCorreoBoleta', function() {
            var data = $('#tbl_boletas').DataTable().row($(this).parents('tr')).data();
            $id_venta_para_correo = data[1];
            $("#mdlEnviarComprobanteCorreo").modal('show');
        })

        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   B O L E T A S
        ====================================================================================== */


        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   F A C T U R A S
        ====================================================================================== */
        $('#tbl_facturas tbody').on('click', '.btnEnviarFacturaSunat', function() {
            var data = $('#tbl_facturas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            $fecha_emision = data[3];
            fnc_EnviarComprobanteSunat($id_venta, $fecha_emision)
        })

        $('#tbl_facturas tbody').on('click', '.btnImprimirFactura', function() {
            var data = $('#tbl_facturas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            fnc_ImprimirFactura($id_venta)
        })

        $('#tbl_facturas tbody').on('click', '.btnImprimirFacturaA4', function() {
            var data = $('#tbl_facturas').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            fnc_ImprimirFacturaA4($id_venta)
        })

        $('#tbl_facturas tbody').on('click', '.btnEnviarCorreoFactura', function() {
            var data = $('#tbl_facturas').DataTable().row($(this).parents('tr')).data();
            $id_venta_para_correo = data[1];
            $("#mdlEnviarComprobanteCorreo").modal('show');
        })
        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   F A C T U R A S
        ====================================================================================== */


        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   N O T A S   D E   C R E D I T O
        ====================================================================================== */
        $('#tbl_notas_credito tbody').on('click', '.btnImprimirNotaCreditoA4', function() {
            var data = $('#tbl_notas_credito').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            window.open($ruta+'vistas/modulos/impresiones/generar_nota_credito_a4.php?id_venta=' + response["id_venta"], 'fullscreen=yes' + "resizable=0,");
        })

        $('#tbl_notas_credito tbody').on('click', '.btnEnviarCorreoNotaCredito', function() {

            var data = $('#tbl_notas_credito').DataTable().row($(this).parents('tr')).data();
            $id_venta_para_correo = data[1];
            $("#mdlEnviarComprobanteCorreo").modal('show');
        })

        $("#btnEnviarComprobanteCorreo").on("click", function() {
            fnc_EnviarCorreo();
        })
        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   N O T A S   D E   C R E D I T O
        ====================================================================================== */

        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   N O T A S   D E   C R E D I T O
        ====================================================================================== */
        $('#tbl_notas_debito tbody').on('click', '.btnImprimirNotaDebitoA4', function() {
            var data = $('#tbl_notas_debito').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];
            window.open($ruta+'vistas/generar_nota_debito_a4.php?id_venta=' + response["id_venta"], 'fullscreen=yes' + "resizable=0,");
        })

        $('#tbl_notas_debito tbody').on('click', '.btnEnviarCorreoNotaDebito', function() {

            var data = $('#tbl_notas_debito').DataTable().row($(this).parents('tr')).data();
            $id_venta_para_correo = data[1];
            $("#mdlEnviarComprobanteCorreo").modal('show');
        })

        $("#btnEnviarComprobanteCorreo").on("click", function() {
            fnc_EnviarCorreo();
        })
        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   N O T A S   D E   C R E D I T O
        ====================================================================================== */


        /* ======================================================================================
        I N I C I O   E V E N T O S   D A T A T A B L E   N O T A S   D E   V E N T A
        ====================================================================================== */

        $('#tbl_notas_venta tbody').on('click', '.btnImprimirNotaVenta', function() {
            var data = $('#tbl_notas_venta').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];

            window.open($ruta+'vistas/modulos/impresiones/generar_nota_venta_ticket.php?id_venta=' + $id_venta,
                "ModalPopUp",
                "toolbar=no," +
                "scrollbars=no," +
                "location=no," +
                "statusbar=no," +
                "menubar=no," +
                "resizable=0," +
                "width=400," +
                "height=600," +
                "left = 450," +
                "top=200");
        })

        $('#tbl_notas_venta tbody').on('click', '.btnEnviarCorreoNotaVenta', function() {

            var data = $('#tbl_notas_venta').DataTable().row($(this).parents('tr')).data();
            $id_venta_para_correo = data[1];
            $("#mdlEnviarComprobanteCorreo").modal('show');
        })

        $('#tbl_notas_venta tbody').on('click', '.btnAnularNotaVenta', function() {

            var data = $('#tbl_notas_venta').DataTable().row($(this).parents('tr')).data();
            $id_venta = data[1];

            fnc_AnularNotaVenta($id_venta)
        })



        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   N O T A S   D E   V E N T A
        ====================================================================================== */

        // 

    })


    function fnc_InicializarFormulario() {
        fnc_CargarDataTableListadoBoletas();
        fnc_CargarDataTableListadoFacturas();
        fnc_CargarDataTableListadoNotasCredito();
        fnc_CargarDataTableListadoNotasDebito();
        fnc_CargarDataTableListadoNotasVenta();
    }

    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   B O L E T A S
    ====================================================================================== */
    function fnc_CargarDataTableListadoBoletas() {

        if ($.fn.DataTable.isDataTable('#tbl_boletas')) {
            $('#tbl_boletas').DataTable().destroy();
            $('#tbl_boletas tbody').empty();
        }

        $("#tbl_boletas").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
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
                    'accion': 'obtener_listado_boletas'
                },
                type: 'POST'
            },
            scrollX: true,
            scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },

                {
                    targets: [1, 6, 7, 10, 11, 12, 14],
                    visible: false
                },
                {
                    targets: 10,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] != 1) {
                            $(td).parent().css('background', '#F2D7D5')
                            $(td).parent().css('color', 'black')
                        } else {
                            $(td).parent().css('background', '#D4EFDF')
                        }
                    }
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $options = `<div class="btn-group">
                                
                                <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list-alt"></i>
                                </button>

                                <div class="dropdown-menu z-3">
                                    <a class="dropdown-item btnImprimirBoleta" style='cursor:pointer;'><i class='px-1 fas fa-print fs-5 text-secondary'></i> <span class='my-color'>Imprimir Boleta (ticket)</span></a>   `

                        if (rowData[10] == 1) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                                <i class='px-1 fas fa-file-code fs-5 my-color'></i> 
                                                <span class='my-color'> Descargar XML</span>
                                            </a>

                                            <a href='fe/facturas/cdr/R-` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                                <i class='px-1 fas fa-file-code fs-5 text-info'></i> 
                                                <span class='my-color'>Descargar CDR</span>
                                            </a>                                        

                                            <a class = "dropdown-item btnAnularBoleta" style='cursor:pointer;'> 
                                                <i class = 'px-1 fas fa-ban fs-5 text-danger'> </i> 
                                                <span class='my-color'>Anular Boleta</span> 
                                            </a>
                                            
                                            <a class="dropdown-item btnEnviarCorreoBoleta" style='cursor:pointer;'>
                                                <i class='px-1 fas fa-envelope fs-5 text-success'></i> 
                                                <span class='my-color'>Enviar Correo Elec.</span>
                                            </a>`;
                        }

                        if (rowData[10] == 2) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                            <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                                        </a>`;
                        }


                        if (rowData[10] == 0 || rowData[13] == 0 || rowData[10] == 2) {
                            $options = $options + `<a class = "dropdown-item btnEnviarBoletaSunat" style = 'cursor:pointer;'> 
                                                <i class='px-1 fas fa-share-square fs-5 text-warning'> </i> <span class='my-color'>Enviar a Sunat</span > 
                                            </a>`
                        }

                        $options = $options + `</div>
                                    </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 11, //ICONO DE ESTADO SUNAT
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-info fs-5 text-warning' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[14] + "'></i>" +
                                "</center>");
                        } else if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-check-circle fs-5 text-success' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[14] + "'></i>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-window-close fs-5 text-danger' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[14] + "'></i>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-share-square fs-5 text-secondary'  data-bs-toggle='tooltip' data-bs-placement='top' title='Otro estado '></i>" +
                                "</center>");
                        }

                    }
                },
                {
                    targets: 13, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Aceptado Sunat</span>" +
                                "</center>");
                        } else if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Rechazado!... enviado con errores</span>" +
                                "</center>");
                        } else if (rowData[10] == 0) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-warning p-1 px-3'>Anulado en Sunat</span>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        }

                    }
                }

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_boletas"));
    }

    function fnc_EnviarBoletaSunat($id_venta, $fecha_emision) {

        // alert($fecha_emision);

        var start = new Date($fecha_emision),
            end = new Date($date);

        // get days
        diff = new Date(end - start);

        days = diff / 1000 / 60 / 60 / 24;
        console.log("🚀 ~ fnc_GuardarVenta ~ days:", days)

        if (parseInt(days) > parseInt(2)) {
            Swal.fire({
                position: 'top-center',
                icon: "error",
                title: "La fecha de emisión no puede ser mayor a dos dias",
                showConfirmButton: true
            })
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de enviar el comprobante a Sunat?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo enviarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'enviar_comprobante_sunat');
                formData.append('id_venta', $id_venta);

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                $("#tbl_boletas").DataTable().ajax.reload();

            }
        })
    }

    function fnc_ImprimirBoleta($id_venta) {

        window.open($ruta+'vistas/modulos/impresiones/generar_ticket.php?id_venta=' + $id_venta,
            "ModalPopUp",
            "toolbar=no," +
            "scrollbars=no," +
            "location=no," +
            "statusbar=no," +
            "menubar=no," +
            "resizable=0," +
            "width=400," +
            "height=600," +
            "left = 450," +
            "top=200");
    }

    function fnc_AnularBoleta($id_venta, $fecha_emision) {

        Swal.fire({
            title: 'Está seguro(a) de anular el Comprobantes?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo anularlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();

                formData.append('accion', 'anular_boleta');
                formData.append('fecha_emision', $fecha_emision);
                formData.append('condicion', 3);
                formData.append('id_venta', $id_venta)

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                if (response) {
                    Swal.fire({
                        position: 'top-center',
                        icon: response.tipo_msj,
                        title: response.msj,
                        showConfirmButton: true
                    })
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: "Error de Conexión con Sunat",
                        showConfirmButton: true
                    })
                }

                fnc_CargarDataTableListadoBoletas()

            }
        })
    }
    /* ======================================================================================
    F I N   F U N C I O N E S   D A T A T A B L E   B O L E T A S
    ====================================================================================== */


    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   F A C T U R A S
    ====================================================================================== */
    function fnc_CargarDataTableListadoFacturas() {

        if ($.fn.DataTable.isDataTable('#tbl_facturas')) {
            $('#tbl_facturas').DataTable().destroy();
            $('#tbl_facturas tbody').empty();
        }

        $("#tbl_facturas").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
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
                    'accion': 'obtener_listado_facturas'
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
                    targets: [1, 6, 7, 10, 11, 12, 14],
                    visible: false
                },
                {
                    targets: 10,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] != 1) {
                            $(td).parent().css('background', '#F2D7D5')
                            $(td).parent().css('color', 'black')
                        } else {
                            $(td).parent().css('background', '#D4EFDF')
                        }
                    }
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $options = `<div class="btn-group">
                                
                                <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-list-alt"></i>
                                </button>

                                <div class="dropdown-menu z-3">
                                    <a class="dropdown-item btnImprimirFactura" style='cursor:pointer;'><i class='px-1 fas fa-print fs-5 text-secondary'></i> <span class='my-color'>Imprimir Factura (ticket)</span></a>
                                    <a class="dropdown-item btnImprimirFacturaA4" style='cursor:pointer;'><i class='px-1 fas fa-file-pdf fs-5 text-danger'></i> <span class='my-color'>Imprimir Factura (A4)</span></a>`

                        if (rowData[10] == 1) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                                <i class='px-1 fas fa-file-code fs-5 my-color'></i> 
                                                <span class='my-color'> Descargar XML</span>
                                            </a>

                                            <a href='fe/facturas/cdr/R-` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                                <i class='px-1 fas fa-file-code fs-5 text-info'></i> 
                                                <span class='my-color'>Descargar CDR</span>
                                            </a>                                         
                                            
                                            <a class="dropdown-item btnEnviarCorreoFactura" style='cursor:pointer;'>
                                                <i class='px-1 fas fa-envelope fs-5 text-success'></i> 
                                                <span class='my-color'>Enviar Correo Elec.</span>
                                            </a>`;
                        }

                        if (rowData[10] == 2) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[12] + `' download class="dropdown-item " style='cursor:pointer;'>
                                            <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                                        </a>`;
                        }


                        if (rowData[10] == 0 || rowData[13] == 0) {
                            $options = $options + `<a class = "dropdown-item btnEnviarFacturaSunat" style = 'cursor:pointer;'> 
                                                <i class='px-1 fas fa-share-square fs-5 text-warning'> </i> <span class='my-color'>Enviar a Sunat</span > 
                                            </a>
                                        <a class="dropdown-item btnEditarFactura" style = 'cursor:pointer;'> 
                                            <i class='px-1 fas fa-pencil-alt fs-5 text-primary'></i><span class='my-color'>Editar Comprobante</span> 
                                        </a>`
                        }

                        $options = $options + `</div>
                                    </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 11, //ICONO DE ESTADO SUNAT
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-info fs-5 text-warning' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                                "</center>");
                        } else if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-check-circle fs-5 text-success' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-window-close fs-5 text-danger' data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-share-square fs-5 text-secondary'  data-bs-toggle='tooltip' data-bs-placement='top'></i>" +
                                "</center>");
                        }

                    }
                },
                {
                    targets: 13, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Aceptado Sunat</span>" +
                                "</center>");
                        } else if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Rechazado!... enviado con errores</span>" +
                                "</center>");
                        } else if (rowData[10] == 0) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-warning p-1 px-3'>Anulado en Sunat</span>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        }

                    }
                }

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_facturas"));
    }

    function fnc_EnviarFacturaSunat($id_venta) {

        Swal.fire({
            title: 'Está seguro(a) de enviar el comprobante a Sunat?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo enviarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'enviar_comprobante_sunat');
                formData.append('id_venta', $id_venta);

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                $("#tbl_facturas").DataTable().ajax.reload();

            }
        })


    }

    function fnc_ImprimirFactura($id_venta) {
        window.open($ruta+'vistas/modulos/impresiones/generar_ticket.php?id_venta=' + $id_venta,
            "ModalPopUp",
            "toolbar=no," +
            "scrollbars=no," +
            "location=no," +
            "statusbar=no," +
            "menubar=no," +
            "resizable=0," +
            "width=400," +
            "height=600," +
            "left = 450," +
            "top=200");
    }

    function fnc_ImprimirFacturaA4($id_venta) {
        window.open($ruta+'vistas/modulos/impresiones/generar_factura_a4.php?id_venta=' + $id_venta,
            'fullscreen=yes' +
            "resizable=0,"
        );
    }

    function fnc_EnviarCorreo() {

        var formData = new FormData();
        formData.append('accion', 'enviar_email_comprobante');
        formData.append('id_venta', $id_venta_para_correo);
        formData.append('email_destino', $("#email").val());

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

        $id_venta_para_correo = '';
        $("#email").val('')
        $("#mdlEnviarComprobanteCorreo").modal('hide')

        Swal.fire({
            position: 'top-center',
            icon: response.tipo_msj,
            title: response.msj,
            showConfirmButton: true
        })


    }
    /* ======================================================================================
    F I N   F U N C I O N E S   D A T A T A B L E   F A C T U R A S
    ====================================================================================== */

    /* ======================================================================================
    I N I C I O   D A T A T A B L E   N O T A S   D E   C R E D I T O
    ====================================================================================== */
    function fnc_CargarDataTableListadoNotasCredito() {

        if ($.fn.DataTable.isDataTable('#tbl_notas_credito')) {
            $('#tbl_notas_credito').DataTable().destroy();
            $('#tbl_notas_credito tbody').empty();
        }

        $("#tbl_notas_credito").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
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
                    'accion': 'obtener_listado_notas_credito'
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
                    targets: [1, 6, 7, 8, 9, 12, 14, 15, 16],
                    visible: false
                },
                // {
                //     targets: 9,
                //     createdCell: function(td, cellData, rowData, row, col) {

                //         if (rowData[9] != 1) {
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
                            <a class="dropdown-item btnImprimirNotaCreditoA4" style='cursor:pointer;'><i class='px-1 fas fa-file-pdf fs-5 text-danger'></i> <span class='my-color'>Imprimir Factura (A4)</span></a>`

                        if (rowData[12] == 1) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                                        <i class='px-1 fas fa-file-code fs-5 my-color'></i> 
                                        <span class='my-color'> Descargar XML</span>
                                    </a>

                                    <a href='fe/facturas/cdr/R-` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                                        <i class='px-1 fas fa-file-code fs-5 text-info'></i> 
                                        <span class='my-color'>Descargar CDR</span>
                                    </a>                                    
                                    
                                    <a class="dropdown-item btnEnviarCorreoNotaCredito" style='cursor:pointer;'>
                                        <i class='px-1 fas fa-envelope fs-5 text-success'></i> 
                                        <span class='my-color'>Enviar Correo Elec.</span>
                                    </a>`;
                        }

                        if (rowData[12] == 2) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                                    <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                                </a>`;
                        }


                        if (rowData[12] == 0 || rowData[15] == 0) {
                            $options = $options + `<a class = "dropdown-item btnEnviarNotaCreditoSunat" style = 'cursor:pointer;'> 
                                        <i class='px-1 fas fa-share-square fs-5 text-warning'> </i> <span class='my-color'>Enviar a Sunat</span > 
                                    </a>`
                        }

                        $options = $options + `</div>
                            </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 13, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Aceptado Sunat</span>" +
                                "</center>");
                        } else if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Rechazado!... enviado con errores</span>" +
                                "</center>");
                        } else if (rowData[10] == 0) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-warning p-1 px-3'>Anulado en Sunat</span>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        }

                    }
                }
            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_notas_credito"));
    }

    /* ======================================================================================
    F I N   D A T A T A B L E   N O T A S   D E   C R E D I T O
    ====================================================================================== */

    /* ======================================================================================
    I N I C I O   D A T A T A B L E   N O T A S   D E   D E B I T O
    ====================================================================================== */

    function fnc_CargarDataTableListadoNotasDebito() {

        if ($.fn.DataTable.isDataTable('#tbl_notas_debito')) {
            $('#tbl_notas_debito').DataTable().destroy();
            $('#tbl_notas_debito tbody').empty();
        }

        $("#tbl_notas_debito").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
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
                    'accion': 'obtener_listado_notas_debito'
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
                    targets: [1, 6, 7, 8, 9, 12, 14, 15, 16],
                    visible: false
                },
                // {
                //     targets: 9,
                //     createdCell: function(td, cellData, rowData, row, col) {

                //         if (rowData[9] != 1) {
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
                    <a class="dropdown-item btnImprimirNotaDebitoA4" style='cursor:pointer;'><i class='px-1 fas fa-file-pdf fs-5 text-danger'></i> <span class='my-color'>Imprimir Nota Débito (A4)</span></a>`

                        if (rowData[12] == 1) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                                <i class='px-1 fas fa-file-code fs-5 my-color'></i> 
                                <span class='my-color'> Descargar XML</span>
                            </a>

                            <a href='fe/facturas/cdr/R-` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                                <i class='px-1 fas fa-file-code fs-5 text-info'></i> 
                                <span class='my-color'>Descargar CDR</span>
                            </a>                                    
                            
                            <a class="dropdown-item btnEnviarCorreoNotaDebito" style='cursor:pointer;'>
                                <i class='px-1 fas fa-envelope fs-5 text-success'></i> 
                                <span class='my-color'>Enviar Correo Elec.</span>
                            </a>`;
                        }

                        if (rowData[12] == 2) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[14] + `' download class="dropdown-item " style='cursor:pointer;'>
                            <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                        </a>`;
                        }


                        if (rowData[12] == 0 || rowData[15] == 0) {
                            $options = $options + `<a class = "dropdown-item btnEnviarNotaDebitoSunat" style = 'cursor:pointer;'> 
                                <i class='px-1 fas fa-share-square fs-5 text-warning'> </i> <span class='my-color'>Enviar a Sunat</span > 
                            </a>`
                        }

                        $options = $options + `</div>
                    </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 13, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Aceptado Sunat</span>" +
                                "</center>");
                        } else if (rowData[10] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Rechazado!... enviado con errores</span>" +
                                "</center>");
                        } else if (rowData[10] == 0) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        } else if (rowData[10] == 3) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-warning p-1 px-3'>Anulado en Sunat</span>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-secondary p-1 px-3'>Pendiente de envío</span>" +
                                "</center>");
                        }

                    }
                }
            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_notas_debito"));
    }

    /* ======================================================================================
    F I N   D A T A T A B L E   N O T A S   D E   D E B I T O
    ====================================================================================== */

    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   N O T A S   D E   V E N T A
    ====================================================================================== */

    function fnc_CargarDataTableListadoNotasVenta() {

        if ($.fn.DataTable.isDataTable('#tbl_notas_venta')) {
            $('#tbl_notas_venta').DataTable().destroy();
            $('#tbl_notas_venta tbody').empty();
        }

        $("#tbl_notas_venta").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE BOLETAS';
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
                    'accion': 'obtener_listado_notas_venta'
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
                    targets: [1],
                    visible: false
                },
                // {
                //     targets: 9,
                //     createdCell: function(td, cellData, rowData, row, col) {

                //         if (rowData[9] != 1) {
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
                            <a class="dropdown-item btnImprimirNotaVenta" style='cursor:pointer;'><i class='px-1 fas fa-print fs-5 text-secondary'></i> <span class='my-color'>Imprimir Nota de Venta (ticket)</span></a>`

                        if (rowData[9] == 1) {

                            $options = $options + `

                                    <a class = "dropdown-item btnAnularNotaVenta" style='cursor:pointer;'> 
                                        <i class = 'px-1 fas fa-ban fs-5 text-danger'> </i> 
                                        <span class='my-color'>Anular Nota de Venta</span> 
                                    </a>
                                    
                                    <a class="dropdown-item btnEnviarCorreoNotaVenta" style='cursor:pointer;'>
                                        <i class='px-1 fas fa-envelope fs-5 text-success'></i> 
                                        <span class='my-color'>Enviar Correo Elec.</span>
                                    </a>`;
                        }

                        $options = $options + `</div>
                            </div>`;

                        $(td).html($options)
                    }
                },

                {
                    targets: 9, // ESTADO SUNAT DEL COMPROBANTE
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[9] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Registrado</span>" +
                                "</center>");
                        } else if (rowData[9] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Anulado</span>" +
                                "</center>");
                        }

                    }
                }

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_notas_venta"));
    }

    function fnc_AnularNotaVenta($id_venta, $fecha_emision) {

        Swal.fire({
            title: 'Está seguro(a) de anular la Nota de Venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo anularla!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();

                formData.append('accion', 'anular_nota_venta');
                formData.append('id_venta', $id_venta)

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);


                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })


                fnc_CargarDataTableListadoNotasVenta()

            }
        })
    }

    function fnc_EnviarComprobanteSunat($id_venta, $fecha_emision) {

        var start = new Date($fecha_emision),
            end = new Date($date);

        // get days
        diff = new Date(end - start);

        days = diff / 1000 / 60 / 60 / 24;
        console.log("🚀 ~ fnc_GuardarVenta ~ days:", days)

        if (parseInt(days) > parseInt(2)) {
            Swal.fire({
                position: 'top-center',
                icon: "error",
                title: "La fecha de emisión no puede ser mayor a dos dias",
                showConfirmButton: true
            })
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de enviar el comprobante a Sunat?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo enviarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'enviar_comprobante_sunat');
                formData.append('id_venta', $id_venta);

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                $("#tbl_facturas").DataTable().ajax.reload();

            }
        })


    }

    /* ======================================================================================
    F I N   F U N C I O N E S   D A T A T A B L E   N O T A S   D E   V E N T A
    ====================================================================================== */
</script>