<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">NOTA DE VENTA</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Nota de venta</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">

    <input type="hidden" name="id_caja" id="id_caja" value="0">

    <div class="container-fluid">

        <form id="frm-datos-venta-factura" class="needs-validation-venta-factura" novalidate>

            <div class="row">

                <!-- --------------------------------------------------------- -->
                <!-- COMPROBANTE DE PAGO -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-7">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">COMPROBANTE DE PAGO </span>

                            <div class="row my-1">

                                <!-- EMITIR POR -->
                                <div class="col-12 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-building mr-1 my-text-color"></i> Empresa Emisora</label>
                                    <select class="form-select" id="empresa_emisora" name="empresa_emisora" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione Empresa</div>
                                </div>

                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Emisión</label>
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_emision"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                        <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_emision" name="fecha_emision" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese Fecha de Emisión</div>
                                    </div>
                                </div>


                                <!-- TIPO COMPROBANTE -->
                                <div class="col-12 col-lg-8 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante</label>
                                    <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required readOnly>
                                    </select>
                                    <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                </div>

                                <!-- SERIE -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                    <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione la Serie</div>
                                </div>

                                <!-- CORRELATIVO -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required readonly>
                                </div>

                                <!-- MONEDA -->
                                <div class="col-12 col-lg-4 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-wave mr-1 my-text-color"></i>Moneda</label>
                                    <select class="form-select" id="moneda" name="moneda" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Seleccione la moneda</div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- DATOS DEL CLIENTE -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-5">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">DATOS DEL CLIENTE </span>

                            <div class="row my-1">

                                <div class="col-12 col-lg-6 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento</label>
                                    <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example">
                                    </select>
                                </div>

                                <div class="col-12 col-lg-6 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento</label>
                                    <div class="input-group input-group-sm mb-3 ">
                                        <span class="input-group-text btnConsultarDni" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-search ml-1 text-white"></i></span>
                                        <input type="text" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="nro_documento" name="nro_documento" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm">
                                    </div>
                                </div>

                                <div class="col-12 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente/ Razón Social</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_razon_social" name="nombre_cliente_razon_social" placeholder="Ingrese Nombre del Cliente o Razón Social" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-9 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                </div>

                                <div class="col-12 col-lg-3 mb-2">

                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Teléfono</label>
                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Teléfono" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- LISTADO DE PRODUCTOS -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-8">

                    <div class="card card-gray shadow mt-4">

                        <div class="card-body px-3 py-3" style="position: relative;">

                            <span class="titulo-fieldset px-3 py-1">LISTADO DE PRODUCTOS </span>

                            <div class="row my-1">

                                <div class="d-block col-12 d-lg-none col-lg-12 mb-3">
                                    <div class="col-12 text-center px-2 rounded-3">
                                        <div class="btn fw-bold fs-3  text-warning my-bg w-100" id="totalVenta">S/0.00</div>
                                    </div>
                                </div>

                                <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                                <div class="col-12 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                    <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-alt mr-1 my-text-color"></i>Tipo Operación</label>
                                    <select class="form-select" id="tipo_operacion" name="tipo_operacion" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese el Tipo de Operación</div>
                                </div>

                                <!-- FORMA DE PAGO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Forma Pago</label>
                                    <select class="form-select" id="forma_pago" name="forma_pago" aria-label="Floating label select example" required>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Forma de Pago</div>
                                </div>

                                <!-- TOTAL RECIBIDO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Recibido</label>
                                    <input type="number" min="0" step="0.01" placeholder="Dinero recibido" style="border-radius: 20px;" class="form-control form-control-sm" id="total_recibido" name="total_recibido" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- VUELTO -->
                                <div class="col-12 col-lg-2 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Vuelto</label>
                                    <input type="number" min="0" step="0.01" placeholder="Vuelto" style="border-radius: 20px;" class="form-control form-control-sm" id="vuelto" name="vuelto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>

                                <!-- MEDIO DE PAGO -->
                                <div class="col-12 col-lg-3 mb-2">
                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Medio Pago</label>
                                    <select class="form-select" id="medio_pago" name="medio_pago" aria-label="Floating label select example" required>
                                        <option value="EFECTIVO" checked>EFECTIVO</option>
                                        <option value="YAPE">YAPE</option>
                                        <option value="PLIN">PLIN</option>
                                        <option value="TRANSFERENCIA">TRANSFERENCIA</option>
                                        <option value="CANJE">CANJE</option>
                                    </select>
                                    <div class="invalid-feedback">Ingrese Medio Pago</div>
                                </div>


                                <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                <div class="col-md-12 mt-2">

                                    <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow" style="font-size: 15px;">
                                        <thead class="bg-main">
                                            <tr>
                                                <th>ITEM</th>
                                                <th>CÓDIGO</th>
                                                <th>DESCRIPCIÓN</th>
                                                <th>ID TIPO IGV</th>
                                                <th>TIPO IGV</th>
                                                <th>UND/MEDIDA</th>
                                                <th>VALOR</th>
                                                <th>CANTIDAD</th>
                                                <th>SUBTOTAL</th>
                                                <th>IGV</th>
                                                <th>IMPORTE</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody style="font-size: 15px;">
                                        </tbody>
                                    </table>
                                    <!-- / table -->
                                </div>


                                <!-- /.col -->
                            </div>
                        </div> <!-- ./ end card-body -->
                    </div>
                </div>

                <!-- --------------------------------------------------------- -->
                <!-- RESUMEN DE LA VENTA -->
                <!-- --------------------------------------------------------- -->
                <div class="col-12 col-lg-4">

                    <div class="row">

                        <div class="col-12">
                            <!-- --------------------------------------------------------- -->
                            <!-- RESUMEN DE LA VENTA -->
                            <!-- --------------------------------------------------------- -->
                            <div class="card card-gray shadow w-lg-100 float-right mt-4">

                                <div class="card-body px-3 py-3 fw-bold" style="position: relative;">

                                    <span class="titulo-fieldset px-3 py-1">DETALLE DE VENTA </span>

                                    <div class="row my-1">

                                        <div class="col-12 col-md-12">
                                            <span>OP. GRAVADAS</span>
                                            <span class="float-right" id="resumen_opes_gravadas">S/
                                                0.00</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <span>OP. INAFECTAS</span>
                                            <span class="float-right" id="resumen_opes_inafectas">S/
                                                0.00</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <span>OP. EXONERADAS</span>
                                            <span class="float-right" id="resumen_opes_exoneradas">S/
                                                0.00</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <span>SUBTOTAL</span>
                                            <span class="float-right" id="resumen_subtotal">S/ 0.00</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <span>IGV</span>
                                            <span class="float-right" id="resumen_total_igv">S/ 0.00</span>
                                            <hr class="m-1" />
                                        </div>

                                        <div class="col-12 col-md-12 fs-4 my-color">
                                            <span>TOTAL</span>
                                            <span class="float-right " id="resumen_total_venta">S/
                                                0.00</span>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                        <div class="col-12 text-center my-1">
                            <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarVenta" style="position: relative; width: 160px;">
                                <span class="text-button">CANCELAR</span>
                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>

                            <a class="btn btn-sm btn-success  fw-bold " id="btnGuardarComprobante" style="position: relative; width: 160px;">
                                <span class="text-button">VENDER</span>
                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>
                        </div>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>

