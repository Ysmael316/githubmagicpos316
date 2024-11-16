<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">CONFIGURACIONES</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Configuraciones</li>
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

                        <!-- TAB  -->
                        <li class="nav-item">
                            <a class="nav-link active my-0" id="servidor-correo-tab" data-toggle="pill" href="#servidor-correo" role="tab" aria-controls="servidor-correo" aria-selected="false"><i class="fas fa-list"></i> Servidor Correo</a>
                        </li>

                        <!-- TAB  -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="modo-facturacion-tab" data-toggle="pill" href="#modo-facturacion" role="tab" aria-controls="modo-facturacion" aria-selected="true"><i class="fas fa-list"></i> Modo Facturación</a>
                        </li>

                        <!-- TAB  -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="modo-guia-remision-tab" data-toggle="pill" href="#modo-guia-remision" role="tab" aria-controls="modo-guia-remision" aria-selected="true"><i class="fas fa-list"></i> Modo Guía Remisión</a>
                        </li>

                        <!-- TAB  -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="usuario-sol-tab" data-toggle="pill" href="#usuario-sol" role="tab" aria-controls="usuario-sol" aria-selected="true"><i class="fas fa-list"></i> Usuario Sol Secundario</a>
                        </li>

                    </ul>

                </div>

                <div class="card-body py-1">

                    <div class="tab-content" id="custom-tabs-comprobantesContent">

                        <!-- SERVIDOR CORREO -->
                        <div class="tab-pane fade active show" id="servidor-correo" role="tabpanel" aria-labelledby="servidor-correo-tab">

                            <div class="row my-2">

                                <div class="col-md-12">

                                    <table id="tbl_configuraciones_correo" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Código</th>
                                            <th>Ordinal</th>
                                            <th>Llave</th>
                                            <th>Valor</th>
                                        </thead>
                                    </table>

                                </div>
                            </div>

                        </div>

                        <!-- MODO FACTURACION -->
                        <div class="tab-pane fade" id="modo-facturacion" role="tabpanel" aria-labelledby="modo-facturacion-tab">

                            <div class="row my-2">

                                <div class="col-md-12">

                                    <table id="tbl_configuraciones_modo_facturacion" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Código</th>
                                            <th>Ordinal</th>
                                            <th>Llave</th>
                                            <th>Valor</th>
                                        </thead>
                                    </table>

                                </div>
                            </div>

                        </div>

                        <!-- MODO GUIAS REMISION -->
                        <div class="tab-pane fade" id="modo-guia-remision" role="tabpanel" aria-labelledby="modo-guia-remision-tab">

                            <div class="row my-2">

                                <div class="col-md-12">

                                    <table id="tbl_configuraciones_modo_guia_remision" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Código</th>
                                            <th>Ordinal</th>
                                            <th>Llave</th>
                                            <th>Valor</th>
                                        </thead>
                                    </table>

                                </div>
                            </div>

                        </div>

                        <!-- USUARIO SOL SECUNDARIO -->
                        <div class="tab-pane fade" id="usuario-sol" role="tabpanel" aria-labelledby="usuario-sol-tab">

                            <div class="row my-2">

                                <div class="col-md-12">

                                    <table id="tbl_configuraciones_usuario_sol" class="table shadow border border-secondary" style="width:100%">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>Código</th>
                                            <th>Ordinal</th>
                                            <th>Llave</th>
                                            <th>Valor</th>
                                        </thead>
                                    </table>

                                </div>
                            </div>

                        </div>



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
<div class="modal fade" id="mdlEditarConfiguracion" role="dialog" tabindex="-1">

    <div class="modal-dialog modal-md" role="document">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Editar Configuración</h5>

                <button type="button" class="text-white m-0 px-1 badge badge-pill badge-danger " data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-white"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <form id="frm-datos-correo" class="needs-validation-correo" novalidate>
                    <div class="row mb-2">

                        <!-- EMAIL -->
                        <div class="col-12 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Código</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="codigo" name="codigo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>

                        </div>

                        <div class="col-12 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Ordinal</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="ordinal" name="ordinal" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>

                        </div>

                        <div class="col-12 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="llave" name="llave" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>

                        </div>

                        <div class="col-12 mb-2 col-valor">
                        </div>

                    </div>

                    <div class="row mt-3">

                        <div class="col-12 text-center">

                            <a class="btn btn-sm btn-success fw-bold " id="btnGuardar" style="position: relative; width: 200px;">
                                <span class="text-button">GUARDAR</span>
                                <span class="btn fw-bold icon-btn-success ">
                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>

                        </div>

                    </div>
                </form>
            </div>


        </div>

    </div>

