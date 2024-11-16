<?php

require_once "../modelos/conexion.php";

$dato_busqueda = $_GET['term'];
$id_tipo_documento = $_GET['id_tipo_documento'];

$stmt = Conexion::conectar()->prepare("SELECT c.id, 
                                                c.id_tipo_documento, 
                                                c.nro_documento, 
                                                c.nombres_apellidos_razon_social, 
                                                c.direccion, 
                                                c.telefono, 
                                                c.estado
                                        FROM clientes c
                                        WHERE c.id_tipo_documento = :id_tipo_documento
                                        AND (c.nombres_apellidos_razon_social like concat('%',:dato_busqueda,'%'))
                                        AND c.estado = 1
                                        LIMIT 0,5");

$stmt->bindParam(":dato_busqueda", $dato_busqueda, PDO::PARAM_STR);
$stmt->bindParam(":id_tipo_documento", $id_tipo_documento, PDO::PARAM_STR);
$stmt->execute();

$productos = $stmt->fetchAll();

$productData = array();

foreach ($productos as $row) {

    $id = $row['id'];
    $id_tipo_documento = $row['id_tipo_documento'];
    $nro_documento = $row['nro_documento'];
    $nombres_apellidos_razon_social = $row['nombres_apellidos_razon_social'];
    $direccion = $row['direccion'];
    $telefono = $row['telefono'];
    $estado = $row['estado'];

    $data["id"] = $id;
    $data["value"] = $nro_documento . ' - ' . $nombres_apellidos_razon_social . ' - ' .$direccion . ' - ' . $telefono;
    $data["label"] = '<div class="row mx-0 border border-secondary border-left-0 border-right-0 border-top-0" style="z-index:100;">
                            <div class="col-lg-12 d-flex flex-row align-items-center">
                                <div class="d-flex flex-column ml-3 text-sm">
                                    <div class="text-sm">Nro Doc: ' . $nro_documento . ' - Cliente: ' . $nombres_apellidos_razon_social . '</div> 
                                </div>
                            </div>
                        </div>';

    array_push($productData, $data);
}

// return $productData;

echo json_encode($productData);
