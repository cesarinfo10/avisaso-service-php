<?php

require_once "conexion.php";

class ModelDatos{

    /*=============================================
	INSERTAR DATOS GENERALES
	=============================================*/
    static public function newDatosGralMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d");

        $stmt = Conexion::conectar()->prepare("SELECT* FROM $tabla WHERE idUsuario = :usuarios AND idModelMarca= :idModelMarca");
    
        $stmt->bindParam(":usuarios",$datos->idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":idModelMarca",$datos->idModelMarca, PDO::PARAM_STR);
        $stmt-> execute();
        $stmt = $stmt->fetchColumn();
    
        if ($stmt!=null){
            return "2";
        }else{
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla
        (idUsuario, idModelMarca, revTecnica, perCirculacion, fechaCreacion, estado)
         VALUES (:idUsuario, :idModelMarca, :revTecnica, :perCirculacion, :fechaCreacion, :estado)");

        $stmt->bindParam(":idUsuario", $datos->idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":idModelMarca", $datos->idModelMarca, PDO::PARAM_STR);
        $stmt->bindParam(":revTecnica", $datos->revTecnica, PDO::PARAM_STR);
        $stmt->bindParam(":perCirculacion", $datos->perCirculacion, PDO::PARAM_STR);
        $stmt->bindParam(":fechaCreacion", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
       

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
    }

    }

    /*=============================================
	LLAMAR A UN DATO
	=============================================*/
    static public function oneDatosGralMDL($id){

        $sql = Conexion::conectar()->prepare("SELECT
        datos_generales.id,
        CONCAT(usuarios.nombre,' ', usuarios.apellido) AS 'Usuario',
        usuarios.id,
        modelo_marca.id AS 'idMarca',
        modelo_marca.numPatente,
        rev_tecnica.estado AS 'idEstadoTec',
        per_circulacion.estado AS 'idEstadoCirc',
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        tipo_movil.id AS 'idModelo',
        tipo_movil.nomTipoMovil
        FROM
        datos_generales
        INNER JOIN usuarios ON datos_generales.idUsuario = usuarios.id
        INNER JOIN modelo_marca ON datos_generales.idModelMarca = modelo_marca.id
        INNER JOIN estado_datos ON datos_generales.estado = estado_datos.id
        INNER JOIN per_circulacion ON per_circulacion.id_numPatente = modelo_marca.id AND per_circulacion.estado = estado_datos.id AND datos_generales.perCirculacion = per_circulacion.id
        INNER JOIN rev_tecnica ON rev_tecnica.estado = estado_datos.id AND rev_tecnica.id_numPatente = modelo_marca.id AND datos_generales.revTecnica = rev_tecnica.id
        INNER JOIN tipo_movil ON modelo_marca.idTipoMovil = tipo_movil.id WHERE  datos_generales.id = $id");

        $sql ->execute();

        return $sql -> fetch();
 
    }

    /*=============================================
	LLAMAR A TODOS LOS DATOS
	=============================================*/
    static public function AllDatosMDL(){

        $sql = Conexion::conectar()->prepare("SELECT
        datos_generales.id,
        CONCAT(usuarios.nombre,' ', usuarios.apellido) AS 'Usuario',
        usuarios.usuario As 'rutUsuario',
        modelo_marca.numPatente,
        (CASE rev_tecnica.estado WHEN  1 THEN 'Vigente' WHEN 2 THEN 'Por Vencer' ELSE 'Vencido' END) as revTecnica,
        (CASE per_circulacion.estado WHEN  1 THEN 'Vigente' WHEN 2 THEN 'Por Vencer' ELSE 'Vencido' END) as perCirculacion,
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        tipo_movil.nomTipoMovil
        FROM
        datos_generales
        INNER JOIN usuarios ON datos_generales.idUsuario = usuarios.id
        INNER JOIN modelo_marca ON datos_generales.idModelMarca = modelo_marca.id
        INNER JOIN estado_datos ON datos_generales.estado = estado_datos.id
        INNER JOIN per_circulacion ON per_circulacion.id_numPatente = modelo_marca.id AND per_circulacion.estado = estado_datos.id AND datos_generales.perCirculacion = per_circulacion.id
        INNER JOIN rev_tecnica ON rev_tecnica.estado = estado_datos.id AND rev_tecnica.id_numPatente = modelo_marca.id AND datos_generales.revTecnica = rev_tecnica.id
        INNER JOIN tipo_movil ON modelo_marca.idTipoMovil = tipo_movil.id");

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	LLAMAR A UN DATO POR PATENTE
	=============================================*/
    static public function oneDatosGralRutMDL($tabla, $id){

        $sql = Conexion::conectar()->prepare("SELECT id, rutUsuario, numPatente FROM $tabla WHERE id = $id");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    /*=============================================
	UPDATE DATOS GENERALES
	=============================================*/
    static public function updateUDatosGralMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d");
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idUsuario=:idUsuario, idModelMarca=:idModelMarca, revTecnica=:revTecnica,
                                              perCirculacion=:perCirculacion, fechaCreacion=:fechaCreacion, estado=:estado  WHERE id=:id");

            $stmt->bindParam(":idUsuario", $datos->idUsuario, PDO::PARAM_STR);
            $stmt->bindParam(":idModelMarca", $datos->idModelMarca, PDO::PARAM_STR);
            $stmt->bindParam(":revTecnica", $datos->revTecnica, PDO::PARAM_STR);
            $stmt->bindParam(":perCirculacion", $datos->perCirculacion, PDO::PARAM_STR);
            $stmt->bindParam(":fechaCreacion", $fecha, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $datos->estado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos->id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
		
    }

    /*=============================================
	DELETE DATOS GENERALES
	=============================================*/
    static public function deleteDatosMDL($tabla, $id){
        
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

		
		
    }

    /*=============================================
	LLAMAR A TODOS LOS DATOS MÓVIL
	=============================================*/
    static public function AllDatosMovilMDL(){

        $sql = Conexion::conectar()->prepare("SELECT
        modelo_marca.id,
        modelo_marca.idTipoMovil,
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        modelo_marca.numPatente,
        modelo_marca.ano,
        (CASE modelo_marca.estado WHEN  1 THEN 'Vigente' WHEN 2 THEN 'Por Vencer' ELSE 'Vencido' END) as estado
        FROM
        modelo_marca");

        $sql ->execute();

        return $sql -> fetchAll();

    }

    /*=============================================
	LLAMAR A TODOS LOS DATOS MÓVIL POR ID
	=============================================*/
    static public function datosMovilIDMDL($id){

        $sql = Conexion::conectar()->prepare("SELECT
        modelo_marca.id,
        modelo_marca.idTipoMovil,
        modelo_marca.nomMarca,
        modelo_marca.nomModelo,
        modelo_marca.numChasis,
        modelo_marca.numMotor,
        modelo_marca.numPatente,
        modelo_marca.ano,
        modelo_marca.estado,
        per_circulacion.estado AS estadoCir,
        rev_tecnica.estado AS estadoPer
        FROM
        modelo_marca
        INNER JOIN per_circulacion ON per_circulacion.id_numPatente = modelo_marca.id
        INNER JOIN rev_tecnica ON rev_tecnica.id_numPatente = modelo_marca.id WHERE modelo_marca.id = $id");

        $sql ->execute();

        return $sql -> fetchAll();

    }
}