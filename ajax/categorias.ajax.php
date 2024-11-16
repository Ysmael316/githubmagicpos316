<?php

require_once "../modelos/categorias.modelo.php";

//=========================================================================================
// PETICIONES POST
//=========================================================================================
if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_categorias':

            $response = CategoriasModelo::mdlObtenerCategorias();
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'listar_categorias':

            // var_dump($_POST);
            // return;

            $response = CategoriasModelo::mdlListarCategorias($_POST);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'registrar_categoria':

            $response = CategoriasModelo::mdlRegistrarCategoria($_POST['descripcion']);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'actualizar_categoria':

            $response = CategoriasModelo::mdlActualizarCategoria($_POST['id_categoria'], $_POST['descripcion']);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'cambiar_estado_categoria':

            $response = CategoriasModelo::mdlCambiarEstadoCategoria($_POST['id_categoria'], $_POST['estado']);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'eliminar_categoria':

            $response = CategoriasModelo::mdlEliminarCategoria($_POST['id_categoria']);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        default:
            # code...
            break;
    }
}



//=========================================================================================
// PETICIONES GET
//=========================================================================================
// if (isset($_GET["accion"])) {

//     switch ($_GET["accion"]) {

//         case 'listar_categorias':
//             $response = CategoriasModelo::mdlListarCategorias();
//             echo json_encode($response, JSON_UNESCAPED_UNICODE);
//             break;
//     }
// }
