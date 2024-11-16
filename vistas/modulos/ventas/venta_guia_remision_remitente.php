<!-- Content Header (Page header) -->
<div class="content-header pb-1">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">GUÍA DE REMISIÓN REMITENTE</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Ventas / Factura</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="content">

    <div class="row">

        <div class="col-12 ">

            <div class="card card-primary card-outline card-outline-tabs">

                <div class="card-body py-1">

                    <form id="frm-datos-guia-remision-remitente" class="needs-validation-guia-remision-remitente" novalidate>

                        <div class="row">


                            <!-- --------------------------------------------------------- -->
                            <!-- COMPROBANTE DE PAGO -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow card-comprobante">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DATOS DE LA GUÍA</h3>
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

                                            <!-- CLIENTE -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Cliente <strong class="text-danger">*</strong></label>
                                                <input type="text" placeholder="Ingrese el dni o nombrel del cliente" style="border-radius: 20px;" class="form-control form-control-sm" id="cliente" name="cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese al Cliente</div>
                                            </div>

                                            <!-- TIPO COMPROBANTE (REMITENTE) -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Tipo Comprobante <strong class="text-danger">*</strong></label>
                                                <select class="form-select readonly" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                            </div>

                                            <!-- SERIE -->
                                            <div class="col-12 col-lg-2 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie <strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="serie" name="serie" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione la Serie</div>
                                            </div>

                                            <!-- CORRELATIVO -->
                                            <div class="col-12 col-lg-2 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm my-disabled" id="correlativo" name="correlativo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese correlativo</div>
                                            </div>

                                            <!-- FECHA EMISION -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Emisión <strong class="text-danger">*</strong></label>
                                                <div class="input-group input-group-sm mb-3 ">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_emision"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_emision" name="fecha_emision" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese Fecha de Emisión</div>
                                                </div>
                                            </div>

                                            <!-- MODALIDAD DE TRASLADO -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Modalidad Traslado <strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="modalidad_traslado" name="modalidad_traslado" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione Modalidad Traslado</div>
                                            </div>

                                            <!-- MOTIVO TRASLADO -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Motivo Traslado <strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="motivo_traslado" name="motivo_traslado" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione Motivo Traslado</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- --------------------------------------------------------- -->
                            <!-- LISTADO DE PRODUCTOS -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h4 class="card-title fs-6">LISTADO DE PRODUCTOS</h4>
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

                                            <!-- INPUT PARA INGRESO DEL CODIGO DE BARRAS O DESCRIPCION DEL PRODUCTO -->
                                            <div class="col-12 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Digite el Producto a vender</label>
                                                <input type="text" placeholder="Ingrese el código de barras o el nombre del producto" style="border-radius: 20px;" class="form-control form-control-sm" id="producto" name="producto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                            <div class="col-md-12 mt-2">

                                                <table id="tbl_ListadoProductos" class="display nowrap table-striped w-100 shadow" style="font-size: 12px;">
                                                    <thead class="bg-main text-center">
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
                                                    <tbody class="text-center" style="font-size: 13px;">
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
                            <!-- DOCUMENTO RELACIONADO -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DOCUMENTO RELACIONADO</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <!-- TIPO COMPROBANTE (REMITENTE) -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Tipo Comprobante Rel.</label>
                                                <select class="form-select" id="tipo_comprobante_rel" name="tipo_comprobante_rel" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione Tipo de Comprobante</div>
                                            </div>

                                            <!-- SERIE -->
                                            <div class="col-12 col-lg-2 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Serie Rel.</label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" maxlength="4" id="serie_rel" name="serie_rel" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese la serie</div>
                                            </div>

                                            <!-- CORRELATIVO -->
                                            <div class="col-12 col-lg-2 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-list-ol mr-1 my-text-color"></i>Correlativo</label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="correlativo_rel" name="correlativo_rel" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese el correlativo</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- DATOS DEL TRASLADO -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DATOS DEL TRASLADO</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <!-- FECHA TRASLADO -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Traslado <strong class="text-danger">*</strong></label>
                                                <div class="input-group input-group-sm mb-3 ">
                                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_traslado"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_traslado" name="fecha_traslado" aria-describedby="inputGroup-sizing-sm" required>
                                                    <div class="invalid-feedback">Ingrese Fecha de Traslado</div>
                                                </div>
                                            </div>

                                            <!-- PESO BRUTO TOTAL -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Peso Bruto Total <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="peso_bruto_total" name="peso_bruto_total" placeholder="Ingrese Peso Bruto Total" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Peso Bruto Total</div>
                                            </div>

                                            <!-- PESO UNIDAD MEDIDA -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Peso Und Medida <strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="peso_unidad_medida" name="peso_unidad_medida" aria-label="Floating label select example" required>
                                                    <option value="KGM" checked>KILOGRAMOS</option>
                                                    <option value="TNE">TONELADAS</option>
                                                </select>
                                                <div class="invalid-feedback">Seleccione Peso Und Medida</div>
                                            </div>

                                            <!-- NRO DE BULTOS -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nro Bultos <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="numero_bultos" name="numero_bultos" placeholder="Ingrese Peso Bruto Total" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Nro Bultos</div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- DATOS DEL TRANSPORTISTA PUBLICO-->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12 tranportista">
                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- PUNTO DE PARTIDA -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">PUNTO DE PARTIDA</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <!-- UBIGEO PARTIDA -->
                                            <div class="col-12 col-lg-5 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Punto Partida <strong class="text-danger">*</strong></label>
                                                <input type="text" placeholder="Ingrese el ubigeo de partida" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="ubigeo_partida" name="ubigeo_partida" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Punto Partida</div>
                                            </div>

                                            <!-- DIRECCION PARTIDA -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Dirección <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="direccion_partida" name="direccion_partida" placeholder="Ingrese la dirección de partida" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Dirección Partida</div>
                                            </div>

                                            <!-- CODIGO ESTABLECIMIENTO SUNAT -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Cód. Establ. Sunat <sub class="text-success">(opcional)</sub></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="codigo_establecimiento_sunat_partida" name="codigo_establecimiento_sunat_partida" placeholder="Código Sunat" aria-label="Small" aria-describedby="inputGroup-sizing-sm">

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- PUNTO DE LLEGADA -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DATOS DEL LLEGADA</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <!-- UBIGEO LLEGADA -->
                                            <div class="col-12 col-lg-5 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-cart-plus mr-1 my-text-color"></i>Punto Llegada <strong class="text-danger">*</strong></label>
                                                <input type="text" placeholder="Ingrese el ubigeo de llegada" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="ubigeo_llegada" name="ubigeo_llegada" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Punto Llegada</div>
                                            </div>

                                            <!-- DIRECCION LLEGADA -->
                                            <div class="col-12 col-lg-4 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color "></i>Dirección <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="direccion_llegada" name="direccion_llegada" placeholder="Ingrese la dirección de llegada" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                                <div class="invalid-feedback">Ingrese Punto Llegada</div>
                                            </div>

                                            <!-- CODIGO ESTABLECIMIENTO SUNAT -->
                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-phone-alt mr-1 my-text-color"></i>Cód. Establ. Sunat <sub class="text-success">(opcional)</sub></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="codigo_establecimiento_sunat_llegada" name="codigo_establecimiento_sunat_llegada" placeholder="Código Sunat" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- OBSERVACIONES -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12">

                                <div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">OBSERVACIONES</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> <!-- ./ end card-header -->

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <div class="col-12 mb-2">

                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Observaciones <sub class="text-success">(opcional)</sub></label>
                                                <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control"></textarea>


                                            </div>



                                        </div>

                                    </div>

                                </div>
                            </div>


                            <!-- --------------------------------------------------------- -->
                            <!-- BOTONES (CANCELAR Y GENERAR GUIA) -->
                            <!-- --------------------------------------------------------- -->
                            <div class="col-12 text-center my-1">
                                <a class="btn btn-sm btn-danger  fw-bold w-25" id="btnCancelarGuia" style="position: relative; ">
                                    <span class="text-button">CANCELAR</span>
                                    <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                        <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                    </span>
                                </a>

                                <a class="btn btn-sm btn-success  fw-bold w-25" id="btnGuardarGuiaRemision" style="position: relative; ">
                                    <span class="text-button">GENERAR GUÍA</span>
                                    <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                        <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                    </span>
                                </a>
                            </div>

                        </div>

                    </form>

                </div>

                <!-- /.card -->
            </div>

        </div>

    </div>

