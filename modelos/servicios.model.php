<?php

require_once "conexion.php";

class ModelServicios{


/*=============================================
INSERTAR LICITAR SERVICIO
=============================================*/
    static public function addServicioMDL($tabla, $datos){

        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(dni_usuario_licita, nombre_usuario_licita, cel_usuario_licita, nomServicio, des_necesidad) VALUES (:dni_usuario_licita, :nombre_usuario_licita, :cel_usuario_licita, :nomServicio, :des_necesidad)");

            $stmt->bindParam(":dni_usuario_licita", $datos->dni_usuario_licita, PDO::PARAM_STR);
            $stmt->bindParam(":nombre_usuario_licita", $datos->nombre_usuario_licita, PDO::PARAM_STR);
            $stmt->bindParam(":cel_usuario_licita", $datos->cel_usuario_licita, PDO::PARAM_STR);
            $stmt->bindParam(":nomServicio", $datos->nomServicio, PDO::PARAM_STR);
            $stmt->bindParam(":des_necesidad", $datos->des_necesidad, PDO::PARAM_STR);

		if($stmt->execute()){
            $lastInsertId = Conexion::conectar()->lastInsertId();
            
			return "1";

		}else{

			return "2";
		
		}
		
    }

    /*=============================================
	LLAMAR A TODAS LAS LICITAIONES POR  SERVICIO
	=============================================*/
    static public function allLicitaionesMDL($tabla, $dni_usuario_licita){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE dni_usuario_licita= :dni ORDER BY id DESC");

        $sql -> bindParam(":dni",$dni_usuario_licita, PDO::PARAM_STR);

        $sql ->execute();

        return $sql->fetchAll(PDO::FETCH_ASSOC);
 
    }

    /*=============================================
	LLAMAR A TODAS LAS LICITACIONES CON Y SI RTA.
	=============================================*/
    static public function detalleLicitacionesUserMDL($tabla, $id_licitacion){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE id= :id");

        $sql -> bindParam(":id",$id_licitacion, PDO::PARAM_STR);

        $sql ->execute();

        return $sql->fetch(PDO::FETCH_ASSOC);
 
    }
    
/*================================================================================================================*/
/*================================================================================================================*/

