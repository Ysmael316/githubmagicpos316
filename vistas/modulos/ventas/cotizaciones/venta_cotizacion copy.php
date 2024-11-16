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

        <div class="row">

            <div class="col-12 ">

                <div class="card card-primary card-outline card-outline-tabs">

                    <div class="card-header p-0 border-bottom-0">

                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                            <!-- TAB LISTADO DE COMPRAS  -->
                            <li class="nav-item">
                                <a class="nav-link active my-0" id="listado-cotizaciones-tab" data-toggle="pill" href="#listado-cotizaciones" role="tab" aria-controls="listado-cotizaciones" aria-selected="true"><i class="fas fa-list"></i> Listado de Cotizaciones</a>
                            </li>

                            <!-- TAB REGISTRO DE COMPRAS -->
                            <li class="nav-item">
                                <a class="nav-link  my-0" id="registrar-cotizacion-tab" data-toggle="pill" href="#registrar-cotizacion" role="tab" aria-controls="registrar-cotizacion" aria-selected="false"><i class="fas fa-file-signature"></i> Registrar</a>
                            </li>

                        </ul>

                    </div>

                    <div class="card-body p-0">

                        <div class="tab-content" id="custom-tabs-four-tabContent">

                            <div class="tab-pane fade active show" id="listado-cotizaciones" role="tabpanel" aria-labelledby="listado-cotizaciones-tab">

                                <div class="row p-4">

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

                            <div class="tab-pane fade " id="registrar-cotizacion" role="tabpanel" aria-labelledby="registrar-cotizacion-tab">

                                <div class="row">

                                    <div class="col-12 ">

                                        <div class="card card-primary card-outline card-outline-tabs">

                                            <div class="card-body py-1">

                                                <form id="frm-datos-cotizacion" class="needs-validation-cotizacion" novalidate>

                                                    <input type="hidden" name="id_cotizacion" id="id_cotizacion" value="0">

                                                    <div class="row">

                                                        <!-- --------------------------------------------------------- -->
                                                        <!-- DATOS DEL COMPROBANTE -->
                                                        <!-- --------------------------------------------------------- -->
                                                        <div class="col-12">

                                                            <div class="card card-gray shadow">

                                                                <div class="card-header">
                                                                    <h3 class="card-title fs-6">DATOS DE LA COTIZACIÓN</h3>
                                                                    <div class="card-tools m-0">

                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                            <i class="fas fa-minus"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>

                                                                    </div> <!-- ./ end card-tools -->
                                                                </div> <!-- ./ end card-header -->

                                                                <div class="card-body py-2">

                                                                    <div class="row">

                                                                        <!-- EMITIR POR -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color">
                                                                                <i class="fas fa-building mr-1 my-text-color"></i> Empresa Emisora
                                                                            </label>
                                                                            <select class="form-select" id="empresa_emisora" name="empresa_emisora" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione Empresa</div>
                                                                        </div>

                                                                        <!-- TIPO COMPROBANTE -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color">
                                                                                <i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante
                                                                            </label>
                                                                            <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                                                        </div>


                                                                        <!-- FECHA DE EMISION -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color">
                                                                                <i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Emisión
                                                                            </label>
                                                                            <div class="input-group input-group-sm mb-3 ">
                                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_emision">
                                                                                    <i class="fas fa-calendar-alt ml-1 text-white"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_emision" name="fecha_emision" aria-describedby="inputGroup-sizing-sm" required>
                                                                                <div class="invalid-feedback">Ingrese Fecha de Emisión</div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- FECHA DE EXPIRACION -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color">
                                                                                <i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Expiración
                                                                            </label>
                                                                            <div class="input-group input-group-sm mb-3 ">
                                                                                <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_expiracion">
                                                                                    <i class="fas fa-calendar-alt ml-1 text-white"></i>
                                                                                </span>
                                                                                <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_expiracion" name="fecha_expiracion" aria-describedby="inputGroup-sizing-sm" required>
                                                                                <div class="invalid-feedback">Ingrese Fecha de Expiración</div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- SERIE -->
                                                                        <div class="col-12 col-lg-2 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                                                            <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione Serie del Comprobante</div>
                                                                        </div>

                                                                        <!-- CORRELATIVO -->
                                                                        <div class="col-12 col-lg-2 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                                                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required readonly>
                                                                        </div>

                                                                        <!-- MONEDA -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-wave mr-1 my-text-color"></i>Moneda</label>
                                                                            <select class="form-select" id="moneda" name="moneda" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione la moneda</div>
                                                                        </div>

                                                                        <!-- TIPO DE CAMBIO -->
                                                                        <div class="col-12 col-lg-2 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Tipo Cambio</label>

                                                                            <div class="input-group input-group-sm mb-3 ">
                                                                                <span class="input-group-text btnActualizarMontos" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-sync-alt ml-1 text-white"></i></span>
                                                                                <input type="number" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="tipo_cambio" name="tipo_cambio" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" value="1" required>
                                                                                <div class="invalid-feedback">Ingrese Tipo de cambio</div>
                                                                            </div>


                                                                            <!-- <input type="number" style="border-radius: 20px;" class="form-control form-control-sm my-disabled" value="1" id="tipo_cambio" name="tipo_cambio" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> -->

                                                                        </div>

                                                                        <!-- COMPROBANTE A GENERAR -->
                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-contract mr-1 my-text-color"></i>Generar</label>
                                                                            <select class="form-select" id="tipo_comprobante_a_generar" name="tipo_comprobante_a_generar" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione Serie del Comprobante</div>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <!-- --------------------------------------------------------- -->
                                                        <!-- DATOS DEL CLIENTE -->
                                                        <!-- --------------------------------------------------------- -->
                                                        <div class="col-12">

                                                            <div class="card card-gray shadow">

                                                                <div class="card-header">
                                                                    <h3 class="card-title fs-6">DATOS DEL CLIENTE</h3>
                                                                    <div class="card-tools m-0">

                                                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                            <i class="fas fa-minus"></i>
                                                                        </button>
                                                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>

                                                                    </div> <!-- ./ end card-tools -->
                                                                </div> <!-- ./ end card-header -->

                                                                <div class="card-body py-2">

                                                                    <div class="row">

                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento</label>
                                                                            <select class="form-select" id="tipo_documento" name="tipo_documento" aria-label="Floating label select example" required>
                                                                            </select>
                                                                            <div class="invalid-feedback">Seleccione el Tipo de Documento</div>
                                                                        </div>

                                                                        <div class="col-12 col-lg-3 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento</label>
                                                                            <div class="input-group input-group-sm mb-3 ">
                                                                                <span class="input-group-text btnConsultarDni" id="inputGroup-sizing-sm" style="cursor: pointer;"><i class="fas fa-search ml-1 text-white"></i></span>
                                                                                <input type="text" class="form-control form-control-sm" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="nro_documento" name="nro_documento" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" required>
                                                                                <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-12 col-lg-6 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre del Cliente/ Razón Social</label>
                                                                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_razon_social" name="nombre_cliente_razon_social" placeholder="Ingrese Nombre del Cliente o Razón Social" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                        </div>

                                                                        <div class="col-12 col-lg-8 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección</label>
                                                                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                                                        </div>

                                                                        <div class="col-12 col-lg-4 mb-2">
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

                                                            <div class="card card-gray shadow">

                                                                <div class="card-header">
                                                                    <h4 class="card-title fs-6">LISTADO DE PRODUCTOS</h4>
                                                                </div> <!-- ./ end card-header -->

                                                                <div class="card-body py-2">

                                                                    <div class="row">

                                                                        <div class="d-block col-12 d-lg-none mb-3">
                                                                            <div class="col-12 text-center px-2 rounded-3">
                                                                                <div class="btn fw-bold fs-3  text-warning my-bg w-100" id="totalVenta">S/0.00</div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                                                                        <div class="col-12 col-lg-10 mb-2">
                                                                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                                                            <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                                        </div>

                                                                        <!-- BUSCAR PRODUCTO -->
                                                                        <div class="d-flex align-items-end p-0 my-2 col-12  col-lg-2 ">

                                                                            <a class="btn btn-sm btn-danger w-100 fw-bold btnLimpiarListado" style="position: relative;">
                                                                                <span class="text-button">Limpiar</span>
                                                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                                                    <i class="fas fa-trash fs-5"></i>
                                                                                </span>
                                                                            </a>
                                                                        </div>

                                                                        <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                                                        <div class="col-md-12 mt-2">

                                                                            <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow" style="font-size: 12px;">
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
                                                                    <div class="card card-gray shadow w-lg-100 float-right">

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

                                                                <div class="col-12 text-center my-1">

                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <a class="btn btn-sm btn-danger  fw-bold w-100 " id="btnCancelarCotizacion" style="position: relative;">
                                                                                <span class="text-button">CANCELAR</span>
                                                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <a class="btn btn-sm btn-success  fw-bold  w-100" id="btnGuardarComprobante" style="position: relative;">
                                                                                <span class="text-button">GUARDAR</span>
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

                                                </form>

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

        $('#empresa_emisora').on('change', function(e) {
            fnc_VerificarEmpresaFacturacionElectronica();
        });

        $('#tipo_comprobante').on('change', function(e) {
            $("#correlativo").val('')
            CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante').val());
        });

        $("#tipo_comprobante_a_generar").on('change', function(e) {

            if ($("#tipo_comprobante_a_generar").val() == "01") {
                $("#tipo_documento").val("6").change();
            } else {
                $("#tipo_documento").val("1").change();
            }

        });

        $('#tipo_documento').on('change', function(e) {

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
        I N I C I O   E V E N T O S   D A T A T A B L E   L I S T A D O   D E   P R O D U C T O S
        ====================================================================================== */

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
                                                                                    style="width:80px;"
                                                                                    codigoProducto = ` + cod_producto_actual + `
                                                                                    class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                                                    value="` + cantidad_actual + `">`).draw();


                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = $afectacion.factor;
                        $porcentaje_igv = $afectacion.porcentaje;

                        //CALCULAR SUBTOTAL
                        $subtotal = ($precio_con_igv / $factor_igv) * cantidad_actual
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
                                style="width:80px;" 
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

        // EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        $('#tbl_ListadoProductos tbody').on('click', '.btnEliminarproducto', function() {
            $('#tbl_ListadoProductos').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });
        /* ======================================================================================
        F I N   E V E N T O S   D A T A T A B L E   L I S T A D O   D E   P R O D U C T O S
        ====================================================================================== */

        $("#btnGuardarComprobante").on('click', function() {
            fnc_GuardarCotizacion();
        })

        $("#btnCancelarCotizacion").on('click', function() {
            fnc_InicializarFormulario();
        })

        $(".btnLimpiarListado").on('click', function() {
            fnc_CargarDataTableListadoProductos();
            recalcularTotales();

        })

        $('#tbl_cotizaciones tbody').on('click', '.btnEditarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_EditarCotizacion($id_cotizacion);
        });

        $('#tbl_cotizaciones tbody').on('click', '.btnEliminarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_EliminarCotizacion($id_cotizacion);
        });

        $('#tbl_cotizaciones tbody').on('click', '.btnConsultarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_ConsultarCotizacion($id_cotizacion);
        });

        $('#tbl_cotizaciones tbody').on('click', '.btnGenerarBoleta', function() {
            /*===================================================================*/
            // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
            /*===================================================================*/
            if (fnc_ObtenerEstadoCajaPorDia()) {
                $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
                fnc_GenerarBoleta($id_cotizacion);
            }

        });

        $('#tbl_cotizaciones tbody').on('click', '.btnGenerarFactura', function() {
            /*===================================================================*/
            // V E R I F I C A R   E L   E S T A D O   D E   L A   C A J A
            /*===================================================================*/
            if (fnc_ObtenerEstadoCajaPorDia()) {
                $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
                fnc_GenerarFactura($id_cotizacion);
            }

        });

        $('#tbl_cotizaciones tbody').on('click', '.btnConfirmarCotizacion', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_ConfirmarCotizacion($id_cotizacion);
        });

        $('#tbl_cotizaciones tbody').on('click', '.btnImprimirCotizacionA4', function() {
            $id_cotizacion = $("#tbl_cotizaciones").DataTable().row($(this).parents('tr')).data()['2']
            fnc_ImprimirCotizacionA4($id_cotizacion)
        })

        $("#listado-cotizaciones-tab").on('click', function() {
            fnc_InicializarFormulario();
        })

        // $("#moneda").change(function() {
        //     fnc_ObtenerSimboloMoneda();
        //     fnc_CargarDataTableListadoProductos();
        //     recalcularTotales();
        //     if ($("#moneda").val() == "PEN") {
        //         $("#tipo_cambio").addClass("my-disabled");
        //         $("#tipo_cambio").val(parseFloat(1.000).toFixed(3))
        //     } else {
        //         $("#tipo_cambio").removeClass("my-disabled");
        //     }

        //     // fnc_InicializarFormulario();
        // })

        $("#tipo_cambio").keyup(function() {
            $tipo_cambio = $("#tipo_cambio").val()
        })

        $(".btnActualizarMontos").on('click', function() {
            $tipo_cambio = $("#tipo_cambio").val()
            recalcularTotales();
        })

        // EVENTO PARA MODIFICAR EL PRECIO DE VENTA DEL PRODUCTO
        $('#tbl_ListadoProductos tbody').on('click', '.dropdown-item', function() {


            codigo_producto = $(this).attr("codigo");
            precio_venta = parseFloat($(this).attr("precio")).toFixed(2);

            recalcularMontos(codigo_producto, precio_venta);
        });

        fnc_OcultarLoader();

    })


    function fnc_InicializarFormulario() {

        $("#listado-cotizaciones-tab").addClass('active')
        $("#listado-cotizaciones-tab").attr('aria-selected', true)
        $("#listado-cotizaciones").addClass('active show')

        $("#registrar-cotizacion-tab").removeClass('active')
        $("#registrar-cotizacion-tab").attr('aria-selected', false)
        $("#registrar-cotizacion").removeClass('active show')

        $("#registrar-cotizacion-tab").html('<i class="fas fa-file-signature"></i> Registrar')

        CargarSelects();
        fnc_ObtenerSimboloMoneda();
        fnc_ObtenerCorrelativo($("#serie").val())
        // fnc_BloquearDatosCliente(true);
        fnc_CargarPluginDateTime();
        fnc_CargarAutocompleteProductos()
        fnc_CargarAutocompleteClientes();
        fnc_CargarDataTableListadoProductos();
        fnc_CargarDataTableListadoCotizaciones();

        //Datos de Cotizacion
        $("#id_cotizacion").val(0);

        //Datos del Comprobante
        $("#tipo_comprobante").attr("readonly", true);

        //Datos del Cliente:
        $("#tipo_documento").attr("readonly", true);
        $("#nro_documento").val('')
        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')
        $("#telefono").val('')

        //Datos de la Venta
        $("#producto").val('')

        $("#totalVenta").html('')
        $("#totalVenta").html('S/ 0.00')


        //Datos del Resumen
        $("#resumen_opes_gravadas").html('S/ 0.00')
        $("#resumen_opes_inafectas").html('S/ 0.00')
        $("#resumen_opes_exoneradas").html('S/ 0.00')
        $("#resumen_subtotal").html('S/ 0.00')
        $("#resumen_total_igv").html('S/ 0.00')
        $("#resumen_total_venta").html('S/ 0.00')

        $(".needs-validation-cotizacion").removeClass("was-validated");

        $("#frm-datos-cotizacion").removeClass("my-disabled");


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
    // C A R G A R   D R O P D O W N'S
    /*===================================================================*/
    function CargarSelects() {

        //OBTENER EMPRESA POR DEFECTO PARA BOLETAS / FACTURAS DE

        var formData = new FormData();
        formData.append("accion", "obtener_empresa_defecto");

        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        // EMPRESA EMISORA
        CargarSelect(response.id_empresa ?? "", $("#empresa_emisora"), "--Seleccionar--", "ajax/empresas.ajax.php", 'obtener_empresas_select');

        // TIPO DE COMPROBANTE
        CargarSelect('CTZ', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');

        // SERIE DEL COMPROBANTE
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante option:selected').val());
        $("#serie").prop('selectedIndex', 1).change();

        // MONEDA
        CargarSelect('PEN', $("#moneda"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_moneda');

        // TIPO DE DOCUMENTO
        CargarSelect('0', $("#tipo_documento"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');

        // TIPO DE COMPROBANTE A GENERAR
        CargarSelect('01', $("#tipo_comprobante_a_generar"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');

        $("#tipo_comprobante_a_generar option[value='07']").remove();
        $("#tipo_comprobante_a_generar option[value='08']").remove();
        $("#tipo_comprobante_a_generar option[value='09']").remove();
        $("#tipo_comprobante_a_generar option[value='RA']").remove();
        $("#tipo_comprobante_a_generar option[value='RC']").remove();
        $("#tipo_comprobante_a_generar option[value='NV']").remove();
        $("#tipo_comprobante_a_generar option[value='CTZ']").remove();

        $("#tipo_documento option[value='0']").remove();

        $("#tipo_documento").val("6").change();

    }

    function fnc_ObtenerSimboloMoneda() {

        var formData = new FormData();
        formData.append('accion', 'obtener_simbolo_moneda');
        formData.append('moneda', $("#moneda").val());

        response = SolicitudAjax("ajax/ventas.ajax.php", "POST", formData);

        $simbolo_moneda = response["simbolo"];
    }
    /*===================================================================*/
    // P L U G I N   D A T E T I M E P I C K E R
    /*===================================================================*/
    function fnc_CargarPluginDateTime() {
        $('#fecha_emision, #fecha_expiracion').datetimepicker({
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

    /*===================================================================*/
    // V E R I F I C A   S I   E M P R E S A   G E N E R A   F A C T U R A C I O N   E L E C T R O N I C A
    /*===================================================================*/
    function fnc_VerificarEmpresaFacturacionElectronica() {

        var formData = new FormData();
        formData.append('accion', 'verificar_empresa_facturacion_electronica');
        formData.append('id_empresa', $("#empresa_emisora").val());

        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        if (response.genera_fact_electronica == "1") {
            $("#rb-venta-envio").prop("disabled", false);
            $("#rb-venta").prop("disabled", false);
        } else {
            $("#rb-venta-envio").prop("disabled", true);
            $("#rb-venta").prop("disabled", true);

            $("#rb-venta-envio").prop("checked", false);
            $("#rb-venta").prop("checked", true);
        }

    }

    /*===================================================================*/
    // O B T E N E R   C O R R E L A T I V O
    /*===================================================================*/
    function fnc_ObtenerCorrelativo(id_serie) {
        var formData = new FormData();
        formData.append('accion', 'obtener_correlativo_serie');
        formData.append('id_serie', id_serie);

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);
        $("#correlativo").val(response["correlativo"])
    }

    /*===================================================================*/
    //A U T O C O M P L E T E   D E   P R O D U C T O S
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
                        label: '<a href="javascript:void(0);" class="d-flex z-100 border border-secondary border-left-0 border-right-0 border-top-0" style="width:100% !important;">' +
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
                    targets: [0, 1, 3, 4, 5, ],
                    visible: false
                }
            ],
            // scrollX: true,
            // // autoWidth: true,
            // scrollY: "50vh",
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
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE COTIZACIONES';
                    return printTitle
                }
            }, 'pageLength'],
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
                                        <div class="dropdown-menu">`;

                        if (rowData[10] == '0' || rowData[10] == '1') { //0: Registrado, 1: Confirmado
                            $options = $options + `<a class="dropdown-item btnEditarCotizacion" style='cursor:pointer;'>
                                                    <i class='fas fa-pencil-alt fs-5 text-primary mr-2'></i> 
                                                    <span class='my-color'>Editar</span>
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
                                            </a>
                                            <a class="dropdown-item btnConsultarCotizacion" style='cursor:pointer;'>
                                                <i class='fas fa-search fs-5 mr-2 text-secondary'></i>
                                                <span class='my-color'>Consultar</span>
                                            </a>`;



                        if (rowData[10] == '1' && rowData[21] == "BOLETA") {
                            $options = $options + `<a class="dropdown-item btnGenerarBoleta" style='cursor:pointer;'>
                                                    <i class='fas fa-file-invoice fs-5 text-warning mr-2'> </i> 
                                                    <span class='my-color'>Generar Boleta</span>
                                                </a>`;
                        }

                        if (rowData[10] == '1' && rowData[21] == "FACTURA") {
                            $options = $options + `<a class="dropdown-item btnGenerarFactura" style='cursor:pointer;'>
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

                            $precio = $('#tbl_ListadoProductos').DataTable().cell(index, 6).data()
                            $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3)
                                .data()

                            let $subtotal = 0;
                            let $factor_igv = 0;
                            let $porcentaje_igv = 0;
                            let $igv = 0;
                            let $importe = 0;

                            // ACTUALIZAR CANTIDAD A 1
                            $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input  type="number" min="0"
                                                    style="width:80px;" 
                                                    codigoProducto = "` + codigo_producto + `" 
                                                    class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                                    value="` + cantidad_a_comprar + `">`).draw();

                            $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = $precio * cantidad_a_comprar;
                            $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IGV
                            if ($id_tipo_afectacion == 10) {
                                $factor_igv = $afectacion.factor;
                                $porcentaje_igv = $afectacion.porcentaje;
                                $igv = ($precio * cantidad_a_comprar * $porcentaje_igv); // * EL % DE IGV

                            } else {
                                $igv = 0
                                $factor_igv = 1;
                            }


                            $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($igv).toFixed(2)).draw();

                            //ACTUALIZAR IMPORTE
                            $importe = ($precio * cantidad_a_comprar) * $factor_igv; // * EL FACTOR DE IGV
                            $('#tbl_ListadoProductos').DataTable().cell(index, 11).data(parseFloat($importe).toFixed(2)).draw();

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

                $tipo_cambio = $("#tipo_cambio").val();

                /*===================================================================*/
                //SI LA RESPUESTA ES VERDADERO, TRAE ALGUN DATO
                /*===================================================================*/
                if (respuesta) {

                    var TotalVenta = 0.00;

                    $('#tbl_ListadoProductos').DataTable().row.add({
                        'id': itemProducto,
                        'codigo_producto': respuesta.codigo_producto,
                        'descripcion': respuesta.descripcion.length > 20 ? respuesta.descripcion.substring(0, 20) + '...' : respuesta.descripcion,
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'tipo_igv': respuesta.tipo_afectacion_igv,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim(respuesta.codigo_producto) + ` value=` + parseFloat(respuesta.precio_unitario_con_igv / $tipo_cambio).toFixed(2) + `>`,
                        'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim(respuesta.codigo_producto) + ` value="1">`,
                        'subtotal': parseFloat((respuesta.precio_unitario_sin_igv / $tipo_cambio) * 1).toFixed(2),
                        'igv': parseFloat(((respuesta.precio_unitario_sin_igv / $tipo_cambio) * 1 * respuesta.porcentaje_igv)).toFixed(2),
                        'importe': parseFloat(((respuesta.precio_unitario_sin_igv / $tipo_cambio) * 1) * respuesta.factor_igv).toFixed(2),
                        'acciones': "<center>" +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
                            "<div class='btn-group'>" +
                            "<button type='button' class=' p-0 btn btn-primary transparentbar dropdown-toggle btn-sm' data-bs-toggle='dropdown' aria-expanded='false'>" +
                            "<i class='fas fa-hand-holding-usd fs-5 text-green'></i> <i class='fas fa-chevron-down text-primary'></i>" +
                            "</button>" +

                            "<ul class='dropdown-menu'>" +

                            "<li><a class='dropdown-item' codigo = '" + respuesta['codigo_producto'] +
                            "' precio=' " + respuesta['precio_unitario_sin_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Normal (" + parseFloat(respuesta[
                                'precio_unitario_sin_igv']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + respuesta['codigo_producto'] +
                            "' precio=' " + respuesta['precio_unitario_mayor_sin_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Por Mayor (S./ " + parseFloat(
                                respuesta['precio_unitario_mayor_sin_igv']).toFixed(2) + ")</a></li>" +

                            "<li><a class='dropdown-item' codigo = '" + respuesta['codigo_producto'] +
                            "' precio=' " + respuesta['precio_unitario_oferta_sin_igv'] +
                            "' style='cursor:pointer; font-size:14px;'>Oferta (S./ " + parseFloat(
                                respuesta['precio_unitario_oferta_sin_igv']).toFixed(2) + ")</a></li>" +

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

    }

    /*===================================================================*/
    // V A L I D A R   S T O C K   A N T E S   D E  G U A R D A R   V E N T A
    /*===================================================================*/
    function fnc_ValidarStock() {

        let stock_valido = true;

        $('#tbl_cotizaciones').DataTable().rows().eq(0).each(function(index) {

            $(this).addClass('bg-danger')

            var row = $('#tbl_cotizaciones').DataTable().row(index);

            var data = row.data();

            var datos = new FormData();
            datos.append('accion', 'verificar_stock');
            datos.append('codigo_producto', data["codigo_producto"]);
            datos.append('cantidad_a_comprar', data["cantidad_final"]);

            response = SolicitudAjax('ajax/productos.ajax.php', 'POST', datos);

            if (response.stock < parseInt(data["cantidad_final"])) {
                mensajeToast("error", "El producto " + data["descripcion"] + " no tiene el stock ingresado, el stock actual es: " + response.stock)
                $('#tbl_cotizaciones').DataTable().cell(index, 7)
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
        formData.append('nro_documento', nro_documento);

        response = SolicitudAjax('ajax/apis/apis.ajax.php', 'POST', formData);
        // $("#nro_documento").val('')
        $("#nombre_cliente_razon_social").val('')
        $("#direccion").val('')
        $("#telefono").val('')

        if (response["existe"]) {
            $("#nombre_cliente_razon_social").val(response['razonSocial']);
            $("#direccion").val(response['direccion']);
            $("#telefono").val(response['telefono']);
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
                    $("#telefono").val('')
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


    /*==========================================================================================================================================
    C A R G A R   D A T O S   P A R A   E D I C I O N
    *=========================================================================================================================================*/
    function fnc_EditarCotizacion($id_cotizacion) {

        //ACTIVAR PANE REGISTRO DE PROVEEDORES:
        $("#registrar-cotizacion-tab").addClass('active')
        $("#registrar-cotizacion-tab").attr('aria-selected', true)
        $("#registrar-cotizacion").addClass('active show')

        //DESACTIVAR PANE LISTADO DE PROVEEDORES:
        $("#listado-cotizaciones-tab").removeClass('active')
        $("#listado-cotizaciones-tab").attr('aria-selected', false)
        $("#listado-cotizaciones").removeClass('active show');

        $("#registrar-cotizacion-tab").html('<i class="fas fa-sync-alt"></i> Actualizar Cotización')

        $("#id_cotizacion").val($id_cotizacion)

        var formDataCotizacion = new FormData();
        formDataCotizacion.append('accion', 'obtener_cotizacion_x_id');
        formDataCotizacion.append('id_cotizacion', $id_cotizacion);

        $cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataCotizacion);

        //SETEAR DATOS DE LA COTIZACION
        $("#empresa_emisora").val($cotizacion.id_empresa_emisora)
        $("#fecha_emision").val($cotizacion.fecha_cotizacion)
        $("#fecha_expiracion").val($cotizacion.fecha_expiracion)
        $("#serie").val($cotizacion.id_serie).trigger('change')
        $("#serie").attr('readonly', true)
        $("#correlativo").val($cotizacion.correlativo)
        $("#moneda").val($cotizacion.id_moneda).trigger('change');
        $("#tipo_cambio").val($cotizacion.tipo_cambio)
        $("#tipo_comprobante_a_generar").val($cotizacion.comprobante_a_generar)

        //SETEAR DATOS DEL CLIENTE
        $("#tipo_documento").val($cotizacion.id_tipo_documento)
        $("#nro_documento").val($cotizacion.nro_documento)
        $("#nombre_cliente_razon_social").val($cotizacion.nombres_apellidos_razon_social)
        $("#direccion").val($cotizacion.direccion)
        $("#telefono").val($cotizacion.telefono)

        //SETEAR PRODUCTOS DE LA COTIZACION
        var formDataDetalleCotizacion = new FormData();
        formDataDetalleCotizacion.append('accion', 'obtener_detalle_cotizacion_x_id');
        formDataDetalleCotizacion.append('id_cotizacion', $id_cotizacion);

        $detalle_cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataDetalleCotizacion);

        for (let index = 0; index < $detalle_cotizacion.length; index++) {

            const $producto = $detalle_cotizacion[index];

            $('#tbl_ListadoProductos').DataTable().row.add({
                'id': $producto.item,
                'codigo_producto': $producto.codigo_producto,
                'descripcion': $producto.descripcion,
                'id_tipo_igv': $producto.id_tipo_afectacion_igv,
                'tipo_igv': $producto.tipo_afectacion_igv,
                'unidad_medida': $producto.unidad_medida,
                'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim($producto.codigo_producto) + ` value=` + $producto.precio_unitario_con_igv + `>`,
                'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim($producto.codigo_producto) + ` value="` + $producto.cantidad + `">`,
                'subtotal': parseFloat($producto.precio_unitario_sin_igv * $producto.cantidad).toFixed(2),
                'igv': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad * $producto.porcentaje_igv)).toFixed(2),
                'importe': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad) * $producto.factor_igv).toFixed(2),
                'acciones': "<center>" +
                    "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                    "<i class='fas fa-trash fs-5'> </i> " +
                    "</span>" +
                    "</center>"
            }).draw();

        }

        recalcularTotales();
    }

    function fnc_ConsultarCotizacion($id_cotizacion) {

        //ACTIVAR PANE REGISTRO DE PROVEEDORES:
        $("#registrar-cotizacion-tab").addClass('active')
        $("#registrar-cotizacion-tab").attr('aria-selected', true)
        $("#registrar-cotizacion").addClass('active show')

        //DESACTIVAR PANE LISTADO DE PROVEEDORES:
        $("#listado-cotizaciones-tab").removeClass('active')
        $("#listado-cotizaciones-tab").attr('aria-selected', false)
        $("#listado-cotizaciones").removeClass('active show');

        $("#registrar-cotizacion-tab").html('<i class="fas fa-search"></i> Consultar Cotización')

        $("#id_cotizacion").val($id_cotizacion)

        var formDataCotizacion = new FormData();
        formDataCotizacion.append('accion', 'obtener_cotizacion_x_id');
        formDataCotizacion.append('id_cotizacion', $id_cotizacion);

        $cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataCotizacion);

        //SETEAR DATOS DE LA COTIZACION
        $("#empresa_emisora").val($cotizacion.id_empresa_emisora)
        $("#fecha_emision").val($cotizacion.fecha_cotizacion)
        $("#fecha_expiracion").val($cotizacion.fecha_expiracion)
        $("#serie").val($cotizacion.id_serie).trigger('change')
        $("#serie").attr('readonly', true)
        $("#correlativo").val($cotizacion.correlativo)
        $("#moneda").val($cotizacion.id_moneda).trigger('change');
        $("#tipo_cambio").val($cotizacion.tipo_cambio)
        $("#tipo_comprobante_a_generar").val($cotizacion.comprobante_a_generar)

        //SETEAR DATOS DEL CLIENTE
        $("#tipo_documento").val($cotizacion.id_tipo_documento)
        $("#nro_documento").val($cotizacion.nro_documento)
        $("#nombre_cliente_razon_social").val($cotizacion.nombres_apellidos_razon_social)
        $("#direccion").val($cotizacion.direccion)
        $("#telefono").val($cotizacion.telefono)

        //SETEAR PRODUCTOS DE LA COTIZACION
        var formDataDetalleCotizacion = new FormData();
        formDataDetalleCotizacion.append('accion', 'obtener_detalle_cotizacion_x_id');
        formDataDetalleCotizacion.append('id_cotizacion', $id_cotizacion);

        $detalle_cotizacion = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formDataDetalleCotizacion);

        for (let index = 0; index < $detalle_cotizacion.length; index++) {

            const $producto = $detalle_cotizacion[index];

            $('#tbl_ListadoProductos').DataTable().row.add({
                'id': $producto.item,
                'codigo_producto': $producto.codigo_producto,
                'descripcion': $producto.descripcion,
                'id_tipo_igv': $producto.id_tipo_afectacion_igv,
                'tipo_igv': $producto.tipo_afectacion_igv,
                'unidad_medida': $producto.unidad_medida,
                'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim($producto.codigo_producto) + ` value=` + $producto.precio_unitario_con_igv + `>`,
                'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                    $.trim($producto.codigo_producto) + ` value="` + $producto.cantidad + `">`,
                'subtotal': parseFloat($producto.precio_unitario_sin_igv * $producto.cantidad).toFixed(2),
                'igv': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad * $producto.porcentaje_igv)).toFixed(2),
                'importe': parseFloat(($producto.precio_unitario_sin_igv * $producto.cantidad) * $producto.factor_igv).toFixed(2),
                'acciones': "<center>" +
                    "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                    "<i class='fas fa-trash fs-5'> </i> " +
                    "</span>" +
                    "</center>"
            }).draw();

        }

        recalcularTotales();

        $("#frm-datos-cotizacion").addClass("my-disabled");
    }

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
            title: 'Está seguro(a) de registrar la Cotización?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Generar Cotización!',
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
    /*===================================================================*/
    // G U A R D A R   C O T I Z A C I O N
    /*===================================================================*/
    function fnc_GuardarCotizacion() {

        var count = 0;
        form_cotizacion_validate = validarFormulario('needs-validation-cotizacion');

        //INICIO DE LAS VALIDACIONES
        if (!form_cotizacion_validate) {
            mensajeToast("error", "complete los datos del comprobante");
            return;
        }

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
            count = count + 1;
        });

        if (count == 0) {
            mensajeToast("error", "Ingrese los productos para la Cotización");
            return;
        }
        //FIN DE LAS VALIDACIONES

        var $productos = [];

        Swal.fire({
            title: 'Está seguro(a) de registrar la Cotización?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Generar Cotización!',
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
                formData.append('accion', 'guardar_cotizacion');
                formData.append('id_cotizacion', $("#id_cotizacion").val());
                formData.append('datos_cotizacion', $("#frm-datos-cotizacion").serialize());
                formData.append('productos', JSON.stringify($productos));

                response = SolicitudAjax('ajax/cotizaciones.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                // window.open($ruta+'vistas/generar_nota_credito_a4.php?id_venta=' + response["id_venta"], 'fullscreen=yes' + "resizable=0,");

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

    function recalcularMontos(codigo_producto, precio_venta) {

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_ListadoProductos').DataTable().row(index);

            var data = row.data();


            if (data['codigo_producto'] == codigo_producto) {

                // AUMENTAR EN 1 EL VALOR DE LA CANTIDAD
                $('#tbl_ListadoProductos').DataTable().cell(index, 6).data(
                    `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
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

                //CALCULAR SUBTOTAL
                $subtotal = $precio * cantidad_actual
                $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($subtotal).toFixed(2)).draw();

                //CALCULAR IGV
                if ($id_tipo_afectacion == 10) {
                    $factor_igv = $afectacion.factor;
                    $porcentaje_igv = $afectacion.porcentaje;
                    $igv = ($precio * cantidad_actual * $porcentaje_igv); // * EL % DE IGV 

                } else {
                    $igv = 0
                    $factor_igv = 1;
                }
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

    function CargarCliente($cliente) {

        $("#nro_documento").val($cliente.split(" - ")[0].trim());
        $("#nombre_cliente_razon_social").val($cliente.split(" - ")[1].trim());
        $("#direccion").val($cliente.split(" - ")[2].trim());
        $("#telefono").val($cliente.split(" - ")[3].trim());
    }
</script>