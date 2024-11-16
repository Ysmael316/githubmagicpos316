<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">NOTA DE DÉBITO</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Nota de Débito</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content" style="position: relative;">

    <input type="hidden" name="id_caja" id="id_caja" value="0">

    <div class="row">

        <div class="col-12 ">

            <div class="row">

                <div class="col-12 ">

                    <div class="card card-primary card-outline card-outline-tabs">

                        <div class="card-body py-1">

                            <div class="row">
                                <!-- --------------------------------------------------------- -->
                                <!-- DATOS DEL COMPROBANTE -->
                                <!-- --------------------------------------------------------- -->
                                <div class="col-12 col-lg-6" id="comprobante">

                                    <form id="frm-datos-comprobante" class="needs-validation-comprobante" novalidate>

                                        <div class="card card-gray shadow">

                                            <div class="card-header">
                                                <h3 class="card-title fs-6">COMPROBANTE DE PAGO</h3>
                                                <div class="card-tools m-0">

                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>

                                                </div> <!-- ./ end card-tools -->
                                            </div> <!-- ./ end card-header -->

                                            <div class="card-body py-2" id="card-body-comprobante">

                                                <div class="row">

                                                    <!-- EMITIR POR -->
                                                    <div class="col-12 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color">
                                                            <i class="fas fa-building mr-1 my-text-color"></i> Empresa Emisora
                                                        </label>
                                                        <select class="form-select" id="empresa_emisora" name="empresa_emisora" aria-label="Floating label select example" required>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione Empresa</div>
                                                    </div>


                                                    <!-- FECHA DE EMISION -->
                                                    <div class="col-12 col-md-4 mb-2">
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

                                                    <!-- TIPO COMPROBANTE -->
                                                    <div class="col-12 col-md-8 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color">
                                                            <i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante
                                                        </label>
                                                        <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required readonly>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                                    </div>

                                                    <!-- SERIE -->
                                                    <div class="col-12 col-md-4 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                                        <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione Serie</div>
                                                    </div>

                                                    <!-- CORRELATIVO -->
                                                    <div class="col-12 col-md-4 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                                        <input type="text" style="border-radius: 20px;" class="form-control form-control-sm readonly" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                        <div class="invalid-feedback">Ingrese correlativo</div>
                                                    </div>


                                                </div>

                                            </div>

                                        </div>

                                    </form>

                                </div>

                                <!-- --------------------------------------------------------- -->
                                <!-- DATOS DEL COMPROBANTE MODIFICADO-->
                                <!-- --------------------------------------------------------- -->
                                <div class="col-12 col-lg-6" id="comprobante-modificado">

                                    <form id="frm-datos-comprobante-modificado" class="needs-validation-comprobante-modificado" novalidate>

                                        <div class="card card-gray shadow">

                                            <div class="card-header">
                                                <h3 class="card-title fs-6">COMPROBANTE DE PAGO A MODIFICAR</h3>
                                                <div class="card-tools m-0">

                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>

                                                </div> <!-- ./ end card-tools -->
                                            </div> <!-- ./ end card-header -->

                                            <div class="card-body py-2" id="card-body-comprobante-modificado">

                                                <div class="row">


                                                    <!-- TIPO COMPROBANTE -->
                                                    <div class="col-12 col-md-6 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color">
                                                            <i class="fas fa-file-contract mr-1 my-text-color"></i>Tipo de Comprobante
                                                        </label>
                                                        <select class="form-select readonly" id="tipo_comprobante_modificado" name="tipo_comprobante_modificado" aria-label="Floating label select example" required>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                                    </div>


                                                    <!-- SERIE -->
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie</label>
                                                        <select class="form-select" id="serie_modificado" name="serie_modificado" aria-label="Floating label select example" required>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione Serie</div>
                                                    </div>

                                                    <!-- CORRELATIVO -->
                                                    <div class="col-12 col-md-3 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                                        <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo_modificado" name="correlativo_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                        <div class="invalid-feedback">Ingrese correlativo</div>
                                                    </div>

                                                    <!-- TIPO NOTA DE CREDITO -->
                                                    <div class="col-12 col-md-12 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-wave mr-1 my-text-color"></i>Motivo Nota de Crédito</label>
                                                        <select class="form-select" id="motivo_nota_debito" name="motivo_nota_debito" aria-label="Floating label select example" required>
                                                        </select>
                                                        <div class="invalid-feedback">Seleccione el motivo</div>
                                                    </div>

                                                    <!-- DESCRIPCION -->
                                                    <div class="col-12 col-md-8 mb-2">
                                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Descripción</label>
                                                        <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="descripcion_nota_debito" name="descripcion_nota_debito" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                        <div class="invalid-feedback">Ingrese la descripción</div>
                                                    </div>

                                                    <div class="col-12 col-md-4 mb-2 d-flex align-items-end">
                                                        <a class="btn btn-sm btn-success  fw-bold  w-100" id="btnRecuperarVenta" style="position: relative;">
                                                            <span class="text-button">OBTENER VENTA</span>
                                                            <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                                <i class="fas fa-search fs-5 text-white m-0 p-0"></i>
                                                            </span>
                                                        </a>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <!-- --------------------------------------------------------- -->
                                <!-- DATOS DEL CLIENTE MODIFICADO-->
                                <!-- --------------------------------------------------------- -->
                                <div class="col-12 d-none" id="cliente-modificado">

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

                                        <div class="card-body py-2" id="card-body-cliente-modificado">

                                            <div class="row">

                                                <!-- TIPO DOCUMENTO MODIFICADO -->
                                                <div class="col-12 col-md-2 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Tipo Documento</label>
                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="tipo_documento_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <!-- NRO DOCUMENTO MODIFICADO -->
                                                <div class="col-12 col-md-2 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Nro Documento</label>
                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nro_documento_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <!-- NOMBRE CLIENTE MODIFICADO -->
                                                <div class="col-12 col-md-3 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Nombre Cliente</label>
                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_cliente_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <!-- DIRECCION CLIENTE MODIFICADO -->
                                                <div class="col-12 col-md-3 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Dirección</label>
                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="direccion_cliente_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <!-- TELEFONO -->
                                                <div class="col-12 col-md-2 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Teléfono</label>
                                                    <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="telefono_modificado" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <!-- --------------------------------------------------------- -->
                                <!-- LISTADO DE PRODUCTOS -->
                                <!-- --------------------------------------------------------- -->
                                <div class="col-12 col-lg-8 d-none" id="listado-productos">

                                    <div class="card card-gray shadow " id="card-detalle-venta">

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
                                                <div class="col-9 mb-2">
                                                    <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                                    <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                                <div class="col-3 text-center">

                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="mb-0 ml-1 text-sm my-text-color"></label>
                                                            <a class="btn btn-sm btn-danger  fw-bold w-100 " id="btnVaciarListado" style="position: relative;">
                                                                <span class="text-button">Vaciar Listado</span>
                                                                <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                                    <i class="fas fa-trash fs-5 text-white m-0 p-0"></i>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </div>

                                                <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                                <div class="col-md-12 mt-2">

                                                    <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow " readonly>
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
                                <div class="col-12 col-lg-4 d-none" id="resumen-venta">

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
                                                            <span>TOTAL NC</span>
                                                            <span class="float-right " id="resumen_total_venta">S/0.00</span>
                                                            <hr class="m-1" />
                                                        </div>

                                                        <div class="col-12 col-md-12 fs-5 text-primary">
                                                            <span>VALOR REFERENCIAL</span>
                                                            <span class="float-right " id="resumen_total_venta_referencial">S/0.00</span>
                                                            <hr class="m-1" />
                                                        </div>

                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 text-center my-1">

                                            <div class="row">
                                                <div class="col-6">
                                                    <a class="btn btn-sm btn-danger  fw-bold w-100 " id="btnCancelarNotaCredito" style="position: relative;">
                                                        <span class="text-button">CANCELAR</span>
                                                        <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                                            <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="btn btn-sm btn-success  fw-bold  w-100" id="btnGuardarNotaCredito" style="position: relative;">
                                                        <span class="text-button">GENERAR ND</span>
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

                        <!-- /.card -->
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
    $(document).ready(function() {

        fnc_MostrarLoader()

        fnc_VerificarEmpresasRegistradas();

        /*===================================================================*/
        // I N I C I A L I Z A R   F O R M U L A R I O 
        /*===================================================================*/
        fnc_InicializarFormulario();

        $('#serie').on('change', function(e) {
            fnc_ObtenerCorrelativo($("#serie").val())
        })

        $('#motivo_nota_debito').on('change', function(e) {
            $("#descripcion_nota_debito").val($("#motivo_nota_debito option:selected").text());
        })

        $('#tipo_comprobante_modificado').on('change', function(e) {
            CargarSelect(null, $("#serie_modificado"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante_modificado').val());
        })

        $('#serie').on('change', function(e) {

            if ($("#serie option:selected").text().substring(0, 1) == 'F') {
                CargarSelect('01', $("#tipo_comprobante_modificado"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante_nota_credito');

            } else {
                CargarSelect('03', $("#tipo_comprobante_modificado"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante_nota_credito');
            }

            CargarSelect(null, $("#serie_modificado"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante_modificado').val());

        })

        $("#btnRecuperarVenta").on('click', function() {
            fnc_RecuperarVenta();
        })

        $("#btnGuardarNotaCredito").on('click', function() {
            fnc_GuardarNotaCredito();
        })

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
                    $precio_con_igv = (parseFloat($.parseHTML(data['precio'])[0]['value']) / 1.18).toFixed(2);
                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos').DataTable().cell(index, 7)
                        .data(`<input type="number"  min="0"
                                style="width:80px;"
                                codigoProducto = ` +
                            cod_producto_actual + `
                                class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                value="` + cantidad_actual + `">`).draw();


                    //CALCULAR SUBTOTAL
                    $subtotal = $precio_con_igv * cantidad_actual
                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = 1.18;
                        $porcentaje_igv = 0.18;
                        $igv = ($precio_con_igv * cantidad_actual * $porcentaje_igv); // * EL % DE IGV = 0.18

                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_con_igv * cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV = 1.18
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


            $precio = parseFloat($(this)[0]['value']);
            $precio_sin_igv = parseFloat($precio) / 1.18;

            cod_producto_actual = $(this)[0]['attributes']['codigoProducto']['value'];

            if ($precio_sin_igv.length == 0 || $precio_sin_igv == 0) {
                $precio_sin_igv = 1;
            }

            if ($precio_sin_igv < 0) {
                mensajeToast("error", "El precio debe ser mayor a 0")
                return;
            }

            $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                var row = $('#tbl_ListadoProductos').DataTable().row(index);
                var data = row.data();

                if (data["codigo_producto"] == cod_producto_actual) {

                    $cantidad_actual = parseFloat($.parseHTML(data['cantidad'])[0]['value'])
                    $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data();

                    // ACTUALIZAR PRECIO
                    $('#tbl_ListadoProductos').DataTable().cell(index, 6)
                        .data(`<input type="number"  min="0"
                    style="width:80px;" 
                    codigoProducto = ` + cod_producto_actual + ` 
                    class="form-control form-control-sm text-center iptPrecio m-0 p-0 rounded-pill" 
                    value="` + $precio + `">`).draw();


                    //CALCULAR SUBTOTAL
                    $subtotal = $precio_sin_igv * $cantidad_actual
                    $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                    //CALCULAR IGV
                    if ($id_tipo_afectacion == 10) {
                        $factor_igv = 1.18;
                        $porcentaje_igv = 0.18;
                        $igv = ($precio_sin_igv * $cantidad_actual * $porcentaje_igv); // * EL % DE IGV = 0.18

                    } else {
                        $igv = 0
                        $factor_igv = 1;
                    }
                    $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                    //CALCULAR IMPORTE
                    $importe = ($precio_sin_igv * $cantidad_actual) * $factor_igv; // * EL FACTOR DE IGV = 1.18
                    $('#tbl_ListadoProductos').DataTable().cell(index, 10).data(parseFloat($.parseHTML(data['cantidad'])[0]['value'] * $precio).toFixed(2)).draw();

                    // RECALCULAMOS TOTALES
                    recalcularTotales();

                }

            })

        });


        $("#btnCancelarNotaCredito").on('click', function() {

            $("#listado-productos").removeClass('d-block');
            $("#resumen-venta").removeClass('d-block');
            $("#cliente-modificado").removeClass('d-block');

            $("#listado-productos").addClass('d-none');
            $("#resumen-venta").addClass('d-none');
            $("#cliente-modificado").addClass('d-none');

            $("#comprobante-modificado").removeClass('my-disabled')
            $("#comprobante").removeClass('my-disabled')
            $("#card-body-comprobante-modificado").removeClass('bg-secondary')
            $("#card-body-comprobante").removeClass('bg-secondary')
            $("#card-body-cliente-modificado").removeClass('bg-secondary')


            $("#empresa_emisora").attr('readonly', false)
            $("#fecha_emision").attr('readonly', false)
            $("#serie").attr('readonly', false)
            $("#moneda").attr('readonly', false)
            $("#serie_modificado").attr('readonly', false)
            $("#correlativo_modificado").attr('readonly', false)
            $("#motivo_nota_debito").attr('readonly', false)
            $("#descripcion_nota_debito").attr('readonly', false)
        })

        // EVENTO PARA ELIMINAR UN PRODUCTO DEL LISTADO
        $('#tbl_ListadoProductos tbody').on('click', '.btnEliminarproducto', function() {
            $('#tbl_ListadoProductos').DataTable().row($(this).parents('tr')).remove().draw();
            recalcularTotales();
        });

        $("#btnVaciarListado").on('click', function() {
            fnc_CargarDataTableListadoProductos();
            recalcularTotales();
        })

        $(document).on('click', '.btnImprimirA4', function() {
            alert("Imprimir")
        })

        fnc_OcultarLoader();
    })

    function fnc_InicializarFormulario() {

        CargarSelects();
        fnc_CargarDataTableListadoProductos();
        // fnc_ObtenerCorrelativo($("#serie").val());
        fnc_CargarPluginDateTime();
        fnc_CargarAutocompleteProductos()

        // fnc_CargarDataTableListadoProductos();

        $("#listado-productos").removeClass('d-block');
        $("#resumen-venta").removeClass('d-block');
        $("#cliente-modificado").removeClass('d-block');

        $("#listado-productos").addClass('d-none');
        $("#resumen-venta").addClass('d-none');
        $("#cliente-modificado").addClass('d-none');

        $("#listado-productos").removeClass('readonly');

        $("#comprobante-modificado").removeClass('my-disabled')
        $("#comprobante").removeClass('my-disabled')
        $("#card-body-comprobante-modificado").removeClass('bg-secondary')
        $("#card-body-comprobante").removeClass('bg-secondary')
        $("#card-body-cliente-modificado").removeClass('bg-secondary')

        $("#empresa_emisora").removeAttr('readonly', true)
        $("#fecha_emision").removeAttr('readonly', true)
        $("#serie").removeAttr('readonly', true)
        $("#moneda").removeAttr('readonly', true)
        $("#serie_modificado").removeAttr('readonly', true)
        $("#correlativo_modificado").removeAttr('readonly', true)
        $("#motivo_nota_debito").removeAttr('readonly', true)
        $("#descripcion_nota_debito").removeAttr('readonly', true)

        $("#correlativo").val('')
        $("#correlativo_modificado").val('')
        $('#tipo_comprobante_modificado').empty();
        $('#serie_modificado').empty();
        $("#descripcion_nota_debito").val('')

        // //Datos del Comprobante
        // $("#tipo_comprobante").attr("readonly", true);        
        // $("#nro_documento").val('')
        // $("#nombre_cliente_razon_social").val('')
        // $("#direccion").val('')
        // $("#telefono").val('')

        // //Datos de la Venta
        // $("#forma_pago").attr("readonly", true);
        // $("#producto").val('')

        // $("#totalVenta").html('')
        // $("#totalVenta").html('S/ 0.00')
        // // $("#forma_pago").val('')
        // $("#total_recibido").val('')
        // $("#vuelto").val('')

        // //Datos del Resumen
        $("#resumen_opes_gravadas").html('S/ 0.00')
        $("#resumen_opes_inafectas").html('S/ 0.00')
        $("#resumen_opes_exoneradas").html('S/ 0.00')
        $("#resumen_subtotal").html('S/ 0.00')
        $("#resumen_total_igv").html('S/ 0.00')
        $("#resumen_total_venta").html('S/ 0.00')
        $("#resumen_total_venta_referencial").html('S/ 0.00')

        $(".needs-validation-comprobante").removeClass("was-validated");
        $(".needs-validation-comprobante-modificado").removeClass("was-validated");

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

                            $valor_unitario = parseFloat($.parseHTML(data['precio'])[0]['value'] / 1.18);
                            $id_tipo_afectacion = $('#tbl_ListadoProductos').DataTable().cell(index, 3).data()

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

                            // $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(cantidad_a_comprar)

                            //ACTUALIZAR SUBTOTAL
                            $subtotal = $valor_unitario * cantidad_a_comprar;

                            $('#tbl_ListadoProductos').DataTable().cell(index, 8).data(parseFloat($subtotal).toFixed(2)).draw();

                            //ACTUALIZAR IGV
                            if ($id_tipo_afectacion == 10) {
                                $factor_igv = 1.18;
                                $porcentaje_igv = 0.18;
                                $igv = ($valor_unitario * cantidad_a_comprar * $porcentaje_igv); // * EL % DE IGV = 0.18

                            } else {
                                $igv = 0
                                $factor_igv = 1;
                            }

                            $('#tbl_ListadoProductos').DataTable().cell(index, 9).data(parseFloat($igv).toFixed(2)).draw();

                            //ACTUALIZAR IMPORTE
                            $importe = ($valor_unitario * cantidad_a_comprar) * $factor_igv; // * EL FACTOR DE IGV = 1.18

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

                    $('#tbl_ListadoProductos').DataTable().row.add({
                        'id': itemProducto,
                        'codigo_producto': respuesta.codigo_producto,
                        'descripcion': respuesta.descripcion.length > 20 ? respuesta.descripcion.substring(0,20)+'...' : respuesta.descripcion,
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'tipo_igv': respuesta.tipo_afectacion_igv,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim(respuesta.codigo_producto) + ` value=` + respuesta.precio_unitario_con_igv + `>`,
                        'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim(respuesta.codigo_producto) + ` value="1">`,
                        'subtotal': parseFloat(respuesta.precio_unitario_sin_igv * 1).toFixed(2),
                        'igv': parseFloat((respuesta.precio_unitario_sin_igv * 1 * respuesta.porcentaje_igv)).toFixed(2),
                        'importe': parseFloat((respuesta.precio_unitario_sin_igv * 1) * respuesta.factor_igv).toFixed(2),
                        'acciones': "<center>" +
                            "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                            "<i class='fas fa-trash fs-5'> </i> " +
                            "</span>" +
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

        let TotalVenta = 0.00;
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

            if (data['id_tipo_igv'] == 10) {
                total_opes_gravadas = total_opes_gravadas + ($.parseHTML(data['precio'])[0]['value'] * $.parseHTML(data['cantidad'])[0]['value']);
                total_igv = total_opes_gravadas - (total_igv + ($.parseHTML(data['precio'])[0]['value'] * ($.parseHTML(data['cantidad'])[0]['value'] / 1.18)))

                // factor_igv = 1.18
            }

            if (data['id_tipo_igv'] == 20) {
                total_opes_exoneradas = total_opes_exoneradas + ($.parseHTML(data['precio'])[0]['value'] * $.parseHTML(data['cantidad'])[0]['value']);
            }

            if (data['id_tipo_igv'] == 30) {
                total_opes_inafectas = total_opes_inafectas + ($.parseHTML(data['precio'])[0]['value'] * $.parseHTML(data['cantidad'])[0]['value']);
            }


            TotalVenta = TotalVenta + ($.parseHTML(data['precio'])[0]['value'] * $.parseHTML(data['cantidad'])[0]['value'] * factor_igv)

        });

        total_opes_gravadas = total_opes_gravadas / 1.18;

        subtotal = subtotal + (total_opes_gravadas + total_opes_exoneradas + total_opes_inafectas);

        $("#resumen_opes_gravadas").html('S/ ' + parseFloat(total_opes_gravadas).toFixed(2));
        $("#resumen_opes_inafectas").html('S/ ' + parseFloat(total_opes_inafectas).toFixed(2));
        $("#resumen_opes_exoneradas").html('S/ ' + parseFloat(total_opes_exoneradas).toFixed(2));
        $("#resumen_subtotal").html('S/ ' + parseFloat(subtotal).toFixed(2));
        $("#resumen_total_igv").html('S/ ' + parseFloat(total_igv).toFixed(2));
        $("#resumen_total_venta").html('S/ ' + parseFloat(TotalVenta).toFixed(2));

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
            CargarContenido('vistas/administrar_empresas.php', 'content-wrapper');
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
    // C A R G A R   D R O P D O W N'S
    /*===================================================================*/
    function CargarSelects() {

        var formData = new FormData();
        formData.append("accion", "obtener_empresa_defecto");
        var response = SolicitudAjax("ajax/empresas.ajax.php", "POST", formData);

        //EMPRESA EMISORA
        CargarSelect(response.id_empresa ?? "", $("#empresa_emisora"), "--Seleccionar--", "ajax/empresas.ajax.php", 'obtener_empresas_select');

        //TIPO DE COMPROBANTE
        CargarSelect('08', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');

        //SERIE DEL COMPROBANTE
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante option:selected').val());

        //MONEDA
        CargarSelect('PEN', $("#moneda"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_moneda');

        //MOTIVO NOTA CREDITO
        CargarSelect(null, $("#motivo_nota_debito"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_motivo_nota_debito');
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
    // R E C U P E R A R   V E N T A
    /*===================================================================*/
    function fnc_RecuperarVenta() {

        var validation = 1; // true

        form_comprobante_validate = validarFormulario('needs-validation-comprobante');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_validate) {
            mensajeToast("error", "complete los datos obligatorios de la Nota de Crédito");
            validation = 0;
        }

        form_comprobante_modificado_validate = validarFormulario('needs-validation-comprobante-modificado');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_modificado_validate) {
            mensajeToast("error", "complete los datos obligatorios del comprobante a modificar");
            validation = 0;
        }

        if (!validation) return;

        var formData = new FormData();
        formData.append('accion', 'obtener_detalle_venta')
        formData.append('id_serie', $("#serie_modificado").val())
        formData.append('correlativo', $("#correlativo_modificado").val());

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

        if (response.length > 0) {

            if (response[0]["estado_comprobante"] == 2) {

                Swal.fire({
                    position: 'top-center',
                    icon: "warning",
                    title: "La " + ($("#serie_modificado option:selected").text().substring(0, 1) == 'B' ? 'Boleta ' : 'Factura ') + $("#serie_modificado option:selected").text() + '-' + $("#correlativo_modificado").val() + " se encuentra anulada en Sunat",
                    showConfirmButton: true
                })

                return;
            }


            $("#tipo_documento_modificado").val(response[0]["descripcion_documento"])
            $("#nro_documento_modificado").val(response[0]["nro_documento"])
            $("#nombre_cliente_modificado").val(response[0]["nombres_apellidos_razon_social"])
            $("#direccion_cliente_modificado").val(response[0]["direccion"])
            $("#telefono_modificado").val(response[0]["telefono"])

            $("#listado-productos").removeClass('d-none');
            $("#resumen-venta").removeClass('d-none');
            $("#cliente-modificado").removeClass('d-none');

            $("#listado-productos").addClass('d-block');
            $("#resumen-venta").addClass('d-block');
            $("#cliente-modificado").addClass('d-block');

            $("#comprobante-modificado").addClass('my-disabled')
            $("#comprobante").addClass('my-disabled')
            $("#card-body-comprobante-modificado").addClass('bg-secondary')
            $("#card-body-comprobante").addClass('bg-secondary')

            $("#cliente-modificado").addClass('my-disabled')
            $("#cliente").addClass('my-disabled')
            $("#card-body-cliente-modificado").addClass('bg-secondary')
            $("#card-body-cliente").addClass('bg-secondary')

            $("#empresa_emisora").attr('readonly', true)
            $("#fecha_emision").attr('readonly', true)
            $("#serie").attr('readonly', true)
            $("#moneda").attr('readonly', true)
            $("#serie_modificado").attr('readonly', true)
            $("#correlativo_modificado").attr('readonly', true)
            $("#motivo_nota_debito").attr('readonly', true)
            $("#descripcion_nota_debito").attr('readonly', true)

            // if ($("#motivo_nota_debito").val() == "01" || $("#motivo_nota_debito").val() == '02') {
            //     $("#listado-productos").addClass('readonly');
            // } else {
            //     $("#listado-productos").removeClass('readonly');
            // }


            fnc_CargarDataTableListadoProductos();

            var total_opes_gravadas = 0.00;
            var total_opes_inafectas = 0.00;
            var total_opes_exoneradas = 0.00;
            var subtotal = 0;
            var total_igv = 0;
            var TotalVenta = 0;

            for (let index = 0; index < response.length; index++) {
                const producto = response[index];

                $('#tbl_ListadoProductos').DataTable().row.add({
                    'id': index,
                    'codigo_producto': producto.codigo_producto,
                    'descripcion': producto.descripcion,
                    'id_tipo_igv': producto.id_tipo_afectacion_igv,
                    'tipo_igv': producto.tipo_afectacion_igv,
                    'unidad_medida': producto.unidad_medida,
                    'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                        producto.codigo_producto + ` value=` + producto.precio_unitario_con_igv + `>`,
                    'cantidad': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
                        producto.codigo_producto + ` value=` + producto.cantidad + `>`,
                    'subtotal': parseFloat(producto.precio_unitario_sin_igv * producto.cantidad).toFixed(2),
                    'igv': parseFloat((producto.precio_unitario_sin_igv * producto.cantidad * producto.porcentaje_igv)).toFixed(2),
                    'importe': parseFloat((producto.precio_unitario_sin_igv * producto.cantidad) * producto.factor_igv).toFixed(2),
                    'acciones': "<center>" +
                        "<span class='btnEliminarproducto text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar producto'> " +
                        "<i class='fas fa-trash fs-5'> </i> " +
                        "</span>" +
                        "</center>"
                }).draw();

                if (index == 0) { //RECUPERA LOS TOTALES DE LA VENTA
                    total_opes_gravadas = parseFloat(total_opes_gravadas) + parseFloat(producto.total_operaciones_gravadas);
                    total_opes_inafectas = parseFloat(total_opes_inafectas) + parseFloat(producto.total_operaciones_inafectas);
                    total_opes_exoneradas = parseFloat(total_opes_exoneradas) + parseFloat(producto.total_operaciones_exoneradas);
                    total_igv = parseFloat(total_igv) + parseFloat(producto.total_igv);
                }
            }

            subtotal = parseFloat(total_opes_gravadas) + parseFloat(total_opes_inafectas) + parseFloat(total_opes_exoneradas);

            TotalVenta = parseFloat(subtotal) + parseFloat(total_igv);

            $("#resumen_opes_gravadas").html('S/ ' + total_opes_gravadas.toFixed(2));
            $("#resumen_opes_inafectas").html('S/ ' + total_opes_inafectas.toFixed(2));
            $("#resumen_opes_exoneradas").html('S/ ' + total_opes_exoneradas.toFixed(2));
            $("#resumen_subtotal").html('S/ ' + subtotal.toFixed(2));
            $("#resumen_total_igv").html('S/ ' + total_igv.toFixed(2));
            $("#resumen_total_venta").html('S/ ' + TotalVenta.toFixed(2));
            $("#resumen_total_venta_referencial").html('S/ ' + TotalVenta.toFixed(2));

        } else {

            Swal.fire({
                position: 'top-center',
                icon: "warning",
                title: "El comprobante no existe",
                showConfirmButton: true
            })

        }



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
                targets: [0, 1, 3, 4, 5, 8],
                visible: false
            }],
            scrollX: true,
            // autoWidth: true,
            // scrollY: "50vh",
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

    }

    /*===================================================================*/
    //G U A R D A R   V E N T A
    /*===================================================================*/
    function fnc_GuardarNotaCredito() {

        var count = 0;
        form_comprobante_validate = validarFormulario('needs-validation-comprobante');

        //INICIO DE LAS VALIDACIONES
        if (!form_comprobante_validate) {
            mensajeToast("error", "complete los datos del comprobante");
            return;
        }

        form_comprobante_modificado_validate = validarFormulario('needs-validation-comprobante-modificado');


        if (!form_comprobante_modificado_validate) {
            mensajeToast("error", "complete los datos del comprobante a modificar");
            return;
        }

        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
            count = count + 1;
        });

        if (count == 0) {
            mensajeToast("error", "Ingrese los productos para la Nota de Crédito");
            return;
        }
        //FIN DE LAS VALIDACIONES

        var $productos = [];

        Swal.fire({
            title: 'Está seguro(a) de generar la Nota de Crédito?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Generar Nota de Crédito!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {

                    var arr = {};
                    var row = $('#tbl_ListadoProductos').DataTable().row(index);

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

                var formData = new FormData();
                formData.append('accion', 'registrar_nota_debito');
                formData.append('datos_comprobante', $("#frm-datos-comprobante").serialize());
                formData.append('datos_comprobante_modificado', $("#frm-datos-comprobante-modificado").serialize());
                formData.append('productos', JSON.stringify($productos));

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                if (response) {
                    Swal.fire({
                        position: 'top-center',
                        // html: `<div class="text-center">
                        //         <a style="cursor: pointer" class="btn btn-primary btn-sm btnImprimirA4 fs-6">Imprimir A4 <i class="fas fa-file-pdf fs-6"></i></a>
                        //         <a style="cursor: pointer" class="btn btn-secondary btn-sm btnEnviarCorreo fs-6 mx-1">Enviar Correo <i class="fas fa-envelope-open-text fs-6"></i></a>
                        //     </div>`,
                        icon: response.tipo_msj,
                        title: response.msj,
                        showConfirmButton: true
                    })

                    window.open($ruta+'vistas/generar_nota_credito_a4.php?id_venta=' + response["id_venta"], 'fullscreen=yes' + "resizable=0,");

                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: "Error de Conexión con Sunat",
                        showConfirmButton: true
                    })
                }



                fnc_InicializarFormulario();
            }
        })




    }
</script>