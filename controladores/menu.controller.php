<?php

class ControladorMenu{
    /*=============================================
	LLAMAR A TODOS LOS MENU
	=============================================*/
    static public function allMenuCTR($menu){

        header('Content-type:application/json');
        
        $tabla = "menu_app";

        $tablaPermiso = "permisos";

        $respuesta = ModelServicios::allMenuMDL($tabla, $tablaPermiso, $menu);
    
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
        $tablaTorre = "torres";
        $tablaFoto = "foto_reporte";

        $respuesta = ModelServicios::oneServiciosMDL($idReporte, $tablaCliente, $tabla, $tablaTorre, $tablaFoto);
    
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
    static public function allSolucionCTR(){

        header('Content-type:application/json');
        
        $tablaCliente = "usuarios";
        $tabla = "detalle_solucion";
        $tablaFoto = "foto_solucion";

        $respuesta = ModelServicios::allallSolucionMDL($tablaCliente, $tabla, $tablaFoto);
    
        $array=json_encode($respuesta);
        
        echo $array;
    }
} 