</div>

<script>
    $(document).ready(function() {

        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();


        $('#tbl_configuraciones_correo tbody').on('click', '.btnEditarConfiguracion', function() {

            var data = $('#tbl_configuraciones_correo').DataTable().row($(this).parents('tr')).data();

            $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="valor" name="valor" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="invalid-feedback">Ingrese el valor</div>`)

            $("#codigo").val(data["id"])
            $("#ordinal").val(data["ordinal"])
            $("#llave").val(data["llave"])
            $("#valor").val(data["valor"])

            $("#mdlEditarConfiguracion").modal('show');
            // $id_venta = data[1];

            // fnc_AnularNotaVenta($id_venta)
        })

        $('#tbl_configuraciones_modo_facturacion tbody').on('click', '.btnEditarConfiguracionFacturacion', function() {

            var data = $('#tbl_configuraciones_modo_facturacion').DataTable().row($(this).parents('tr')).data();

            $("#codigo").val(data["id"])
            $("#ordinal").val(data["ordinal"])
            $("#llave").val(data["llave"])
            if (data["ordinal"] != 3) {

                $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="valor" name="valor" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="invalid-feedback">Ingrese el valor</div>`)

            } else {

                $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                                    <select class="form-select" id="valor" name="valor" aria-label="Floating label select example" required>
                                        <option value="" disabled>--Seleccione un valor--</option>
                                        <option value="DESARROLLO" selected>DESARROLLO</option>
                                        <option value="PRODUCCION">PRODUCCION</option>
                                    </select>
                                    <div class="invalid-feedback">Seleccione el valor</div>`)
            }

            $("#valor").val(data["valor"])

            $("#mdlEditarConfiguracion").modal('show');

        })

        $('#tbl_configuraciones_modo_guia_remision tbody').on('click', '.btnEditarConfiguracionGuiaRemision', function() {

            var data = $('#tbl_configuraciones_modo_guia_remision').DataTable().row($(this).parents('tr')).data();

            $("#codigo").val(data["id"])
            $("#ordinal").val(data["ordinal"])
            $("#llave").val(data["llave"])
            if (data["ordinal"] != 9) {

                $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="valor" name="valor" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                <div class="invalid-feedback">Ingrese el valor</div>`)

            } else {

                $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                        <select class="form-select" id="valor" name="valor" aria-label="Floating label select example" required>
                            <option value="" disabled>--Seleccione un valor--</option>
                            <option value="DESARROLLO" selected>DESARROLLO</option>
                            <option value="PRODUCCION">PRODUCCION</option>
                        </select>
                        <div class="invalid-feedback">Seleccione el valor</div>`)
            }

            $("#valor").val(data["valor"])

            $("#mdlEditarConfiguracion").modal('show');

        })

        $('#tbl_configuraciones_usuario_sol tbody').on('click', '.btnEditarConfiguracionUsuarioSol', function() {

            var data = $('#tbl_configuraciones_usuario_sol').DataTable().row($(this).parents('tr')).data();

            $(".col-valor").html(`<label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Llave</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="valor" name="valor" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="invalid-feedback">Ingrese el valor</div>`)

            $("#codigo").val(data["id"])
            $("#ordinal").val(data["ordinal"])
            $("#llave").val(data["llave"])
            $("#valor").val(data["valor"])

            $("#mdlEditarConfiguracion").modal('show');
        })

        $("#btnGuardar").on('click', function() {
            fnc_GuardarDatos();
        })

    })

    function fnc_InicializarFormulario() {
        fnc_CargarDataTableCorreo();
        fnc_CargarDataTableModoFacturacion();
        fnc_CargarDataTableModoGuiaRemision();
        fnc_CargarDataTableUsuarioSol();

    }

    /* ======================================================================================
    I N I C I O   F U N C I O N E S   D A T A T A B L E   B O L E T A S
    ====================================================================================== */
    function fnc_CargarDataTableCorreo() {

        if ($.fn.DataTable.isDataTable('#tbl_configuraciones_correo')) {
            $('#tbl_configuraciones_correo').DataTable().destroy();
            $('#tbl_configuraciones_correo tbody').empty();
        }

        $("#tbl_configuraciones_correo").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: 'ajax/configuraciones.ajax.php',
                dataSrc: '',
                data: {
                    'accion': 'obtener_configuracion_correo'
                },
                type: 'POST'
            },
            scrollX: true,
            // scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (rowData["ordinal"] > 0) {
                            $options = `<center>
                                        <span class='btnEditarConfiguracion text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Configuración'> 
                                            <i class='fas fa-pencil-alt fs-5'></i> 
                                        </span>
                                    </center>`;

                            $(td).html($options)
                        }

                    }
                },

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_configuraciones_correo"));
    }

    function fnc_CargarDataTableModoFacturacion() {

        if ($.fn.DataTable.isDataTable('#tbl_configuraciones_modo_facturacion')) {
            $('#tbl_configuraciones_modo_facturacion').DataTable().destroy();
            $('#tbl_configuraciones_modo_facturacion tbody').empty();
        }

        $("#tbl_configuraciones_modo_facturacion").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: 'ajax/configuraciones.ajax.php',
                dataSrc: '',
                data: {
                    'accion': 'obtener_configuracion_modo_facturacion'
                },
                type: 'POST'
            },
            scrollX: true,
            // scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        codigo = rowData['id'];
                        ordinal = rowData['ordinal'];
                        llave = rowData['llave'];
                        valor = rowData['valor'];

                        if (rowData["ordinal"] > 0) {
                            $options = `<center>
                                <span class='btnEditarConfiguracionFacturacion text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Configuración'  > 
                                    <i class='fas fa-pencil-alt fs-5'></i> 
                                </span>
                            </center>`;

                            $(td).html($options)
                        }

                    }
                },

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_configuraciones_modo_facturacion"));
    }

    function fnc_CargarDataTableModoGuiaRemision() {

        if ($.fn.DataTable.isDataTable('#tbl_configuraciones_modo_guia_remision')) {
            $('#tbl_configuraciones_modo_guia_remision').DataTable().destroy();
            $('#tbl_configuraciones_modo_guia_remision tbody').empty();
        }

        $("#tbl_configuraciones_modo_guia_remision").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: 'ajax/configuraciones.ajax.php',
                dataSrc: '',
                data: {
                    'accion': 'obtener_configuracion_modo_guia_remision'
                },
                type: 'POST'
            },
            scrollX: true,
            // scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        codigo = rowData['id'];
                        ordinal = rowData['ordinal'];
                        llave = rowData['llave'];
                        valor = rowData['valor'];

                        if (rowData["ordinal"] > 0) {
                            $options = `<center>
                        <span class='btnEditarConfiguracionGuiaRemision text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Configuración'  > 
                            <i class='fas fa-pencil-alt fs-5'></i> 
                        </span>
                    </center>`;

                            $(td).html($options)
                        }

                    }
                },

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_configuraciones_modo_guia_remision"));
    }

    function fnc_CargarDataTableUsuarioSol() {

        if ($.fn.DataTable.isDataTable('#tbl_configuraciones_usuario_sol')) {
            $('#tbl_configuraciones_usuario_sol').DataTable().destroy();
            $('#tbl_configuraciones_usuario_sol tbody').empty();
        }

        $("#tbl_configuraciones_usuario_sol").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: 'ajax/configuraciones.ajax.php',
                dataSrc: '',
                data: {
                    'accion': 'obtener_configuracion_usuario_sol'
                },
                type: 'POST'
            },
            scrollX: true,
            // scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        codigo = rowData['id'];
                        ordinal = rowData['ordinal'];
                        llave = rowData['llave'];
                        valor = rowData['valor'];

                        if (rowData["ordinal"] > 0) {
                            $options = `<center>
                                            <span class='btnEditarConfiguracionUsuarioSol text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Configuración'  > 
                                                <i class='fas fa-pencil-alt fs-5'></i> 
                                            </span>
                                        </center>`;

                            $(td).html($options)
                        }

                    }
                },

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_configuraciones_usuario_sol"));
    }

    function fnc_GuardarDatos() {

        form_correo_validate = validarFormulario('needs-validation-correo');

        //INICIO DE LAS VALIDACIONES
        if (!form_correo_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de guardar los datos?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!',
            cancelButtonText: 'No',
        }).then((result) => {

            if (result.isConfirmed) {


                var formData = new FormData();

                formData.append('accion', 'actualizar_configuracion_correo');
                formData.append('datos_correo', $("#frm-datos-correo").serialize());

                response = SolicitudAjax('ajax/configuraciones.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true
                });

                $("#tbl_configuraciones_correo").DataTable().ajax.reload();
                $("#tbl_configuraciones_modo_facturacion").DataTable().ajax.reload();
                $("#tbl_configuraciones_usuario_sol").DataTable().ajax.reload();
                $("#mdlEditarConfiguracion").modal('hide');
                // fnc_LimpiarFomulario();

            }

        })

    }

    function fnc_ShowModalEditarModoFacturacion($codigo, $ordinal, $llave, $valor) {
        alert($llave)
    }
</script>