    /*=============================================
	LLAMAR A TODOS LOS REPORTES SIN FILTROS
	=============================================*/
    static public function todosServiciosMDL($usuario, $tabla, $tablaFoto, $usser){

        $sql = Conexion::conectar()->prepare("SELECT id, idUsuario,id_numPatente,
        (SELECT nombre FROM $usuario WHERE id = idUsuario LIMIT 1) AS 'Usuario',
        (SELECT numPatente FROM modelo_marca WHERE id = id_numPatente LIMIT 1) AS 'numPatente', 
        numMovil, 
        descripcion, descripcionQR, fecha, (CASE estado WHEN  '1' THEN 'Activo' ELSE 'Inactivo' END) as 'est',
        (SELECT rutaFoto FROM $tablaFoto WHERE idReporte = id LIMIT 1) AS 'rutaFoto',
        (CASE solucionado WHEN  '1' THEN 'Si' ELSE 'No' END) as 'solucions'
        FROM $tabla ORDER BY fecha DESC");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }


    /*====================================================
	LLAMAR A TODOS LOS REPORTES SIN SOLUCION TIPO USUARIOS
	=====================================================*/
    static public function allSinSolucionServiciosMDL($usuario, $tabla, $tablaFoto, $usser){

        $sql = Conexion::conectar()->prepare("SELECT id, idUsuario,id_numPatente,
        (SELECT nombre FROM $usuario WHERE id = idUsuario LIMIT 1) AS 'Usuario',
        (SELECT numPatente FROM modelo_marca WHERE id = id_numPatente LIMIT 1) AS 'numPatente', 
        numMovil, descripcion, descripcionSolucion, descripcionQR, fecha, (CASE estado WHEN  '1' THEN 'Activo' ELSE 'Inactivo' END) as 'est',
        (SELECT rutaFoto FROM $tablaFoto WHERE idReporte = id LIMIT 1) AS 'rutaFoto',
        (CASE solucionado WHEN  '1' THEN 'Si' ELSE 'No' END) as 'solucions'
        FROM $tabla WHERE solucionado!=1 AND idUsuario= '$usser' ORDER BY fecha DESC");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    /*=============================================
	LLAMAR UNO REPORTE POR USUARIOS 
	=============================================*/
    static public function oneServiciosMDL($idReporte, $tablaCliente, $tabla, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id, idUsuario, id_numPatente, numMovil,
        (SELECT numPatente FROM modelo_marca WHERE id = id_numPatente LIMIT 1) AS 'numPatente',
        (SELECT nombre FROM $tablaCliente WHERE id = idUsuario LIMIT 1) AS 'Usuario', 
        idPredef, descripcion, descripcionSolucion, descripcionQR, fecha, estado, coords, solucionado AS IDSolucionado,
        (SELECT rutaFoto FROM $tablaFoto WHERE idReporte = id LIMIT 1) AS 'rutaFoto',
        (CASE solucionado WHEN  '1' THEN 'Si' ELSE 'No' END) as 'solucions' FROM $tabla WHERE id = $idReporte");

        $sql ->execute();

        return $sql -> fetch();

    }
    /*=============================================
	LLAMAR A UNO LOS TIPO USUARIOS OARA REPORTE
	=============================================*/
    static public function oneSolucionMDL($idSolucion, $tablaCliente, $tabla, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT id, idReporte, idUsuario,
        (SELECT nombre FROM $tablaCliente WHERE id = idUsuario LIMIT 1)AS 'Clientes', 
        desde, hasta, descripcion,coords, 
        (SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = id LIMIT 1) AS 'rutaFoto'
         FROM $tabla WHERE id = $idSolucion");

        $sql ->execute();

        return $sql -> fetchAll();

    }

    /*=============================================
	LLAMAR A UNO LOS TIPO USUARIOS PARA REPORTE
	=============================================*/
    static public function oneServiciosFotodMDL($idReporte, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT rutaFoto, fotoReporte FROM $tablaFoto WHERE idReporte = $idReporte AND activo=1");

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	CONSULTA ALBUM  DE SOLUCION POR USUARIO
	=============================================*/
    static public function oneSolucionFotodMDL($idSolucion, $tablaFoto){

        $sql = Conexion::conectar()->prepare("SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = $idSolucion AND activo=1");

        $sql ->execute();

        return $sql -> fetchAll();


    }
    /*=============================================
	LLAMAR A TODAS LAS SOLUCIONES
	=============================================*/
    static public function allallSolucionMDL($usuario, $tabla, $tablaFoto, $user){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT nombre FROM $usuario WHERE id = idUsuario LIMIT 1) AS 'Clientes', 
        desde, hasta, descripcion,
        (SELECT rutaFoto FROM $tablaFoto WHERE idSolucion = id LIMIT 1) AS 'rutaFoto' 
        FROM $tabla WHERE idUsuario= '$user' ORDER BY fecha_crea DESC");

        $sql ->execute();

        return $sql -> fetchAll();
    }

    /*=============================================
	LLAMAR A TODOS ESTADOS DATOS
	=============================================*/
    static public function allEstadoDatoMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    
    /*=============================================
	LLAMAR A TODOS TIPO DATOS
	=============================================*/
    static public function allTipoDatoMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }
    
    /*=============================================
	LLAMAR A TODOS TIPO DATOS
	=============================================*/
    static public function allMMDMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }

    /*=============================================
	UPDATE REPORTE DESDE LA WEB
	=============================================*/
    static public function updateReporteMDL($tabla, $datos){

        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET idPredef=:idPredef, descripcion=:descripcion, descripcionSolucion=:descripcionSolucion WHERE id=:id");

            $stmt->bindParam(":idPredef", $datos->idPredef, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $datos->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":descripcionSolucion", $datos->descripcionSolucion, PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos->id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
		
    }
    /*=============================================
	INSERTAR DOCUMENTOS
	=============================================*/
    static public function docPDFMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario, tipo_doc, num_doc_carro, doc, fechaHora) VALUES (:idUsuario, :tipo_doc, :num_doc_carro, :doc, :fechaHora)");

        $stmt->bindParam(":idUsuario", $datos->idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos->tipo_doc, PDO::PARAM_STR);
        $stmt->bindParam(":num_doc_carro", $datos->num_doc_carro, PDO::PARAM_STR);
        $stmt->bindParam(":doc", $datos->doc, PDO::PARAM_STR);
        $stmt->bindParam(":fechaHora", $fecha, PDO::PARAM_STR);
		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

    }

    /*=============================================
	LLAMAR A TODOS LOS DOCUMENTOS
	=============================================*/
    static public function allDocnMDL( $tabla, $usuario){

        $sql = Conexion::conectar()->prepare("SELECT id,
        (SELECT nombre FROM $usuario WHERE id = idUsuario LIMIT 1) AS 'Nombre', 
        tipo_doc, num_doc_carro, fechaHora
        FROM $tabla  ORDER BY fechaHora DESC");

        $sql ->execute();

        return $sql -> fetchAll();
    }

        /*=============================================
	CONSULTA ALBUM  DE SOLUCION POR USUARIO
	=============================================*/
    static public function oneDocMDL($id, $tabla){

        $sql = Conexion::conectar()->prepare("SELECT tipo_doc, num_doc_carro, doc FROM $tabla WHERE id = $id ");

        $sql ->execute();

        return $sql -> fetchAll();


    }

}