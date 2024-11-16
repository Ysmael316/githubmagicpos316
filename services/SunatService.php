<?php

use Greenter\Model\Client\Client;
use Greenter\Model\Company\Address;
use Greenter\Model\Company\Company;
use Greenter\Model\Despatch\Despatch;
use Greenter\Model\Despatch\DespatchDetail;
use Greenter\Model\Despatch\Direction;
use Greenter\Model\Despatch\Driver;
use Greenter\Model\Despatch\Shipment;
use Greenter\Model\Despatch\Transportist;
use Greenter\Model\Despatch\Vehicle;
use Greenter\Model\Sale\Document;
use Greenter\Model\Sale\FormaPagos\FormaPagoContado;
use Greenter\Model\Sale\Invoice;
use Greenter\Model\Sale\Legend;
use Greenter\Model\Sale\SaleDetail;
use Greenter\See;
use Greenter\Ws\Services\SunatEndpoints;
use Illuminate\Support\Facades\Storage;

require_once "../modelos/configuraciones.modelo.php";

class SunatService
{

    public function getSee($company)
    {

        $see = new See();
        // $see->setCertificate(Storage::get($company->cert_path));
        // $see->setService($company->production ? SunatEndpoints::FE_PRODUCCION : SunatEndpoints::FE_BETA);
        // $see->setClaveSOL($company->ruc, $company->sol_user, $company->sol_pass);

        return $see;
    }

    public function obtenerCredencialesApi($empresa)
    {

        $modo_guia_remision = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 9)["valor"];

