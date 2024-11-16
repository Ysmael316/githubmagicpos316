<!-- Content Header (Page header) -->
<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-8">

                <h2 class="m-0 fw-bold">ADMINISTRAR TIPO AFECTACIÓN IGV <sub>SUNAT</sub></h2>

            </div><!-- /.col -->

            <div class="col-sm-4  d-none d-md-block">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

                    <li class="breadcrumb-item active">Administrar Tipo Afectación Igv</li>

                </ol>

            </div><!-- /.col -->

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->

</div><!-- /.content-header -->

<div class="content">

    <div class="row">

        <div class="col-12 ">

            <div class="card card-primary card-outline card-outline-tabs">

                <div class="card-header p-0 border-bottom-0">

                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">

                        <!-- TAB LISTADO DE TIPOS DE DOCUMENTO -->
                        <li class="nav-item">
                            <a class="nav-link active my-0" id="listado-tipo-afectacion-igv-tab" data-toggle="pill" href="#listado-tipo-afectacion-igv" role="tab" aria-controls="listado-tipo-afectacion-igv" aria-selected="true"><i class="fas fa-list"></i> Listado</a>
                        </li>

                        <!-- TAB REGISTRO DE TIPO DE DOCUMENTO -->
                        <li class="nav-item">
                            <a class="nav-link my-0" id="registrar-tipo-afectacion-igv-tab" data-toggle="pill" href="#registrar-tipo-afectacion-igv" role="tab" aria-controls="registrar-tipo-afectacion-igv" aria-selected="false"><i class="fas fa-file-signature"></i> Registrar</a>
                        </li>
                    </ul>

                </div>

                <div class="card-body">

                    <div class="tab-content" id="custom-tabs-four-tabContent">

                        <!-- TAB CONTENT LISTADO DE SERIES -->
                        <div class="tab-pane fade active show" id="listado-tipo-afectacion-igv" role="tabpanel" aria-labelledby="listado-tipo-afectacion-igv-tab">

                            <div class="row">

                                <!--LISTADO DE CATEGORIAS -->
                                <div class="col-md-12">
                                    <table id="tbl_tipo_afectacion_igv" class="table table-striped w-100 shadow border border-secondary">
                                        <thead class="bg-main text-left">
                                            <th></th>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Letra</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Tipo</th>
                                            <th>% Imp.</th>
                                            <th>Estado</th>
                                        </thead>
                                    </table>
                                </div>

                            </div>

                        </div>

                        <!-- TAB CONTENT REGISTRO DE TIPO DE AFECTACION -->
                        <div class="tab-pane fade" id="registrar-tipo-afectacion-igv" role="tabpanel" aria-labelledby="registrar-tipo-afectacion-igv-tab">

                            <form id="frm-datos-tipo-afectacion-igv" class="needs-validation-tipo-afectacion-igv" novalidate>

                                <input type="hidden" name="id_tipo_afectacion" id="id_tipo_afectacion" value="0">

                                <div class="row">

                                    <div class="col-3 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Código</label>
                                        <input type="text" placeholder="Ingrese el código" style="border-radius: 20px;" class="form-control form-control-sm " id="codigo" id-tipo-afectacion="0" name="codigo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" onchange="validateJS(event, 'codigo_tipo_afectacion')" required>
                                        <div class="invalid-feedback">Ingrese el código de Afectación</div>
                                    </div>

                                    <!-- DESCRIPCIÓN -->
                                    <div class="col-12 col-lg-9 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-align-left mr-1 my-text-color"></i>Descripción</label>
                                        <input type="text" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="descripcion" name="descripcion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese la descripción</div>
                                    </div>

                                    <!-- LETRA TRIBUTO -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-font mr-1 my-text-color"></i>Letra Tributo</label>
                                        <input type="text" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="letra_tributo" name="letra_tributo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese la Letra del tributo</div>
                                    </div>

                                    <!-- CODIGO TRIBUTO -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-barcode mr-1 my-text-color"></i>Código Tributo</label>
                                        <input type="text" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="codigo_tributo" name="codigo_tributo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese el codigo del tributo</div>
                                    </div>

                                    <!-- NOMBRE TRIBUTO -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-file-signature mr-1 my-text-color"></i>Nombre Tributo</label>
                                        <input type="text" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="nombre_tributo" name="nombre_tributo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese nombre del tributo</div>
                                    </div>

                                    <!-- TIPO TRIBUTO -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Tipo Tributo</label>
                                        <input type="text" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="tipo_tributo" name="tipo_tributo" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                                        <div class="invalid-feedback">Ingrese tipo de tributo</div>
                                    </div>

                                    <!-- PORCENTAJE AFECTACIÓN -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-percent mr-1 my-text-color"></i>Afectación</label>
                                        <input type="number" placeholder="Ingrese la descripción" style="border-radius: 20px;" class="form-control form-control-sm " id="porcentaje_impuesto" name="porcentaje_impuesto" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                    </div>

                                    <!-- ESTADO -->
                                    <div class="col-12 col-lg-2 mb-2">
                                        <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-toggle-on mr-1 my-text-color"></i>Estado</label>
                                        <select class="form-select" id="estado" name="estado" aria-label="Floating label select example" required>
                                            <option value="" disabled>--Seleccione un estado--</option>
                                            <option value="1" selected>ACTIVO</option>
                                            <option value="0">INACTIVO</option>
                                        </select>
                                        <div class="invalid-feedback">Seleccione el estado</div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="text-center">
                                            <a class="btn btn-sm btn-danger  fw-bold " id="btnCancelarTipoAfectacion" style="position: relative; width: 160px;">
                                                <span class="text-button">CANCELAR</span>
                                                <span class="btn fw-bold icon-btn-danger ">
                                                    <i class="fas fa-times fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>
                                            <a class="btn btn-sm btn-success  fw-bold " id="btnRegistrarTipoAfectacion" style="position: relative; width: 160px;">
                                                <span class="text-button">GUARDAR</span>
                                                <span class="btn fw-bold icon-btn-success ">
                                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                                </span>
                                            </a>
                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

                <!-- /.card -->
            </div>

        </div>

    </div>

