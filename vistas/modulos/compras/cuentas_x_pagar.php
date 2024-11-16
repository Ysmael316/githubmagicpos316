<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">Cuentas por Pagar</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Cuentas x Pagar</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<!-- Main content -->
<div class="content mb-3">
    <div class="container-fluid">
        <!-- row para criterios de busqueda -->
        <div class="row">
            <div class="col-md-12">
                <table id="tbl_compras_x_pagar" class="table shadow border border-secondary" style="width:100%">
                    <thead class="bg-main text-left">
                        <th></th>
                        <th>Compra N°</th>
                        <th>Comprobante</th>
                        <th>Proveedor</th>
                        <th>Fecha Emisión</th>
                        <th>Total</th>
                        <th>Nro Cuotas</th>
                        <th>Cuotas Pagadas</th>
                        <th>Saldo Pendiente</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- =============================================================================================================================
MODAL MOSTRAR DETALLE DE CUOTAS
===============================================================================================================================-->
<div class="modal fade" id="mdlCuotas" role="dialog" tabindex="-1">

    <div class="modal-dialog modal-xl" role="document">

        <!-- contenido del modal -->
        <div class="modal-content">

            <!-- cabecera del modal -->
            <div class="modal-header my-bg py-1">

                <h5 class="modal-title text-white text-lg">Detalle de Cuotas</h5>

                <button type="button" class="btn btn-danger btn-sm text-white text-sm" data-bs-dismiss="modal">
                    <i class="fas fa-times text-sm m-0 p-0"></i>
                </button>

            </div>

            <!-- cuerpo del modal -->
            <div class="modal-body">

                <div class="row">

                    <input type="hidden" name="id_compra" id="id_compra" value="0">
                    <div class="col-lg-3">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-alt mr-1 my-text-color"></i>Importe a pagar</label>
                        <input type="number" step="0.01" min="0.01" class="form-control form-control-sm" id="importe_a_pagar" name="importe_a_pagar" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                    </div>

                    <div class="col-lg-3">
                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-money-bill-alt mr-1 my-text-color"></i>Saldo Pendiente</label>
                        <input type="text" class="form-control form-control-sm" id="saldo_pendiente" aria-label="Small" aria-describedby="inputGroup-sizing-sm" readonly>
                    </div>

                    <div class="col-lg-6 text-right d-flex align-items-end justify-content-end">
                        <a class="btn btn-sm btn-success  fw-bold w-25" id="btnPagar" style="position: relative;">
                            <span class="text-button">PAGAR</span>
                            <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                            </span>
                        </a>
                    </div>

                </div>

                <div class="row mt-3">

                    <!--LISTADO DE CUOTAS DE LA FACTURA SELECCIONADA -->
                    <div class="col-md-12">
                        <table id="tbl_cuotas_compra" class="table w-100 shadow border border-secondary">
                            <thead class="bg-main text-left">
                                <th>Id Cuota</th>
                                <th>Cuota</th>
                                <th>Importe</th>
                                <th>Importe Pagado</th>
                                <th>Saldo Pendiente</th>
                                <th>Cuota Pagada?</th>
                                <th>Fecha Vencimiento</th>
                            </thead>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function() {

        fnc_CargarDataTableComprasPorPagar();

        $('#tbl_compras_x_pagar tbody').on('click', '.btnPagarCuotas', function() {
            fnc_MostrarListadoCuotas($("#tbl_compras_x_pagar").DataTable().row($(this).parents('tr')).data());

        });

        $("#btnPagar").on('click', function() {
            if (!$("#importe_a_pagar").val()) {
                mensajeToast("error", "Ingrese el monto a pagar");
                return;
            }

            fnc_Pagar();

        });

        $('#mdlCuotas').on('hidden.bs.modal', function(e) {
            fnc_CargarDataTableComprasPorPagar();
            $("#id_compra").val(0);

            $("#importe_a_pagar").val('')
            $("#saldo_pendiente").val('')
        })

        $("#btnCalcular").on('click', function() {
            fnc_CalcularSaldoPendiente();
        });

    })

    function fnc_CargarDataTableComprasPorPagar() {

        if ($.fn.DataTable.isDataTable('#tbl_compras_x_pagar')) {
            $('#tbl_compras_x_pagar').DataTable().destroy();
            $('#tbl_compras_x_pagar tbody').empty();
        }

        $("#tbl_compras_x_pagar").DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE CUENTAS POR PAGAR';
                    return printTitle
                }
            },'pageLength'],
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/compras.ajax.php',
                data: {
                    'accion': 'compras_x_pagar'
                },
                type: 'POST'
            },
            scrollX: true,
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    createdCell: function(td, cellData, rowData, row, col) {

                        $(td).html(`<center> 
                                        <span class='btnPagarCuotas px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Pagar Cuotas'> 
                                            <i class='fas fa-check-circle fs-5 my-color '></i>
                                        </span>
                                    </center>
                        `)

                    }
                }
            ],
            language: {
                url: "vistas/assets/languages/spanish.json"
            }
        })
    }

    function fnc_MostrarListadoCuotas(data) {
        $("#mdlCuotas").modal("show")
        $("#id_compra").val(data["1"]);
        fnc_CargarDataTableCuotas(data["1"])
    }

    function fnc_CargarDataTableCuotas($id_compra) {

        if ($.fn.DataTable.isDataTable('#tbl_cuotas_compra')) {
            $('#tbl_cuotas_compra').DataTable().destroy();
            $('#tbl_cuotas_compra tbody').empty();
        }

        $("#tbl_cuotas_compra").DataTable({
            dom: 'Bfrtip',
            searching: false,
            paging: false,
            buttons: ['pageLength'],
            pageLength: [5, 10, 15, 30, 50, 100],
            pageLength: 10,
            ajax: {
                url: 'ajax/compras.ajax.php',
                dataSrc: function(json) {

                    var saldo_pendiente = parseFloat(0.00).toFixed(2);

                    for (let index = 0; index < json.length; index++) {
                        saldo_pendiente = parseFloat(saldo_pendiente)+ parseFloat(json[index]["saldo_pendiente"])                        
                    }


                    $("#saldo_pendiente").val(parseFloat(saldo_pendiente).toFixed(2));
                    return json;
                },
                data: {
                    'accion': 'obtener_cuotas_x_id_compra',
                    'id_compra': $id_compra
                },
                type: 'POST',
                async: false
            },
            // scrollX: true,
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    visible: false
                }

            ],
            language: {
                url: "vistas/assets/languages/spanish.json"
            }
        })
    }

    function fnc_Pagar() {

        let v_saldo_pendiente = parseFloat(0).toFixed(2);

        $('#tbl_cuotas_compra').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_cuotas_compra').DataTable().row(index);
            var data = row.data();            

            v_saldo_pendiente = parseFloat(v_saldo_pendiente) + parseFloat(data["saldo_pendiente"])
            
        })        

        if (parseFloat($("#importe_a_pagar").val()).toFixed(2) > parseFloat(v_saldo_pendiente).toFixed(2)) {
            mensajeToast("error", "El importe a pagar supera el saldo pendiente");
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de realizar el Pago?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo pagarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();

                formData.append('accion', 'pagar_cuota');
                formData.append('id_compra', $("#id_compra").val());
                formData.append('monto_a_pagar', $("#importe_a_pagar").val())

                response = SolicitudAjax('ajax/compras.ajax.php', 'POST', formData);

                fnc_CargarDataTableCuotas($("#id_compra").val());
                $("#importe_a_pagar").val('');
                fnc_CalcularSaldoPendiente();

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

            }
        })
    }

    function fnc_CalcularSaldoPendiente() {

        let v_saldo_pendiente = 0;


        $('#tbl_cuotas_compra').DataTable().rows().eq(0).each(function(index) {

            var row = $('#tbl_cuotas_compra').DataTable().row(index);
            var data = row.data();
            alert("entro")
            v_saldo_pendiente = v_saldo_pendiente + parseFloat(data["4"])            
        })

        $("#saldo_pendiente").val(v_saldo_pendiente);
    }
</script>