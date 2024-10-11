<?php

require_once "conexion.php";

class ModelCombustible{

    /*=============================================
	INSERTAR DETALLE DE REPORTE COMBUSTIBLE
	=============================================*/
    static public function newCombMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario,fecha, unidad, valorCarga, canLitros, lugarCarga, observaciones, estado, coords) VALUES (:idUsuario, :fecha, :unidad, :valorCarga, :canLitros, :lugarCarga, :observaciones, :estado, :coords)");

        $stmt->bindParam(":idUsuario", $datos->idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":unidad", $datos->unidad, PDO::PARAM_STR);
        $stmt->bindParam(":valorCarga", $datos->valorCarga, PDO::PARAM_STR);
        $stmt->bindParam(":canLitros", $datos->canLitros, PDO::PARAM_STR);
        $stmt->bindParam(":lugarCarga", $datos->lugarCarga, PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos->observaciones, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
        $stmt->bindParam(":coords", $datos->coords, PDO::PARAM_STR);
       

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}


    }

    /*=============================================
	 REGISTRO DE REPORTES DE SOLUCION FOTOS
	=============================================*/
    static public function consultaComFotoMDL($tabla, $rut){

        $sql = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE idUsuario = :rut ORDER BY id DESC LIMIT 1");

        $sql -> bindParam(":rut",$rut, PDO::PARAM_STR);

        $sql ->execute();

        return $sql -> fetch();

    }
   
    /*=============================================
	INSERTAR FOTO DETALLE DE COMBUSTIBLE USUARIO
	=============================================*/
    static public function combustibleFotoMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idCombustible, rutaFoto, usuario_crea, fecha_crea) VALUES (:idCombustible, :rutaFoto, :crea, :fecha_crea)");

        $stmt->bindParam(":idCombustible", $datos->idCombustible, PDO::PARAM_STR);
        $stmt->bindParam(":rutaFoto", $datos->rutaFoto, PDO::PARAM_STR);
        $stmt->bindParam(":crea", $datos->usuario_crea, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_crea", $fecha, PDO::PARAM_STR);
        
		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

    }

    /*=============================================
	LLAMAR A UN COMBUSTIBLE
	=============================================*/
    static public function oneCombustibleMDL($tablaCliente, $tabla, $tablaFoto, $usser){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT NOMBRE FROM $tablaCliente WHERE USUARIO = idUsuario LIMIT 1) AS 'Clientes', 
        fecha, unidad, valorCarga, lugarCarga, observaciones,
        (SELECT rutaFoto FROM $tablaFoto WHERE idCombustible = id LIMIT 1) AS 'rutaFoto' 
        FROM $tabla WHERE idUsuario= '$usser' ORDER BY fecha DESC");

        $sql ->execute();

        return $sql -> fetchAll();
    }

    /*=============================================
	LLAMAR A UN COMBUSTIBLE
	=============================================*/
    static public function oneSolucionMDL($idReporte, $tablaCliente, $tabla, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT NOMBRE FROM $tablaCliente WHERE USUARIO = idUsuario LIMIT 1) AS 'Clientes', 
        fecha, unidad, valorCarga, lugarCarga, observaciones, coords,
        (SELECT rutaFoto FROM $tablaFoto WHERE idCombustible = id LIMIT 1) AS 'rutaFoto'
        FROM $tabla WHERE id = $idReporte");

        $sql ->execute();

        return $sql -> fetchAll();

    }

    /*=============================================
	CONSULTA ALBUM  DE COMBUSTIBLE POR USUARIO
	=============================================*/
    static public function oneSolucionFotodMDL($idReporte, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT rutaFoto FROM $tablaFoto WHERE idCombustible = $idReporte AND activo=1");

        $sql ->execute();

        return $sql -> fetchAll();

    }
}