</div>

<script>
    $(document).ready(function() {
        // CargarSelects();
        fnc_CargarDatatableTipoAfectacionIgv();
        // fnc_LoadDataTableEdit();

        $("#btnRegistrarTipoAfectacion").on('click', function() {
            fnc_GuardarTipoAfectacion();
        });

        $("#btnCancelarTipoAfectacion").on('click', function() {
            fnc_LimpiarFomulario();
        });

        $("#registrar-tipo-afectacion-igv-tab").on('click', function() {
            fnc_LimpiarFomulario();
        })

        $("#listado-tipo-afectacion-igv-tab").on('click', function() {
            fnc_LimpiarFomulario();
        })

        $('#tbl_tipo_afectacion_igv tbody').on('click', '.btnEditarTipoAfectacion', function() {
            fnc_IrFormularioActualizarAfectacion($(this));
        });

        $('#tbl_tipo_afectacion_igv tbody').on('click', '.btnEliminarTipoAfectacion', function() {
            fnc_EliminarTipoAfectacion($(this));
        });

    })


    function fnc_CargarDatatableTipoAfectacionIgv() {

        if ($.fn.DataTable.isDataTable('#tbl_tipo_afectacion_igv')) {
            $('#tbl_tipo_afectacion_igv').DataTable().destroy();
            $('#tbl_tipo_afectacion_igv tbody').empty();
        }

        $("#tbl_tipo_afectacion_igv").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'excel',
                title: function() {
                    var printTitle = 'LISTADO DE TIPO DE AFECTACION IGV';
                    return printTitle
                }
            }, 'pageLength'],
            pageLength: 10,
            processing: true,
            serverSide: true,
            ajax: {
                url: 'ajax/tipo_afectacion_igv.ajax.php',
                data: {
                    'accion': 'obtener_tipo_afectacion_igv'
                },
                type: 'POST'
            },
            scrollX: true,
            scrollY: "63vh",
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {                  
                    "targets": [4,5,7],
                    visible: false
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
                                            <a class="dropdown-item btnEditarTipoAfectacion" style='cursor:pointer;'>
                                                <i class='px-1 fas fa-edit fs-5 text-primary'></i> 
                                                <span class='my-color'>Editar Tipo Afectación</span>
                                            </a>
                                            <a class="dropdown-item btnEliminarTipoAfectacion" style='cursor:pointer;'>
                                                <i class='px-1 fas fa-trash fs-5 text-danger'></i> 
                                                <span class='my-color'>Eliminar Tipo Afectación</span>
                                            </a>
                                        </div>
                                    </div>`;

                        $(td).html($options)
                    }
                },
                {
                    targets: 9,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (rowData[9] != 'ACTIVO') {
                            $(td).parent().css('background', '#F2D7D5')
                            $(td).parent().css('color', 'black')
                        }
                    }
                },

            ],
            order: [
                [0, 'ASC']
            ],
            language: {
                url: "ajax/language/spanish.json"
            }

        })


    }

    function fnc_LoadDataTableEdit() {

        $("#tbl_tipo_afectacion_igv").on('draw.dt', function() {

            $("#tbl_tipo_afectacion_igv").Tabledit({
                url: 'ajax/actions_editable/actions_tipo_afectacion_igv.php',
                dataType: 'json',
                inputClass: 'form-control input-sm',
                columns: {
                    identifier: [0, 'id'],
                    editable: [
                        [1, 'codigo'],
                        [2, 'descripcion'],
                        [3, 'letra_tributo'],
                        [4, 'codigo_tributo'],
                        [5, 'nombre_tributo'],
                        [6, 'tipo_tributo'],
                        [7, 'estado', '{ "1" : "ACTIVO", "0" : "INACTIVO"}'],
                    ]
                },
                restoreButton: true,
                buttons: {
                    edit: {
                        class: 'btn btn-sm m-0 p-0 data-bs-toggle="tooltip" data-bs-placement="top" title="Activar/Editar Categoría"',
                        html: '<i class="fas fa-edit text-primary fs-5"></i>',
                        action: 'edit'
                    },
                    delete: {
                        class: 'd-none',
                        html: '',
                        action: 'delete'
                    },
                    save: {
                        class: 'btn btn-sm btn-success p-0 px-2 rounded-pill',
                        html: '<i class="fas fa-check "></i>'
                    },
                    restore: {
                        class: 'btn btn-sm btn-warning',
                        html: 'Deshacer',
                        action: 'restore'
                    },
                    confirm: {
                        class: 'btn btn-sm btn-danger p-0 px-1 rounded-pill',
                        html: '<i class="fas fa-check "></i>'
                    }
                },
                onSuccess: function(data, textStatus, jqXHR) {

                    if (data.action == "edit") {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'Se actualizó el tipo de afectación correctamente',
                            showConfirmButton: true,
                            timer: 2000
                        })
                        // $("#tbl_tipo_afectacion_igv").DataTable().ajax.reload();
                        fnc_CargarDatatableTipoAfectacionIgv();
                    }
                }
            })
        })
    }

    function fnc_GuardarTipoAfectacion() {

        form_tipo_afectacion_igv_validate = validarFormulario('needs-validation-tipo-afectacion-igv');

        //INICIO DE LAS VALIDACIONES
        if (!form_tipo_afectacion_igv_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        Swal.fire({
            title: 'Está seguro(a) de registrar el Tipo de Afectación?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo registrarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', 'registrar_tipo_afectacion_igv');
                formData.append('datos_tipo_afectacion_igv', $("#frm-datos-tipo-afectacion-igv").serialize());

                response = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true,
                    timer: 2000
                })

                fnc_LimpiarFomulario();

            }

        })
    }

    function fnc_LimpiarFomulario() {

        $("#id_tipo_afectacion").val(0);
        $("#codigo").val('');
        $("#codigo").attr('id-tipo-afectacion', 0)
        $("#descripcion").val('');
        $("#letra_tributo").val('')
        $("#codigo_tributo").val('')
        $("#nombre_tributo").val('')
        $("#tipo_tributo").val('')
        $("#porcentaje_impuesto").val('');
        $("#estado").val("1");

        $(".needs-validation-tipo-afectacion-igv").removeClass("was-validated");

        $("#listado-tipo-afectacion-igv-tab").addClass('active')
        $("#listado-tipo-afectacion-igv-tab").attr('aria-selected', true)
        $("#listado-tipo-afectacion-igv").addClass('active show')
        $("#registrar-tipo-afectacion-igv-tab").html('<i class="fas fa-file-signature"></i> Registrar')

        //DESACTIVAR PANE LISTADO DE TIPO DE DOCUMENTO
        $("#registrar-tipo-afectacion-igv-tab").removeClass('active')
        $("#registrar-tipo-afectacion-igv-tab").attr('aria-selected', false)
        $("#registrar-tipo-afectacion-igv").removeClass('active show')



        // $("#tbl_tipo_afectacion_igv").DataTable().ajax.reload();
        fnc_CargarDatatableTipoAfectacionIgv();
    }

    function fnc_IrFormularioActualizarAfectacion(fila_actualizar) {

        var data = (fila_actualizar.parents('tr').hasClass('child')) ?
            $("#tbl_tipo_afectacion_igv").DataTable().row(fila_actualizar.parents().prev('tr')).data() :
            $("#tbl_tipo_afectacion_igv").DataTable().row(fila_actualizar.parents('tr')).data();

        if (fila_actualizar.parents('tr').hasClass('selected')) {
            fnc_LimpiarFomulario();
        } else {

            //ACTIVAR PANE REGISTRO DE PROVEEDORES:
            $("#registrar-tipo-afectacion-igv-tab").addClass('active')
            $("#registrar-tipo-afectacion-igv-tab").attr('aria-selected', true)
            $("#registrar-tipo-afectacion-igv").addClass('active show')

            //DESACTIVAR PANE LISTADO DE PROVEEDORES:
            $("#listado-tipo-afectacion-igv-tab").removeClass('active')
            $("#listado-tipo-afectacion-igv-tab").attr('aria-selected', false)
            $("#listado-tipo-afectacion-igv").removeClass('active show');

            // $("#registrar-proveedores-tab").html('Actualizar Proveedor')
            $("#registrar-tipo-afectacion-igv-tab").html('<i class="fas fa-sync-alt"></i> Actualizar')

            $("#id_tipo_afectacion").val(data['1']);
            $("#codigo").val(data['2']);
            $("#codigo").attr('id-tipo-afectacion', data['1'])
            $("#descripcion").val(data['3']);
            $("#letra_tributo").val(data['4'])
            $("#codigo_tributo").val(data['5'])
            $("#nombre_tributo").val(data['6'])
            $("#tipo_tributo").val(data['7'])
            $("#porcentaje_impuesto").val(data['8']);
            if (data['9'] == "ACTIVO") $("#estado").val("1")
            else $("#estado").val("0");

        }

    }

    function fnc_EliminarTipoAfectacion($fila_actualizar) {

        var data = ($fila_actualizar.parents('tr').hasClass('child')) ?
            $("#tbl_tipo_afectacion_igv").DataTable().row($fila_actualizar.parents().prev('tr')).data() :
            $("#tbl_tipo_afectacion_igv").DataTable().row($fila_actualizar.parents('tr')).data();


        Swal.fire({
            title: 'Está seguro(a) de eliminar el Tipo de Afectación?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarlo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                $id_tipo_afectacion = data['1'];
                $codigo = data['2'];

                var formData = new FormData();
                formData.append('accion', 'eliminar_tipo_afectacion');
                formData.append('id_tipo_afectacion', $id_tipo_afectacion);

                response = SolicitudAjax('ajax/tipo_afectacion_igv.ajax.php', 'POST', formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response['tipo_msj'],
                    title: response['msj'],
                    showConfirmButton: true
                })


                fnc_LimpiarFomulario();

            }

        })


    }
</script>