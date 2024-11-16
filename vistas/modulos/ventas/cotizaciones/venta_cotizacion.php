<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">COTIZACIONES</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Cotizaciones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content" style="position: relative;">

    <input type="hidden" name="id_caja" id="id_caja" value="0">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">LISTADO DE COTIZACIONES </span>

                <div class="row my-3">

                    <div class="col-12">
                        <table id="tbl_cotizaciones" class="table table-striped w-100 shadow responsive border border-secondary">
                            <thead class="bg-main text-left">
                                <th></th>
                                <th></th>
                                <th>Id</th>
                                <th>Id Serie</th>
                                <th>Serie</th>
                                <th>Correlativo</th>
                                <th>Comprobante</th>
                                <th>Fecha Cotización</th>
                                <th>Cliente</th>
                                <th>Importe Total</th>
                                <th>Estado</th>
                                <th>Fecha Expiración</th>
                                <th>Moneda</th>
                                <th>Tipo Cambio</th>
                                <th>Cod. Cliente</th>
                                <th>Ope. Grav.</th>
                                <th>Ope. Exo.</th>
                                <th>Ope. Ina.</th>
                                <th>IGV</th>
                                <th>Cod. Usuario</th>
                                <th>Usuario</th>
                                <th>Comprobante a Generar</th>
                            </thead>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

<div class="loading">Loading</div>

