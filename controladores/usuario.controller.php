<?php

class ControladorPlantilla{
	/*=============================================
	INICIAR SESIÓN
	=============================================*/
    static public function iniciarSesion($dni, $pass){

    $tabla="usuarios";

    $respuesta = ModelSession::iniciarSesion($tabla, $dni, $pass);

    $array=json_encode($respuesta);
        
    echo $array;
    
    }
	/*=============================================
	INSERTAR USUARIO
	=============================================*/
    static public function newUser($userData){

        $tabla="usuarios";

        $respuesta = ModelSession::newUserMDL($tabla, $userData);
    
        echo $respuesta;

        
    }

    /*=============================================
	UPDATE USUARIO
	=============================================*/
    static public function updateUsePosSesionCTR($datos){

        $tabla="usuarios";

        $respuesta = ModelSession::updateUsePosSesionMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    
    /*=============================================
	CONSULTAR POR USUARIO
	=============================================*/
    static public function consultaUserCTR($dni){

        header('Content-type:application/json');
        $tabla = "usuarios";

        $respuesta = ModelSession::consultaUserMDL($tabla, $dni);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    
	/*=============================================
	INSERTAR PROFESIÓN
	=============================================*/
    static public function newUserProf($userData){

        $tabla="servicios";

        $respuesta = ModelSession::newUserProfMDL($tabla, $userData);
    
        echo $respuesta;

        
    }
    /*=============================================
	CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function consultaUserSerCTR($dni){

        header('Content-type:application/json');
        $tabla = "servicios";

        $respuesta = ModelSession::consultaUserSerMDL($tabla, $dni);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function consultaUserSerOneCTR($id){

        header('Content-type:application/json');
        $tabla = "servicios";

        $respuesta = ModelSession::consultaOneUserSerMDL($tabla, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	CONSULTA SERVICIOS DEL USUARIO 
	=============================================*/
    static public function busquedaOneUserSerMDL($nomServicio){

        header('Content-type:application/json');

        $tablaUsuarios= "usuarios"; 
        $tablaServicios = "servicios";


        $respuesta = ModelSession::busquedaOneUserSerMDL($tablaUsuarios, $tablaServicios, $nomServicio);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    
   /*=============================================
	BUSQUEDA SERVICIOS DEL USUARIO PARA LICITAR
	=============================================*/
    static public function busquedaOneUserSer(){

        header('Content-type:application/json');

        $tablaUsuarios= "usuarios"; 
        $tablaServicios = "servicios";


        $respuesta = ModelSession::busquedaOneUserSer($tablaUsuarios, $tablaServicios);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

/*================================================================================================================*/
/*================================================================================================================*/


    /*=============================================
    LLAMAR A TODOS LOS PREDEFINIDOS
    =============================================*/
    static public function allPredCTR(){

        header('Content-type:application/json');
        $tabla = "operaciones_predef";

        $respuesta = ModelSession::allPredMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }


    /*=============================================
	CONSULTAR POR USUARIO PARA EDICIÓN
	=============================================*/
    static public function consultaUserEditCTR($id){

        header('Content-type:application/json');
        $tabla = "usuarios";
        $tablaTorre= "torres";
        //$tablaTipo = "usuarios_tipos";

        $respuesta = ModelSession::consultaUserEditMDL($tabla, $tablaTorre, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	CONSULTAR PEDEFINIDOS
	=============================================*/
    static public function consultaPredefinidosCTR(){

        header('Content-type:application/json');
        $tabla = "predefindos";

        $respuesta = ModelSession::consultaPredefinidosMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    
    /*=============================================
	INSERTAR DETALLES DE REPORTE
	=============================================*/
    static public function newUseReporte($datos){

        $tabla="detalle_reporte";

        $respuesta = ModelSession::newUserReporteMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	INSERTAR FOTO DETALLES DE REPORTE
	=============================================*/
    static public function reporteFotoCTR($datos){

        $tabla="foto_reporte";

        $respuesta = ModelSession::reporteFotoMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	INSERTAR FOTO DETALLES DE SOLUCION
	=============================================*/
    static public function solucionFotoCTR($datos){

        $tabla="foto_solucion";

        $respuesta = ModelSession::solcionFotoMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	CONSULTAR ID DE REPORTE PARA FOTO
	=============================================*/
    static public function consultaUserReportCTR($rut){

        header('Content-type:application/json');
        $tabla = "detalle_reporte";

        $respuesta = ModelSession::consultaUserReporteMDL($tabla, $rut);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	CONSULTAR ID DE REPORTE PARA FOTO
	=============================================*/
    static public function consultaSolFotoCTR($id){

        header('Content-type:application/json');
        $tabla = "detalle_solucion";

        $respuesta = ModelSession::consultaSolFotoMDL($tabla, $id);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	INSERTAR DETALLES DE SOLUCION
	=============================================*/
    static public function newUseSolucion($datos){

        $tabla="detalle_solucion";

        $respuesta = ModelSession::newUserSolucionMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	CONSULTA DE REPORTE PARA SOLUCIÓN
	=============================================*/
    static public function consultaReporteCTR($rut){

        header('Content-type:application/json');
        $tabla = "detalle_reporte";

        $respuesta = ModelSession::consultaReporteMDL($tabla, $rut);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	CONSULTA DE REPORTE PARA SOLUCIÓN
	=============================================*/
    static public function consultaUserEditNotiCTR($usser, $userId){

        header('Content-type:application/json');
        $tabla = "usuarios";

        $respuesta = ModelSession::consultaUserEditNotiMDL($tabla, $usser, $userId);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	LLAMAR A TODOS LOS USUARIO DE NOTIFICACIONESS
	=============================================*/
    static public function allUserNotCTR(){

        $tabla = "usuarios";

        $respuesta = ModelSession::allUserMDL($tabla);
    
        return $respuesta;
    }
    /*=============================================
	CONSULTAR POR USUARIO NOTIFICACION
	=============================================*/
    static public function consultaUserNotCTR($rut){
        header('Content-type:application/json');
        $tabla = "usuarios";

        $respuesta = ModelSession::consultaUserNotMDL($tabla, $rut);
    
        //return ($respuesta);
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	UPADATE DETALLE SOLUCIÓN
	=============================================*/
    static public function updateSolucionesWeb($datos){

        $tabla="detalle_solucion";

        $respuesta = ModelSession::updateSolucionMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
}