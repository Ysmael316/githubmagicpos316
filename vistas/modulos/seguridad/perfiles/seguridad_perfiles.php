<!-- Content Header (Page header) -->
<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h2 class="m-0 fw-bold">ADMINISTRAR PERFILES</h2>

            </div><!-- /.col -->

            <div class="col-sm-6 d-none d-md-block">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>

                    <li class="breadcrumb-item active">Administrar Perfiles</li>

                </ol>

            </div><!-- /.col -->

        </div><!-- /.row -->

    </div><!-- /.container-fluid -->

</div><!-- /.content-header -->

<div class="content">

    <div class="container-fluid">

        <div class="card card-gray shadow mt-4">

            <div class="card-body px-3 py-3" style="position: relative;">

                <span class="titulo-fieldset px-3 py-1">LISTADO DE PERFILES </span>

                <div class="row my-3">

                    <div class="col-12">

                        <table id="tbl_perfiles" class="table table-striped w-100 shadow border border-secondary">
                            <thead class="bg-main text-left">
                                <th></th>
                                <th>Id</th>
                                <th>Descripción</th>
                                <th>Estado</th>
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

        fnc_CargarDatatablePerfil();

    })

    function fnc_CargarDatatablePerfil() {

        if ($.fn.DataTable.isDataTable('#tbl_perfiles')) {
            $('#tbl_perfiles').DataTable().destroy();
            $('#tbl_perfiles tbody').empty();
        }

        $("#tbl_perfiles").DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Registrar Perfil',
                    className: 'addNewRecord',
                    action: function(e, dt, node, config) {
                        
                        //IR A REGISTRAR PERFIL
                        CargarContenido('vistas/modulos/seguridad/perfiles/modulos/registrar_perfil.php', 'content-wrapper')
                    }
                },
                {
                    extend: 'excel',
                    title: function() {
                        var printTitle = 'LISTADO DE PERFILES';
                        return printTitle
                    }
                }, 'pageLength'
            ],
            pageLength: 10,
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: 'ajax/perfiles.ajax.php',
                data: {
                    'accion': 'obtener_perfiles'
                },
                type: 'POST'
            },
            columnDefs: [{
                    "className": "dt-center",
                    "targets": "_all"
                },
                {
                    targets: 0,
                    orderable: false,
                    width: '5%',
                    createdCell: function(td, cellData, rowData, row, col) {
                        console.log(rowData);

                        $(td).html(`
                                    <div class="btn-group" >
                                        <button class="btn btn-sm dropdown-toggle p-0 m-0 my-text-color fs-5" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-list-alt"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" style='cursor:pointer;' onclick="fnc_EditarPerfil('` + rowData[1] + `');"><i class='fas fa-pencil-alt fs-6 text-primary mr-2'></i> <span class='my-color'>Editar</span>
                                            </a>
                                            <a class="dropdown-item" style='cursor:pointer;' onclick="fnc_EliminarPerfil('` + rowData[1] + `');"><i class='fas fa-trash fs-6 text-danger mr-2'></i> <span class='my-color'>Eliminar</span>
                                            </a>
                                        </div>
                                    </div>`)
                    }
                },
                {
                    targets: 3,
                    createdCell: function(td, cellData, rowData, row, col) {
                        if (rowData[3] != 'ACTIVO') {
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


    /* ======================================================================================
    IR A EDITAR PERFIL
    =========================================================================================*/
    function fnc_EditarPerfil($id_perfil) {

        $(".content-wrapper").fadeOut('slow', function() {
            $(".content-wrapper").load('vistas/modulos/seguridad/perfiles/modulos/actualizar_perfil.php', {
                    id_perfil: $id_perfil
                },
                function() {
                    $(".content-wrapper").fadeIn(60);

                },
            );
        })
    }

    function fnc_EliminarPerfil($id_perfil){
        alert($id_perfil);
    }
</script>