<script>
    //Variables Globales
    var itemProducto = 1;
    var $simbolo_moneda = '';
    var $tipo_cambio = 1.000;

    $(document).ready(function() {

        fnc_MostrarLoader()

        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();

        /*===================================================================*/
        // V E R I F I C A R   E M P R E S A S   R E G I S T R A D A S
        /*===================================================================*/
        fnc_VerificarEmpresasRegistradas();

        /*===================================================================*/
        // INICIO EVENTOS DATATABLE COTIZACIONES
        /*===================================================================*/
        // $('#tbl_cotizaciones tbody').on('click', '.btnEditarCotizacion', function() {
        //     $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
        //     fnc_EditarCotizacion($id_cotizacion);
        // });

        $('#tbl_cotizaciones tbody').on('click', '.btnEliminarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_EliminarCotizacion($id_cotizacion);
        });

        // $('#tbl_cotizaciones tbody').on('click', '.btnConsultarCotizacion', function() {
        //     $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
        //     fnc_ConsultarCotizacion($id_cotizacion);
        // });

        // $('#tbl_cotizaciones tbody').on('click', '.btnGenerarBoleta', function() {

        //     /*===================================================================*/
        //     // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
        //     /*===================================================================*/
        //     if (fnc_ObtenerEstadoCajaPorDia()) {
        //         $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
        //         fnc_GenerarBoleta($id_cotizacion);
        //     }

        // });

        // $('#tbl_cotizaciones tbody').on('click', '.btnGenerarFactura', function() {
        //     /*===================================================================*/
        //     // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
        //     /*===================================================================*/
        //     if (fnc_ObtenerEstadoCajaPorDia()) {
        //         $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
        //         fnc_GenerarFactura($id_cotizacion);
        //     }

        // });

        $('#tbl_cotizaciones tbody').on('click', '.btnConfirmarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_ConfirmarCotizacion($id_cotizacion);
        });

        $('#tbl_cotizaciones tbody').on('click', '.btnImprimirCotizacionA4', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_ImprimirCotizacionA4($id_cotizacion)
        })
        /*===================================================================*/
        // FIN EVENTOS DATATABLE COTIZACIONES
        /*===================================================================*/

        fnc_OcultarLoader();

    })


    function fnc_InicializarFormulario() {
        fnc_CargarDataTableListadoCotizaciones();
    }

    function fnc_VerificarEmpresasRegistradas() {

        var datos = new FormData();
        datos.append('accion', 'verificar_empresas_registradas');

        response = SolicitudAjax('ajax/empresas.ajax.php', 'POST', datos)

        //CUANDO LA CAJA ESTA CERRADA
        if (response['cantidad'] == '0') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe registrar la Empresa del Negocio',
                showConfirmButton: true
            })
            $(".nav-link").removeClass('active');
            $(this).addClass('active');

            // CargarContenido('vistas/modulos/administracion/administrar_empresas.php', 'content-wrapper');

            // $(".content-wrapper").fadeOut('slow', function() {
            //     $(".content-wrapper").load('vistas/modulos/administracion/administrar_empresas.php',
            //         function() {
            //             $(".content-wrapper").fadeIn(60);

            //         },
            //     );
            // })
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/administracion/administrar_empresas.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);
                    },
                );
            })
            return false;

        }
    }

    function fnc_ObtenerEstadoCajaPorDia() {

        var datos = new FormData();
        datos.append('accion', 'obtener_estado_caja_por_dia');

        response = SolicitudAjax('ajax/arqueo_caja.ajax.php', 'POST', datos)

        //CUANDO LA CAJA ESTA CERRADA
        if (response['cantidad'] == '0' || response['estado'] == '0') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe aperturar la caja',
                showConfirmButton: true
            })
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
            // CargarContenido('vistas/caja.php', 'content-wrapper');
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/caja/caja.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);

                    },
                );
            })

            return false;

        } else {
            $("#id_caja").val(response["id"]);
            return true;
        }
    }

    /*===================================================================*/
    // C A R G A R   D A T A T A B L E   D E   C O T I Z A C I O N E S
    /*===================================================================*/
    function fnc_CargarDataTableListadoCotizaciones() {

        if ($.fn.DataTable.isDataTable('#tbl_cotizaciones')) {
            $('#tbl_cotizaciones').DataTable().destroy();
            $('#tbl_cotizaciones tbody').empty();
        }

        $("#tbl_cotizaciones").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Registrar Cotización',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        CargarContenido('vistas/modulos/ventas/cotizaciones/modulos/registrar_cotizacion.php', 'content-wrapper')
                    }
                },
                {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE COTIZACIONES';
                        return printTitle
                    }
                }, 'pageLength'
            ],
            // autoWidth: true,
            // scrollX: true,
            // scrollY: "50vh",
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/cotizaciones.ajax.php',
                data: {
                    'accion': 'obtener_listado_cotizaciones'
                },
                type: 'POST'
            },
            autoWidth: false,
            columnDefs: [{
                    className: 'control',
                    orderable: false,
                    targets: 0
                },
                {
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [3, 5, 6, 14],
                    visible: false
                },
                {
                    targets: 10,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[10] == '0') {
                            $(td).html('<span class="bg-primary px-2  rounded-pill fw-bold">REGISTRADA</span>')
                        }

                        if (rowData[10] == '1') {
                            $(td).html('<span class="bg-success px-2  rounded-pill fw-bold text-white">CONFIRMADA</span>')
                        }

                        if (rowData[10] == '2') {
                            $(td).html('<span class="bg-secondary px-2  rounded-pill fw-bold text-white">CERRADA</span>')
                        }
                    }
                },
                {
                    targets: 1,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $options = ``;

                        $options = $options + `<div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cogs"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        
                                            <a class="dropdown-item btnConsultarCotizacion" style='cursor:pointer;' onclick="fnc_ConsultarCotizacion(` + rowData[2] + `)">
                                                <i class='fas fa-search fs-5 mr-2 text-secondary'></i>
                                                <span class='my-color'>Consultar</span>
                                            </a>`;

                        if (rowData[10] == '0' || rowData[10] == '1') { //0: Registrado, 1: Confirmado
                            $options = $options + `<a class="dropdown-item btnEditarCotizacion" style='cursor:pointer;' onclick="fnc_IrActualizarCotizacion(` + rowData[2] + `)">
                                                    <i class='fas fa-pencil-alt fs-5 text-primary mr-2'></i> 
                                                    <span class='my-color'>Actualizar</span>
                                                </a>
                                                <a class="dropdown-item btnEliminarCotizacion" style='cursor:pointer;'>
                                                    <i class='fas fa-trash fs-5 text-danger mr-2'> </i> 
                                                    <span class='my-color'>Eliminar</span>
                                                </a>`;
                        }

                        if (rowData[10] == '0') { //0: Registrado,
                            $options = $options + `<a class="dropdown-item btnConfirmarCotizacion" style='cursor:pointer;'>
                                                    <i class='fas fa-check-double fs-5 text-success mr-2'> </i> 
                                                    <span class='my-color'>Confirmar</span>
                                                </a>`
                        }



                        $options = $options + `<a class="dropdown-item btnImprimirCotizacionA4" style='cursor:pointer;'>
                                                <i class='fas fa-file-pdf fs-5 mr-2 text-info'></i> 
                                                <span class='my-color'>Imprimir (A4)</span>
                                            </a>`;


                        if (rowData[10] == '1' && rowData[21] == "BOLETA") {
                            $options = $options + `<a class="dropdown-item btnGenerarComprobante" style='cursor:pointer;' onclick="fnc_GenerarComprobanteCotizacion(` + rowData[2] + `,'` + rowData[21] + `')">
                                                    <i class='fas fa-file-invoice fs-5 text-warning mr-2'> </i> 
                                                    <span class='my-color'>Generar Boleta</span>
                                                </a>`;
                        }

                        if (rowData[10] == '1' && rowData[21] == "FACTURA") {
                            $options = $options + `<a class="dropdown-item btnGenerarFactura" style='cursor:pointer;' 
                                                        onclick="fnc_GenerarComprobanteCotizacion(` + rowData[2] + `,'` + rowData[21] + `')">
                                                        <i class='fas fa-file-invoice fs-5 text-warning mr-2'> </i> 
                                                        <span class='my-color'>Generar Factura</span>
                                                    </a>`;
                        }

                        $options = $options + `</div>
                                            </div>`;

                        $(td).html($options);

                    }
                },




            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })

        ajustarHeadersDataTables($("#tbl_cotizaciones"))

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

    // function fnc_ConsultarCotizacion($id_cotizacion) {

    //     //ACTIVAR PANE REGISTRO DE PROVEEDORES:
    //     $("#registrar-cotizacion-tab").addClass('active')
    //     $("#registrar-cotizacion-tab").attr('aria-selected', true)
    //     $("#registrar-cotizacion").addClass('active show')

    //     //DESACTIVAR PANE LISTADO DE PROVEEDORES:
    //     $("#listado-cotizaciones-tab").removeClass('active')
    //     $("#listado-cotizaciones-tab").attr('aria-selected', false)
    //     $("#listado-cotizaciones").removeClass('active show');

    //     $("#registrar-cotizacion-tab").html('<i class="fas fa-search"></i> Consultar Cotización')

    //     $("#id_cotizacion").val($id_cotizacion)

    //     var formDataCotizacion = new FormData();
    //     formDataCotizacion.append('accion', 'obtener_cotizacion_x_id');
    //     formDataCotizacion.append('id_cotizacion', $id_cotizacion);

    //     $cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataCotizacion);

    //     //SETEAR DATOS DE LA COTIZACION
    //     $("#empresa_emisora").val($cotizacion.id_empresa_emisora)
    //     $("#fecha_emision").val($cotizacion.fecha_cotizacion)
    //     $("#fecha_expiracion").val($cotizacion.fecha_expiracion)
    //     $("#serie").val($cotizacion.id_serie).trigger('change')
    //     $("#serie").attr('readonly', true)
    //     $("#correlativo").val($cotizacion.correlativo)
    //     $("#moneda").val($cotizacion.id_moneda).trigger('change');
    //     $("#tipo_cambio").val($cotizacion.tipo_cambio)
    //     $("#tipo_comprobante_a_generar").val($cotizacion.comprobante_a_generar)

    //     //SETEAR DATOS DEL CLIENTE
    //     $("#tipo_documento").val($cotizacion.id_tipo_documento)
    //     $("#nro_documento").val($cotizacion.nro_documento)
    //     $("#nombre_cliente_razon_social").val($cotizacion.nombres_apellidos_razon_social)
    //     $("#direccion").val($cotizacion.direccion)
    //     $("#telefono").val($cotizacion.telefono)

    //     //SETEAR PRODUCTOS DE LA COTIZACION
    //     var formDataDetalleCotizacion = new FormData();
    //     formDataDetalleCotizacion.append('accion', 'obtener_detalle_cotizacion_x_id');
    //     formDataDetalleCotizacion.append('id_cotizacion', $id_cotizacion);

    //     $detalle_cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataDetalleCotizacion);

    //     for (let index = 0; index < $detalle_cotizacion.length; index++) {

    //         const $producto = $detalle_cotizacion[index];

    //         $('#tbl_ListadoProductos').DataTable().row.add({
    //             'id': $producto.item,
    //             'codigo_producto': $producto.codigo_producto,
    //             'descripcion': $producto.descripcion,
    //             'id_tipo_igv': $producto.id_tipo_afectacion_igv,
    //             'tipo_igv': $producto.tipo_afectacion_igv,
    //             'unidad_medida': $producto.unidad_medida,
    //             'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
    //                 $.trim($producto.codigo_producto) + ` value=` + $producto.precio_unitario_con_igv + `>`,
    //             'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
    //                 $.trim($producto.codigo_producto) + ` value="` + $producto.cantidad + `">`,
    //             'subtotal': parseFloat($producto.precio_unitario_sin_igv * $producto.cantidad).toFixed(2),
    //             'igv': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad * $producto.porcentaje_igv)).toFixed(2),
    //             'importe': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad) * $producto.factor_igv).toFixed(2),
    //             'acciones': "<center>" +
    //                 "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
    //                 "<i class='fas fa-trash fs-5'> </i> " +
    //                 "</span>" +
    //                 "</center>"
    //         }).draw();

    //     }

    //     recalcularTotales();

    //     $("#frm-datos-cotizacion").addClass("my-disabled");
    // }

    function fnc_GenerarBoleta($id_cotizacion) {

        Swal.fire({
            title: 'Está seguro(a) de generar la Boleta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Generar Boleta!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {
                var formDataCotizacion = new FormData();
                formDataCotizacion.append('accion', 'generar_boleta_cotizacion');
                formDataCotizacion.append('id_cotizacion', $id_cotizacion);
                formDataCotizacion.append('id_caja', $("#id_caja").val());

                response = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataCotizacion);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                window.open($ruta+'vistas/modulos/impresiones/generar_ticket.php?id_venta=' + response["id_venta"],
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

                fnc_InicializarFormulario();
            }
        })

    }

    function fnc_ObtenerEstadoCajaPorDia() {

        var datos = new FormData();
        datos.append('accion', 'obtener_estado_caja_por_dia');

        response = SolicitudAjax('ajax/arqueo_caja.ajax.php', 'POST', datos)

        //CUANDO LA CAJA ESTA CERRADA
        if (response['cantidad'] == '0' || response['estado'] == '0') {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'Debe aperturar la caja',
                showConfirmButton: true
            })
            $(".nav-link").removeClass('active');
            $(this).addClass('active');
            // CargarContenido('vistas/caja.php', 'content-wrapper');
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/caja/caja.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);

                    },
                );
            })

            return false;

        } else {
            $("#id_caja").val(response["id"]);
            return true;
        }
    }

    function fnc_GenerarFactura($id_cotizacion) {

        Swal.fire({
            title: 'Está seguro(a) de generar la Factura?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Generar Factura!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {
                var formDataCotizacion = new FormData();
                formDataCotizacion.append('accion', 'generar_factura_cotizacion');
                formDataCotizacion.append('id_cotizacion', $id_cotizacion);
                formDataCotizacion.append('id_caja', $("#id_caja").val());

                response = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataCotizacion);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                window.open($ruta+'vistas/modulos/impresiones/generar_factura_a4.php?id_venta=' + response["id_venta"], 'fullscreen=yes' + "resizable=0,");


                fnc_InicializarFormulario();
            }
        })

    }

    function fnc_EliminarCotizacion($id_cotizacion) {

        Swal.fire({
            title: 'Está seguro(a) de eliminar la Cotización?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar Cotización!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'eliminar_cotizacion');
                formData.append('id_cotizacion', $id_cotizacion);

                response = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                fnc_InicializarFormulario();

            }
        })

    }

    function fnc_ConfirmarCotizacion($id_cotizacion) {

        Swal.fire({
            title: 'Está seguro(a) de confirmar la Cotización?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Confirmar Cotización!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'confirmar_cotizacion');
                formData.append('id_cotizacion', $id_cotizacion);

                response = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                fnc_InicializarFormulario();

            }
        })
    }

    function fnc_ImprimirCotizacionA4($id_cotizacion) {
        window.open($ruta+'vistas/modulos/impresiones/generar_cotizacion_a4.php?id_cotizacion=' + $id_cotizacion,
            'fullscreen=yes' +
            "resizable=0,"
        );
    }


    /* ======================================================================================
    IR A EDITAR COTIZACION
    =======================================================================================*/
    function fnc_IrActualizarCotizacion($id_cotizacion) {

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/ventas/cotizaciones/modulos/actualizar_cotizacion.php', {
                    id_cotizacion: $id_cotizacion
                },
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        });
    }

    function fnc_ConsultarCotizacion($id_cotizacion) {

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/ventas/cotizaciones/modulos/consultar_cotizacion.php', {
                    id_cotizacion: $id_cotizacion
                },
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        })
    }

    function fnc_GenerarComprobanteCotizacion($id_cotizacion, $comprobante_a_generar) {

        /* VERIFICAR EL ESTADO DE LA CAJA */
        if(!fnc_ObtenerEstadoCajaPorDia()){
            return;
        }

        if ($comprobante_a_generar == 'BOLETA') {

            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/ventas/cotizaciones/modulos/generar_boleta_cotizacion.php', {
                        id_cotizacion: $id_cotizacion
                    },
                    function() {
                        $(".content-wrapper").fadeIn(60);
                    },
                );
            })
        } else {

            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/ventas/cotizaciones/modulos/generar_factura_cotizacion.php', {
                        id_cotizacion: $id_cotizacion
                    },
                    function() {
                        $(".content-wrapper").fadeIn(60);
                    },
                );
            })
        }

    }
</script>