<!-- =============================================================================================================================
MODAL CUOTAS DEL CREDITO
===============================================================================================================================-->
<div class="modal fade" id="mdlCronogramaPagos" role="dialog" tabindex="-1">

    <div class="modal-dialog modal-lg" role="document">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Cronograma de Pagos</h5>

                <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times text-sm m-0 p-0"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <div class="row mb-2">

                    <!-- TOTAL DE CUOTAS -->
                    <!-- <div class="col-12 col-md-5 col-lg-2 mb-1">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Cuota N° <strong class="text-danger fw-bold">*</strong></label>
                        <input type="number" style="border-radius: 20px;" class="form-control form-control-sm" id="nro_cuota" name="nro_cuota" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                    </div> -->

                    <!-- FECHA INICIO CUOTAS -->
                    <div class="col-12 col-md-5 col-lg-3 mb-1">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Vencimiento <strong class="text-danger fw-bold">*</strong></label>
                        <div class="input-group input-group-sm mb-3 ">
                            <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_vencimiento"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                            <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_vencimiento" name="fecha_vencimiento" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="invalid-feedback">Ingrese Fecha de Registro</div>
                        </div>
                    </div>

                    <!-- IMPORTE DE LA CUOTA -->
                    <div class="col-12 col-md-5 col-lg-2 mb-1">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Importe <strong class="text-danger fw-bold">*</strong></label>
                        <input type="number" style="border-radius: 20px;" class="form-control form-control-sm" id="importe_cuota" name="importe_cuota" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                    </div>

                    <!-- IMPORTE DE LA VENTA -->
                    <div class="col-12 col-md-5 col-lg-2 mb-1">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i>Total Venta</label>
                        <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="total_venta" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                    </div>

                    <div class="col-5 text-right d-flex align-items-end justify-content-end mb-1">
                        <a class="btn btn-sm btn-success  fw-bold " id="btnAgregarCuota" style="position: relative; width: 120px;">
                            <span class="text-button">AGREGAR</span>
                            <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                <i class="fas fa-plus fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>
                    </div>

                </div>

                <div class="row">

                    <div class="col-12">

                        <table id="tbl_cronograma" class="table  w-100 shadow border border-secondary">
                            <thead class="bg-main text-left">
                                <th>Cuota</th>
                                <th>Vencimiento</th>
                                <th>Importe</th>
                                <th>Saldo</th>
                                <th></th>
                            </thead>

                            <body>
                            </body>
                        </table>

                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-12 text-center">

                        <a class="btn btn-sm btn-success fw-bold " id="btnConfirmarVenta" style="position: relative; width: 200px;">
                            <span class="text-button">CONFIRMAR VENTA</span>
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


<div class="loading">Loading</div>

