<?php

require_once "../modelos/configuraciones.modelo.php";

//=========================================================================================
// PETICIONES POST
//=========================================================================================
if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_configuracion_correo':

            $response = ConfiguracionesModelo::mdlObtenerConfiguracion(100);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_configuracion_modo_facturacion':

            $response = ConfiguracionesModelo::mdlObtenerConfiguracion(200);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_configuracion_modo_guia_remision':

            $response = ConfiguracionesModelo::mdlObtenerConfiguracion(300);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_configuracion_usuario_sol':

            $response = ConfiguracionesModelo::mdlObtenerConfiguracion(400);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'actualizar_configuracion_correo':

            $formulario_correo = [];
            parse_str($_POST['datos_correo'], $formulario_correo);

            $response = ConfiguracionesModelo::mdlActualizarConfiguracionCorreo($formulario_correo);
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
