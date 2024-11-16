<?php

use Greenter\Report\XmlUtils;

require_once "../services/SunatService.php";
require_once "../modelos/empresas.modelo.php";

// use App\Http\Controllers\Controller;
// use App\Models\Company;
// use App\Services\SunatService;
// use Greenter\Report\XmlUtils;
// use Illuminate\Http\Request;

class ApiGuiaRemision
{
    static public function enviarGuia($guia, $id_guia)
    {

        $guia = json_decode($guia, true);

        $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();

        $sunat = new SunatService();

        $despatch = $sunat->obtenerGuiaRemision($guia);
        // $despatch = $sunat->obtenerGuiaRemisionTransportista($guia);

        $api = $sunat->obtenerCredencialesApi($empresa);

        $result = $api->send($despatch);

        $ticket = $result->getTicket();
        $result = $api->getStatus($ticket);

        $response['xml'] = $api->getLastXml();
        $response['hash'] = (new XmlUtils)->getHashSign($response['xml']);
        $response['sunatResponse'] = $sunat->sunatResponse($result);
        $response["guia"] =  $guia["serie"] . '-' . $guia["correlativo"];
        $response["id_guia"] =  $id_guia;

        return $response;
    }

    static public function enviarGuiaTransportista($guia, $id_guia)
    {

        $guia = json_decode($guia, true);

        $empresa = EmpresasModelo::mdlObtenerEmpresaPrincipal();

        $sunat = new SunatService();

        $despatch = $sunat->obtenerGuiaRemisionTransportista($guia);
        // $despatch = $sunat->obtenerGuiaRemisionTransportista($guia);

        $api = $sunat->obtenerCredencialesApi($empresa);

        $result = $api->send($despatch);

        $ticket = $result->getTicket();
        $result = $api->getStatus($ticket);

        $response['xml'] = $api->getLastXml();
        $response['hash'] = (new XmlUtils)->getHashSign($response['xml']);
        $response['sunatResponse'] = $sunat->sunatResponse($result);
        $response["guia"] =  $guia["serie"] . '-' . $guia["correlativo"];
        $response["id_guia"] =  $id_guia;

        return $response;
    }
}