<script>
    //Variables Globales
    var itemProducto = 1;
    var $id_venta_para_correo;

    $(document).ready(function() {

        fnc_MostrarLoader()

        fnc_VerificarEmpresasRegistradas();

        /* VERIFICAR EL ESTADO DE LA CAJA */
        fnc_ObtenerEstadoCajaPorDia()

        fnc_InicializarFormulario();

        $('#tipo_comprobante').on('change', function(e) {
            $("#correlativo").val('')
            CargarSelect(null, $("#serie"), "--Seleccione Serie--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante').val());

        });

        $('#tipo_documento').on('change', function(e) {

            fnc_CargarAutocompleteClientes()

            $("#nro_documento").val('')
            $("#nombre_cliente_razon_social").val('')
            $("#direccion").val('')
            $("#telefono").val('')

            if ($('#tipo_documento').val() == 0) {
                fnc_BloquearDatosCliente(true)
            } else {
                fnc_BloquearDatosCliente(false)
            }

        });

        $('#serie').on('change', function(e) {
            fnc_ObtenerCorrelativo($("#serie").val())
        })

        $(".btnConsultarDni").on('click', function() {
            fnc_ConsultarNroDocumento($("#nro_documento").val());
        })

        $("#nro_documento").on('keypress', function(e) {
            if (e.which == 13) {
                fnc_ConsultarNroDocumento($("#nro_documento").val())
            }
        });

        $("#direccion").on('keypress', function(e) {
            if (e.which == 13) {
                $("#telefono").focus();
            }
        });

        $("#telefono").on('keypress', function(e) {
            if (e.which == 13) {
                $("#producto").focus();
            }
        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DE VENTA DEL PRODUCTO
        ======================================================================================*/
        $('#tbl_ListadoProductos tbody').on('click', '.dropdown-item', function() {

            codigo_producto = $(this).attr("codigo");
            precio_venta = parseFloat($(this).attr("precio")).toFixed(2);

            recalcularMontos(codigo_producto, precio_venta);
        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos tbody').on('change', '.iptCantidad', function() {

            let $subtotal = 0;
            let $factor_igv = 0;
            let $porcentaje_igv = 0;
            let $igv = 0;
            let $importe = 0;

            let cantidad_actual = $(this)[0]['value'];
            let cod_producto_actual = $(this)[0]['attributes']['codigoproducto']['value'];

            if (cantidad_actual.length == 0 || cantidad_actual == 0) {
                cantidad_actual = 1;
            }

            if (cantidad_actual < 0) {
                mensajeToast("error", "Ingrese valores mayores a 0")
                return;
            }

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    //OBTENER PRECIO DEL PRODUCTO
                    $precio_con_igv = (parseFloat($.parseHTML(data['precio'])[0]['value'])).toFixed(2);

                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', $id_tipo_afectacion);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);


                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input type="number"  min="0" step="0.01"
                                                            style="width:100%;"
                                                            codigoProducto = ` + cod_producto_actual + `
                                                            class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                            value="` + cantidad_actual + `">`).draw();


                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        //CALCULAR SUBTOTAL
                        $factor_igv = $afectacion.factor;
                        $porcentaje_igv = $afectacion.porcentaje;

                        $subtotal = ($precio_con_igv / $afectacion.factor) * cantidad_actual
                        $igv = ($precio_con_igv * cantidad_actual) - (($precio_con_igv * cantidad_actual) / $factor_igv); // * EL % DE IGV
                    } else {
                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_igv) * cantidad_actual
                        $igv = 0
                        $factor_igv = 1;
                    }

                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_igv * cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV
                    $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat(parseFloat($.parseHTML(data['precio'])[0]['value']) * cantidad_actual).toFixed(2)).draw();

                    $("#producto").val("");
                    $("#producto").focus();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR EL PRECIO DEL PRODUCTO DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos tbody').on('change', '.iptPrecio', function() {

            let $id_tipo_afectacion = 0;
            let $subtotal = 0;
            let $factor_igv = 0;
            let $porcentaje_igv = 0;
            let $igv = 0;
            let $importe = 0;
            let $cantidad_actual = 0;

            $precio_con_igv = parseFloat($(this)[0]['value']);

            cod_producto_actual = $(this)[0]['attributes']['codigoProducto']['value'];

            if ($precio_con_igv.length == 0 || $precio_con_igv == 0) {
                $precio_con_igv = 1;
            }

            if ($precio_con_igv < 0) {
                mensajeToast("error", "El precio debe ser mayor a 0")
                return;
            }

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value'])
                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', $id_tipo_afectacion);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

                    // ACTUALIZAR PRECIO
                    $('#tbl_ListadoProductos').DataTable().cell(index, 6)
                        .data(`<input type="number"  min="0" step="0.01"
                                    style="width:100%;" 
                                    codigoProducto = ` + cod_producto_actual + ` 
                                    class="form-control form-control-sm text-center iptPrecio m-0 p-0 rounded-pill" 
                                    value="` + $precio_con_igv + `">`).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {

                        $factor_igv = $afectacion.factor;
                        $porcentaje_igv = $afectacion.porcentaje;

                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_igv / $factor_igv) * $cantidad_actual
                        $igv = ($precio_con_igv * $cantidad_actual) - (($precio_con_igv * $cantidad_actual) / $factor_igv); // * EL % DE IGV
                    } else {
                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_igv) * $cantidad_actual
                        $igv = 0
                        $factor_igv = 1;
                    }

                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_igv * $cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV
                    $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($.parseHTML(data['cantidad'])[0]['value'] * $precio_con_igv).toFixed(2)).draw();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });

        /* ======================================================================================
        EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        ======================================================================================*/
        $('#tbl_ListadoProductos tbody').on('click', '.btnEliminarproducto', function() {
            $('#tbl_ListadoProductos').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });

        $("#btnGuardarComprobante").on('click', function() {
            fnc_GuardarVenta();
        })

        $("#total_recibido").on("keyup", function() {
            $total_venta = parseFloat($("#resumen_total_venta").html().replace('S/', '')).toFixed(2);

            $total_recibido = parseFloat($("#total_recibido").val());

            if ($total_recibido >= $total_venta) {
                $("#vuelto").val(parseFloat($total_recibido - $total_venta).toFixed(2));
            }
        })

        $("#total_recibido").change(function() {
            $total_venta = $("#totalVenta").html().replace('S/', '');
            $total_recibido = parseFloat($("#total_recibido").val());

            if ($total_recibido < $total_venta) {
                mensajeToast("warning", "El monto recibido es menor al valor de la venta");
                $("#total_recibido").val('')
                $("#total_recibido").focus();
                $("#vuelto").val('')
                return false;
            }
        })

        $("#btnCancelarVenta").on('click', function() {
            fnc_InicializarFormulario();
        })

        $('#tbl_ListadoProductos tbody').on('keypress', '.iptCantidad', function(e) {
            var key = e.keyCode;
            //102 -> F
            //98 -> B

            if (key == 45) {
                e.preventDefault();
            }

        });

        $("#btnAgregarCuota").on('click', function() {
            fnc_AgregarCuotaCronograma();
        })

        $("#btnConfirmarVenta").on('click', function() {
            fnc_ConfirmarVenta();
        })

        $('#tbl_cronograma tbody').on('click', '.btnEliminarCuota', function() {
            // alert("entro")
            $('#tbl_cronograma').DataTable().row($(this).parents('tr')).remove().draw();

            let $total_venta = parseFloat($("#resumen_total_venta").html().replace('S/', ''));
            let $importe = 0;
            let nro_cuota = 1;

            $('#tbl_cronograma').DataTable().rows().eq(0).each(function(index) {
                $importe = $importe + parseFloat($('#tbl_cronograma').DataTable().cell(index, 2).data())
                $('#tbl_cronograma').DataTable().cell(index, 3).data(parseFloat($total_venta - $importe).toFixed(2));
                $('#tbl_cronograma').DataTable().cell(index, 0).data(nro_cuota);
                nro_cuota = nro_cuota + 1;
            });
        });

        $("#email").change(function() {
            var pattern = /^[^0-9][.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/;

            if (!pattern.test($("#email").val())) {
                mensajeToast('warning', 'Formato de email inválido');
                $("#email").val('');
                $("#email").focus();
                return;
            }
        })

        $("#btnEnviarComprobanteCorreo").on("click", function() {
            fnc_EnviarCorreo();
        })

        $("#moneda").change(function() {
            fnc_ObtenerSimboloMoneda();
            // fnc_CargarDataTableListadoProductos();
            // recalcularTotales();
            // if ($("#moneda").val() == "PEN") {
            //     $("#tipo_cambio").addClass("my-disabled");
            //     $("#tipo_cambio").val(parseFloat(1.000).toFixed(3))
            // } else {
            //     $("#tipo_cambio").removeClass("my-disabled");
            // }

            // fnc_InicializarFormulario();
        })

        fnc_OcultarLoader();
    })


    function fnc_InicializarFormulario() {

        fnc_CargarSelects();
        fnc_ObtenerSimboloMoneda();
        fnc_CargarAutocompleteProductos();
        fnc_CargarAutocompleteClientes();
        // fnc_CargarDataTableListadoFacturas();
        fnc_CargarPluginDateTime();

        fnc_CargarDataTableListadoProductos();

        fnc_CargarDataTableCronograma()
        // fnc_CargarDataTableListadoFacturas();

        $('#fecha_vencimiento').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.lang('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'
                    .split('_'),
                monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split(
                    '_'),
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            }),
            // defaultDate: moment(),
        });

        //Datos del Comprobante
        $("#serie").val('')
        $("#correlativo").val('')

        //Datos del Cliente
        // $("#tipo_documento").val('')
        $("#nro_documento").val('')
        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')
        $("#telefono").val('')

        //Datos de la Venta
        $("#producto").val('')
        $("#totalVenta").html('')
        $("#totalVenta").html('S/ 0.00')
        $("#total_recibido").val('')
        $("#vuelto").val('')

        //Datos del Resumen
        $("#resumen_opes_gravadas").html('S/ 0.00')
        $("#resumen_opes_inafectas").html('S/ 0.00')
        $("#resumen_opes_exoneradas").html('S/ 0.00')
        $("#resumen_subtotal").html('S/ 0.00')
        $("#resumen_total_igv").html('S/ 0.00')
        $("#resumen_total_venta").html('S/ 0.00')

        $(".needs-validation-venta-factura").removeClass("was-validated");

        $("#mdlCronogramaPagos").modal('hide')

    }

    /*===================================================================*/
    //CARGAR DROPDOWN'S
    /*===================================================================*/
    function fnc_CargarSelects() {

        var formData = new FormData();
        formData.append("accion", "obtener_empresa_defecto");
        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        // EMPRESA EMISORA
        CargarSelect(response.id_empresa ?? "", $("#empresa_emisora"), "--Seleccionar--", "ajax/empresas.ajax.php", 'obtener_empresas_select');
        CargarSelect('NV', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante').val());
        CargarSelect('PEN', $("#moneda"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_moneda');
        CargarSelect('0', $("#tipo_documento"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');
        CargarSelect('0101', $("#tipo_operacion"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_operacion');
        CargarSelect(1, $("#forma_pago"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_forma_pago');

    }

    /*===================================================================*/
    // P L U G I N   D A T E T I M E P I C K E R
    /*===================================================================*/
    function fnc_CargarPluginDateTime() {
        $('#fecha_emision').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: moment.lang('es', {
                months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'
                    .split('_'),
                monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split(
                    '_'),
                weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
                weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
                weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            }),
            defaultDate: moment(),
        });
    }

    function fnc_ObtenerCorrelativo(id_serie) {
        var formData = new FormData();
        formData.append('accion', 'obtener_correlativo_serie');
        formData.append('id_serie', id_serie);

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);
        $("#correlativo").val(response["correlativo"])
    }

    /*===================================================================*/
    //CARGAR AUTOCOMPLETE DE PRODUCTOS
    /*===================================================================*/
    function fnc_CargarAutocompleteProductos() {

        $("#producto").autocomplete({
            source: "ajax/autocomplete_productos.ajax.php",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                CargarProductos(ui.item.id);
                $("#producto").val('');
                $("#producto").focus();
                return false;
            },
            response: function(event, ui) {

                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: '<a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
                            '<div class=""> ' +
                            '<span class="text-sm fw-bold">No existen datos</span>' +
                            '</div>' +
                            '</a>'
                    };
                    ui.content.push(noResult);
                }
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };

    }

    /*===================================================================*/
    //A U T O C O M P L E T E   D E   C L I E N T E S
    /*===================================================================*/
    function fnc_CargarAutocompleteClientes() {


        $("#nombre_cliente_razon_social").autocomplete({
            source: "ajax/autocomplete_clientes.ajax.php?id_tipo_documento=" + $("#tipo_documento").val(),
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                CargarCliente(ui.item.value);
                return false;
            },
            response: function(event, ui) {

                if (!ui.content.length) {
                    var noResult = {
                        value: "",
                        label: '<a href="javascript:void(0);" class="d-flex border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
                            '<div class=""> ' +
                            '<span class="text-sm fw-bold">No existen datos</span>' +
                            '</div>' +
                            '</a>'
                    };
                    ui.content.push(noResult);
                }
            },
            open: function() {
                $("ul.ui-menu").width($(this).innerWidth());
            }
        }).data("ui-autocomplete")._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };

    }

    /*===================================================================*/
    // C A R G A R   D A T A T A B L E   D E   P R O D U C T O S   A   V E N D ER
    /*===================================================================*/
    function fnc_CargarDataTableListadoProductos() {

        if ($.fn.DataTable.isDataTable('#tbl_ListadoProductos')) {
            $('#tbl_ListadoProductos').DataTable().destroy();
            $('#tbl_ListadoProductos tbody').empty();
        }

        $('#tbl_ListadoProductos').DataTable({
            // searching: false,
            paging: false,
            info: false,
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "id_tipo_igv"
                },
                {
                    "data": "tipo_igv"
                },
                {
                    "data": "unidad_medida"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "cantidad"
                },
                {
                    "data": "subtotal"
                },
                {
                    "data": "igv"
                },
                {
                    "data": "importe"
                },
                {
                    "data": "acciones"
                }
            ],
            columnDefs: [{
                    "className": "dt-center",
                    "targets": [6, 7, 10]
                },
                {
                    targets: [0, 1, 3, 4, 5, 8, 9],
                    visible: false
                },
                {
                    width: '50%',
                    "className": "dt-left",
                    targets: 2,

                },
                {
                    width: '15%',
                    targets: 6
                },
                {
                    width: '15%',
                    targets: 7
                },
                {
                    width: '15%',
                    targets: 10
                }
            ],
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        ajustarHeadersDataTables($("#tbl_ListadoProductos"))

    }


    /*===================================================================*/
    // C A R G A R   P R O D U C T O S   E N   E L   D A T A T A B L E
    /*===================================================================*/
    function CargarProductos(producto = "") {

        var codigo_producto;

        if (producto != "") codigo_producto = producto;
        else codigo_producto = $("#iptCodigoVenta").val();

        var producto_repetido = 0;

        /*===================================================================*/
        // AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO
        /*===================================================================*/
        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);
            var data = row.data();

            if (codigo_producto == data['codigo_producto']) {

                var formaData = new FormData();
                formaData.append('accion', 'obtener_porcentaje_impuesto');
                formaData.append('codigo_afectacion', data['id_tipo_igv']);

                $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

                producto_repetido = 1;

                cantidad_a_comprar = parseFloat($.parseHTML(data['cantidad'])[0]['value']) + 1;

                $.ajax({
                    async: false,
                    url: "ajax/productos.ajax.php",
                    method: "POST",
                    data: {
                        'accion': 'verificar_stock',
                        'codigo_producto': codigo_producto,
                        'cantidad_a_comprar': cantidad_a_comprar
                    },
                    dataType: 'json',
                    success: function(respuesta) {

                        if (parseInt(respuesta['stock']) < cantidad_a_comprar) {

                            mensajeToast('error', ' El producto ' + data['descripcion'] + ' no tiene el stock ingresado, el stock actual es: ' + respuesta.stock);

                            $("#producto").val("");
                            $("#producto").focus();

                        } else {

                            $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / $afectacion.factor);
                            $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data()

                            let $subtotal = 0;
                            let $factor_igv = 0;
                            let $porcentaje_igv = 0;
                            let $igv = 0;
                            let $importe = 0;

                            // ACTUALIZAR CANTIDAD A 1
                            $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input  type="number" min="0"
                                                style="width:100%;" 
                                                codigoProducto = "` + codigo_producto + `" 
                                                class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                                value="` + cantidad_a_comprar + `">`).draw();

                            // $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = $valor_unitario * cantidad_a_comprar;

                            $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IGV
                            if ($id_tipo_afectacion == 10) {
                                $factor_igv = $afectacion.factor;
                                $porcentaje_igv = $afectacion.porcentaje;
                                $igv = ($valor_unitario * cantidad_a_comprar * $porcentaje_igv); // * EL % DE IGV

                            } else {
                                $igv = 0
                                $factor_igv = 1;
                            }

                            $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                            //ACTUALIZAR IMPORTE
                            $importe = ($valor_unitario * cantidad_a_comprar) * $factor_igv; // * EL FACTOR DE IGV

                            $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($importe).toFixed(2)).draw();

                            // RECALCULAMOS TOTALES
                            recalcularTotales();

                        }
                    }
                });

            }
        });

        if (producto_repetido == 1) {
            return;
        }

        $.ajax({
            url: "ajax/productos.ajax.php",
            method: "POST",
            data: {
                'accion': 'obtener_producto_x_codigo', //BUSCAR PRODUCTOS POR SU CODIGO DE BARRAS
                'codigo_producto': codigo_producto
            },
            dataType: 'json',
            success: function(respuesta) {

                /*===================================================================*/
                //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO
                /*===================================================================*/
                if (respuesta) {

                    var TotalVenta = 0.00;

                    $tipo_cambio = 1.00;
                    $factor_igv = respuesta.factor_igv
                    $codigo_producto = respuesta.codigo_producto;
                    $descripcion = respuesta.descripcion;
                    $precio = respuesta.precio_unitario_con_igv;
                    $precio = $precio / $tipo_cambio;
                    $subtotal = ($precio / $factor_igv) * 1;
                    $igv = ($precio) - ($precio / $factor_igv);
                    $importe = $precio * 1;

                    $('#tbl_ListadoProductos').DataTable().row.add({
                        'id': itemProducto,
                        'codigo_producto': $codigo_producto,
                        'descripcion': $descripcion.length > 60 ? $descripcion.substring(0, 60) + '...' : $descripcion,
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'tipo_igv': respuesta.tipo_afectacion_igv,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value=` + parseFloat($precio).toFixed(2) + `>`,
                        'cantidad': `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value="1">`,
                        'subtotal': parseFloat($subtotal).toFixed(2),
                        'igv': parseFloat($igv).toFixed(2),
                        'importe': parseFloat($importe).toFixed(2),
                        'acciones': "<center>" +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "<div class='btn-group'>" +
                            "<button type='button' class=' p-0 btn btn-primary transparentbar dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>" +
                            "<i class='fas fa-hand-holding-usd fs-5 text-green'></i> <i class='fas fa-chevron-down text-primary'></i>" +
                            "</button>" +

                            "<ul class='dropdown-menu'>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_con_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Normal (" + parseFloat(respuesta[
                                'precio_unitario_con_igv']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_mayor_con_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Por Mayor (S./ " + parseFloat(
                                respuesta['precio_unitario_mayor_con_igv']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + $codigo_producto +
                            "' precio=' " + respuesta['precio_unitario_oferta_con_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Oferta (S./ " + parseFloat(
                                respuesta['precio_unitario_oferta_con_igv']).toFixed(2) + ")</a></li>" +

                            "</ul>" +
                            "</div>" +
                            "</center>"
                    }).draw();

                    itemProducto = itemProducto + 1;
                    //  Recalculamos el total de la venta
                    recalcularTotales();

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    mensajeToast('error', 'EL PRODUCTO NO EXISTE O NO TIENE STOCK');
                }

            }
        });

        $("#producto").val("");
        $("#producto").focus();

    }

    function recalcularMontos(codigo_producto, precio_venta) {

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);

            var data = row.data();


            if (data['codigo_producto'] == codigo_producto) {

                // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                $('#tbl_ListadoProductos').DataTable().cell(index, 6).data(
                    `<input type="number" style="width:100%;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim(codigo_producto) + ` value=` + precio_venta + `>`
                ).draw();

                //OBTENER PRECIO DEL PRODUCTO
                $precio = parseFloat($.parseHTML(data['precio'])[0]['value']);

                $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                var formaData = new FormData();
                formaData.append('accion', 'obtener_porcentaje_impuesto');
                formaData.append('codigo_afectacion', $id_tipo_afectacion);

                $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

                let $subtotal = 0;
                let $factor_igv = 0;
                let $porcentaje_igv = 0;
                let $igv = 0;
                let $importe = 0;

                cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

                //CALCULAR IGV
                if ($id_tipo_afectacion == 10) {
                    $factor_igv = $afectacion.factor;
                    $porcentaje_igv = $afectacion.porcentaje;
                    $igv = ($precio * cantidad_actual * $porcentaje_igv); // * EL % DE IGV
                    $subtotal = $precio / $factor_igv
                } else {
                    $igv = 0
                    $factor_igv = 1;
                    $subtotal = $precio / $factor_igv
                }

                //SETEAR SUBTOTAL
                $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                //SETEAR IGV
                $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                //CALCULAR IMPORTE
                $importe = ($precio * cantidad_actual); // * EL FACTOR DE IGV
                $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($importe).toFixed(2)).draw();

            }

            // RECALCULAMOS TOTALES
            recalcularTotales();


        });

        // RECALCULAMOS TOTALES
        recalcularTotales();

    }

    /*===================================================================*/
    //R E C A L C U L A R   L O S   T O T A L E S  D E   V E N T A
    /*===================================================================*/
    function recalcularTotales() {

        let totalVenta = 0.00;
        let total_opes_gravadas = 0.00;
        let total_opes_exoneradas = 0.00;
        let total_opes_inafectas = 0.00;
        let subtotal = 0.00;
        let total_igv = 0.00;
        let factor_igv = 1;

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);
            var data = row.data();

            factor_igv = 1;

            var formaData = new FormData();
            formaData.append('accion', 'obtener_porcentaje_impuesto');
            formaData.append('codigo_afectacion', data['id_tipo_igv']);

            $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

            $cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

            if (data['id_tipo_igv'] == 10) {
                $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / $afectacion.factor);
                total_opes_gravadas = parseFloat(total_opes_gravadas) + (parseFloat($valor_unitario) * parseFloat($cantidad));
                total_igv = parseFloat(total_igv) + ((parseFloat($valor_unitario) * $cantidad) * $afectacion.porcentaje);
            }

            if (data['id_tipo_igv'] == 20) {
                $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value']);
                total_opes_exoneradas = parseFloat(total_opes_exoneradas + ($valor_unitario * $cantidad));
            }

            if (data['id_tipo_igv'] == 30) {
                $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value']);
                total_opes_inafectas = parseFloat(total_opes_inafectas + ($valor_unitario * $cantidad));
            }

        });

        totalVenta = parseFloat(totalVenta) + parseFloat(total_opes_gravadas) + parseFloat(total_opes_exoneradas) + parseFloat(total_opes_inafectas) + parseFloat(total_igv)
        subtotal = subtotal + (total_opes_gravadas + total_opes_exoneradas + total_opes_inafectas);

        $("#resumen_opes_gravadas").html($simbolo_moneda + parseFloat(total_opes_gravadas).toFixed(2));
        $("#resumen_opes_inafectas").html($simbolo_moneda + parseFloat(total_opes_inafectas).toFixed(2));
        $("#resumen_opes_exoneradas").html($simbolo_moneda + parseFloat(total_opes_exoneradas).toFixed(2));
        $("#resumen_subtotal").html($simbolo_moneda + parseFloat(subtotal).toFixed(2));
        $("#resumen_total_igv").html($simbolo_moneda + parseFloat(total_igv).toFixed(2));
        $("#resumen_total_venta").html($simbolo_moneda + parseFloat(totalVenta).toFixed(2));

        $("#total_recibido").val(parseFloat(totalVenta).toFixed(2))

    }

    function fnc_GuardarVenta() {

        //SI LA FORMA DE PAGO ES AL CREDITO
        if ($("#forma_pago").val() == 2) {

            let cantidad = 0;

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
                cantidad = cantidad + 1;
            });

            if (cantidad == 0) {
                mensajeToast("error", "Ingrese los productos a vender");
                $("#forma_pago").val(1)
                return;
            }

            $("#total_venta").val($("#resumen_total_venta").html().replace('S/', ''));

            fnc_CargarDataTableCronograma();
            $("#mdlCronogramaPagos").modal('show')

        } else {


            let count = 0;
            form_comprobante_validate = validarFormulario('needs-validation-venta-factura');

            //INICIO DE LAS VALIDACIONES
            if (!form_comprobante_validate) {
                mensajeToast("error", "complete los datos obligatorios");
                return;
            }

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
                count = count + 1;
            });

            if (count == 0) {
                mensajeToast("error", "Ingrese los productos para la venta");
                return;
            }

            if ($("#total_recibido").val() == "") {
                mensajeToast("error", "Ingrese el Total recibido");
                return;
            }

            if (!fnc_ValidarStock()) {
                return;
            }

            //FIN DE LAS VALIDACIONES

            var $productos = [];

            Swal.fire({
                title: 'Está seguro(a) de registrar la Nota de Venta?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, deseo registrarlo!',
                cancelButtonText: 'Cancelar',
            }).then((result) => {

                if (result.isConfirmed) {

                    $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                        var arr = {};
                        var row = $('#tbl_ListadoProductos').DataTable().row(index);

                        var data = row.data();

                        var formaData = new FormData();
                        formaData.append('accion', 'obtener_porcentaje_impuesto');
                        formaData.append('codigo_afectacion', data["id_tipo_igv"]);

                        $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

                        if (data["id_tipo_igv"] == "10") {
                            precio = parseFloat($.parseHTML(data['precio'])[0]['value']) / $afectacion.factor;
                        } else {
                            precio = parseFloat($.parseHTML(data['precio'])[0]['value']);
                        }

                        cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value'])

                        arr['codigo_producto'] = data["codigo_producto"];
                        arr['descripcion'] = data["descripcion"];
                        arr['id_tipo_igv'] = data["id_tipo_igv"];
                        arr['precio'] = precio;
                        arr['cantidad'] = cantidad;
                        arr['igv'] = data["igv"];
                        arr['subtotal'] = data["subtotal"];
                        arr['importe_total'] = data["importe"];
                        $productos.push(arr);

                    });

                    var formData = new FormData();
                    formData.append('accion', 'registrar_nota_venta');
                    formData.append('datos_venta', $("#frm-datos-venta-factura").serialize());
                    formData.append('id_caja', $("#id_caja").val());
                    // formData.append('arr_detalle_productos', JSON.stringify(detalle_productos));
                    formData.append('productos', JSON.stringify($productos));

                    response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                    Swal.fire({
                        position: 'top-center',
                        icon: response.tipo_msj,
                        title: response.msj,
                        showConfirmButton: true
                    })

                    window.open($ruta+'vistas/generar_nota_venta_ticket.php?id_venta=' + response["id_venta"],
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

                fnc_InicializarFormulario();

            })


        }
    }




    /*===================================================================*/
    //GENERALES
    /*===================================================================*/
    function fnc_ConsultarNroDocumento(nro_documento) {

        var formData = new FormData();
        let accion = '';

        if ($("#tipo_documento").val() == 1) {
            accion = 'consultar_dni';
        } else if ($("#tipo_documento").val() == 6) {
            accion = 'consultar_ruc';
        }

        formData.append('accion', accion);
        formData.append('nro_documento', $.trim(nro_documento));

        response = SolicitudAjax('ajax/apis/apis.ajax.php', 'POST', formData);

        if (response) {

            if (response['message']) {

                if (response['message'] == "not found") {
                    mensajeToast("error", 'No se encontraron datos')
                }

                if (response['message'] == "dni no valido") {
                    mensajeToast("error", 'El DNI ingresado no es válido')
                }

                if (response['message'] == "ruc no valido") {
                    mensajeToast("error", 'El RUC ingresado no es válido')
                }

                $("#nro_documento").val('')
                $("#nombre_cliente_razon_social").val('')
                $("#direccion").val('')
                $("#telefono").val('')
                return;
            }

            if ($("#tipo_documento").val() == 1) {
                $("#nombre_cliente_razon_social").val(response['nombres'] + ' ' + response['apellidoPaterno'] + ' ' +
                    response['apellidoMaterno']);
            } else if ($("#tipo_documento").val() == 6) {
                $("#nombre_cliente_razon_social").val(response['razonSocial']);
                $("#direccion").val(response['direccion']);
                if (response['telefono']) $("#telefono").val(response['telefono']);

                $("#direccion").focus();
            }

        }
    }

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
                    targets: [1, 4, 5, 6, 7, 9, 11, 13],
                    visible: false
                },
                {
                    targets: 9,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[9] != 1) {
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
                                            <a class="dropdown-item btnImprimirFacturaA4" style='cursor:pointer;'><i class='px-1 fas fa-file-pdf fs-5 text-danger'></i> <span class='my-color'>Imprimir Factura (A4)</span></a>
                                            <a class="dropdown-item btnEnviarCorreo" style='cursor:pointer;'><i class='px-1 fas fa-envelope fs-5 text-success'></i> <span class='my-color'>Enviar Correo Elec.</span></a>`

                        if (rowData[9] == 1) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[11] + `' download class="dropdown-item btnDescargarXml" style='cursor:pointer;'>
                                                        <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                                                    </a>

                                                    <a href='fe/facturas/cdr/R-` + rowData[11] + `' download class="dropdown-item btnDescargarCdr" style='cursor:pointer;'>
                                                        <i class='px-1 fas fa-file-code fs-5 text-info'></i> <span class='my-color'>Descargar CDR</span>
                                                    </a>`;
                        }

                        if (rowData[9] == 2) {

                            $options = $options + `<a href='fe/facturas/xml/` + rowData[11] + `' download class="dropdown-item btnDescargarXml" style='cursor:pointer;'>
                                                    <i class='px-1 fas fa-file-code fs-5 my-color'></i> <span class='my-color'> Descargar XML</span>
                                                </a>`;
                        }

                        if (rowData[9] == 1 && rowData[12] != 2) {
                            $options = $options + `<a class = "dropdown-item btnAnularBoleta" style='cursor:pointer;'> 
                                                        <i class = 'px-1 fas fa-ban fs-5 text-danger'> </i> <span class='my-color'>Anular Boleta</span> 
                                                    </a>`;
                        }

                        if (rowData[9] != 1 || rowData[12] == 0) {
                            $options = $options + `<a class = "dropdown-item btnEnviarSunat" style = 'cursor:pointer;'> 
                                                        <i class='px-1 fas fa-share-square fs-5 text-warning'> </i> <span class='my-color'>Enviar a Sunat</span > 
                                                    </a>
                                                <a class="dropdown-item btnEditarComprobante" style = 'cursor:pointer;'> 
                                                    <i class='px-1 fas fa-pencil-alt fs-5 text-primary'></i><span class='my-color'>Editar Comprobante</span> 
                                                </a>`
                        }

                        $options = $options + `</div>
                                            </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 10,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[9] == 2) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-window-close fs-5 text-danger btnMensajeRespuestaSunat' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[12] + "'></i>" +
                                "</center>");
                        } else if (rowData[9] == 1) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-check-circle fs-5 text-success btnMensajeRespuestaSunat' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[12] + "'></i>" +
                                "</center>");
                        } else if (rowData[9] == 3) {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-window-close fs-5 text-danger btnMensajeRespuestaSunat' data-bs-toggle='tooltip' data-bs-placement='top' title='" + rowData[12] + "'></i>" +
                                "</center>");
                        } else {
                            $(td).html("<center>" +
                                "<i style='cursor:pointer;' class='fas fa-share-square fs-5 text-warning btnMensajeRespuestaSunat'  data-bs-toggle='tooltip' data-bs-placement='top' title='Pendiente de envio'></i>" +
                                "</center>");
                        }

                    }
                },
                {
                    targets: 12,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[12] == 1) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-success p-1 px-3'>Registrado Sunat</span>" +
                                "</center>");
                        } else if (rowData[12] == 2) {
                            $(td).html("<center>" +
                                "<span class='rounded-pill bg-danger p-1 px-3'>Anulado Sunat</span>" +
                                "</center>");
                        } else if (rowData[12] == 0) {
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

    function fnc_EnviarComprobanteSunat($id_venta) {

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
        window.open($ruta+'vistas/modulos/impresiones/generar_nota_venta_ticket.php?id_venta=' + $id_venta,
            'fullscreen=yes' +
            "resizable=0,"
        );
    }

    function fnc_ValidarStock() {

        let stock_valido = true;

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);

            var data = row.data();

            var datos = new FormData();
            datos.append('accion', 'verificar_stock');
            datos.append('codigo_producto', data["codigo_producto"]);
            datos.append('cantidad_a_comprar', data["cantidad_final"]);

            response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos);

            if (response.stock < parseInt(data["cantidad_final"])) {
                mensajeToast("error", "El producto " + data["descripcion"] + " no tiene el stock ingresado, el stock actual es: " + response.stock)
                $('#tbl_ListadoProductos').DataTable().cell(index, 7)
                    .data(`<input  type="number" min="0"
                    style="width:100%;background-color:#D98880" 
                    codigoProducto = "` + cod_producto_actual + `" 
                    class="form-control text-center iptCantidad m-0 p-0 form-control-sm rounded-pill" 
                    value="` + data["cantidad_final"] + `">`).draw();

                stock_valido = false;

            }

        });

        return stock_valido;
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

        } else {
            $("#id_caja").val(response["id"]);
        }
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
            // CargarContenido('vistas/administrar_empresas.php', 'content-wrapper');
            $(".content-wrapper").fadeOut('slow', function() {
                $(".content-wrapper").load('vistas/modulos/administracion/administrar_empresas.php',
                    function() {
                        $(".content-wrapper").fadeIn(60);

                    },
                );
            })

        }
    }

    /*===================================================================*/
    //CARGAR DATATABLE DE CRONOGRAMA
    /*===================================================================*/
    function fnc_CargarDataTableCronograma() {

        if ($.fn.DataTable.isDataTable('#tbl_cronograma')) {
            $('#tbl_cronograma').DataTable().destroy();
            $('#tbl_cronograma tbody').empty();
        }

        $('#tbl_cronograma').DataTable({
            searching: false,
            paging: false,
            info: false,
            // dom: 'Bfrtip',
            // buttons: ['pageLength'],
            "columns": [{
                    "data": "cuota"
                },
                {
                    "data": "fecha_vencimiento" //1
                },
                {
                    "data": "importe"
                },
                {
                    "data": "saldo"
                },
                {
                    "data": "acciones"
                }
            ],
            // columnDefs: [{
            //     targets: [0, 1, 3, 4, 5, 8],
            //     visible: false
            // }],
            scrollX: true,
            "order": [
                [0, 'asc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        ajustarHeadersDataTables($("#tbl_cronograma"))
    }

    /*===================================================================*/
    //CARGAR CRONOGRAA EN EL DATATABLE
    /*===================================================================*/
    function fnc_AgregarCuotaCronograma() {

        let $saldo = 0;
        let $total_venta = parseFloat($("#resumen_total_venta").html().replace('S/', ''));
        let $importe = 0;
        let $nro_cuota = 1;
        let $fecha_actual = $("#fecha_vencimiento").val()
        let $flag_fechas = 0;

        //VALIDAR QUE SE INGRESE LA FECHA Y EL IMPORTE
        if ($("#fecha_vencimiento").val() == "" || $("#importe_cuota").val() == "" || $("#importe_cuota").val() == "0") {
            mensajeToast("error", "Complete los todos los datos")
            return;
        }

        // OBTENER LA SUMA DE IMPORTES DE CUOTA
        $('#tbl_cronograma').DataTable().rows().eq(0).each(function(index) {
            $importe = $importe + parseFloat($('#tbl_cronograma').DataTable().cell(index, 2).data())
            $nro_cuota = $nro_cuota + 1;

            if ($fecha_actual < $('#tbl_cronograma').DataTable().cell(index, 1).data()) {
                $flag_fechas = 1;
            }
        });

        if (parseFloat($importe + parseFloat($("#importe_cuota").val())).toFixed(2) > parseFloat($total_venta).toFixed(2)) {
            mensajeToast("error", "El importe de la cuota supera el saldo pendiente")
            return;
        }

        if ($flag_fechas == 1) {
            mensajeToast("error", "La fecha ingresada debe ser mayor a la fecha de la última cuota registrada")
            return;
        }

        $('#tbl_cronograma').DataTable().row.add({
            'cuota': $nro_cuota,
            'fecha_vencimiento': $("#fecha_vencimiento").val(),
            'importe': parseFloat($("#importe_cuota").val()).toFixed(2),
            'saldo': 0,
            'acciones': `<center>
                            <span class='btnEliminarCuota text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar cuota'>
                                <i class="fas fa-trash"></i>
                            </span>
                        </center>`
        }).draw();

        $importe = 0;

        $('#tbl_cronograma').DataTable().rows().eq(0).each(function(index) {
            $importe = $importe + parseFloat($('#tbl_cronograma').DataTable().cell(index, 2).data())
            $('#tbl_cronograma').DataTable().cell(index, 3).data(parseFloat($total_venta - $importe).toFixed(2));
        });

        $("#nro_cuota").val('')
        $("#fecha_vencimiento").val('')
        $("#importe_cuota").val('')
    }

    function fnc_ConfirmarVenta() {

        let count = 0;
        form_comprobante_validate = validarFormulario('needs-validation-venta-factura');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        if ($("#tipo_documento").val() != "0" && ($("#nro_documento").val() == "" ||
                $("#nombre_cliente_razon_social").val() == "" ||
                $("#direccion").val() == "")) {
            mensajeToast("error", "Debe completar los datos del Cliente (Razón Social y Dirección)");
            return;
        }


        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
            count = count + 1;
        });

        if (count == 0) {
            mensajeToast("error", "Ingrese los productos para la venta");
            return;
        }

        if ($("#total_recibido").val() == "") {
            mensajeToast("error", "Ingrese el Total recibido");
            return;
        }

        if (!fnc_ValidarStock()) {
            return;
        }

        let cantidad_cuotas = 0;
        let $importe_cuota = 0;
        let $total_venta = parseFloat($("#resumen_total_venta").html().replace('S/', ''));
        $('#tbl_cronograma').DataTable().rows().eq(0).each(function(index) {
            cantidad_cuotas = cantidad_cuotas + 1;
            $importe_cuota = $importe_cuota + parseFloat($('#tbl_cronograma').DataTable().cell(index, 2).data())
        });

        if (cantidad_cuotas == 0) {
            mensajeToast("error", "Ingrese las cuotas del cronograma");
            return;
        }

        if ($importe_cuota < $total_venta) {
            mensajeToast("error", "Complete las cuotas, queda saldo pendiente");
            return;
        }

        //FIN DE LAS VALIDACIONES

        var $productos = [];

        Swal.fire({
            title: 'Está seguro(a) de registrar la Venta?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                    var arr = {};
                    var row = $('#tbl_ListadoProductos').DataTable().row(index);

                    var data = row.data();

                    var formaData = new FormData();
                    formaData.append('accion', 'obtener_porcentaje_impuesto');
                    formaData.append('codigo_afectacion', data["id_tipo_igv"]);

                    $afectacion = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formaData);

                    if (data["id_tipo_igv"] == "10") {
                        precio = parseFloat($.parseHTML(data['precio'])[0]['value']) / $afectacion.factor;
                    } else {
                        precio = parseFloat($.parseHTML(data['precio'])[0]['value']);
                    }

                    cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value'])

                    arr['codigo_producto'] = data["codigo_producto"];
                    arr['descripcion'] = data["descripcion"];
                    arr['id_tipo_igv'] = data["id_tipo_igv"];
                    arr['precio'] = precio;
                    arr['cantidad'] = cantidad;
                    arr['igv'] = data["igv"];
                    arr['subtotal'] = data["subtotal"];
                    arr['importe_total'] = data["importe"];
                    $productos.push(arr);

                });

                cronograma = $("#tbl_cronograma").DataTable().rows().data().toArray();

                var formData = new FormData();
                formData.append('accion', 'registrar_nota_venta');
                formData.append('datos_venta', $("#frm-datos-venta-factura").serialize());
                formData.append('id_caja', $("#id_caja").val());
                formData.append('productos', JSON.stringify($productos));
                formData.append('arr_cronograma', JSON.stringify(cronograma));

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                window.open($ruta+'vistas/generar_nota_venta_ticket.php?id_venta=' + response["id_venta"],
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

    function fnc_ObtenerSimboloMoneda() {

        var formData = new FormData();
        formData.append('accion', 'obtener_simbolo_moneda');
        formData.append('moneda', $("#moneda").val());

        response = SolicitudAjax("ajax/ventas.ajax.php", "POST", formData);

        $simbolo_moneda = response["simbolo"];
    }

    function CargarCliente($cliente) {

        $("#nro_documento").val($cliente.split(" - ")[0].trim());
        $("#nombre_cliente_razon_social").val($cliente.split(" - ")[1].trim());
        $("#direccion").val($cliente.split(" - ")[2].trim());
        $("#telefono").val($cliente.split(" - ")[3].trim());
    }
</script>