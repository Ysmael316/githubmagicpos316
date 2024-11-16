<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">REGISTRO DE VENTAS</h2>
            </div><!-- /.col -->
            <div class="col-sm-6  d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item active">Reporte Ventas por Producto</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content mb-3">

    <div class="container-fluid">

        <!-- row para criterios de busqueda -->
        <div class="row">

            <div class="col-lg-12">

                <div class="card card-gray shadow">
                    <div class="card-header">
                        <h3 class="card-title">CRITERIOS DE BÚSQUEDA</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool text-warning" id="btnLimpiarBusqueda">
                                <i class="fas fa-times"></i>
                            </button>
                        </div> <!-- ./ end card-tools -->
                    </div> <!-- ./ end card-header -->
                    <div class="card-body py-2">

                        <div class="row">


                            <!-- <div class="col-12 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Desde</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="FechaDesde" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div> -->

                            <!-- FECHA DE COMPRA -->
                            <div class="col-12 col-md-4 col-lg-3 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Desde</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_desde"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_desde" name="fecha_desde" aria-describedby="inputGroup-sizing-sm">
                                </div>
                                <!-- <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Desde</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="FechaDesde" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> -->
                            </div>

                            <div class="col-12 col-lg-3 mb-2">
                                <!-- <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-calendar-alt mr-1 my-text-color"></i> Fecha Hasta</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="FechaHasta" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> -->

                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-id-card mr-1 my-text-color"></i> Fecha Hasta</label>
                                <div class="input-group input-group-sm mb-3 ">
                                    <span class="input-group-text" id="inputGroup-sizing-sm" style="cursor: pointer;" data-toggle="datetimepicker" data-target="#fecha_hasta"><i class="fas fa-calendar-alt ml-1 text-white"></i></span>
                                    <input type="text" class="form-control form-control-sm datetimepicker-input" style="border-top-right-radius: 20px;border-bottom-right-radius: 20px;" aria-label="Sizing example input" id="fecha_hasta" name="fecha_hasta" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-2">
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-gifts mr-1 my-text-color"></i>Cliente</label>
                                <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="cliente" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>

                            <div class="col-12 col-lg-3">

                                <!-- TIPO COMPROBANTE -->
                                <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-alt mr-1 my-text-color"></i> Comprobante</label>
                                <select class="form-select" id="tipo_comprobante" name="tipo_comprobante" aria-label="Floating label select example">
                                </select>

                            </div>


                            <!-- <div class="col-6">
                                <div class="form-group">
                                    <label class="mb-0 ml-1 text-sm my-text-color"> <i class="fas fa-file-invoice mr-1 my-text-color"></i> Comprobantes</label>
                                    <select class="select2bs4 form-select" multiple="multiple" aria-label="Floating label select example" data-placeholder="Seleccionar comprobantes" style="width: 100%;" id="comprobantes">
                                        <option>Factura</option>
                                        <option>Boleta</option>
                                        <option>Nota de Crédito</option>
                                        <option>Nota de Débito</option>
                                        <option>Nota de Venta</option>
                                    </select>
                                </div>
                            </div> -->

                            <!-- BUSCAR PRODUCTO -->
                            <div class="d-flex align-items-end col-12 col-lg-9 justify-content-end">

                                <a class="btn btn-sm btn-danger fw-bold w-25" id="btnLimpiarFiltros" style="position: relative;">
                                    <span class="text-button">LIMPIAR</span>
                                    <span class="btn fw-bold icon-btn-danger d-flex align-items-center">
                                        <i class="fas fa-times-circle fs-5"></i>
                                    </span>
                                </a>

                                <a class="btn btn-sm btn-info w-25 fw-bold btnBuscarVentas ml-2" style="position: relative;">
                                    <span class="text-button">BUSCAR</span>
                                    <span class="btn fw-bold icon-btn-custom d-flex align-items-center">
                                        <i class="fas fa-search fs-5"></i>
                                    </span>
                                </a>
                            </div>


                        </div>

                    </div> <!-- ./ end card-body -->

                </div>

            </div>

        </div>

        <!-- row para criterios de busqueda -->
        <div class="row">

            <div class="col-md-12">

                <table id="tbl_ventas_productos" class="shadow border border-secondary" style="width:100%">
                    <thead class="bg-main" style="font-size:12px;">
                        <tr class="text-center table-bordered">
                            <th rowspan="2">NÚMERO CORRELATIVO DEL REGISTRO O CÓDIGO UNICO DE LA OPERACIÓN</th>
                            <th rowspan="2">FECHA DE EMISIÓN DEL COMPROBANTE DE PAGO O DOCUMENTO</th>
                            <th rowspan="2">FECHA DE VENCIMIENTO Y/O PAGO</th>
                            <th colspan="3">COMPROBANTE DE PAGO O DOCUMENTO </th>
                            <th colspan="3">INFORMACIÓN DEL CLIENTE</th>
                            <th rowspan="2">VALOR FACTURADO DE LA EXPORTACIÓN</th>
                            <th rowspan="2">BASE IMPONIBLE DE LA OPERACIÓN GRAVADA</th>
                            <th colspan="2">IMPORTE TOTAL DE LA OPERACIÓN EXONERADA O INAFECTA</th>
                            <th rowspan="2">ISC</th>
                            <th rowspan="2">IGV Y/O IPM</th>
                            <th rowspan="2">OTROS TRIBUTOS Y CARGOS QUE NO FORMAN PARTE DE LA BASE IMPONIBLE</th>
                            <th rowspan="2">IMPORTE TOTAL DEL COMPROBANTE DE PAGO</th>
                            <th rowspan="2">TIPO DE CAMBIO</th>
                            <th colspan="4">REFERENCIA DEL COMPROBANTE DE PAGO O DOCUMENTO ORIGINAL QUE SE MODIFICA</th>
                        </tr>
                        <tr class="text-center table-bordered">
                            <th>TIPO (TABLA 10)</th>
                            <th>N° SERIE O N° DE SERIE DE LA MAQUINA REGISTRADORA</th>
                            <th>NÚMERO</th>
                            <th>TIPO DOCUMENTO DE IDENTIDAD (TABLA 2)</th>
                            <th>N° DOCUMENTO DE IDENTIDAD</th>
                            <th>APELLIDOS Y NOMBRES, DENOMINACIÓN O RAZÓN SOCIAL</th>
                            <th>EXONERADA</th>
                            <th>INAFECTA</th>
                            <th>FECHA</th>
                            <th>TIPO (TABLA 10)</th>
                            <th>SERIE</th>
                            <th>N° DEL COMPROBANTE DE PAGO O DOCUMENTO</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:13px;"></tbody>
                </table>

            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function() {

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        fnc_CargarInputsFecha();

        fnc_CargarAutocompleteClientes();

        // $(".btnBuscarProducto").on('click', function() {
        //     fnc_CargarDataTableVentasProductos($("#comprobantes").val());
        // })


        CargarSelect(null, $("#tipo_comprobante"), "--Todos--", "ajax/series.ajax.php", 'obtener_tipo_comprobante', null, 1);

        // BUSQUEDA POR DESCRIPCION DE PRODUCTO
        // $("#cliente").keyup(function() {
        //     $("#tbl_ventas_productos").DataTable().column($(this).data('index')).search(this.value).draw();
        // })

        // // BUSQUEDA POR RANGO DE PRECIOS
        // $("#FechaDesde, #FechaHasta").keyup(function() {
        //     $("#tbl_ventas_productos").DataTable().draw();
        // })

        // $.fn.dataTable.ext.search.push(

        //     function(settings, data, dataIndex) {

        //         var fechaDesde = $("#FechaDesde").val();
        //         var fechaHasta = $("#FechaHasta").val();

        //         var col_fecha = data[1];

        //         if ((fechaDesde == "" && fechaHasta == "") ||
        //             (fechaDesde == "" && col_fecha <= fechaHasta) ||
        //             (fechaDesde <= col_fecha && fechaHasta == "") ||
        //             (fechaDesde <= col_fecha && col_fecha <= fechaHasta)) {
        //             return true;
        //         }

        //         return false;
        //     }
        // )

        // BUSQUEDA POR CATEGORIAS
        // $("#tipo_comprobante").change(function() {

        //     if (this.value != 0) {
        //         $('#tbl_ventas_productos').DataTable().column($(this).data('index')).search(this.value).draw();
        //     } else {
        //         $('#tbl_ventas_productos').DataTable().column($(this).data('index')).search("").draw();
        //     }

        // })

        $(".btnBuscarVentas").on('click', function() {
            fnc_CargarDataTableVentasProductos($("#tipo_comprobante").val(),
                $("#cliente").val(),
                $("#fecha_desde").val(),
                $("#fecha_hasta").val())
        })

        $("#btnLimpiarFiltros").on('click', function() {
            $("#fecha_desde").val('')
            $("#fecha_hasta").val('')
            $("#cliente").val("")
            $("#tipo_comprobante").val("")
            fnc_CargarDataTableVentasProductos("0", "", "", "");
        })

        fnc_CargarDataTableVentasProductos($("#tipo_comprobante").val(),
            $("#cliente").val(),
            $("#fecha_desde").val(),
            $("#fecha_hasta").val());

    })

    /*===================================================================*/
    //A U T O C O M P L E T E   D E   C L I E N T E S
    /*===================================================================*/
    function fnc_CargarAutocompleteClientes() {

        $("#cliente").autocomplete({
            source: "ajax/clientes.ajax.php",
            minLength: 2,
            autoFocus: true,
            select: function(event, ui) {
                $("#cliente").val(ui.item.value.split('-')[1].trim())
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

    function fnc_CargarInputsFecha() {
        $('#fecha_desde, #fecha_hasta').datetimepicker({
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
    }

    function fnc_CargarDataTableVentasProductos($comprobantes, $cliente, $fecha_desde, $fecha_hasta) {

        if ($.fn.DataTable.isDataTable('#tbl_ventas_productos')) {
            $('#tbl_ventas_productos').DataTable().destroy();
            $('#tbl_ventas_productos tbody').empty();
        }

        $("#tbl_ventas_productos").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'REPORTE VENTAS';
                    return printTitle
                }
            }, 'pageLength'],
            pageLength: 10,
            // processing: true,
            // serverSide: true,
            order: [0, 'desc'],
            ajax: {
                url: 'ajax/reportes.ajax.php?',
                dataSrc: '',
                data: {
                    'accion': 'reporte_registro_ventas',
                    'comprobantes': $comprobantes,
                    'cliente': $cliente,
                    'fecha_desde': $fecha_desde,
                    'fecha_hasta': $fecha_hasta
                },
                type: 'POST'
            },

            scrollX: true,
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },

            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })
    }
</script>