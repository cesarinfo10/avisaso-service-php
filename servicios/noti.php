<?php
ob_start();
require_once "../controladores/notificaciones.controller.php";
require_once "../controladores/notificacionesgral.controller.php";
require_once "../modelos/conexion.php";
//URL http://localhost/appcondominio/servicios/noti.php?noti
/*=============================================
LLAMAR A TODAS LAS RODAS HECHAS
=============================================*/
if (isset($_GET['noti'])){ 
     $usuarioRut = $_POST['usuarioRut'];
     $include_player_ids = $_POST['include_player_ids'];
     $titulo = $_POST['titulo'];
     $mensaje = $_POST['mensaje'];
 
     $usuarioRut = $usuarioRut;
	$response = sendMessage($usuarioRut, $include_player_ids, $titulo, $mensaje);
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
     print("\n");

     $addNot= new NotificacionesController();
     $addNot->addNotificacion($usuarioRut, $include_player_ids, $titulo, $mensaje);
    
    }
//URL http://localhost/appcondominio/servicios/noti.php?notiGral
/*=============================================
LLAMAR A TODAS LAS RODAS HECHAS
=============================================*/
if (isset($_GET['notiGral'])){ 
     $tituloGral = $_POST['tituloGral'];
     $mensajeGral = $_POST['mensajeGral'];

	$response = sendMessageGral($tituloGral, $mensajeGral);
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
     print("\n");

     $addNot= new NotificacionesController();
     $addNot->addNotificacionGral($tituloGral, $mensajeGral);
    
    }
//URL http://localhost/appcondominio/servicios/noti.php?usuarioRut=1-9&include_player_ids=abcd&titulo=titulo&mensaje=mensaje&idReporte=11&noti_auto
/*=============================================
NOTIFICACIONES AUTOMATICAS
=============================================*/
if (isset($_GET['noti_auto'])){ 
   
     if (isset( $_GET['idReporte'])){

          $idReporte = $_GET['idReporte'];
          $sql = Conexion::conectar()->prepare("SELECT descripcion, idCliente FROM detalle_reporte WHERE id= $idReporte");
          $sql ->execute();
          $reporte = $sql -> fetch();
          $mensaje = $_GET['mensaje']. ' '.$reporte[0];
          $usuarioRut = $reporte[1];
          }else{
               $mensaje = $_GET['mensaje'];
               $usuarioRut = $_GET['usser'];  
          }

     $include_player_ids = $_GET['include_player_ids'];
     $titulo = $_GET['titulo'];
     

	$response = sendMessage($usuarioRut, $include_player_ids, $titulo, $mensaje);
	$return["allresponses"] = $response;
	$return = json_encode( $return);
	
	print("\n\nJSON received:\n");
	print($return);
     print("\n");
    }

   header('Content-type: application/json');
   header("Access-Control-Allow-Origin: *");
   ob_end_flush();