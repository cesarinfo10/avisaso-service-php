<?php

require_once "../controladores/datos.movil.controller.php";

require_once "../modelos/datos.movi.model.php";

header("Access-Control-Allow-Origin: *");
ob_end_flush();

// URL http://localhost/omr/omrservice/servicios/datos_movil.php?addDatos
/*=============================================
INSERTAR DATOS GENERALES
=============================================*/
if (isset($_GET['addDatosMovil'])){    

header('Content-type: application/json');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$datos = ($request);
//$datos = json_encode($request);
 $addDatosMovil= new ControladorDatosMovil();
 $addDatosMovil->newDatosMovilCRL($datos);
    
}

/*=============================================
LLAMAR A UN DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos_movil.php?id=1&getAllDatosMovilId
if (isset($_GET['getAllDatosMovilId'])){

    $id= $_GET['id'];

    $oneDatosMovil= new ControladorDatosMovil();
    $oneDatosMovil->oneDatosMovilCTR($id);
    }
/*=============================================
LLAMAR TODOS LOS DATOS MÓVIL
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos_movil.php?getAllDatosMovil
if (isset($_GET['getAllDatosMovil'])){

    $datosMovil= new ControladorDatosMovil();
    $datosMovil->AllDatosMovilCTR();
    
    }

/*=============================================
UPADATE USUARIO POS SESION
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos_movil.php?updateDatos
if (isset($_GET['updateDatos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updateDatosMovil= new ControladorDatosMovil();
    $updateDatosMovil->updateDatosCTR($datos);       
}

/*=============================================
DELETE UN DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos_movil.php?id=1&deleteDatosMovil
if (isset($_GET['deleteDatosMovil'])){

    $id= $_GET['id'];

    $oneDatosGralDelete= new ControladorDatosMovil();
    $oneDatosGralDelete->deleteDatosCTR($id);
    }

/*==========================================================================================*/

