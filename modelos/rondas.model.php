<?php

require_once "conexion.php";

class ModelRondas{

    /*=============================================
	LLAMAR A TODAS LAS RODAS NO HECHAS
	=============================================*/
    static public function consultaPuntosMDL($usuario, $fecha, $rSolicitud, $rRutas){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $rSolicitud WHERE FECHA_CREA LIKE '%$fecha%' AND USUARIO = '$usuario' AND USUARIO_CIERRA IS NULL");

        $sql ->execute();

        $filas = $sql -> fetchColumn();
        //var_dump($filas);
        if ($filas > 1){
            $sql = Conexion::conectar()->prepare("SELECT PUNTO, (SELECT DESCRIPCION FROM rondas_zonas_puntos 
                                                  WHERE CODIGO = PUNTO AND ACTIVO =1) AS RUTAS FROM $rRutas WHERE 
                                                  FECHA_CREA LIKE '%$fecha%'AND USUARIO = '$usuario' AND REALIZADO = 0
                                                  AND CODIGO = (SELECT CODIGO FROM rondas_solicitud WHERE FECHA_CREA LIKE
                                                  '%$fecha%' AND USUARIO = '$usuario' AND USUARIO_CIERRA IS NULL) ");
    
            $sql ->execute();
    
            return $sql -> fetchAll();
           
        }else{

        return 0;

        }

 
    }

/*=============================================
	MARCAR PUNTOS
	=============================================*/
    static public function MarcarPuntosMDL($punto, $fecha, $usuario, $rRutas){


        $sql = Conexion::conectar()->prepare("SELECT *FROM $rRutas WHERE FECHA_CREA LIKE '%$fecha%' 
        AND USUARIO = '$usuario' AND  PUNTO=$punto AND REALIZADO = 0");

        $sql ->execute();
        
        return $sql -> fetch();


}
/*=============================================
UPDATE PUNTOS
=============================================*/
static public function updateMarcarPuntosMDL($usuario, $rRutas, $aTiempo, $id){
    date_default_timezone_set("America/Santiago");
    $hora = date("Y-m-d H:i:s");
    $sql = Conexion::conectar()->prepare("UPDATE $rRutas SET REALIZADO = 1, REALIZADO_A_TIEMPO = $aTiempo, 
                                        FECHA_MARCA = '$hora', USUARIO_MARCA = '$usuario' WHERE ID = $id");
    $sql ->execute();
    if (!$sql){
        return 0;
    }else{
        return 1;
    }
}

/*=============================================
LLAMAR A TODAS LAS RODAS HECHAS
=============================================*/
static public function consultaPuntosHechosMDL($usuario, $fecha, $rRutas){


        $sql = Conexion::conectar()->prepare("SELECT *FROM rondas_solicitud WHERE FECHA_CREA LIKE '%$fecha%' AND USUARIO = '$usuario' AND USUARIO_CIERRA IS NULL");

        $sql ->execute();

        $filas = $sql -> fetchColumn();
        //var_dump($filas);
        if ($filas > 1){
        $sql = Conexion::conectar()->prepare("SELECT DATE_FORMAT(FECHA, '%d-%m-%Y') AS FECHAS,
        (SELECT DESCRIPCION FROM torres WHERE CODIGO = (SELECT TORRE FROM rondas_zonas_puntos WHERE CODIGO = PUNTO AND ACTIVO = 1) ) AS TORRES,
        (SELECT ZONA FROM rondas_zonas_puntos WHERE CODIGO = PUNTO AND ACTIVO = 1) AS ZONA,
        (SELECT DESCRIPCION FROM rondas_zonas_puntos WHERE CODIGO = PUNTO AND ACTIVO = 1) AS PUNTOS, RANGO_MARCA_INICIO, RANGO_MARCA_TERMINO,
        CASE
            WHEN REALIZADO = 1
            THEN 'SI'
            ELSE 'NO'
            END AS MARCADO,
        CASE
            WHEN REALIZADO_A_TIEMPO = 1
            THEN 'A TIEMPO'
            ELSE 'FUERA DE TIEMPO'
            END AS TIEMPO
        FROM $rRutas WHERE FECHA = '$fecha' AND USUARIO = '$usuario'");

        $sql ->execute();

        return $sql -> fetchAll();
        }
       $sql = null;


}
}