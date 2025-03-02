<?php

require_once "conexion.php";

class ModelSession{
	/*=============================================
	INICIAR SESIÓN
	=============================================*/
    static public function iniciarSesion($tabla, $dni, $pass){
        $sql = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE dni = :dni AND password = :pass");

        $sql->bindParam(":dni", $dni, PDO::PARAM_STR);
        $sql->bindParam(":pass", $pass, PDO::PARAM_STR);
    
        $sql->execute();
    
        $result = $sql->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result;
        } else {
            return 2;
        }

    }

	/*=============================================
	INSERTAR USUARIO
	=============================================*/
    public static function newUserMDL($table, $data) {
        // Verificar si $data es un objeto, si no, intentar decodificarlo
        if (is_string($data)) {
            $data = json_decode($data);
        }
    
        // Verificar si la decodificación fue exitosa
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "Error: Datos JSON inválidos";
        }
    
        $stmt = Conexion::conectar()->prepare("INSERT INTO $table (dni, nombres, apellidos, password, rep_password) 
        VALUES (:dni, :nombres, :apellidos, :password, :rep_password)");
    
        $stmt->bindParam(":dni", $data->dni, PDO::PARAM_STR);
        $stmt->bindParam(":nombres", $data->nombres, PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $data->apellidos, PDO::PARAM_STR);
        $stmt->bindParam(":password", $data->password, PDO::PARAM_STR);
        $stmt->bindParam(":rep_password", $data->rep_password, PDO::PARAM_STR);
    
        if ($stmt->execute()) {
            return "1";
        } else {
            return "2";
        }
    }
 
    /*=============================================
	UPDATE USUARIO POS SESIÓN
	=============================================*/
    static public function updateUsePosSesionMDL($tabla, $datos){
        /*date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");*/
       // var_dump($datos);
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET tipo_usuario=:tipo_usuario, correo=:correo, celular=:celular, telefono=:telefono,
                                             direccion=:direccion, latitud=:latitud, longitud=:longitud, foto_perfil=:foto_perfil, usuario=:usuario,
                                             carta_presentacion=:presentacion WHERE dni=:dni");

        $stmt->bindParam(":tipo_usuario", $datos->tipo_usuario, PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datos->correo, PDO::PARAM_STR);
		$stmt->bindParam(":celular", $datos->celular, PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos->telefono, PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos->direccion, PDO::PARAM_STR);
        $stmt->bindParam(":latitud", $datos->latitud, PDO::PARAM_STR);
        $stmt->bindParam(":longitud", $datos->longitud, PDO::PARAM_STR);
        $stmt->bindParam(":foto_perfil", $datos->foto_perfil, PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos->usuario, PDO::PARAM_STR);
        $stmt->bindParam(":presentacion", $datos->presentacion, PDO::PARAM_STR);
        $stmt->bindParam(":dni", $datos->dni, PDO::PARAM_STR);
       

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
    }

    /*=============================================
	LLAMAR USUARIOS SESIÓN
	=============================================*/
    static public function consultaUserMDL($tabla, $dni){
        // $contrasena= base64_encode($pass);
         $sql = Conexion::conectar()->prepare("SELECT 
        u.id, 
        u.tipo_usuario, 
        t.tipo_usuario AS tipo, 
        u.nombres, 
        u.apellidos, 
        u.dni, 
        u.correo, 
        u.celular, 
        u.telefono, 
        u.direccion, 
        u.latitud, 
        u.longitud,
        u.foto_perfil, 
        u.usuario, 
        u.carta_presentacion, 
        u.estado 
        FROM $tabla u
        LEFT JOIN tipo_usuario t ON u.tipo_usuario = t.id
        WHERE u.dni = :dni");
 
         $sql -> bindParam(":dni",$dni, PDO::PARAM_STR);
 
         $sql ->execute();
 
         return $sql -> fetch(PDO::FETCH_ASSOC);
 
     }
 
     public static function newUserProfMDL($table, $data) {
        // Verificar si $data es un objeto, si no, intentar decodificarlo
        if (is_string($data)) {
            $data = json_decode($data);
        }
    
        // Verificar si la decodificación fue exitosa
        if (json_last_error() !== JSON_ERROR_NONE) {
            return "Error: Datos JSON inválidos";
        }
    
        if ($data->id == 0) {
            // Inserción
            $stmt = Conexion::conectar()->prepare("INSERT INTO $table (dni, nomServicio, descripcion, estado) 
            VALUES (:dni, :nomServicio, :descripcion, :estado)");
    
            $stmt->bindParam(":dni", $data->dni, PDO::PARAM_STR);
            $stmt->bindParam(":nomServicio", $data->nomServicio, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $data->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $data->estado, PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                return "1";
            } else {
                return "2";
            }
        } else {
            // Actualización
            $stmt = Conexion::conectar()->prepare("UPDATE $table SET dni = :dni, nomServicio = :nomServicio, descripcion = :descripcion, estado = :estado WHERE id = :id");
    
            $stmt->bindParam(":dni", $data->dni, PDO::PARAM_STR);
            $stmt->bindParam(":nomServicio", $data->nomServicio, PDO::PARAM_STR);
            $stmt->bindParam(":descripcion", $data->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":estado", $data->estado, PDO::PARAM_STR);
            $stmt->bindParam(":id", $data->id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return "3";
            } else {
                return "2";
            }
        }
    }

     /*=============================================
		CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function consultaUserSerMDL($tabla, $dni){
        // $contrasena= base64_encode($pass);
         $sql = Conexion::conectar()->prepare("  SELECT *FROM $tabla WHERE dni = :dni");
 
         $sql -> bindParam(":dni",$dni, PDO::PARAM_STR);
 
         $sql ->execute();
 
         return $sql -> fetchAll(PDO::FETCH_ASSOC);
 
     }
    /*=============================================
		CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function consultaOneUserSerMDL($tabla, $id){
        // $contrasena= base64_encode($pass);
         $sql = Conexion::conectar()->prepare("  SELECT *FROM $tabla WHERE id = :id");
 
         $sql -> bindParam(":id",$id, PDO::PARAM_STR);
 
         $sql ->execute();
 
         return $sql -> fetchAll(PDO::FETCH_ASSOC);
 
     }

    /*=============================================
		BUSQUEDA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function busquedaOneUserSerMDL($tablaUsuarios, $tablaServicios, $nomServicio){
        $sql = Conexion::conectar()->prepare("SELECT 
            nomServicio,
            (SELECT a.dni FROM $tablaUsuarios a WHERE a.dni = b.dni) AS dni,
            (SELECT a.nombres FROM $tablaUsuarios a WHERE a.dni = b.dni) AS nombres,
            (SELECT a.apellidos FROM $tablaUsuarios a WHERE a.dni = b.dni) AS apellidos,
            (SELECT a.celular FROM $tablaUsuarios a WHERE a.dni = b.dni) AS celular,
            (SELECT a.latitud FROM $tablaUsuarios a WHERE a.dni = b.dni) AS latitud,
            (SELECT a.longitud FROM $tablaUsuarios a WHERE a.dni = b.dni) AS longitud            
            FROM $tablaServicios b 
            WHERE nomServicio LIKE :nomServicio AND estado = 1
        ");
    
        $likeNomServicio = "%$nomServicio%";
        $sql->bindParam(":nomServicio", $likeNomServicio, PDO::PARAM_STR);
    
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
    /*=============================================
	BUSQUEDA SERVICIOS DEL USUARIO PARA LICITAR
	=============================================*/
    static public function busquedaOneUserSer($tablaUsuarios, $tablaServicios){
        $sql = Conexion::conectar()->prepare("SELECT nomServicio FROM $tablaServicios WHERE   estado = 1 group by nomServicio");
    
        $sql->execute();
    
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
/*================================================================================================================*/
/*================================================================================================================*/


    /*=============================================
	LLAMAR A TODOS LOS USUARIOS
	=============================================*/
    static public function allUserMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT usuario,
                                            (SELECT descripcion FROM tipos_usuarios WHERE id = tipo_usuario) AS tipo_usuario, 
                                            apellido, nombre, correo, clave,
                                            rclave, estado,fecha_creacion
                                            FROM $tabla WHERE estado = 1");

        $sql ->execute();

        return $sql -> fetchAll();
 

    }
    /*=============================================
    LLAMAR A TODOS LOS PREDEFINIDOS
    =============================================*/
    static public function allPredMDL($tabla){

        $sql = Conexion::conectar()->prepare("SELECT ID, DESCRIPCION FROM $tabla WHERE ACTIVO = 1");

        $sql ->execute();

        return $sql -> fetchAll();
 
    }

    /*=============================================
	LLAMAR USUARIOS PARA EDITAR
	=============================================*/
   static public function consultaUserEditMDL($tabla, $tablaTorre, $id){

        $sql = Conexion::conectar()->prepare("SELECT ID, USUARIO, TIPO_USUARIO, APELLIDO,
        NOMBRE, CORREO, TORRE, UNIDAD, ACTIVO, (SELECT DESCRIPCION FROM $tablaTorre WHERE CODIGO = TORRE)
        AS 'TORRES'  FROM $tabla WHERE USUARIO = :id");

        $sql -> bindParam(":id",$id, PDO::PARAM_STR);

        $sql ->execute();

        return $sql -> fetch();

    }

   /*=============================================
	LLAMAR PREDEFINIDOS
	=============================================*/
   static public function consultaPredefinidosMDL($tabla){

    $sql = Conexion::conectar()->prepare("SELECT *FROM $tabla");


    $sql ->execute();

    return $sql -> fetchAll();

}
    
    /*=============================================
	INSERTAR DETALLE DE REPORTE USUARIO
	=============================================*/
    static public function newUserReporteMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario, numMovil, descripcion, descripcionSolucion, 
                                               idPredef, descripcionQR, fecha, coords) VALUES (:idUsuario, :numMovil, 
                                               :descripcion, :descripcionSolucion, :idPredef, :descripcionQR, :fecha_crea, :coords)");

        $stmt->bindParam(":idUsuario", $datos->idUsuario, PDO::PARAM_STR);
        $stmt->bindParam(":numMovil", $datos->numMovil, PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":descripcionSolucion", $datos->descripcionSolucion, PDO::PARAM_STR);
        $stmt->bindParam(":idPredef", $datos->idPredef, PDO::PARAM_STR);
        $stmt->bindParam(":descripcionQR", $datos->descripcionQR, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_crea", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":coords", $datos->coords, PDO::PARAM_STR);
		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

    }
    /*=============================================
	LLAMAR ID REPORTE PARA FOTOS
	=============================================*/
    static public function consultaUserReporteMDL($tabla, $rut){

        $sql = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE idUsuario = :rut ORDER BY id DESC LIMIT 1");

        $sql -> bindParam(":rut",$rut, PDO::PARAM_STR);

        $sql ->execute();

        return $sql -> fetch();

    }

    /*=============================================
	 REGISTRO DE REPORTES DE SOLUCION FOTOS
	=============================================*/
    static public function consultaSolFotoMDL($tabla, $id){

        $sql = Conexion::conectar()->prepare("SELECT id FROM $tabla WHERE idUsuario = :id ORDER BY id DESC LIMIT 1");

        $sql -> bindParam(":id",$id, PDO::PARAM_STR);

        $sql ->execute();

        return $sql -> fetch();

    }
    /*=============================================
	INSERTAR FOTO DETALLE DE REPORTE USUARIO
	=============================================*/
    static public function reporteFotoMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idReporte, rutaFoto, fotoReporte, usuario_crea, fecha_crea) VALUES (:idReporte, :rutaFoto, :fotoReporte, :crea, :fecha_crea)");

        $stmt->bindParam(":idReporte", $datos->idReporte, PDO::PARAM_STR);
        $stmt->bindParam(":rutaFoto", $datos->rutaFoto, PDO::PARAM_STR);
        $stmt->bindParam(":fotoReporte", $datos->fotoReporte, PDO::PARAM_STR);
        $stmt->bindParam(":crea", $datos->usuario_crea, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_crea", $fecha, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

    }

    /*=============================================
	INSERTAR FOTO DETALLE DE SOLUCION USUARIO
	=============================================*/
    static public function solcionFotoMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idSolucion, rutaFoto, usuario_crea, fecha_crea) VALUES (:idSolucion, :rutaFoto, :crea, :fecha_crea)");

        $stmt->bindParam(":idSolucion", $datos->idSolucion, PDO::PARAM_STR);
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
	INSERTAR DETALLE DE REPORTE USUARIO SOLUCION
	=============================================*/
    static public function newUserSolucionMDL($tabla, $datos){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
        
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(idUsuario, idReporte, desde, hasta, descripcion, 
        fecha_crea, usuario_crea, coords) VALUES (:idUsuario, :reporte, :desde, :hasta, :descripcion, :fecha_crea, 
        :usuario_crea, :coords)");

        $stmt->bindParam(":idUsuario", $datos->usuario, PDO::PARAM_STR);
        $stmt->bindParam(":reporte", $datos->reporte, PDO::PARAM_STR);
        $stmt->bindParam(":desde", $datos->desde, PDO::PARAM_STR);
        $stmt->bindParam(":hasta", $datos->hasta, PDO::PARAM_STR);       
        $stmt->bindParam(":descripcion", $datos->descripcion, PDO::PARAM_STR);
        $stmt->bindParam(":fecha_crea", $fecha, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_crea", $datos->usuario_crea, PDO::PARAM_STR);
        $stmt->bindParam(":coords", $datos->coords, PDO::PARAM_STR);


		if($stmt->execute()){

           
            $stmt = Conexion::conectar()->prepare("UPDATE detalle_reporte SET solucionado = 1 WHERE id = :reporte");
            $stmt->bindParam(":reporte", $datos->reporte, PDO::PARAM_STR);
            $stmt->execute();
            return "1";
		}else{

			return "2";
		
		}

		
    }

    /*=============================================
	CONSULTA DE REPORTE PARA SOLUCIÓN
	=============================================*/
    static public function consultaReporteMDL($tabla, $rut){

        $sql = Conexion::conectar()->prepare("SELECT id, descripcion FROM $tabla WHERE idUsuario= :rut  AND solucionado!=1");
        $sql -> bindParam(":rut",$rut, PDO::PARAM_STR);

        $sql ->execute();

        return $sql -> fetchAll();

    }
    /*=============================================
	UPDATE USUARIO POS SESIÓN
	=============================================*/
    static public function consultaUserEditNotiMDL($tabla, $usser, $userId){
        date_default_timezone_set("America/Santiago");
        $fecha = date("Y-m-d G:i:s");
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET IDNOTIFICACION = '$userId' WHERE USUARIO='$usser'");

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}

		
		
    }
    /*=============================================
	LLAMAR USUARIOS SESIÓN
	=============================================*/
    static public function consultaUserNotMDL($tabla, $usuario){
        // $contrasena= base64_encode($pass);
         $sql = Conexion::conectar()->prepare("SELECT IDNOTIFICACION FROM $tabla WHERE USUARIO = :usser");
 
         $sql -> bindParam(":usser",$usuario, PDO::PARAM_STR);
 
         $sql ->execute();
 
         return $sql -> fetch();

     }

    /*=============================================
	UPADATE DETALLE SOLUCIÓN
	=============================================*/
    static public function updateSolucionMDL($tabla, $datos){
        
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET descripcion=:descripcion, desde=:desde, 
                                                hasta=:hasta WHERE id=:id");

            $stmt->bindParam(":descripcion", $datos->descripcion, PDO::PARAM_STR);
            $stmt->bindParam(":desde", $datos->desde, PDO::PARAM_STR);
            $stmt->bindParam(":hasta", $datos->hasta, PDO::PARAM_STR);
            $stmt->bindParam(":id", $datos->id, PDO::PARAM_STR);

		if($stmt->execute()){

			return "1";

		}else{

			return "2";
		
		}
		
    }

}