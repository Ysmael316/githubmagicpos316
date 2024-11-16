<?php
date_default_timezone_set('America/Lima');

require_once('../../modelos/clientes.modelo.php');

if (isset($_POST["accion"])) {

    switch ($_POST["accion"]) {

        case 'consultar_dni':

            // Datos
            // $token = 'apis-token-5544.90Ef81FECRR3Hn4N52JYvlbUuQl0Q4wk';
            $token = 'apis-token-7799.ryyt1IDYE8o6qGdjRJi5PuGXz9q6bG9I';
            $dni = $_POST["nro_documento"];

            $response = ClientesModelo::mdlObtenerClientePorDocumento(1, $dni);
            if ($response) {
                $response["existe"] = "1";
                echo json_encode($response);
                return;
            }


            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar dni
            curl_setopt_array($curl, array(
                // para user api versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
                // para user api versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos listos para usar
            echo $response;
            break;


        case 'consultar_ruc':

            $token = 'apis-token-7799.ryyt1IDYE8o6qGdjRJi5PuGXz9q6bG9I';
            // $token = 'apis-token-5544.90Ef81FECRR3Hn4N52JYvlbUuQl0Q4wk';
            $ruc = $_POST["nro_documento"];

            $response = ClientesModelo::mdlObtenerClientePorDocumento(6, $ruc);
            if ($response) {
                $response["existe"] = "1";
                echo json_encode($response);
                return;
            }
            // Iniciar llamada a API
            $curl = curl_init();

            // Buscar ruc sunat
            curl_setopt_array($curl, array(
                // para usar la versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ruc,
                // para usar la versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/ruc?numero=' . $ruc,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: http://apis.net.pe/api-ruc',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            // Datos de empresas según padron reducido
            echo $response;
            break;

        case "tipo_cambio":

            // Datos
            $token = 'apis-token-7796.rBKalHBJz-SD65hzygkjQ0yTfw80T6nJ';
            $fecha = date('Y-m-d');

            // print_r($fecha);

            // Iniciar llamada a API
            $curl = curl_init();

            curl_setopt_array($curl, array(
                // para usar la api versión 2
                CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
                // para usar la api versión 1
                // CURLOPT_URL => 'https://api.apis.net.pe/v1/tipo-cambio-sunat?fecha=' . $fecha,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
                    'Authorization: Bearer ' . $token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // Datos listos para usar
            echo $response;
            break;
    }
}