        //CONFIGURACION API
        if (strtoupper($modo_guia_remision) == "DESARROLLO") {
            $client_id = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 1)["valor"];
            $client_secret = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 2)["valor"];
            $auth = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 5)["valor"];
            $cpe = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 6)["valor"];
        } else {
            $client_id = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 3)["valor"];
            $client_secret = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 4)["valor"];
            $auth = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 7)["valor"];
            $cpe = ConfiguracionesModelo::mdlObtenerConfiguracionValue(300, 8)["valor"];
        }

        $usuario_sol = ConfiguracionesModelo::mdlObtenerConfiguracionValue(400, 1)["valor"];
        $clave_sol = ConfiguracionesModelo::mdlObtenerConfiguracionValue(400, 2)["valor"];

        $api = new \Greenter\Api([
            'auth' => $auth,
            'cpe' => $cpe
        ]);


        // $api = new \Greenter\Api($company["production"] ? [
        //     'auth' => 'https://api-seguridad.sunat.gob.pe/v1',
        //     'cpe' => 'https://api-cpe.sunat.gob.pe/v1'
        // ] : [
        //     'auth' => 'https://gre-test.nubefact.com/v1',
        //     'cpe' => 'https://gre-test.nubefact.com/v1'
        // ]);


        // $api->setBuilderOptions([
        //     'strict_variables' => true,
        //     'optimizations' => 0,
        //     'debug' => true,
        //     'cache' => false
        // ])->setApiCredentials(
        //     $company["production"] ? $company["client_id"] : "test-85e5b0ae-255c-4891-a595-0b98c65c9854",
        //     $company["production"] ? $company["client_secret"] : "test-Hty/M6QshYvPgItX2P0+Kw=="
        // )->setClaveSOL(
        //     $company["ruc"],
        //     $company["production"] ? $company["usuario_sol"] : "MODDATOS",
        //     $company["production"] ? $company["clave_sol"] : "MODDATOS"
        // )->setCertificate(file_get_contents("../fe/certificado/".$company["certificado_digital_pem"]));

        $api->setBuilderOptions([
            'strict_variables' => true,
            'optimizations' => 0,
            'debug' => true,
            'cache' => false
        ])
            ->setApiCredentials($client_id, $client_secret)
            ->setClaveSOL(
                $empresa["ruc"],
                $usuario_sol,
                $clave_sol
            )->setCertificate(file_get_contents("../fe/certificado/" . $empresa["certificado_digital_pem"]));


        return $api;
    }


    public function obtenerGuiaRemisionTransportista($guia)
    {

        $despacth = (new Despatch)
            ->setVersion($guia["version"] ?? "2022")
            ->setTipoDoc($guia["tipoDoc"] ?? "31")
            ->setSerie($guia["serie"] ?? null)
            ->setCorrelativo($guia["correlativo"] ?? null)
            ->setFechaEmision(new DateTime($guia["fechaEmision"] ?? null))
            ->setRelDoc(SunatService::getRelDocs($guia["relDocs"]))
            ->setCompany(SunatService::getCompany($guia["company"]))
            ->setDestinatario(SunatService::getClient($guia["destinatario"]))
            // ->setTercero(SunatService::getClient($guia["tercero"])??null)            
            ->setEnvio(SunatService::getEnvioTransportista($guia["envio"]))
            ->setDetails(SunatService::getDespatchDetails($guia["details"]));

        if (isset($guia["tercero"])) {
            $despacth->setTercero(SunatService::getClient($guia["tercero"]));
        }

        return $despacth;
    }

    public function obtenerGuiaRemision($guia)
    {

        return (new Despatch)
            ->setVersion($guia["version"] ?? "2022")
            ->setTipoDoc($guia["tipoDoc"] ?? "09")
            ->setSerie($guia["serie"] ?? null)
            ->setCorrelativo($guia["correlativo"] ?? null)
            ->setFechaEmision(new DateTime($guia["fechaEmision"] ?? null))
            ->setRelDoc(SunatService::getRelDocs($guia["relDocs"]))
            ->setCompany(SunatService::getCompany($guia["company"]))
            ->setDestinatario(SunatService::getClient($guia["destinatario"]))
            ->setEnvio(SunatService::getEnvio($guia["envio"]))
            ->setDetails(SunatService::getDespatchDetails($guia["details"]));
    }

    static public function getCompany($company)
    {

        return (new Company())
            ->setRuc($company["ruc"])
            ->setRazonSocial($company["razonSocial"])
            ->setNombreComercial($company["nombreComercial"])
            ->setAddress(SunatService::getAddress($company['address']));
    }

    static public function getClient($client)
    {
        return (new Client())
            ->setTipoDoc($client["tipoDoc"])
            ->setNumDoc($client["numDoc"])
            ->setRznSocial($client["rznSocial"]);
    }

    static public function getTercero($tercero)
    {
        return (new Client())
            ->setTipoDoc($tercero["tipoDoc"])
            ->setNumDoc($tercero["numDoc"])
            ->setRznSocial($tercero["rznSocial"]);
    }

    static public function getAddress($address)
    {

        return (new Address())
            ->setUbigueo($address["ubigeo"])
            ->setDepartamento($address["departamento"])
            ->setProvincia($address["provincia"])
            ->setDistrito($address["distrito"])
            ->setUrbanizacion($address["urbanizacion"])
            ->setDireccion($address["direccion"])
            ->setCodLocal($address["codLocal"]); // Codigo de establecimiento asignado por SUNAT, 0000 por defecto.

    }

    //GUIAS DE REMISION
    static public function getEnvio($data)
    {
        $shipment = (new Shipment)
            ->setCodTraslado($data["codTraslado"] ?? null)
            ->setModTraslado($data["modTraslado"] ?? null)
            ->setFecTraslado(new DateTime($data["fecTraslado"] ?? null))
            ->setPesoTotal($data["pesoTotal"] ?? null)
            ->setUndPesoTotal($data["undPesoTotal"] ?? null)
            ->setNumBultos($data["numBultos"] ?? null)
            ->setLlegada(new Direction($data["llegada"]["ubigeo"], $data["llegada"]["direccion"]))
            ->setPartida(new Direction($data["partida"]["ubigeo"], $data["partida"]["direccion"]));

        if ($data["modTraslado"] == "01") {
            $shipment->setTransportista(SunatService::getTransportista($data["transportista"]));
        }

        if ($data["modTraslado"] == "02") {
            $shipment->setVehiculo(SunatService::getVehiculos($data["vehiculos"]))
                ->setChoferes(SunatService::getChoferes($data["choferes"]));
        }

        return $shipment;
    }

    //GUIAS DE REMISION
    static public function getEnvioTransportista($data)
    {
        $shipment = (new Shipment)
            //  ->setCodTraslado($data["codTraslado"] ?? null)
            //  ->setModTraslado($data["modTraslado"] ?? null)
            ->setFecTraslado(new DateTime($data["fecTraslado"] ?? null))
            ->setPesoTotal($data["pesoTotal"] ?? null)
            ->setUndPesoTotal($data["undPesoTotal"] ?? null)
            ->setNumBultos($data["numBultos"] ?? null)
            ->setLlegada(new Direction($data["llegada"]["ubigeo"], $data["llegada"]["direccion"]))
            ->setPartida(new Direction($data["partida"]["ubigeo"], $data["partida"]["direccion"]));


        $shipment->setVehiculo(SunatService::getVehiculos($data["vehiculos"]))
            ->setChoferes(SunatService::getChoferes($data["choferes"]));


        return $shipment;
    }


    static  public function getTransportista($data)
    {
        return (new Transportist)
            ->setTipoDoc($data["tipoDoc"] ?? null)
            ->setNumDoc($data["numDoc"] ?? null)
            ->setRznSocial($data["rznSocial"] ?? null)
            ->setNroMtc($data["nroMtc"] ?? null);
    }

    static  public function getVehiculos($vehiculos)
    {

        $secundarios = [];

        foreach ($vehiculos as $item) {

            if ($item["item"] > 0) {
                $secundarios[] = (new Vehicle)->setPlaca($item["placa"]);
            }
        }

        return (new Vehicle)
            ->setPlaca($vehiculos[0]["placa"])
            ->setSecundarios($secundarios);
    }

    static public function getChoferes($choferes)
    {

        $drivers = [];

        $drivers[] = (new Driver)
            ->setTipo('Principal')
            ->setTipoDoc($choferes[0]['tipoDoc'] ?? null)
            ->setNroDoc($choferes[0]['nroDoc'] ?? null)
            ->setLicencia($choferes[0]['licencia'] ?? null)
            ->setNombres($choferes[0]['nombres'] ?? null)
            ->setApellidos($choferes[0]['apellidos'] ?? null);

        foreach ($choferes as $item) {

            if ($item["item"] > 0) {
                $drivers[] = (new Driver)
                    ->setTipo('Secundario')
                    ->setTipoDoc($item['tipoDoc'] ?? null)
                    ->setNroDoc($item['nroDoc'] ?? null)
                    ->setLicencia($item['licencia'] ?? null)
                    ->setNombres($item['nombres'] ?? null)
                    ->setApellidos($item['apellidos'] ?? null);
            }
        }

        return $drivers;
    }

    static  public function getDespatchDetails($details)
    {

        $green_details = [];

        foreach ($details as $detail) {

            $green_details[] = (new DespatchDetail())
                ->setCantidad($detail["cantidad"] ?? null)
                ->setUnidad($detail["unidad"] ?? null)
                ->setDescripcion($detail["descripcion"] ?? null)
                ->setCodigo($detail["codigo"] ?? null);
        }


        return $green_details;
    }

    static public function getRelDocs($relDocs)
    {

        return (new Document)
            ->setTipoDoc($relDocs['relDoc']["tipoDoc"])
            ->setNroDoc($relDocs['relDoc']["nroDoc"]);
    }

    static  public function sunatResponse($result)
    {
        $response['success'] = $result->isSuccess();

        // Verificamos que la conexión con SUNAT fue exitosa.
        if (!$response['success']) {
            // Mostrar error al conectarse a SUNAT.
            // echo 'Codigo Error: ' . $result->getError()->getCode();
            // echo 'Mensaje Error: ' . $result->getError()->getMessage();

            $response['error'] = [
                'code' => $result->getError()->getCode(),
                'message' => $result->getError()->getMessage()
            ];
            return $response;
        }

        $response['cdrZip'] = base64_encode($result->getCdrZip());

        $cdr = $result->getCdrResponse();

        $response['cdrResponse'] = [
            'code' => (int)$cdr->getCode(),
            'description' => $cdr->getDescription(),
            'notes' => $cdr->getNotes(),

        ];

        return $response;
    }
}
