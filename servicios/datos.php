<?php

require_once "../controladores/datos.controller.php";

require_once "../modelos/datos.model.php";

// URL http://localhost/omr/omrservice/servicios/datos.php?addDatos
/*=============================================
INSERTAR DATOS GENERALES
=============================================*/
if (isset($_GET['addDatos'])){    

header('Content-type: application/json');
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$datos = ($request);
//$datos = json_encode($request);
 $addDatosGral= new ControladorDatos();
 $addDatosGral->newDatosGraCRL($datos);
    
}

/*=============================================
LLAMAR A UN DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?id=1&getOneDatosGral
if (isset($_GET['getOneDatosGral'])){

    $id= $_GET['id'];

    $oneDatosGral= new ControladorDatos();
    $oneDatosGral->oneDatosGralCTR($id);
    }
/*=============================================
LLAMAR TODOS LOS DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?getAllDatos
if (isset($_GET['getAllDatos'])){

    $oneDatosGral= new ControladorDatos();
    $oneDatosGral->AllDatosCTR();
    
    }

/*=============================================
UPADATE USUARIO POS SESION
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?updateDatos
if (isset($_GET['updateDatos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);

    $updateDatosGral= new ControladorDatos();
    $updateDatosGral->updateDatosCTR($datos);       
}

/*=============================================
DELETE UN DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?id=1&deleteDatos
if (isset($_GET['deleteDatosGral'])){

    $id= $_GET['id'];

    $oneDatosGralDelete= new ControladorDatos();
    $oneDatosGralDelete->deleteDatosCTR($id);
    }

/*==========================================================================================*/

/*=============================================
LLAMAR TODOS LOS DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?getAllDatosMovil
if (isset($_GET['getAllDatosMovil'])){

    $datosMovil= new ControladorDatos();
    $datosMovil->AllDatosMovilCTR();
    
}
/*=============================================
LLAMAR TODOS LOS DATOS
=============================================*/
// URL http://localhost/omr/omrservice/servicios/datos.php?id=1&getAllDatosMovilId
 if (isset($_GET['getAllDatosMovilId'])){

    $id= $_GET['id'];
    
    $oneDatosMovil= new ControladorDatos();
    $oneDatosMovil->DatosMovilIDCTR($id);
}
header("Access-Control-Allow-Origin: *");
ob_end_flush();