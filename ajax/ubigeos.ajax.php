<?php

require_once "../modelos/ubigeos.modelo.php";

//=========================================================================================
// PETICIONES POST
//=========================================================================================
if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'obtener_departamentos':

            $response = UbigeosModelo::mdlObtenerDepartamentos();
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;


        case 'obtener_provincias':

            $response = UbigeosModelo::mdlObtenerProvinciasPorDepartamento($_POST["id_filtro"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_distritos':

            $response = UbigeosModelo::mdlObtenerDistritosPorProvincia($_POST["id_filtro"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;

        case 'obtener_ubigeo':

            $response = UbigeosModelo::mdlObtenerUbigeoPorDepProvDist($_POST["departamento"], $_POST["provincia"], $_POST["distrito"]);
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            break;
    }
}
