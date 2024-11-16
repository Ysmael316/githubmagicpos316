<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2 class="m-0 fw-bold">ADMINISTRAR CATEGORÍAS</h2>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <ol class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
                    <li class="breadcrumb-item">Productos</li>
                    <li class="breadcrumb-item active">Categorías</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">LISTADO DE CATEGORÍAS</span>

                <div class="row my-3">

                    <div class="col-12">
                        <table id="tbl_categorias" class="table table-striped w-100 shadow border border-secondary">
                            <thead class="bg-main text-left">
                                <th></th>
                                <th>Id</th>
                                <th>Categoría</th>
                                <th>Estado</th>
                                <th>F. Creación</th>
                            </thead>
                        </table>
                    </div>

                </div>

            </div>

        </div>

    </div>


</div>


<div class="modal fade" id="mdlGestionarCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-main py-2">
                <h6 class="modal-title titulo_modal_categoria">Registrar Categoría</h6>
                <button type="button" class="text-white m-0 px-1 badge badge-pill badge-danger " data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>

            <div class="modal-body">

                <form class="needs-validation-categorias" novalidate>

                    <div class="row">

                        <div class="col-md-12">
                            <label class="mb-0 ml-1 text-sm my-text-color"><i class="fas fa-layer-group mr-1 my-text-color"></i>Categoría</label>
                            <input type="text" style="border-radius: 20px;" class="form-control form-control-sm" id="descripcion" name="descripcion" aria-label="Small" aria-describedby="inputGroup-sizing-sm" required>
                            <div class="invalid-feedback">Ingrese la categoría</div>
                        </div>

                        <div class="col-md-12 mt-3 text-center">
                            <a class="btn btn-sm btn-success  fw-bold " id="btnRegistrarCategoria" style="position: relative; width: 50%;">
                                <span class="text-button">GUARDAR</span>
                                <span class="btn fw-bold icon-btn-success d-flex align-items-center">
                                    <i class="fas fa-save fs-5 text-white m-0 p-0"></i>
                                </span>
                            </a>
                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>
</div>

