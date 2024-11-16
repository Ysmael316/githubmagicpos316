<input type="hidden" name="id_caja" id="id_caja" value="0">


<!-- Ventana Modal de Venta POS-->
<div class="modal fade" id="mdlPos">

    <div class="modal-dialog mdlVentaPos">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cuerpo del modal -->
            <div class="modal-body p-1">

                <!-- CARRITO DE COMPRAS - PANEL LATERAL -->
                <aside class="control-sidebar control-sidebar-dark w-carrito-pos" style="display: none;">

                    <div class="tab-content" id="vert-tabs-tabContent">

                        <div class="tab-pane active show text-left fade scrolly-productos" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab" style="height:100vh; overflow-y: scroll;overflow-x: hidden;">

                            <div class="card card-gray shadow">

                                <div class="card-body p-0">

                                    <div class="row">

                                        <!-- <div class="col-12 div-carrito-pos">
                                            <div class="row"> -->
                                        <div class="col-md-12 mt-2">

                                            <table id="tbl_ListadoProductos_POS_responsive" class="display nowrap table-striped w-100 shadow" style="font-size: 12px;">
                                                <thead class="bg-main text-left d-none">
                                                    <tr>
                                                        <th>IMAGEN</th>
                                                        <th>COD PROD</th>
                                                        <th>DESCRIPCIÓN</th>
                                                        <th>CANTIDAD TEMP</th>
                                                        <th>IMPORTE</th>
                                                        <th>PRODUCTO</th>
                                                        <th>TIPO AFEC IGV</th>
                                                        <th>FACTOR IGV</th>
                                                        <th>PRECIO</th>
                                                        <th>IGV</th>
                                                        <th>SUBTOTAL</th>
                                                        <!-- <th></th> -->
                                                    </tr>
                                                </thead>
                                                <tbody class="text-left" style="font-size: 13px;">
                                                </tbody>
                                            </table>
                                            <!-- / table -->
                                        </div>

                                        <!-- </div>
                                        </div> -->
                                    </div>

                                </div>

                            </div>

                            <div class="card card-gray shadow">

                                <div class="card card-gray shadow w-lg-100 float-right m-0">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">RESUMEN</h3>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row fw-bold">

                                            <div class="col-12 col-md-12 text-dark" style="font-size: 13px;">
                                                <span>OP. GRAVADAS</span>
                                                <span class="float-right" id="resumen_opes_gravadas_responsive">S/
                                                    0.00</span>
                                            </div>
                                            <div class="col-12 col-md-12 text-dark" style="font-size: 13px;">
                                                <span>OP. INAFECTAS</span>
                                                <span class="float-right" id="resumen_opes_inafectas_responsive">S/
                                                    0.00</span>
                                            </div>
                                            <div class="col-12 col-md-12 text-dark" style="font-size: 13px;">
                                                <span>OP. EXONERADAS</span>
                                                <span class="float-right" id="resumen_opes_exoneradas_responsive">S/
                                                    0.00</span>
                                            </div>
                                            <div class="col-12 col-md-12 text-dark" style="font-size: 13px;">
                                                <span>SUBTOTAL</span>
                                                <span class="float-right" id="resumen_subtotal_responsive">S/ 0.00</span>
                                            </div>
                                            <div class="col-12 col-md-12 text-dark" style="font-size: 13px;">
                                                <span>IGV</span>
                                                <span class="float-right" id="resumen_total_igv_responsive">S/ 0.00</span>
                                                <hr class="m-1" />
                                            </div>

                                            <div class="col-12 col-md-12 fs-4 my-color">
                                                <span>TOTAL</span>
                                                <span class="float-right " id="resumen_total_venta_responsive">S/
                                                    0.00</span>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <a class="btn btn-sm btn-success  fw-bold  w-100" id="btnGuardarComprobanteResponsive" style="position: relative;">
                                <span class="text-button text-white">VENDER</span>
                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>

                        </div>
                </aside>

                <div class="row">

                    <!-- BUSQUEDA Y LISTADO DE PRODUCTOS -->
                    <div class="col-12 col-lg-7">

                        <div class="card card-gray shadow">

                            <div class="card-body p-0">

                                <div class="row">

                                    <div class="col-8 d-lg-none">
                                        <!-- CARRITO DE VENTA PARA MOVIL -->

                                        <ul class="navbar-nav ml-auto">
                                            <!-- Messages Dropdown Menu -->
                                            <li class="nav-item dropdown">

                                                <ul class="navbar-nav ml-auto">

                                                    <li class="nav-item mx-2">
                                                        <a class="nav-link p-0 pt-2" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                                                            <i class="fas fa-cart-plus fs-1 text-primary"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>

                                    <div class="col-4 d-lg-none">
                                        <a class="nav-link p-0 pt-2 mx-2 float-right" href="./">
                                            <i class="fas fa-times-circle fs-1 text-danger"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="row px-4">

                                    <!-- INPUT BUSQUEDA DE PRODUCTOS -->
                                    <div class="col-12 col-lg-9 my-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                        <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <!-- SWITCH PARA LECTOR DE CODIGO DE BARRAS -->
                                    <div class="col-7 col-lg-3 d-flex justify-content-center align-items-center">
                                        <div class="form-check form-switch float-right">
                                            <input class="form-check-input" type="checkbox" role="switch" id="switch_codigo_barras">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Código de Barras</label>
                                        </div>
                                    </div>

                                </div>

                                <!-- LSITADO DE CATEGORIAS Y PRODUCTOS -->
                                <div class="row mx-2 my-2">

                                    <div class="col-12">

                                        <div class="tab-content" id="vert-tabs-tabContent">

                                            <div class="tab-pane active show text-left div-categorias fade scrolly-categorias d-flex" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab" style="overflow-x: scroll;overflow-y: hidden;">

                                                <!-- <div class="row mt-3 text-center" style="height: auto;">

                                                    <div class="col-12  px-2" style="height: auto !important">

                                                    </div>

                                                </div> -->

                                            </div>

                                        </div>


                                    </div>

                                    <div class="col-12 mt-2">

                                        <div class="tab-content" id="vert-tabs-tabContent">

                                            <div class="tab-pane active show text-left h-productos-pos fade scrolly-productos" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab" style="overflow-y: scroll;overflow-x: hidden;">

                                                <div class="row mt-3 mx-2 div-productos" style="height: auto;">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- DETALLE DE LA VENTA -->
                    <div class="d-none d-lg-block col-lg-5">

                        <!-- --------------------------------------------------------- -->
                        <!-- DATOS DEL COMPROBANTE Y CLIENTE -->
                        <!-- --------------------------------------------------------- -->
                        <div class="card card-gray shadow ">

                            <div class="card-body py-2  h-listado-productos">

                                <div class="row">
                                    <div class="col-md-12 mt-2">

                                        <table id="tbl_ListadoProductos_POS" class="display nowrap table-striped w-100 shadow" style="font-size: 12px;">
                                            <thead class="bg-main text-left">
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
                                            <tbody class="text-left" style="font-size: 13px;">
                                            </tbody>
                                        </table>
                                        <!-- / table -->
                                    </div>


                                </div>

                                <div class="row">
                                    <!-- --------------------------------------------------------- -->
                                    <!-- RESUMEN DE LA VENTA -->
                                    <!-- --------------------------------------------------------- -->
                                    <div class="col-12 my-2">
                                        <!-- --------------------------------------------------------- -->
                                        <!-- RESUMEN DE LA VENTA -->
                                        <!-- --------------------------------------------------------- -->
                                        <div class="card card-gray shadow w-lg-100 float-right m-0">

                                            <div class="card-header">
                                                <h3 class="card-title fs-6">RESUMEN</h3>
                                            </div> <!-- ./ end card-header -->

                                            <div class="card-body py-2">

                                                <div class="row fw-bold">

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
                                </div>

                                <div class="row">
                                    <div class="col-12 text-center my-1">
                                        <div class="row">
                                            <div class="col-6">
                                                <a href="./" class="btn btn-sm btn-danger  fw-bold w-100 " id="btnCancelarVenta" style="position: relative;">
                                                    <span class="text-button">CANCELAR</span>
                                                    <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                        <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a class="btn btn-sm btn-success  fw-bold  w-100" id="btnGuardarComprobante" style="position: relative;">
                                                    <span class="text-button">VENDER</span>
                                                    <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                        <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                    </span>
                                                </a>
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

    </div>

