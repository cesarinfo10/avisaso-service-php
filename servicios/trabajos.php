<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

ob_start();
require_once "../controladores/trabajos.controller.php";

require_once "../modelos/trabajos.model.php";


//URL http://localhost/appcondominio/servicios/rondas.php?usuario=1-9&getPuntosRondas
/*=============================================
AGREGAR TRABAJO
=============================================*/
if (isset($_GET['addTrabajos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //var_dump($datos);
    $addTrabajos= new ControladorTrabajos();
    $addTrabajos->addTrabajosCTR($datos);
}

/*=============================================
AGREGAR FOTOS
=============================================*/
if (isset($_GET['addFotosTrabajos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //var_dump($datos);
    $addFotosTrabajos= new ControladorTrabajos();
    $addFotosTrabajos->addFotosTrabajosCTR($datos);
}
/*=============================================
EDITAR  FOTOS
=============================================*/
if (isset($_GET['EditFotosTrabajos'])){
    
    header('Content-type: application/json');
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $datos = ($request);
    //var_dump($datos);
    $addFotosTrabajos= new ControladorTrabajos();
    $addFotosTrabajos->editFotosTrabajosCTR($datos);
}

/*=============================================
DELETE UN FOTOS
=============================================*/
if (isset($_GET['DeleteFotosTrabajos'])){

    $id= $_GET['id'];

    $oneDatosGralDelete= new ControladorTrabajos();
    $oneDatosGralDelete->deleteFotosCTR($id);
    }

/*=============================================
CONSULTAR TRABAJOS Y FOTOS POR USUARIO
=============================================*/
if (isset($_GET['consultaFotosTrabajos'])){

    $dni= $_GET['dni'];

    $consultaFotosTrabajos= new ControladorTrabajos();
    $consultaFotosTrabajos->consultaFotosTrabajosCTR($dni);
    }

/*=============================================
DELETE UN FOTOS Y UN TRABAJO
=============================================*/
if (isset($_GET['DeleteFotosYTrabajos'])){

    $id= $_GET['id'];

    $oneDatosGralDelete= new ControladorTrabajos();
    $oneDatosGralDelete->deleteFotosJobCTR($id);
    }
