<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="m-0 fw-bold">CARGA MASIVA DE PRODUCTOS</h2>
            </div><!-- /.col -->
            <div class="col-sm-6 d-none d-md-block">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="./">Inicio</a></li>
                    <li class="breadcrumb-item active">Carga Masiva de Productos</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">

    <div class="container-fluid">

        <!-- FILA PARA INPUT FILE -->
        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">SELECCIONE EL ARCHIVO EXCEL </span>

                <div class="row my-3">

                    <div class="col-lg-9">
                        <input type="file" name="fileProductos" id="fileProductos" class="form-control" accept=".xls, .xlsx">
                    </div>
                    <div class="col-lg-3">
                        <button class="btn btn-sm btn-success w-100" id="btnCargar" style="position: relative;">
                            <span class="text-button fw-bold fs-6">INICIAR CARGA</span>
                            <span class="btn fw-bold icon-btn-success">
                                <i class="fas fa-save fs-5"></i>
                            </span>
                        </button>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <!-- <a href='archivos/Inventario_Productos.xlsx' class="btn btn-primary bg-main"  style='cursor:pointer;'>
                                    <i class='px-1 fas fa-cloud-download-alt fs-5 my-color'></i> 
                                    <span class='my-color'> Descargar Plantilla</span>
                                </a> -->
                        <a href='archivos/Inventario_Productos.xlsx' class="btn btn-sm btn-info w-25 fw-bold " style="position: relative;">
                            <span class="text-button">Descargar Plantilla</span>
                            <span class="btn fw-bold icon-btn-custom d-flex align-items-center">
                                <i class="fas fa-cloud-download-alt fs-5"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <table id="tbl_cargas_masivas" class="table w-100 shadow border responsive border-secondary">
                            <thead class="bg-main">
                                <tr style="font-size: 15px;">
                                    <th> </th> <!-- 0 -->
                                    <th>Carga N°</th> <!-- 1 -->
                                    <th>Categ. Insert.</th> <!-- 2 -->
                                    <th>Categ. Excel</th> <!-- 3 -->
                                    <th>Prods Insert.</th> <!-- 4 -->
                                    <th>Prods Excel</th> <!-- 5 -->
                                    <th>Unds Med. Insert.</th> <!-- 6 -->
                                    <th>Unds Med. Excel</th> <!-- 7 -->
                                    <th>Estado</th> <!-- 8 -->
                                    <th>Fecha Carga</th> <!-- 9 -->
                                </tr>
                            </thead>
                            <tbody class="text-small">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>


    </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<div class="loading d-none">Loading</div>

<script>

    $(document).ready(function() {

        fnc_CargarDataTableCargasMasivas();

        $("#btnCargar").on("click", function() {

            if ($("#fileProductos").get(0).files.length == 0) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Debe seleccionar un archivo (Excel).',
                    showConfirmButton: true,
                })
            } else {
                fnc_MostrarLoader();
                setTimeout(function() {
                    fnc_CargarExcel();
                }, 2000);
            }
        })

    })


    function fnc_CargarExcel() {

        var archivo_valido = true;
        var formData = new FormData();

        formData.append('accion', 'carga_masiva_productos')

        var file = $("#fileProductos").val();
        
        if (file) {

            var ext = file.substring(file.lastIndexOf("."));
            
            if (ext != ".xls" && ext != ".xlsx") {

                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Debe seleccionar un archivo con extensión .xls o .xlsx.',
                    showConfirmButton: false
                })

                archivo_valido = false;
            }

            if (!archivo_valido) {
                return false;
            }

            const inputFile = document.querySelector('#fileProductos');
            // console.log("🚀 ~ fnc_CargarExcel ~ inputFile:", inputFile.files[0])
            formData.append('archivo[]', inputFile.files[0])
        }

        
        response = SolicitudAjax("ajax/productos.ajax.php", "POST", formData);
        
        fnc_OcultarLoader();
        fnc_CargarDataTableCargasMasivas();

        Swal.fire({
            position: 'center',
            icon: response["tipo_msj"],
            title: response["msj"],
            showConfirmButton: true
        })


    }

    function fnc_CargarDataTableCargasMasivas() {

        if ($.fn.DataTable.isDataTable('#tbl_cargas_masivas')) {
            $('#tbl_cargas_masivas').DataTable().destroy();
            $('#tbl_cargas_masivas tbody').empty();
        }

        $("#tbl_cargas_masivas").DataTable({
            dom: 'Bfrtip',
            buttons: ['pageLength'],
            pageLength: 25,
            ajax: {
                url: "ajax/productos.ajax.php",
                dataSrc: '',
                type: "POST",
                data: {
                    'accion': 'listar_cargas_masivas' //1: LISTAR PRODUCTOS
                },
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
                    targets: 8,
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData['estado_carga'] == 1) {
                            $(td).html(`<a style = 'cursor:pointer;'> 
                                            <i class='px-1 fas fa-check-circle fs-5 text-success'> </i> 
                                        </a>`)
                        } else {
                            $(td).html(`<a style = 'cursor:pointer;'> 
                                            <i class='px-1 fas fa-times-circle fs-5 text-danger'> </i> 
                                        </a>`)
                        }
                        // if (parseFloat(rowData['stock']) <= parseFloat(rowData['minimo_stock'])) {
                        //     $(td).parent().css('background', '#F2D7D5')
                        //     $(td).parent().css('color', 'black')
                        // }
                    }
                },
                // {
                //     targets: [1],
                //     visible: false
                // },
            ],
            // scrollX: true,
            // scrollY: "50vh",
            language: {
                url: "ajax/language/spanish.json"
            }

        });

    }
</script>