<script>
    //variables para registrar o editar la categoria
    var $global_id_categoria = 0;

    $(document).ready(function() {

        fnc_InicializarFormulario();

        $('#tbl_categorias tbody').on('click', '.btnEliminarCategoria', function() {
            var data = $('#tbl_categorias').DataTable().row($(this).parents('tr')).data();
            $id_categoria = data[1];
            fnc_EliminarCategoria($id_categoria)
        })

        $('#tbl_categorias tbody').on('click', '.btnEditarCategoria', function() {
            var data = $('#tbl_categorias').DataTable().row($(this).parents('tr')).data();
            $id_categoria = data[1];
            $descripcion = data[2];
            fnc_MostrarModalEditarCategoria($id_categoria, $descripcion)
        })

        $('#tbl_categorias tbody').on('click', '.btnActivarCategoria', function() {
            var data = $('#tbl_categorias').DataTable().row($(this).parents('tr')).data();
            $id_categoria = data[1];
            fnc_CambiarEstadoCategoria($id_categoria, 1); //1: ACTIVO
        })

        $('#tbl_categorias tbody').on('click', '.btnDesactivarCategoria', function() {
            var data = $('#tbl_categorias').DataTable().row($(this).parents('tr')).data();
            $id_categoria = data[1];
            fnc_CambiarEstadoCategoria($id_categoria, 0); //0: INACTIVO
        })


        $("#btnRegistrarCategoria").on('click', function() {
            fnc_guardarCategoria();
        })

        $('#mdlGestionarCategoria').on('hidden.bs.modal', function(e) {
            $("#descripcion").val('')
            $(".needs-validation-categorias").removeClass("was-validated");
        })


    })

    function fnc_InicializarFormulario() {
        fnc_CargarDatatableCategorias();
        // fnc_CargarEditableCategorias();
    }

    function fnc_CargarDatatableCategorias() {

        if ($.fn.DataTable.isDataTable('#tbl_categorias')) {
            $('#tbl_categorias').DataTable().destroy();
            $('#tbl_categorias tbody').empty();
        }

        $("#tbl_categorias").DataTable({
            // bFilter: false,
            // bPaginate: false,
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Agregar Categoría',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        $(".titulo-modal-productos").html("Registrar Producto")
                        $("#mdlGestionarCategoria").modal('show');
                        $global_id_categoria = 0;
                    }
                },
                {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE CATEGORÍAS';
                        return printTitle
                    }
                }, 'pageLength'
            ],
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/categorias.ajax.php',
                data: {
                    'accion': 'listar_categorias'
                },
                type: 'POST'
            },
            scrollX: true,
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 4,
                    visible: false
                },
                {
                    targets: 1,
                    "width": "10%"
                },
                {
                    targets: 0,
                    "width": "10%",
                    sortable: false,
                    render: function(data, type, full, meta) {

                        $opciones = '';

                        $opciones = $opciones +
                            `<center>
                                    <span class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Categoría'> 
                                        <i class='fas fa-pencil-alt fs-5'></i> 
                                    </span> 
                                    <span class='btnEliminarCategoria text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Categoría'> 
                                        <i class='fas fa-trash fs-5'> </i> 
                                    </span>`;


                        if (full[3] == "ACTIVO") {
                            $opciones = $opciones +
                                `<span class='btnDesactivarCategoria text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Desactivar Categoría'>
                                        <i class='fas fa-toggle-on  fs-5'></i> 
                                    </span>`;

                        } else {
                            $opciones = $opciones +
                                `<span class='btnActivarCategoria text-success px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Activar Categoría'>
                                        <i class='fas fa-toggle-off  fs-5'></i>
                                    </span>`;
                        }

                        $opciones = $opciones + `</center>`;

                        return $opciones;

                    }
                },

                {
                    targets: 3,
                    "width": "25%",
                    createdCell: function(td, cellData, rowData, row, col) {

                        if (rowData[3] == 'ACTIVO') {
                            $(td).html('<span class="bg-success px-2 py-1 rounded-pill fw-bold"> ' + rowData[3] + ' </span>')
                        }

                        if (rowData[3] == 'INACTIVO') {
                            $(td).html('<span class="bg-danger px-2 py-1 rounded-pill fw-bold"> ' + rowData[3] + ' </span>')
                        }

                    }
                },


            ],
            language: {
                url: "ajax/language/spanish.json"
            }
        })


        // $('#tbl_categorias').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'excel', 'print', 'pageLength',
        //     ],
        //     ajax: {
        //         url: 'ajax/categorias.ajax.php',
        //         type: 'POST',
        //         data: {
        //             'accion': 'listar_categorias'
        //         },
        //         dataSrc: ""
        //     },
        //     scrollX: true,
        //     columnDefs: [
        //         {
        //             targets: 1,
        //             render: function(data, type, full, meta) {
        //                 return "<div class='text-wrap width-200'>" + data + "</div>";
        //             }

        //         },
        //         {
        //             targets: 2,
        //             sortable: false,
        //             createdCell: function(td, cellData, rowData, row, col) {

        //                 if (parseInt(rowData[2]) == 0) {
        //                     $(td).html("Und(s)")
        //                 } else {
        //                     $(td).html("Kg(s)")
        //                 }

        //             }
        //         },
        //         {
        //             targets: 5,
        //             sortable: false,
        //             render: function(data, type, full, meta) {
        //                 return "<center>" +
        //                     "<span class='btnEditarCategoria text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar Categoría'> " +
        //                     "<i class='fas fa-pencil-alt fs-5'></i> " +
        //                     "</span> " +
        //                     "<span class='btnEliminarCategoria text-danger px-1'style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar Categoría'> " +
        //                     "<i class='fas fa-trash fs-5'> </i> " +
        //                     "</span>" +
        //                     "</center>";
        //             }
        //         }
        //     ],
        //     "order": [
        //         [1, 'asc']
        //     ],
        //     lengthMenu: [0, 5, 10, 15, 20, 50],
        //     "pageLength": 15,
        //     "language": {
        //         "url": "ajax/language/spanish.json"
        //     }
        // });
    }

    function fnc_guardarCategoria() {

        form_categorias_validate = validarFormulario('needs-validation-categorias');

        if (!form_categorias_validate) {
            mensajeToast("error", "complete los datos obligatorios");
            return;
        }

        Swal.fire({
            title: 'Está seguro de ' + ($global_id_categoria > 0 ? 'actualizar' : 'registrar') + ' la categoría?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar!',
            cancelButtonText: 'Cancelar!',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();
                formData.append('accion', $global_id_categoria > 0 ? 'actualizar_categoria' : 'registrar_categoria');
                if ($global_id_categoria > 0) {
                    formData.append("id_categoria", $global_id_categoria);
                }
                formData.append("descripcion", $("#descripcion").val());

                response = SolicitudAjax("ajax/categorias.ajax.php", "POST", formData);

                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                $("#descripcion").val("");

                $("#mdlGestionarCategoria").modal('hide');
                fnc_CargarDatatableCategorias();
                $(".needs-validation-categorias").removeClass("was-validated");

            }
        })
    }

    function fnc_EliminarCategoria($id_categoria) {

        Swal.fire({
            title: 'Está seguro(a) de eliminar la Categoría?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, deseo eliminarla!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {

            if (result.isConfirmed) {

                var formData = new FormData();

                formData.append('accion', 'eliminar_categoria');
                formData.append('id_categoria', $id_categoria)

                response = SolicitudAjax('ajax/categorias.ajax.php', 'POST', formData);


                Swal.fire({
                    position: 'top-center',
                    icon: response.tipo_msj,
                    title: response.msj,
                    showConfirmButton: true
                })

                fnc_CargarDatatableCategorias();

            }
        })
    }

    function fnc_MostrarModalEditarCategoria($id_categoria, $descripcion) {

        $(".titulo_modal_categoria").html("Actualizar Producto")
        $("#mdlGestionarCategoria").modal('show');

        $global_id_categoria = $id_categoria;
        $("#descripcion").val($descripcion)

    }

    function fnc_CambiarEstadoCategoria($id_categoria, $estado) {

        var formData = new FormData();
        formData.append("accion", 'cambiar_estado_categoria');
        formData.append("id_categoria", $id_categoria);
        formData.append("estado", $estado);

        response = SolicitudAjax("ajax/categorias.ajax.php", "POST", formData);

        Swal.fire({
            position: 'top-center',
            icon: response.tipo_msj,
            title: response.msj,
            showConfirmButton: true
        })

        fnc_CargarDatatableCategorias();

    }
</script>