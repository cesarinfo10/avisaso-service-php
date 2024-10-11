<?php
//header('Access-Control-Allow-Origin: *');

echo
$target_path = "https://www.infositechile.cl/omrservice/assets/detalle_video/";
 
$target_path = $target_path . basename( $_FILES['file']['name']);
 
if (move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    echo "Upload and move success";
} else {
echo $target_path;
  //  echo "There was an error uploading the file, please try again!";
}

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

// httpttps://www.infositechile.cl/omrservice/assets/detalle_video/There was an error uploading the file, please try again!
/*$data = ['result'=>false];
$target_path = time().'.mp4';

if (isset($_POST['file'])){

    var_dump($_POST['file']);
   /* $videoData = $_POST['file'];
    $videoData = str_replace('data:video/mp4;base64,','', $videoData);
    $videoData = str_replace('data:video/mp4;base64,','', $videoData);
    $videoData = str_replace(' ','+', $videoData);
    $videoData = base64_decode($videoData);

    file_put_contents($target_path, $videoData);

    $data['result'] = true;
    
    /* CASA */

  /*  $host= $_SERVER["HTTP_HOST"];

    //$data['image_url'] ='http://'.$host.'/omr_taller/omrbssservice/assets/detalle_video/'.$target_path;
    /* INFOSITE */
  /* $data['video_url'] = 'https://www.infositechile.cl/omrservice/assets/detalle_video/'.$target_path;

}


header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
//echo json_encode($data);
//  echo $target_path;