</div>

<!-- Ventana Modal de Venta POS-->
<div class="modal fade" id="mdlVenta">

    <div class="modal-dialog modal-lg">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Datos de la venta</h5>

                <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times text-sm m-0 p-0"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <form id="frm-datos-venta" class="needs-validation-venta" novalidate>

                    <div class="row">

                        <!-- TIPO COMPROBANTE -->
                        <div class="col-12 col-md-5 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color">
                                <i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante
                            </label>
                            <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example">
                            </select>
                        </div>

                        <!-- SERIE -->
                        <div class="col-12 col-md-4 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                            <select class="form-select" id="serie" name="serie" aria-label="Floating label select example">
                            </select>
                        </div>

                        <!-- CORRELATIVO -->
                        <div class="col-12 col-md-3 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required readonly>
                        </div>

                        <!-- FORMA DE PAGO -->
                        <div class="col-6 col-lg-3 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Forma Pago</label>
                            <select class="form-select" id="forma_pago" name="forma_pago" aria-label="Floating label select example" required readonly>
                            </select>
                            <div class="invalid-feedback">Ingrese Forma de Pago</div>
                        </div>

                        <!-- MEDIO DE PAGO -->
                        <div class="col-6 col-lg-3 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="far fa-credit-card mr-1 my-text-color"></i>Medio Pago</label>
                            <select class="form-select" id="medio_pago" name="medio_pago" aria-label="Floating label select example" required>
                            </select>
                            <div class="invalid-feedback">Ingrese Medio Pago</div>
                        </div>

                        <!-- TOTAL RECIBIDO -->
                        <div class="col-6 col-lg-3 mb-2">

                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Recibido</label>
                            <input type="number" min="0" step="0.01" placeholder="Dinero recibido" style="border-radius: 20px;" class="form-control form-control-sm" id="total_recibido" name="total_recibido" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <!-- VUELTO -->
                        <div class="col-6 col-lg-3 mb-2">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-hand-holding-usd mr-1 my-text-color"></i>Vuelto</label>
                            <input type="number" min="0" step="0.01" placeholder="Vuelto" style="border-radius: 20px;" class="form-control form-control-sm" id="vuelto" name="vuelto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <!-- TIPO DOCUMENTO DEL CLIENTE -->
                        <div class="col-6 col-lg-6 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento</label>
                            <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required>
                            </select>
                            <div class="invalid-feedback">Seleccione el Tipo de Documento</div>
                        </div>

                        <!-- NRO DOCUMENTO DEL CLIENTE -->
                        <div class="col-6 col-lg-6 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento</label>
                            <div class="input-group input-group-sm mb-3 ">
                                <span class="input-group-text btnConsultarDni" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-search ml-1 text-white"></i></span>
                                <input type="text" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="nro_documento" name="nro_documento" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" required>
                                <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                            </div>
                        </div>

                        <!-- NOMBRE O RAZON SOCIAL DEL CLIENTE -->
                        <div class="col-12 col-lg-6 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente/ Razón Social</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_razon_social" name="nombre_cliente_razon_social" placeholder="Ingrese Nombre del Cliente o Razón Social" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>

                        <!-- DIRECCION DEL CLIENTE -->
                        <div class="col-12 col-lg-6 mb-1">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                        </div>

                    </div>

                    <div class="row mt-2">
                        <div class="col-12 text-center my-1">
                            <div class="row">
                                <div class="col-6">
                                    <a class="btn btn-sm btn-danger  fw-bold w-100 " id="btnCerrarModal" style="position: relative;">
                                        <span class="text-button">CERRAR</span>
                                        <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                            <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                        </span>
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-sm btn-success   fw-bold  w-100" id="btnGenerarComprobante" style="position: relative;">
                                        <span class="text-button">GUARDAR</span>
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

    </div>

</div>

