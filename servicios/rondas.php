<?php
ob_start();
require_once "../controladores/rondas.controller.php";

require_once "../modelos/rondas.model.php";

if (isset( $_GET['usuario'])){

    $usuario= $_GET['usuario'];
    
    }

    if (isset( $_GET['punto'])){

        $punto= $_GET['punto'];
        
    }

//URL http://localhost/appcondominio/servicios/rondas.php?usuario=1-9&getPuntosRondas
/*=============================================
LLAMAR A TODAS LAS RODAS
=============================================*/
if (isset($_GET['getPuntosRondas'])){ 
    date_default_timezone_set("America/Santiago");
    $fecha = date('Y-m-d');

    $fotosolucion= new ControladorRondas();
    $fotosolucion->consultaPuntosCTR($usuario, $fecha);
    
    }
//URL http://localhost/appcondominio/servicios/rondas.php?usuario=1-9&punto=1&getMarcarPuntos
/*=============================================
MARCAR PUNTOS
=============================================*/
if (isset($_GET['getMarcarPuntos'])){ 
    date_default_timezone_set("America/Santiago");
    $hora = date('H:i:s');
    $fecha = date('Y-m-d');

    $marcarpunto= new ControladorRondas();
    $marcarpunto->MarcarPuntosCTR($punto, $fecha, $hora, $usuario);
    
    }
//URL http://localhost/appcondominio/servicios/rondas.php?usuario=1-9&getPuntosRondasHechas
/*=============================================
LLAMAR A TODAS LAS RODAS HECHAS
=============================================*/
if (isset($_GET['getPuntosRondasHechas'])){ 
    date_default_timezone_set("America/Santiago");
    $fecha = date('Y-m-d');

    $fotosolucion= new ControladorRondas();
    $fotosolucion->consultaPuntosHechosCTR($usuario, $fecha);
    
    }
   header('Content-type: application/json');
   header("Access-Control-Allow-Origin: *");
   ob_end_flush();