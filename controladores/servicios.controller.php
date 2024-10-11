<?php

class ControladorServicios{


    /*=============================================
	UPDATE REPORTE DESDE LA WEB
	=============================================*/
    static public function addServicioCTR($datos){

        $tabla="licitar";

        $respuesta = ModelServicios::addServicioMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
	LLAMAR A TODAS LAS LICITAIONES POR  SERVICIO
	=============================================*/
    static public function alllLicitaionesCTR($dni_usuario_licita){

        header('Content-type:application/json');

        $tabla = "licitar";

        $respuesta = ModelServicios::alllLicitaionesMDL($tabla, $dni_usuario_licita);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }



    
/*================================================================================================================*/
/*================================================================================================================*/
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIO
	=============================================*/
    static public function todosServiciosCTR($usser){

        header('Content-type:application/json');
        
        $usuario = "usuarios";
        $tabla = "detalle_reporte";
        $tablaFoto = "foto_reporte";

        $respuesta = ModelServicios::todosServiciosMDL($usuario, $tabla, $tablaFoto, $usser);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*====================================================
	LLAMAR A TODOS LOS REPORTES SIN SOLUCION TIPO USUARIOS
	=====================================================*/
    static public function allSinSolucionServiciosCTR($usser){

        header('Content-type:application/json');
        
        $usuario = "usuarios";
        $tabla = "detalle_reporte";
        $tablaFoto = "foto_reporte";

        $respuesta = ModelServicios::allSinSolucionServiciosMDL($usuario, $tabla, $tablaFoto, $usser);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIO
	=============================================*/
    static public function oneServiciosCTR($idReporte){

        header('Content-type:application/json');
        
        $tablaCliente = "usuarios";
        $tabla = "detalle_reporte";
        $tablaFoto = "foto_reporte";

        $respuesta = ModelServicios::oneServiciosMDL($idReporte, $tablaCliente, $tabla, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	LLAMAR A UNA SOLUCION
	=============================================*/
    static public function oneSolucionCTR($idSolucion){

        header('Content-type:application/json');
        
        $tablaCliente = "usuarios";
        $tabla = "detalle_solucion";
        $tablaFoto = "foto_solucion";

        $respuesta = ModelServicios::oneSolucionMDL($idSolucion, $tablaCliente, $tabla, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
	=============================================*/
    static public function oneServiciosFotoCTR($idReporte){

        header('Content-type:application/json');

        $tablaFoto = "foto_reporte";

        $respuesta = ModelServicios::oneServiciosFotodMDL($idReporte, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    
    /*=============================================
	CONSULTA ALBUM  DE SOLUCION POR USUARIO
	=============================================*/
    static public function oneSolucionFotoCTR($idSolucion){

        header('Content-type:application/json');

        $tablaFoto = "foto_solucion";

        $respuesta = ModelServicios::oneSolucionFotodMDL($idSolucion, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
    /*=============================================
	LLAMAR A TODOS LOS TIPO USUARIO
	=============================================*/
    static public function allSolucionCTR($user){

        header('Content-type:application/json');
        
        $usuarios = "usuarios";
        $tabla = "detalle_solucion";
        $tablaFoto = "foto_solucion";

        $respuesta = ModelServicios::allallSolucionMDL($usuarios, $tabla, $tablaFoto, $user);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	LLAMAR A TODOS ESTADOS DATOS
	=============================================*/
    static public function allallEstadoDatoCTR(){

        header('Content-type:application/json');
        
        $tabla = "estado_datos";

        $respuesta = ModelServicios::allEstadoDatoMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
   /*=============================================
	LLAMAR A TODOS TIPO DATOS
	=============================================*/
    static public function allallTipoDatoCTR(){

        header('Content-type:application/json');
        
        $tabla = "tipo_movil";

        $respuesta = ModelServicios::allTipoDatoMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
    LLAMAR TODOS LOS MODELO MARCA DATOS
    =============================================*/
    static public function allaMMDCTR(){

        header('Content-type:application/json');
        
        $tabla = "modelo_marca";

        $respuesta = ModelServicios::allMMDMDL($tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	UPDATE REPORTE DESDE LA WEB
	=============================================*/
    static public function updateReporteCTR($datos){

        $tabla="detalle_reporte";

        $respuesta = ModelServicios::updateReporteMDL($tabla, $datos);
    
        echo $respuesta;

        
    }
    /*=============================================
	INSERTAR FOTO DETALLES DE REPORTE
	=============================================*/
    static public function docPDFCTR($datos){

        $tabla="tbl_docs";

         $respuesta = ModelServicios::docPDFMDL($tabla, $datos);
    
        echo $respuesta;

        
    }

    /*=============================================
    LLAMAR TODOS LOS DOCUMENTOS
    =============================================*/
    static public function allDocCTR(){

        header('Content-type:application/json');
        
        $tabla = "tbl_docs";
        $usuario = "usuarios";

        $respuesta = ModelServicios::allDocnMDL($tabla, $usuario);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }

    /*=============================================
	CONSULTA UN DOCUMENTO
	=============================================*/
    static public function oneDocument($id){

        header('Content-type:application/json');

        $tabla = "tbl_docs";

        $respuesta = ModelServicios::oneDocMDL($id, $tabla);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
}