<script>
    var itemProducto = 1;
    var $simbolo_moneda = '';
    var $venta_responsive = 0;

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000
    });


    $(document).ready(function() {


        /*===================================================================*/
        // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
        /*===================================================================*/
        fnc_InicializarFormulario();

        if (!fnc_VerificarEmpresasRegistradas()) {
            return;
        }

        if (fnc_ObtenerEstadoCajaPorDia()) {
            $("#mdlPos").modal('show')
        }

        fnc_CargarLogoEmpresa();

        fnc_ObtenerCategorias();
        fnc_ObtenerProductos(0);


        $("#btnCancelarVenta").on('click', function() {
            $("#mdlPos").modal('hide');
        })

        $(".btnCategoria").on('click', function() {
            // alert("entro")
            $("#producto").val('')
            $id_categoria = $(this)[0]["attributes"]["categoria"]["value"];
            $(this).removeClass("bg-main");
            $(".btnCategoria").removeClass("bg-warning");
            $(".btnCategoria").addClass("bg-main");
            $(this).removeClass("bg-main");
            $(this).addClass("bg-warning");
            fnc_ObtenerProductos($id_categoria)

            $(".btnAgregar").on('click', function() {
                CargarProductos($(this)[0]["attributes"]["codigo-producto"]["value"], false)
                CargarProductosResponsive($(this)[0]["attributes"]["codigo-producto"]["value"])
            })
        })

        $("#producto").keyup(function() {
            $(".btnCategoria").removeClass("bg-warning");
            $(".btnCategoria").addClass("bg-main");
            fnc_ObtenerProductosPorDescripcion($("#producto").val());
            $(".btnAgregar").on('click', function() {
                CargarProductos($(this)[0]["attributes"]["codigo-producto"]["value"], false)
                CargarProductosResponsive($(this)[0]["attributes"]["codigo-producto"]["value"])
            })
        })

        $(".btnAgregar").on('click', function() {
            CargarProductos($(this)[0]["attributes"]["codigo-producto"]["value"], false)
            CargarProductosResponsive($(this)[0]["attributes"]["codigo-producto"]["value"])
        })

        // EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        $('#tbl_ListadoProductos_POS tbody').on('click', '.btnEliminarproducto', function() {
            $('#tbl_ListadoProductos_POS').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });


        $('#tipo_comprobante').on('change', function(e) {
            $("#correlativo").val('')
            // SERIE DEL COMPROBANTE
            CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante option:selected').val());
            $("#serie").prop('selectedIndex', 1).change();

            if ($('#tipo_comprobante').val() == '01' || $('#tipo_comprobante').val() == 'NV') {
                $("#forma_pago").attr('readonly', false);
            } else {
                $("#forma_pago").attr('readonly', true);
            }
        })

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

        $('#tipo_documento').on('change', function(e) {

            $("#nro_documento").val('')
            $("#nombre_cliente_razon_social").val('')
            $("#direccion").val('')

            if ($('#tipo_documento').val() == 0) {
                fnc_BloquearDatosCliente(true)
            } else {
                fnc_BloquearDatosCliente(false)
            }

        });

        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos_POS tbody').on('change', '.iptCantidad', function() {

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

            $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    //OBTENER PRECIO DEL PRODUCTO
                    $precio_con_igv = (parseFloat($.parseHTML(data['precio'])[0]['value'])).toFixed(2);

                    $id_tipo_afectacion = $('#tbl_ListadoProductos_POS').DataTable().cell(index, 3).data();

                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 7).data(`<input type="number"  min="0" step="0.01"
                                                            style="width:80px;"
                                                            codigoProducto = ` + cod_producto_actual + `
                                                            class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                            value="` + cantidad_actual + `">`).draw();


                    //CALCULAR SUBTOTAL
                    $subtotal = ($precio_con_igv / 1.18) * cantidad_actual

                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = 1.18;
                        $porcentaje_igv = 0.18;
                        $igv = ($precio_con_igv * cantidad_actual) - (($precio_con_igv * cantidad_actual) / $factor_igv); // * EL % DE IGV = 0.18
                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_igv * cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV = 1.18
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 10).data(parseFloat(parseFloat($.parseHTML(data['precio'])[0]['value']) * cantidad_actual).toFixed(2)).draw();

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
        $('#tbl_ListadoProductos_POS tbody').on('change', '.iptPrecio', function() {

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

            $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value'])
                    $id_tipo_afectacion = $('#tbl_ListadoProductos_POS').DataTable().cell(index, 3).data();

                    // ACTUALIZAR PRECIO
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 6)
                        .data(`<input type="number"  min="0" step="0.01"
                            style="width:80px;" 
                            codigoProducto = ` + cod_producto_actual + ` 
                            class="form-control form-control-sm text-center iptPrecio m-0 p-0 rounded-pill" 
                            value="` + $precio_con_igv + `">`).draw();


                    //CALCULAR SUBTOTAL
                    $subtotal = ($precio_con_igv / 1.18) * $cantidad_actual

                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = 1.18;
                        $porcentaje_igv = 0.18;
                        $igv = ($precio_con_igv * $cantidad_actual) - (($precio_con_igv * $cantidad_actual) / $factor_igv); // * EL % DE IGV = 0.18
                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_igv * $cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV = 1.18
                    $('#tbl_ListadoProductos_POS').DataTable().cell(index, 10).data(parseFloat($.parseHTML(data['cantidad'])[0]['value'] * $precio_con_igv).toFixed(2)).draw();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });

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

        $("#btnGuardarComprobante").on('click', function() {
            // fnc_GuardarVenta();

            $venta_responsive = 0;

            let count = 0;
            $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {
                count = count + 1;
            });
            if (count == 0) {
                mensajeToast("error", "Ingrese los productos para la venta");
                return;
            }

            $("#tipo_comprobante option[value='07']").remove();
            $("#tipo_comprobante option[value='08']").remove();
            $("#tipo_comprobante option[value='09']").remove();
            $("#tipo_comprobante option[value='RA']").remove();
            $("#tipo_comprobante option[value='RC']").remove();
            $("#tipo_comprobante option[value='CTZ']").remove();
            $("#tipo_comprobante option[value='NC']").remove();

            $("#mdlVenta").modal('show');
        })

        $("#btnGuardarComprobanteResponsive").on('click', function() {
            // fnc_GuardarVenta();

            $venta_responsive = 1;

            let count = 0;
            $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {
                count = count + 1;
            });
            if (count == 0) {
                mensajeToast("error", "Ingrese los productos para la venta");
                return;
            }

            $("#tipo_comprobante option[value='07']").remove();
            $("#tipo_comprobante option[value='08']").remove();
            $("#tipo_comprobante option[value='09']").remove();
            $("#tipo_comprobante option[value='RA']").remove();
            $("#tipo_comprobante option[value='RC']").remove();
            $("#tipo_comprobante option[value='CTZ']").remove();
            $("#tipo_comprobante option[value='NC']").remove();

            $("#mdlVenta").modal('show');
        })

        $("#producto").on('keypress', function(e) {
            if (e.which == 13 && $('#switch_codigo_barras').is(':checked')) {
                CargarProductos($("#producto").val(), true)
            }
        });

        $('#switch_codigo_barras').change(function() {
            if ($('#switch_codigo_barras').is(':checked')) {
                $("#producto").focus();
            }
        })

        $("#btnGenerarComprobante").on('click', function() {
            fnc_GuardarVenta();
        })

        $("#btnCerrarModal").on('click', function() {
            $("#mdlVenta").modal('hide');
        })

        // EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        $('#tbl_ListadoProductos_POS_responsive tbody').on('click', '.btnDeleteProdResp', function() {
            $('#tbl_ListadoProductos_POS_responsive').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotalesResponsive();
        });

        $('#tbl_ListadoProductos_POS_responsive tbody').on('click', '.btnAumentarCantidad', function() {

            cod_producto_actual = $(this)[0]['attributes']['codigo_producto']['value'];

            $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos_POS_responsive').DataTable().row(index);
                var data = row.data();

                let $subtotal = 0;
                let $factor_igv = 0;
                let $porcentaje_igv = 0;
                let $igv = 0;
                let $importe = 0;

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data()) + 1;
                    $producto = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 5).data();
                    $id_tipo_afectacion = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 6).data();
                    $factor_igv = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 7).data(); //1.18
                    $precio_con_igv = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 8).data();

                    // ACTUALIZAR INPUT CANTIDAD
                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 2).data(
                        `<center>
                            <span class='text-dark fw-bold px-1'> 
                            ` + $producto + `
                            </span>
                            <div class="text-sm text-muted m-0 d-flex justify-content-center">
                                <i class="fas fa-minus-circle text-danger fs-2 mr-2 btnDisminuirCantidad"  codigo_producto="` + (cod_producto_actual) + `"></i>
                                <input type="number" style="width:80px;" class="form-control form-control-sm my-disabled text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                        $.trim(cod_producto_actual) + ` value="` + ($cantidad_actual) + `" >
                                <i class="fas fa-plus-circle text-primary fs-2 ml-2 btnAumentarCantidad"  codigo_producto="` + (cod_producto_actual) + `" ></i> 
                            </div>
                        </center>`).draw();


                    // //CALCULAR SUBTOTAL
                    // $subtotal = ($precio_con_igv / 1.18) * $cantidad_actual

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data(parseFloat($cantidad_actual)).draw();

                    $subtotal = ($precio_con_igv / 1.18) * $cantidad_actual;

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 10).data(parseFloat($subtotal).toFixed(2)).draw();

                    //ACTUALIZAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = 1.18;
                        $porcentaje_igv = 0.18;
                        $igv = ($subtotal * $porcentaje_igv); // * EL % DE IGV = 0.18

                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    // //CALCULAR IMPORTE
                    $importe = (parseFloat($precio_con_igv) * (parseFloat($cantidad_actual))); // * EL FACTOR DE IGV = 1.18

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 4).data(`<div class="d-flex flex-column">
                        <span class='text-dark fw-bold px-1 mb-2'>` + ($simbolo_moneda + parseFloat($importe).toFixed(2)) + `                                              
                        </span>
                        <i class='px-1 fas fa-trash fs-5 text-danger btnDeleteProdResp'></i>                         
                        </div>`).draw();

                    // // RECALCULAMOS TOTALES
                    recalcularTotalesResponsive();

                }

            })
        });

        $('#tbl_ListadoProductos_POS_responsive tbody').on('click', '.btnDisminuirCantidad', function() {

            cod_producto_actual = $(this)[0]['attributes']['codigo_producto']['value'];

            $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos_POS_responsive').DataTable().row(index);
                var data = row.data();

                let $subtotal = 0;
                let $factor_igv = 0;
                let $porcentaje_igv = 0;
                let $igv = 0;
                let $importe = 0;

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data());

                    if ($cantidad_actual == 1) {
                        mensajeToast("error", "El minimo es 1und")
                        return;
                    }

                    $cantidad_actual = parseFloat($('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data()) - 1;
                    $producto = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 5).data();
                    $id_tipo_afectacion = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 6).data();
                    $factor_igv = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 7).data(); //1.18
                    $precio_con_igv = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 8).data();

                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 2).data(
                        `<center>
                            <span class='text-dark fw-bold px-1'> 
                            ` + $producto + `
                            </span>
                            <div class="text-sm text-muted m-0 d-flex justify-content-center">
                                <i class="fas fa-minus-circle text-danger fs-2 mr-2 btnDisminuirCantidad"  codigo_producto="` + (cod_producto_actual) + `"></i>
                                <input type="number" style="width:80px;" class="form-control form-control-sm my-disabled text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                        $.trim(cod_producto_actual) + ` value="` + ($cantidad_actual) + `" >
                                <i class="fas fa-plus-circle text-primary fs-2 ml-2 btnAumentarCantidad"  codigo_producto="` + (cod_producto_actual) + `" ></i> 
                            </div>
                        </center>`).draw();


                    // //CALCULAR SUBTOTAL
                    $subtotal = ($precio_con_igv / 1.18) * $cantidad_actual

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data(parseFloat($cantidad_actual)).draw();
                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 10).data(parseFloat($subtotal).toFixed(2)).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $porcentaje_igv = parseFloat($factor_igv) - 1;
                        $igv = (($subtotal * $porcentaje_igv)); // * EL % DE IGV = 0.18
                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }
                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    // //CALCULAR IMPORTE
                    $importe = (parseFloat($precio_con_igv) * (parseFloat($cantidad_actual))); // * EL FACTOR DE IGV = 1.18

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 4).data(`<div class="d-flex flex-column">
                                            <span class='text-dark fw-bold px-1 mb-2'>` + ($simbolo_moneda + parseFloat($importe).toFixed(2)) + `                                              
                                            </span>
                                            <i class='px-1 fas fa-trash fs-5 text-danger btnDeleteProdResp'></i> 
                                            </div>`).draw();

                    // // RECALCULAMOS TOTALES
                    recalcularTotalesResponsive();

                }

            })
        });

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

    })

    function fnc_InicializarFormulario() {

        fnc_CargarDataTableListadoProductos();
        fnc_CargarDataTableListadoProductosResponsive();
        fnc_BloquearDatosCliente(true);
        // fnc_ObtenerCategorias();
        // fnc_ObtenerProductos(0);

        CargarSelects();
        fnc_ObtenerSimboloMoneda();

        //Datos del Comprobante
        // $("#tipo_comprobante").attr("readonly", true);
        $("#nro_documento").val('')
        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')

        //Datos de la Venta
        $("#forma_pago").attr("readonly", true);
        $("#producto").val('')

        $("#total_recibido").val('')
        $("#vuelto").val('')

        //Datos del Resumen
        $("#resumen_opes_gravadas").html($simbolo_moneda + '0.00')
        $("#resumen_opes_inafectas").html($simbolo_moneda + '0.00')
        $("#resumen_opes_exoneradas").html($simbolo_moneda + '0.00')
        $("#resumen_subtotal").html($simbolo_moneda + '0.00')
        $("#resumen_total_igv").html($simbolo_moneda + '0.00')
        $("#resumen_total_venta").html($simbolo_moneda + '0.00')

        $("#resumen_opes_gravadas_responsive").html($simbolo_moneda + '0.00')
        $("#resumen_opes_inafectas_responsive").html($simbolo_moneda + '0.00')
        $("#resumen_opes_exoneradas_responsive").html($simbolo_moneda + '0.00')
        $("#resumen_subtotal_responsive").html($simbolo_moneda + '0.00')
        $("#resumen_total_igv_responsive").html($simbolo_moneda + '0.00')
        $("#resumen_total_venta_responsive").html($simbolo_moneda + '0.00')

        $(".needs-validation-venta").removeClass("was-validated");

        $("#mdlVenta").modal("hide");

        $(".control-sidebar-dark").css("display", "none");
        $("body").removeClass("control-sidebar-slide-open")
    }

    /*===================================================================*/
    // C A R G A R   D R O P D O W N'S
    /*===================================================================*/
    function CargarSelects() {

        // TIPO DE COMPROBANTE
        CargarSelect('03', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');

        // SERIE DEL COMPROBANTE
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante option:selected').val());
        $("#serie").prop('selectedIndex', 1).change();

        fnc_ObtenerCorrelativo($("#serie").val())


        //TIPO DE DOCUMENTO
        CargarSelect('0', $("#tipo_documento"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');

        //FORMA DE PAGO
        CargarSelect('1', $("#forma_pago"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_forma_pago');

        //MEDIO DE PAGO
        CargarSelect(1, $("#medio_pago"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_medio_pago');


    }

    function fnc_CargarLogoEmpresa() {
        var formData = new FormData();
        formData.append('accion', 'obtener_empresa_principal');

        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        if (response) {
            $("#logo_sistema").attr("src", "vistas/assets/dist/img/logos_empresas/" + response.logo);
        } else {
            $("#logo_sistema").attr("src", "vistas/assets/dist/img/logos_empresas/no_image.jpg");
        }

    }

    /*===================================================================*/
    // C A R G A R   D A T A T A B L E   D E   P R O D U C T O S   A   V E N D ER
    /*===================================================================*/
    function fnc_CargarDataTableListadoProductos() {

        if ($.fn.DataTable.isDataTable('#tbl_ListadoProductos_POS')) {
            $('#tbl_ListadoProductos_POS').DataTable().destroy();
            $('#tbl_ListadoProductos_POS tbody').empty();
        }

        $('#tbl_ListadoProductos_POS').DataTable({
            searching: false,
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
                    "targets": "_all"
                },
                {
                    targets: [0, 1, 3, 4, 5, 8, 9],
                    visible: false
                }
            ],
            scrollX: true,
            scrollY: "43vh",
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        ajustarHeadersDataTables($("#tbl_ListadoProductos_POS"))

    }

    /*===================================================================*/
    // C A R G A R   D A T A T A B L E   D E   P R O D U C T O S   A   V E N D ER
    /*===================================================================*/
    function fnc_CargarDataTableListadoProductosResponsive() {

        if ($.fn.DataTable.isDataTable('#tbl_ListadoProductos_POS_responsive')) {
            $('#tbl_ListadoProductos_POS_responsive').DataTable().destroy();
            $('#tbl_ListadoProductos_POS_responsive tbody').empty();
        }

        $('#tbl_ListadoProductos_POS_responsive').DataTable({
            searching: false,
            paging: false,
            info: false,
            "columns": [{
                    "data": "imagen"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "cantidad_temp"
                },
                {
                    "data": "importe"
                },
                {
                    "data": "producto"
                },
                {
                    "data": "id_tipo_igv"
                },
                {
                    "data": "factor_igv"
                },
                {
                    "data": "precio"
                },
                {
                    "data": "igv"
                },
                {
                    "data": "subtotal"
                }
            ],
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [1, 3, 5, 6, 7, 8, 9, 10],
                    visible: false
                }
            ],
            scrollX: true,
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        ajustarHeadersDataTables($("#tbl_ListadoProductos_POS_responsive"))

    }

    function fnc_ObtenerCategorias() {

        var formData = new FormData();
        formData.append('accion', 'obtener_categorias')
        response = SolicitudAjax('ajax/categorias.ajax.php', 'POST', formData)

        $(".div-categorias").html('');

        $(".div-categorias").append(`<a class="btn btn-app bg-warning m-0 w-25 d-flex flex-column justify-content-center align-items-center btnCategoria" categoria="0">
                                            <img src="vistas/assets/imagenes/iconos/categoria.png" style="height: 20px; width: 30%;object-fit: cover" alt="" class=""> Todas
                                        </a>`);

        for (let $i = 0; $i < response.length; $i++) {
            const element = response[$i];

            $(".div-categorias").append(`<a class="btn btn-app px-2 bg-main m-0 w-25 d-flex flex-column justify-content-center align-items-center btnCategoria" categoria="` + element.id + `" >
                                            <img src="vistas/assets/imagenes/iconos/categoria.png" style="height: 20px; width: 30%;object-fit: cover" alt="" class=""> <span class="px-2">` + element.descripcion + `</span>
                                        </a>`);

        }

    }

    function fnc_ObtenerProductos($id_categoria = 0) {


        var formData = new FormData();
        formData.append('accion', 'listar_productos_x_categoria')
        formData.append('id_categoria', $id_categoria)
        response = SolicitudAjax('ajax/productos.ajax.php', 'POST', formData)

        $(".div-productos").html('');

        if (response.length > 0) {

            for (let $i = 0; $i < response.length; $i++) {
                const element = response[$i];

                $(".div-productos").append(`<div class="col-4 col-md-2 p-1" style="height: auto !important;">

                                                <div class="card card-primary card-outline card-outline-tabs m-0 d-flex flex-column justify-content-center align-items-center " style="position: relative;border: 1px solid lightgray;">

                                                    <div class="card-body p-0 text-center" style="height: 100px;width: 100%;">
                                                        <img src="vistas/assets/imagenes/productos/` + element.imagen + `" style="height: 100px; width: 100%;object-fit: containt" alt="" class="">
                                                    </div>

                                                    <span style="height:70px" class="text-center">` + element.producto + `</span>

                                                    <a style="position: absolute; right: 0;top:0;cursor: pointer;" class="text-primary btnAgregar " codigo-producto="` + element.codigo_producto + `"><i class="fas fa-cart-plus fs-5 bg-main p-2" style="border-bottom-left-radius: 15px;"></i></a>

                                                    <span class="text-secondary fw-bold bg-main w-100 text-center">
                                                        S/ ` + element.precio_unitario_con_igv + `
                                                    </span>

                                                </div>

                                            </div>`);

            }
        } else {
            $(".div-productos").append(`<div class="col-lg-12 d-flex justify-content-center align-items-center" style="height: auto !important">
                                           <span class="fs-3"> No Hay Productos    </span>
                                        </div>`);
        }


    }

    function fnc_ObtenerProductosPorDescripcion($producto = '') {


        var formData = new FormData();
        formData.append('accion', 'listar_productos_x_descripcion')
        formData.append('producto', $producto)
        response = SolicitudAjax('ajax/productos.ajax.php', 'POST', formData)

        $(".div-productos").html('');

        if (response.length > 0) {

            for (let $i = 0; $i < response.length; $i++) {
                const element = response[$i];

                $(".div-productos").append(`<div class="col-4 col-md-2 " style="height: auto !important">

                                                <div class="card card-primary card-outline card-outline-tabs d-flex flex-column justify-content-center align-items-center mt-1" style="position: relative">

                                                    <div class="card-body p-0 text-center" style="height: 100px;width: 100%;">
                                                        <img src="vistas/assets/imagenes/productos/` + element.imagen + `" style="height: 100px; width: 100%;object-fit: containt" alt="" class="">
                                                    </div>

                                                    <span style="height:70px" class="text-center">` + element.producto + `</span>

                                                    <span style="position: absolute; right: 0;top:0;cursor: pointer;" class="text-primary btnAgregar" codigo-producto=` + element.codigo_producto + `><i class="fas fa-cart-plus fs-4 bg-primary p-2"></i></span>

                                                    <span style="position: absolute; left: 0;bottom:0;" class="text-secondary fw-bold bg-main w-100 text-center">
                                                        <span>S/ ` + element.precio_unitario_con_igv + `</span
                                                    </span>

                                                </div>
                                            </div>`);

            }
        } else {
            $(".div-productos").append(`<div class="col-lg-12 d-flex justify-content-center align-items-center" style="height: auto !important">
                                   <span class="fs-3"> No Hay Productos    </span>
                                </div>`);
        }

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
        $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);
            var data = row.data();

            if (codigo_producto == data['codigo_producto']) {

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

                            // mensajeToast('error', ' El producto no tiene el stock ingresado, el stock actual es: ' + respuesta.stock);

                            Toast.fire({
                                icon: 'error',
                                title: ' El producto no tiene el stock ingresado, el stock actual es: ' + respuesta.stock
                            })

                            if ($('#switch_codigo_barras').is(':checked')) {
                                $("#producto").focus();
                                $("#producto").val("");
                            }

                        } else {

                            $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / 1.18);
                            $id_tipo_afectacion = $('#tbl_ListadoProductos_POS').DataTable().cell(index, 3).data()

                            let $subtotal = 0;
                            let $factor_igv = 0;
                            let $porcentaje_igv = 0;
                            let $igv = 0;
                            let $importe = 0;

                            // ACTUALIZAR CANTIDAD A 1
                            $('#tbl_ListadoProductos_POS').DataTable().cell(index, 7).data(`<input  type="number" min="0"
                                        style="width:80px;" 
                                        codigoProducto = "` + codigo_producto + `" 
                                        class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                        value="` + cantidad_a_comprar + `">`).draw();

                            // $('#tbl_ListadoProductos_POS').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = $valor_unitario * cantidad_a_comprar;

                            $('#tbl_ListadoProductos_POS').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IGV
                            if ($id_tipo_afectacion == 10) {
                                $factor_igv = 1.18;
                                $porcentaje_igv = 0.18;
                                $igv = ($valor_unitario * cantidad_a_comprar * $porcentaje_igv); // * EL % DE IGV = 0.18

                            } else {
                                $igv = 0
                                $factor_igv = 1;
                            }

                            $('#tbl_ListadoProductos_POS').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                            //ACTUALIZAR IMPORTE
                            $importe = ($valor_unitario * cantidad_a_comprar) * $factor_igv; // * EL FACTOR DE IGV = 1.18

                            $('#tbl_ListadoProductos_POS').DataTable().cell(index, 10).data(parseFloat($importe).toFixed(2)).draw();

                            // RECALCULAMOS TOTALES
                            recalcularTotales();

                            if ($('#switch_codigo_barras').is(':checked')) {
                                $("#producto").focus();
                                $("#producto").val("");
                            }

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

                    $('#tbl_ListadoProductos_POS').DataTable().row.add({
                        'id': itemProducto,
                        'codigo_producto': $codigo_producto,
                        'descripcion': $descripcion.length > 20 ? $descripcion.substring(0, 20) + '...' : $descripcion,
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'tipo_igv': respuesta.tipo_afectacion_igv,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value=` + parseFloat($precio).toFixed(2) + `>`,
                        'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value="1">`,
                        'subtotal': parseFloat($subtotal).toFixed(2),
                        'igv': parseFloat($igv).toFixed(2),
                        'importe': parseFloat($importe).toFixed(2),
                        'acciones': "<center>" +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "</center>"
                    }).draw();

                    itemProducto = itemProducto + 1;
                    //  Recalculamos el total de la venta
                    recalcularTotales();

                    if ($('#switch_codigo_barras').is(':checked')) {
                        // alert("entro")
                        $("#producto").focus();
                        $("#producto").val("");
                    }

                    // $("#producto").val("");
                    // $("#producto").focus();

                    // $(".div-carrito-pos").append(`<div class="media p-2">
                    //                                 <img src="vistas/assets/imagenes/productos/` + respuesta.imagen + `" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    //                                 <div class="media-body">
                    //                                     <h6 class="text-dark m-0">
                    //                                         ` + ($descripcion.length > 20 ? $descripcion.substring(0, 20) + '...' : $descripcion) + `
                    //                                         <span class="float-right text-sm text-danger fw-bold">
                    //                                         ` + $simbolo_moneda + parseFloat($importe).toFixed(2) + `   
                    //                                         </span>
                    //                                     </h6>
                    //                                     <span>` + $codigo_producto + `</span>
                    //                                     <p class="text-sm text-muted m-0">                                                             
                    //                                         <i class="fas fa-minus-circle text-danger fs-5 mr-2 btnDisminuirCantidad" cantidad="1" ></i>
                    //                                             <span codigo_producto="` + $codigo_producto + `" >1<span> 
                    //                                         <i class="fas fa-plus-circle text-primary fs-5 ml-2 btnAumentarCantidad" cantidad="1" codigo_producto="` + $codigo_producto + `" ></i> 
                    //                                     </p>
                    //                                 </div>
                    //                             </div>
                    //                             <div class="dropdown-divider m-0"></div>`)

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    // mensajeToast('error', 'EL PRODUCTO NO EXISTE O NO TIENE STOCK');
                    Toast.fire({
                        icon: 'error',
                        title: 'EL PRODUCTO NO EXISTE O NO TIENE STOCK'
                    })
                }

            }
        });




    }

    /*===================================================================*/
    // C A R G A R   P R O D U C T O S   E N   E L   D A T A T A B L E
    /*===================================================================*/
    function CargarProductosResponsive(producto = "") {

        var codigo_producto;

        if (producto != "") codigo_producto = producto;
        else codigo_producto = $("#iptCodigoVenta").val();

        var producto_repetido = 0;

        /*===================================================================*/
        // AUMENTAMOS LA CANTIDAD SI EL PRODUCTO YA EXISTE EN EL LISTADO
        /*===================================================================*/
        $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos_POS_responsive').DataTable().row(index);
            var data = row.data();

            if (codigo_producto == data['codigo_producto']) {


                // mensajeToast("error", "Producto ya fue agregado")
                // $("#producto").val("");
                // $("#producto").focus();

                producto_repetido = 1;

                cantidad_a_comprar = parseFloat($('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data()) + 1;

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

                            //mensajeToast('error', ' El producto no tiene el stock ingresado, el stock actual es: ' + respuesta.stock);

                            Toast.fire({
                                icon: 'error',
                                title: ' El producto no tiene el stock ingresado, el stock actual es: ' + respuesta.stock
                            })

                            // $("#producto").val("");
                            // $("#producto").focus();

                        } else {

                            $valor_unitario = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 8).data()

                            let $subtotal = 0;
                            let $factor_igv = 0;
                            let $porcentaje_igv = 0;
                            let $igv = 0;
                            let $importe = 0;

                            // // ACTUALIZAR CANTIDAD A 1
                            $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 2).data(
                                `<center>
                                    <span class='text-dark fw-bold px-1'> 
                                    ` + data['producto'] + `
                                    </span>
                                    <div class="text-sm text-dark fw-bold m-0 d-flex justify-content-center">
                                        <i class="fas fa-minus-circle text-danger fs-2 mr-2 btnDisminuirCantidad" codigo_producto="` + (codigo_producto) + `"></i>
                                        <input type="number" style="width:80px;" class="form-control form-control-sm my-disabled text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                                $.trim(codigo_producto) + ` value="` + (cantidad_a_comprar) + `" >
                                        <i class="fas fa-plus-circle text-primary fs-2 ml-2 btnAumentarCantidad" codigo_producto="` + (codigo_producto) + `" ></i> 
                                    </div>
                                </center>`).draw();

                            $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data(parseFloat(cantidad_a_comprar)).draw();

                            // // $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = ($valor_unitario / 1.18) * cantidad_a_comprar;

                            $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 10).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IGV
                            if ($id_tipo_afectacion == 10) {
                                $factor_igv = 1.18;
                                $porcentaje_igv = 0.18;
                                $igv = (($valor_unitario / 1.18) * cantidad_a_comprar * $porcentaje_igv); // * EL % DE IGV = 0.18

                            } else {
                                $igv = 0
                                $factor_igv = 1;
                            }

                            $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                            // //ACTUALIZAR IMPORTE
                            $importe = ($valor_unitario * cantidad_a_comprar); // * EL FACTOR DE IGV = 1.18

                            $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 4).data(`<div class="d-flex flex-column">
                                        <span class='text-dark fw-bold px-1 mb-2'>` + ($simbolo_moneda + parseFloat($importe).toFixed(2)) + `
                                        </span>
                                            <i class='px-1 fas fa-trash fs-5 text-danger btnDeleteProdResp'></i> 
                            </div>`).draw();

                            // RECALCULAMOS TOTALES
                            recalcularTotalesResponsive();

                            Toast.fire({
                                icon: 'success',
                                title: 'Producto Agregado'
                            })

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

                    $('#tbl_ListadoProductos_POS_responsive').DataTable().row.add({
                        // 'id': itemProducto,

                        'imagen': `<img src="vistas/assets/imagenes/productos/` + respuesta.imagen + `" alt="User Avatar" class="img-size-50 img-circle m-0">`,
                        'codigo_producto': $codigo_producto,
                        'descripcion': `<center
                                        <span class='text-dark fw-bold px-1'> 
                                        ` + ($descripcion.length > 20 ? $descripcion.substring(0, 20) + '...' : $descripcion) + `
                                        </span>
                                        <div class="text-sm m-0 d-flex justify-content-center">
                                            <i class="fas fa-minus-circle text-danger fs-2 mr-2 btnDisminuirCantidad" cantidad="1" ></i>
                                            <input type="number" style="width:80px;" class="form-control form-control-sm my-disabled text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value="1" >
                                            <i class="fas fa-plus-circle text-primary fs-2 ml-2 btnAumentarCantidad" cantidad="1" codigo_producto="` + $codigo_producto + `" ></i> 
                                        </div>
                            </center>`,
                        'cantidad_temp': 1,
                        'importe': `<div class="d-flex flex-column">
                                        <span class='text-dark fw-bold px-1 mb-2'>` + ($simbolo_moneda + parseFloat($importe).toFixed(2)) + `</span>
                                        <i class='px-1 fas fa-trash fs-5 text-danger btnDeleteProdResp'></i> 
                                    </div>`,
                        'producto': $descripcion,
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'factor_igv': $factor_igv,
                        'precio': $precio,
                        'igv': parseFloat($igv).toFixed(2),
                        'subtotal': parseFloat($subtotal).toFixed(2)

                        // 'acciones': "<center>" +
                        //     "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                        //     "<i class='fas fa-trash fs-5'> </i> " +
                        //     "</span>" +
                        //     "</center>"
                    }).draw();

                    itemProducto = itemProducto + 1;
                    //  Recalculamos el total de la venta
                    recalcularTotalesResponsive();

                    Toast.fire({
                        icon: 'success',
                        title: 'Producto Agregado'
                    })

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    // mensajeToast('error', 'EL PRODUCTO NO EXISTE O NO TIENE STOCK');
                    Toast.fire({
                        icon: 'error',
                        title: 'EL PRODUCTO NO EXISTE O NO TIENE STOCK'
                    })
                }

            }
        });

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

        $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);
            var data = row.data();

            factor_igv = 1;
            $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / 1.18);
            $cantidad = parseFloat($.parseHTML(data['cantidad'])[0]['value']);

            if (data['id_tipo_igv'] == 10) {
                total_opes_gravadas = parseFloat(total_opes_gravadas) + (parseFloat($valor_unitario) * parseFloat($cantidad));
                total_igv = parseFloat(total_igv) + ((parseFloat($valor_unitario) * $cantidad) * 0.18);
            }

            if (data['id_tipo_igv'] == 20) {
                total_opes_exoneradas = parseFloat(total_opes_exoneradas + ($valor_unitario * $cantidad));
            }

            if (data['id_tipo_igv'] == 30) {
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
        $("#vuelto").val('')

    }

    /*===================================================================*/
    //R E C A L C U L A R   L O S   T O T A L E S  D E   V E N T A
    /*===================================================================*/
    function recalcularTotalesResponsive() {

        let totalVenta = 0.00;
        let total_opes_gravadas = 0.00;
        let total_opes_exoneradas = 0.00;
        let total_opes_inafectas = 0.00;
        let subtotal = 0.00;
        let total_igv = 0.00;
        let factor_igv = 1;

        $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos_POS_responsive').DataTable().row(index);
            var data = row.data();

            factor_igv = 1;
            $valor_unitario = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 8).data();
            $cantidad = $('#tbl_ListadoProductos_POS_responsive').DataTable().cell(index, 3).data();

            if (data['id_tipo_igv'] == 10) {
                total_opes_gravadas = parseFloat(total_opes_gravadas) + (parseFloat($valor_unitario / 1.18) * parseFloat($cantidad));
                total_igv = parseFloat(total_igv) + ((parseFloat($valor_unitario / 1.18) * $cantidad) * 0.18);
            }

            if (data['id_tipo_igv'] == 20) {
                total_opes_exoneradas = parseFloat(total_opes_exoneradas + ($valor_unitario * $cantidad));
            }

            if (data['id_tipo_igv'] == 30) {
                total_opes_inafectas = parseFloat(total_opes_inafectas + ($valor_unitario * $cantidad));
            }

        });

        totalVenta = parseFloat(totalVenta) + parseFloat(total_opes_gravadas) + parseFloat(total_opes_exoneradas) + parseFloat(total_opes_inafectas) + parseFloat(total_igv)
        subtotal = subtotal + (total_opes_gravadas + total_opes_exoneradas + total_opes_inafectas);

        $("#resumen_opes_gravadas_responsive").html($simbolo_moneda + parseFloat(total_opes_gravadas).toFixed(2));
        $("#resumen_opes_inafectas_responsive").html($simbolo_moneda + parseFloat(total_opes_inafectas).toFixed(2));
        $("#resumen_opes_exoneradas_responsive").html($simbolo_moneda + parseFloat(total_opes_exoneradas).toFixed(2));
        $("#resumen_subtotal_responsive").html($simbolo_moneda + parseFloat(subtotal).toFixed(2));
        $("#resumen_total_igv_responsive").html($simbolo_moneda + parseFloat(total_igv).toFixed(2));
        $("#resumen_total_venta_responsive").html($simbolo_moneda + parseFloat(totalVenta).toFixed(2));

        $("#total_recibido").val(parseFloat(totalVenta).toFixed(2))
        $("#vuelto").val('')

    }

    function fnc_ObtenerSimboloMoneda() {

        var formData = new FormData();
        formData.append('accion', 'obtener_simbolo_moneda');
        formData.append('moneda', 'PEN');

        response = SolicitudAjax("ajax/ventas.ajax.php", "POST", formData);

        $simbolo_moneda = response["simbolo"];
    }

    function fnc_ObtenerCorrelativo(id_serie) {
        var formData = new FormData();
        formData.append('accion', 'obtener_correlativo_serie');
        formData.append('id_serie', id_serie);

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);
        $("#correlativo").val(response["correlativo"])
    }

    function fnc_ConsultarNroDocumento(nro_documento) {

        var formData = new FormData();
        let accion = '';

        if ($("#tipo_documento").val() == 1) {
            accion = 'consultar_dni';
        } else if ($("#tipo_documento").val() == 6) {
            accion = 'consultar_ruc';
        }

        formData.append('accion', accion);
        formData.append('nro_documento', nro_documento);

        response = SolicitudAjax('ajax/apis/apis.ajax.php', 'POST', formData);

        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')

        if (response && response["existe"]) {
            $("#nombre_cliente_razon_social").val(response['razonSocial']);
            $("#direccion").val(response['direccion']);
        } else {

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
                    return;
                }

                if ($("#tipo_documento").val() == 1) {
                    $("#nombre_cliente_razon_social").val(response['nombres'] + ' ' + response['apellidoPaterno'] + ' ' +
                        response['apellidoMaterno']);
                } else if ($("#tipo_documento").val() == 6) {
                    $("#nombre_cliente_razon_social").val(response['razonSocial']);
                    $("#direccion").val(response['direccion']);
                }

                $("#direccion").focus();

            }
        }
    }

    function fnc_BloquearDatosCliente(disabled) {
        $("#nro_documento").prop('disabled', disabled)
        $("#nombre_cliente_razon_social").prop('disabled', disabled)
        $("#direccion").prop('disabled', disabled)
        $("#telefono").prop('disabled', disabled)
        if (disabled == true) $(".btnConsultarDni").prop('readonly', 'true')
        else $(".btnConsultarDni").prop('readonly', 'false');

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
    //G U A R D A R   V E N T A
    /*===================================================================*/
    function fnc_GuardarVenta() {

        let count = 0;
        form_comprobante_validate = validarFormulario('needs-validation-venta');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        if ($("#tipo_documento").val() != "0" && ($("#nro_documento").val() == "" ||
                $("#nombre_cliente_razon_social").val() == "" ||
                $("#direccion").val() == "")) {
            mensajeToast("error", "Debe completar el Nombre y la Dirección del Cliente");
            return;
        }

        if ($("#resumen_total_venta").html().replace('S/', '') > 700) {

            if ($("#tipo_documento").val() == "0") {
                mensajeToast("error", "Para montos mayores a 700, se debe identificar al cliente!");
                return;
            }

        }

        $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {
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

        if ($("#tipo_comprobante").val() == "01" && $("#tipo_documento").val() != "6") {
            mensajeToast("error", "Debe seleccionar un RUC");
            return;
        }
        //FIN DE LAS VALIDACIONES

        var $productos = [];

        //DATOS DEL CLIENTE
        $tipo_documento = $("#tipo_documento").val();
        $nro_documento = $("#nro_documento").val();
        $nombre_cliente_razon_social = $("#nombre_cliente_razon_social").val();
        $direccion = $("#direccion").val();

        //DATOS DEL COMPROBANTE
        $serie = $("#serie").val();
        $forma_pago = $("#forma_pago").val();
        $tipo_comprobante = $("#tipo_comprobante").val();
        $medio_pago = $("#medio_pago").val();
        $vuelto = $("#vuelto").val();
        $total_recibido = $("#total_recibido").val();

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

                if (!$venta_responsive) {

                    $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

                        var arr = {};
                        var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);

                        var data = row.data();

                        precio = parseFloat($.parseHTML(data['precio'])[0]['value']) / 1.18;
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
                } else {
                    $('#tbl_ListadoProductos_POS_responsive').DataTable().rows().eq(0).each(function(index) {

                        var arr = {};
                        var row = $('#tbl_ListadoProductos_POS_responsive').DataTable().row(index);

                        var data = row.data();

                        arr['codigo_producto'] = data["codigo_producto"];
                        arr['descripcion'] = data["producto"];
                        arr['id_tipo_igv'] = data["id_tipo_igv"];
                        arr['precio'] = data["precio"] / 1.18;
                        arr['cantidad'] = data["cantidad_temp"];
                        arr['igv'] = data["igv"];
                        arr['subtotal'] = data["subtotal"];
                        arr['importe_total'] = parseFloat(data["precio"]) * parseFloat(data["cantidad_temp"]);
                        $productos.push(arr);

                    });
                }

                var formData = new FormData();

                formData.append('accion', 'registrar_venta_pos');

                formData.append('tipo_documento', $tipo_documento);
                formData.append('nro_documento', $nro_documento);
                formData.append('nombre_cliente_razon_social', $nombre_cliente_razon_social);
                formData.append('direccion', $direccion);

                formData.append('serie', $serie);
                formData.append('forma_pago', $forma_pago);

                formData.append('tipo_comprobante', $tipo_comprobante);
                formData.append('medio_pago', $medio_pago);
                formData.append('vuelto', $vuelto);
                formData.append('total_recibido', $total_recibido);

                formData.append('productos', JSON.stringify($productos));
                formData.append('id_caja', $("#id_caja").val());

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })


                window.open($ruta+'vistas/modulos/impresiones/generar_ticket.php?id_venta=' +
                    response["id_venta"],
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
                // CargarContenido('vistas/venta_pos.php', 'content-wrapper');

            }

        })
    }

    /*===================================================================*/
    // V A L I D A R   S T O C K   A N T E S   D E  G U A R D A R   V E N T A
    /*===================================================================*/
    function fnc_ValidarStock() {

        let stock_valido = true;

        $('#tbl_ListadoProductos_POS').DataTable().rows().eq(0).each(function(index) {

            $(this).addClass('bg-danger')

            var row = $('#tbl_ListadoProductos_POS').DataTable().row(index);

            var data = row.data();

            var datos = new FormData();
            datos.append('accion', 'verificar_stock');
            datos.append('codigo_producto', data["codigo_producto"]);
            datos.append('cantidad_a_comprar', data["cantidad_final"]);

            response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos);

            if (response.stock < parseInt(data["cantidad_final"])) {
                mensajeToast("error", "El producto " + data["descripcion"] + " no tiene el stock ingresado, el stock actual es: " + response.stock)
                $('#tbl_ListadoProductos_POS').DataTable().cell(index, 7)
                    .data(`<input  type="number" min="0"
                    style="width:80px;background-color:#D98880" 
                    codigoProducto = "` + cod_producto_actual + `" 
                    class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                    value="` + data["cantidad_final"] + `">`).draw();
                stock_valido = false;

            }

        });

        return stock_valido;
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

            return false;
        } else {
            return true;
        }
    }
</script>