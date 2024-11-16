<?php

require_once "conexion.php";

class UbigeosModelo
{

    static public function mdlObtenerDepartamentos()
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    distinct departamento as id,
                                                            departamento as descripcion
                                                FROM 
                                                    tb_ubigeos
                                                ORDER BY departamento");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerProvinciasPorDepartamento($departamento)
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    distinct provincia as id, provincia as descripcion
                                                FROM 
                                                    tb_ubigeos p 
                                                WHERE  (p.departamento  LIKE CONCAT('%', :departamento, '%'))
                                                ORDER BY provincia");
        
        $stmt->bindParam(":departamento", $departamento, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerDistritosPorProvincia($provincia)
    {
        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    distinct distrito as id, distrito as descripcion
                                                FROM 
                                                    tb_ubigeos p 
                                                WHERE  (p.provincia  LIKE CONCAT('%', :provincia, '%'))
                                                ORDER BY distrito");
        
        $stmt->bindParam(":provincia", $provincia, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function mdlObtenerUbigeoPorDepProvDist($departamento, $provincia, $distrito)
    {
        $stmt = Conexion::conectar()->prepare("SELECT distinct substring(ubigeo_reniec,1,6) as ubigeo
                                                FROM tb_ubigeos 
                                                WHERE  (departamento  LIKE CONCAT('%', :departamento, '%')) 
                                                and (provincia  LIKE CONCAT('%', :provincia, '%'))
                                                and  (distrito  LIKE CONCAT('%', :distrito, '%'))");
        
        $stmt->bindParam(":departamento", $departamento, PDO::PARAM_STR);
        $stmt->bindParam(":provincia", $provincia, PDO::PARAM_STR);
        $stmt->bindParam(":distrito", $distrito, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }
    

}
