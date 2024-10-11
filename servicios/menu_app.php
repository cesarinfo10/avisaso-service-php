<?php
ob_start();
require_once "../controladores/menu.controller.php";

require_once "../modelos/menu.model.php";

if (isset( $_GET['menu'])){

    $menu= $_GET['menu'];
    
    }

    if (isset( $_GET['idSolucion'])){

        $idSolucion= $_GET['idSolucion'];
        
    }

//URL http://localhost/appcondominio/servicios/menu_app.php?menu=ADMINISTRADOR&getAllMen
/*=============================================
LLAMAR A TODOS LOS USUARIOS
=============================================*/
if (isset($_GET['getAllMenu'])){

   $alltipouser= new ControladorMenu();
   $alltipouser->allMenuCTR($menu);
   
   }
//URL http://localhost/appcondominio/servicios/servicios.php?getAllServicios
/*=============================================
LLAMAR A UN REPORTE
=============================================*/
if (isset($_GET['getOneServicios'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneServiciosCTR($idReporte);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?getOneSolucion
/*=============================================
LLAMAR A UNA SOLUCION
=============================================*/
if (isset($_GET['getOneSolucion'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneSolucionCTR($idReporte);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?idReporte=7&getOneServiciosFotos
/*=============================================
LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
=============================================*/
if (isset($_GET['getOneServiciosFotos'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->oneServiciosFotoCTR($idReporte);
    
    }
//URL http://localhost/appcondominio/servicios/servicios.php?idSolucion=7&getOneSolucionFotos
/*=============================================
LLAMAR A TODAS LAS FOTOS DE REPORTE POR USUARIO
=============================================*/
if (isset($_GET['getOneSolucionFotos'])){

    $fotosolucion= new ControladorServicios();
    $fotosolucion->oneSolucionFotoCTR($idSolucion);
    
    }

//URL http://localhost/appcondominio/servicios/servicios.php?getAllSolucion
/*=============================================
LLAMAR A UN REPORTE
=============================================*/
if (isset($_GET['getAllSolucion'])){

    $alltipouser= new ControladorServicios();
    $alltipouser->allSolucionCTR();
    
    }

    header("Access-Control-Allow-Origin: *");
    ob_end_flush();