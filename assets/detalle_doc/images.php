<?php

$data = ['result'=>false];
$target_path = time().'.pdf';

if (isset($_POST['file'])){

    $imageData = $_POST['file'];
    $imageData = str_replace('data:application/pdf;base64,','', $imageData);
    $imageData = str_replace('data:application/pdf;base64,','', $imageData);
    $imageData = str_replace(' ','+', $imageData);
    $imageData = base64_decode($imageData);

    file_put_contents($target_path, $imageData);

    $data['result'] = true;
    
    /* CASA */

    $host= $_SERVER["HTTP_HOST"];

    $data['image_url'] ='http://'.$host.'/omr_taller/omrbssservice/assets/detalle_doc/'.$target_path;
    /* INFOSITE */
   //$data['image_url'] = 'https://www.infositechile.cl/omrservice/assets/detalle_reporte/'.$target_path;

}


header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
echo json_encode($data);
//  echo $target_path;