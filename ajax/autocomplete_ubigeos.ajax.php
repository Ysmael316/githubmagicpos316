<?php

require_once "../modelos/conexion.php";

$dato_busqueda = $_GET['term'];

$stmt = Conexion::conectar()->prepare("SELECT concat(ubigeo_reniec, ' - ', departamento,' - ', provincia, ' - ', distrito) as ubigeo
                                        FROM tb_ubigeos
                                        WHERE concat(upper(departamento),'-', upper(provincia), '-', upper(distrito)) LIKE  concat('%',upper(:dato_busqueda),'%')
                                    LIMIT 0,5");

$stmt->bindParam(":dato_busqueda", $dato_busqueda, PDO::PARAM_STR);
$stmt->execute();

$productos = $stmt->fetchAll();

$productData = array();

foreach ($productos as $row) {

    $ubigeo = $row['ubigeo'];
    
    $data["id"] = $ubigeo;
    $data["value"] = $ubigeo;
    $data["label"] = '<div class="row mx-0 border border-secondary border-left-0 border-right-0 border-top-0" style="z-index:100;">
                            <div class="col-lg-12 d-flex flex-row align-items-center">
                                <div class="d-flex flex-column ml-3 text-sm">
                                    <div class="text-sm">Ubigeo: ' . $ubigeo . '</div> 
                                </div>
                            </div>
                        </div>';

    array_push($productData, $data);
}

// return $productData;

echo json_encode($productData);
