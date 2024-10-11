<?php

require_once "conexion.php";

class NotificacionModel{

    static public function addNotificacionMDL($tabla, $usuarioRut, $include_player_ids, $titulo, $mensaje) {
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");        
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(usuario, titulo, idEquipo, mensaje, fecha)
         VALUES ('$usuarioRut', '$titulo', '$include_player_ids', '$mensaje', '$fecha')");


		if($stmt->execute()){
            return "1";
		}else{

			return "2";
		
		}
    }

    static public function addNotificacionGralMDL($tabla, $tituloGral, $mensajeGral) {
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");        
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(titulo, mensaje, fecha)
         VALUES ('$tituloGral', '$mensajeGral', '$fecha')");


		if($stmt->execute()){
            return "1";
		}else{

			return "2";
		
		}
    }

}