</div>

<script>
    var itemProducto = 1;

    $(document).ready(function() {

        fnc_InicializarFormulario();

        $('#serie').on('change', function(e) {
            fnc_ObtenerCorrelativo($("#serie").val())
        })

        $("#btnGuardarGuiaRemision").on("click", function() {
            fnc_GenerarGuiaRemisionRemitente();
        })

        $("#btnCancelarGuia").on('click', function() {
            fnc_InicializarFormulario();
        })

        $("#btnAgregarChofer").on('click', function() {
            fnc_AgregarChofer();
        })

        $("#modalidad_traslado").change(function() {
            if ($("#modalidad_traslado").val() == "01") {
                fnc_AgregarTransportistaPublico();
                // fnc_QuitarTransportistaPrivado();
            } else {
                fnc_AgregarTransportistaPrivado();
                // fnc_QuitarTransportistaPublico();
            }
        })

        /* ======================================================================================
        EVENTO PARA MODIFICAR LA CANTIDAD DE PRODUCTOS DEL DATATABLE
        ====================================================================================== */
        $('#tbl_ListadoProductos tbody').on('change', '.iptCantidad', function() {

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

                    // ACTUALIZAR CANTIDAD
                    $('#tbl_ListadoProductos').DataTable().cell(index, 7).data(`<input type="number"  min="0" step="0.01"
                                                style="width:80px;"
                                                codigoProducto = ` + cod_producto_actual + `
                                                class="form-control form-control-sm text-center iptCantidad m-0 p-0 rounded-pill" 
                                value="` + cantidad_actual + `">`).draw();




                }

            })

        });

    });

    function fnc_InicializarFormulario() {

        fnc_LimpiarControles();
        fnc_CargarSelects();

        fnc_CargarAutocompleteProductos();
        fnc_CargarAutocompleteClientes();
        fnc_CargarAutocompleteUbigeos();

        fnc_CargarPluginDateTime();

        fnc_CargarDataTableListadoProductos();
        fnc_CargarDataTableListadoChoferes();

        fnc_AgregarTransportistaPublico();
    }

    /*===================================================================*/
    // L I M P I A R   C O N T R O L E S
    /*===================================================================*/
    function fnc_LimpiarControles() {

        $("#cliente").val('');
        $("#serie").val('');
        $("#correlativo").val('');
        $("#fecha_emision").val('');
        $("#modalidad_traslado").val('');
        $("#motivo_traslado").val('');
        $("#tipo_comprobante_rel").val('');
        $("#serie_rel").val('');
        $("#correlativo_rel").val('');
        $("#fecha_traslado").val('');
        $("#peso_bruto_total").val('');
        $("#numero_bultos").val('');
        $("#tipo_documento_transportista").val('');
        $("#nro_documento_transportista").val('');
        $("#nombre_transportista").val('');
        $("#nro_mtc").val('');
        $("#ubigeo_partida").val('');
        $("#direccion_partida").val('');
        $("#codigo_establecimiento_sunat_partida").val('');
        $("#ubigeo_llegada").val('');
        $("#direccion_llegada").val('');
        $("#codigo_establecimiento_sunat_llegada").val('');
        $("#observaciones").val('').change();

        $(".needs-validation-guia-remision-remitente").removeClass("was-validated");

    }

    /*===================================================================*/
    //CARGAR DROPDOWN'S
    /*===================================================================*/
    function fnc_CargarSelects() {

        CargarSelect('09', $("#tipo_comprobante"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante');
        CargarSelect(null, $("#tipo_comprobante_rel"), "--Seleccionar--", "ajax/series.ajax.php", 'obtener_tipo_comprobante', null, 1);
        $('#tipo_comprobante_rel option[value="07"]').remove();
        $('#tipo_comprobante_rel option[value="08"]').remove();
        $('#tipo_comprobante_rel option[value="RA"]').remove();
        $('#tipo_comprobante_rel option[value="RC"]').remove();
        $('#tipo_comprobante_rel option[value="NV"]').remove();
        $('#tipo_comprobante_rel option[value="CTZ"]').remove();
        $('#tipo_comprobante_rel option[value="NC"]').remove();
        CargarSelect(null, $("#tipo_documento_transportista"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');
        $('#tipo_documento_transportista option[value="0"]').remove();
        $('#tipo_documento_transportista option[value="1"]').remove();
        $('#tipo_documento_transportista option[value="4"]').remove();
        $('#tipo_documento_transportista option[value="7"]').remove();
        CargarSelect(null, $("#tipo_documento_chofer"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');
        $('#tipo_documento_chofer option[value="0"]').remove();
        $('#tipo_documento_chofer option[value="6"]').remove();
        CargarSelect(null, $("#serie"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_serie_comprobante', $('#tipo_comprobante').val());
        CargarSelect(null, $("#modalidad_traslado"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_modalidad_traslado');
        $('#modalidad_traslado option[value=""]').remove();
        CargarSelect(null, $("#motivo_traslado"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_motivo_traslado');

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
                    targets: [0, 3, 4, 6, 8, 9, 10],
                    visible: false
                },
                {
                    width: '5%',
                    targets: 7
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
    // C A R G A R   D A T A T A B L E   D E   P R O D U C T O S   A   V E N D ER
    /*===================================================================*/
    function fnc_CargarDataTableListadoChoferes() {

        if ($.fn.DataTable.isDataTable('#tbl_ListadoChoferes')) {
            $('#tbl_ListadoChoferes').DataTable().destroy();
            $('#tbl_ListadoChoferes tbody').empty();
        }

        $('#tbl_ListadoChoferes').DataTable({
            searching: false,
            paging: false,
            info: false,
            "columns": [{
                    "data": "acciones"
                },
                {
                    "data": "id_tipo_documento"
                },
                {
                    "data": "tipo_documento"
                },
                {
                    "data": "nro_documento"
                },
                {
                    "data": "licencia"
                },
                {
                    "data": "nombres"
                },
                {
                    "data": "apellidos"
                },
                {
                    "data": "placa"
                },
            ],
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: [1],
                    visible: false
                },
            ],
            "order": [
                [0, 'desc']
            ],
            "language": {
                "url": "ajax/language/spanish.json"
            }
        });

        // ajustarHeadersDataTables($("#tbl_ListadoChoferes"))

    }

    /*===================================================================*/
    // A U T O C O M P L E T E   D E   C L I E N T E S
    /*===================================================================*/
    function fnc_CargarAutocompleteClientes() {

        $("#cliente").autocomplete({
            source: "ajax/autocomplete_clientes_guias.ajax.php?id_tipo_documento=" + $("#tipo_documento").val(),
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                $cliente = ui.item.value;
                $("#cliente").val($cliente.split(" - ")[0].trim() + ' - ' + $cliente.split(" - ")[1].trim());
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
    // P L U G I N   D A T E T I M E P I C K E R
    /*===================================================================*/
    function fnc_CargarPluginDateTime() {

        $('#fecha_emision, #fecha_traslado').datetimepicker({
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
    // A U T O C O M P L E T E   D E   P R O D U C T O S
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

    function fnc_ObtenerCorrelativo(id_serie) {
        var formData = new FormData();
        formData.append('accion', 'obtener_correlativo_serie');
        formData.append('id_serie', id_serie);

        response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);
        $("#correlativo").val(response["correlativo"])
    }

    /*===================================================================*/
    // A U T O C O M P L E T E   D E   U B I G E O S
    /*===================================================================*/
    function fnc_CargarAutocompleteUbigeos() {

        $("#ubigeo_partida").autocomplete({
            source: "ajax/autocomplete_ubigeos.ajax.php?",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                $ubigeo_llegada = ui.item.value;
                $("#ubigeo_partida").val($ubigeo_llegada);
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

        $("#ubigeo_llegada").autocomplete({
            source: "ajax/autocomplete_ubigeos.ajax.php?",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                $ubigeo_llegada = ui.item.value;
                $("#ubigeo_llegada").val($ubigeo_llegada);
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
                        'descripcion': $descripcion.length > 20 ? $descripcion.substring(0, 20).toUpperCase() + '...' : $descripcion.toUpperCase(),
                        'id_tipo_igv': respuesta.id_tipo_afectacion_igv,
                        'tipo_igv': respuesta.tipo_afectacion_igv,
                        'unidad_medida': respuesta.unidad_medida,
                        'precio': `<input type="number" style="width:80px;" class="form-control form-control-sm text-center iptPrecio rounded-pill p-0 m-0" codigoProducto=` +
                            $.trim($codigo_producto) + ` value=` + parseFloat($precio).toFixed(2) + `>`,
                        'cantidad': `<input type="number"  class="form-control form-control-sm text-center iptCantidad rounded-pill p-0 m-0" codigoProducto=` +
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

                    /*===================================================================*/
                    //SI LA RESPUESTA ES FALSO, NO TRAE ALGUN DATO
                    /*===================================================================*/
                } else {
                    mensajeToast('error', 'EL PRODUCTO NO EXISTE O NO TIENE STOCK');
                }

            }
        });


    }

    function fnc_AgregarChofer() {

        if ($("#tipo_documento_chofer").val() == "" ||
            $("#nro_documento_chofer").val() == "" ||
            $("#licencia_chofer").val() == "" ||
            $("#nombres_chofer").val() == "" ||
            $("#apellidos_chofer").val() == "" ||
            $("#placa_vehiculo").val() == "") {

            mensajeToast("error", 'Complete todos los datos del Chofer')
            return;
        }

        $('#tbl_ListadoChoferes').DataTable().row.add({
            'acciones': "<center>" +
                "<span class='btnEliminarChofer text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Chofer'> " +
                "<i class='fas fa-trash fs-5'> </i> " +
                "</span>" +
                "</center>",
            'id_tipo_documento': $("#tipo_documento_chofer").val(),
            'tipo_documento': $("#tipo_documento_chofer option:selected").text(),
            'nro_documento': $("#nro_documento_chofer").val().toUpperCase(),
            'licencia': $("#licencia_chofer").val().toUpperCase(),
            'nombres': $("#nombres_chofer").val().toUpperCase(),
            'apellidos': $("#apellidos_chofer").val().toUpperCase(),
            'placa': $("#placa_vehiculo").val().toUpperCase()

        }).draw();

        $("#tipo_documento_chofer").val("")
        $("#nro_documento_chofer").val("")
        $("#licencia_chofer").val("")
        $("#nombres_chofer").val("")
        $("#apellidos_chofer").val("")
        $("#placa_vehiculo").val("")

    }

    function fnc_GenerarGuiaRemisionRemitente() {


        let count = 0;
        form_guia_remision_validate = validarFormulario('needs-validation-guia-remision-remitente');

        //INICIO DE LAS VALIDACIONES
        if (!form_guia_remision_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }


        $('#tbl_ListadoProductos').DataTable().rows().eq(0).each(function(index) {
            count = count + 1;
        });

        if (count == 0) {
            mensajeToast("error", "Ingrese los productos a trasladar");
            return;
        }

        count = 0;

        if ($("#modalidad_traslado").val() == "02") {
            $('#tbl_ListadoChoferes').DataTable().rows().eq(0).each(function(index) {
                count = count + 1;
            });

            if (count == 0) {
                mensajeToast("error", "Ingrese los Choferes");
                return;
            }

        }
        var $productos = [];
        var $choferes = []

        Swal.fire({
            title: 'Está seguro(a) de generar la Guía de Remisión?',
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

                    cantidad = $.parseHTML(data['cantidad'])[0]['value']

                    arr['cantidad'] = cantidad;
                    arr['descripcion'] = data["descripcion"];
                    arr['codigo_producto'] = data["codigo_producto"];
                    arr['unidad_medida'] = data["unidad_medida"];

                    $productos.push(arr);

                });

                if ($("#modalidad_traslado").val() == "02") {
                    var $i = 0;
                    $('#tbl_ListadoChoferes').DataTable().rows().eq(0).each(function(index) {

                        var arr = {};
                        var row = $('#tbl_ListadoChoferes').DataTable().row(index);

                        var data = row.data();

                        arr['item'] = $i;
                        arr['id_tipo_documento'] = data["id_tipo_documento"];
                        arr['nro_documento'] = data["nro_documento"];
                        arr['licencia'] = data["licencia"];
                        arr['nombres'] = data["nombres"];
                        arr['apellidos'] = data["apellidos"];
                        arr['placa'] = data["placa"];

                        $choferes.push(arr);
                        $i = $i + 1;

                    });
                }

                var formData = new FormData();
                formData.append('accion', 'generar_guia_remision_remitente');
                formData.append('datos_guia_remision_remitente', $("#frm-datos-guia-remision-remitente").serialize());
                formData.append('productos', JSON.stringify($productos));
                formData.append('choferes', JSON.stringify($choferes));

                response = SolicitudAjax('ajax/ventas.ajax.php', 'POST', formData);

                if (response.sunatResponse.success) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: response.sunatResponse.cdrResponse.description + ', se generó la Guia de Remisión Remitente: ' + response.guia,
                        showConfirmButton: true
                    })

                    window.open($ruta+'vistas/generar_guia_remision_a4.php?id_guia=' + response.id_guia,
                        'fullscreen=yes' +
                        "resizable=0,"
                    );
                } else {

                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: response.sunatResponse.error.message,
                        showConfirmButton: true
                    })

                }

                fnc_InicializarFormulario();

            }

        })

    }

    /*===================================================================*/
    //GENERALES
    /*===================================================================*/
    function fnc_AgregarTransportistaPublico() {

        $(".tranportista").html(`<div class="card card-gray shadow">
                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DATOS DEL TRANSPORTISTA</h3>
                                        <div class="card-tools m-0">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div> 
                                    <div class="card-body py-2">

                                        <div class="row">

                                            <div class="col-12 col-lg-3 mb-2">

                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento<strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="tipo_documento_transportista" name="tipo_documento_transportista" aria-label="Floating label select example" required>
                                                </select>
                                                <div class="invalid-feedback">Seleccione el Tipo de Documento</div>

                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">

                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento <strong class="text-danger">*</strong></label>
                                                <div class="input-group input-group-sm mb-3 ">
                                                    <input type="text" class="form-control form-control-sm btnConsultarRuc" style="border-radius: 20px;" aria-label="Sizing example input" id="nro_documento_transportista" name="nro_documento_transportista" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm" required />
                                                    <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                                </div>

                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombre <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nombre_transportista" name="nombre_transportista" placeholder="Ingrese Nombre del Transportista" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required />
                                                <div class="invalid-feedback">Ingrese el Nro de Documento</div>
                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Nro Registro MTC <sub class="text-success">(opcional)</sub></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="nro_mtc" name="nro_mtc" placeholder="Ingrese la dirección" aria-label="Small" aria-describedby="inputGroup-sizing-sm" />
                                            </div>

                                        </div>

                                    </div>

                                </div>`)

        CargarSelect(null, $("#tipo_documento_transportista"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');
        $('#tipo_documento_transportista option[value="0"]').remove();
        $('#tipo_documento_transportista option[value="1"]').remove();
        $('#tipo_documento_transportista option[value="4"]').remove();
        $('#tipo_documento_transportista option[value="7"]').remove();

        $("#nro_documento_transportista").on('keypress', function(e) {
            if (e.which == 13) {
                fnc_ConsultarNroDocumento($("#nro_documento_transportista").val())
            }
        });

    }

    function fnc_AgregarTransportistaPrivado() {


        $(".tranportista").html(`<div class="card card-gray shadow">

                                    <div class="card-header">
                                        <h3 class="card-title fs-6">DATOS DEL TRANSPORTISTA</h3>
                                        <div class="card-tools m-0">

                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>

                                        </div>
                                    </div>

                                    <div class="card-body py-2">

                                        <div class="row">

                                            <div class="col-12 col-lg-3 mb-2">

                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Tipo Documento Chofer<strong class="text-danger">*</strong></label>
                                                <select class="form-select" id="tipo_documento_chofer" name="tipo_documento_chofer" aria-label="Floating label select example">
                                                </select>

                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">

                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Nro Documento <strong class="text-danger">*</strong></label>
                                                <div class="input-group input-group-sm mb-3 ">
                                                    <input type="text" class="form-control form-control-sm" style="border-radius: 20px;" aria-label="Sizing example input" id="nro_documento_chofer" name="nro_documento_chofer" placeholder="Ingrese Nro de documento" aria-describedby="inputGroup-sizing-sm">
                                                </div>

                                            </div>                                           

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Nombres Chofer <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="nombres_chofer" name="nombres_chofer" placeholder="Ingrese el nombre" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Apellidos Chofer</label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="apellidos_chofer" name="apellidos_chofer" placeholder="Ingrese el apellido" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-user-tie mr-1 my-text-color"></i>Licencia Chofer <strong class="text-danger">*</strong></label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="licencia_chofer" name="licencia_chofer" placeholder="Ej: A1234567898" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="col-12 col-lg-3 mb-2">
                                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-map-marker-alt mr-1 my-text-color"></i>Placa Vehículo</label>
                                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm text-uppercase" id="placa_vehiculo" name="placa_vehiculo" placeholder="Ej: ABC123" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                            </div>

                                            <div class="col-12 col-lg-6 text-center my-1 d-flex justify-content-end align-items-end pb-1">
                                                <a class="btn btn-sm btn-success  fw-bold w-50" id="btnAgregarChofer" style="position: relative; ">
                                                    <span class="text-button">AGREGAR</span>
                                                    <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                                        <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                    </span>
                                                </a>
                                            </div>

                                            <!-- LISTADO QUE CONTIENE LOS PRODUCTOS QUE SE VAN AGREGANDO PARA LA COMPRA -->
                                            <div class="col-md-12 mt-2">
                                                <table id="tbl_ListadoChoferes" class="display nowrap table-striped w-100 shadow" style="font-size: 12px;">
                                                    <thead class="bg-main text-center">
                                                        <tr>
                                                            <th></th>
                                                            <th>Id Tipo Documento</th>
                                                            <th>Tipo Documento</th>
                                                            <th>Nro Documento</th>                                                            
                                                            <th>Nombres</th>
                                                            <th>Apellidos</th>
                                                            <th>Licencia</th>
                                                            <th>Placa</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center" style="font-size: 13px;">
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>

                                </div>`);

        CargarSelect(null, $("#tipo_documento_chofer"), "--Seleccionar--", "ajax/ventas.ajax.php", 'obtener_tipo_documento');
        $('#tipo_documento_chofer option[value="0"]').remove();
        $('#tipo_documento_chofer option[value="6"]').remove();
        fnc_CargarDataTableListadoChoferes();

        $("#btnAgregarChofer").on('click', function() {
            fnc_AgregarChofer();
        })

    }

    /*===================================================================*/
    //GENERALES
    /*===================================================================*/
    function fnc_ConsultarNroDocumento(nro_documento) {

        var formData = new FormData()
        formData.append('accion', 'consultar_ruc');
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

                $("#nro_documento_transportista").val('')
                $("#nombre_transportista").val('')
                return;
            }

            $("#nombre_transportista").val(response['razonSocial']);

        }
    }
</script>