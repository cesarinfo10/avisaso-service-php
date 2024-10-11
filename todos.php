<?php
require_once "controladores/usuario.controller.php";

require_once "modelos/usuario.model.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"  crossorigin="anonymous">
    <title>Notificaciones</title>
    
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#"> <img class="logo" src="assets/logo-icon.png" height="40"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar1">
    <ul class="navbar-nav ml-auto"> 
<li class="nav-item">
<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
</li>
<li class="nav-item"><a class="nav-link" href="index.php"> Notificación por usuario </a></li>
<li class="nav-item active"><a class="nav-link" href="todos.php"> Notificar a todos </a></li>
    </ul>
  </div>
</nav>
<div class="container"> 
<div class="col-md-12">
<div class="panel panel-primary p-3">
  <div class="panel-heading">
    <h3 class="panel-title">Notificación General</h3>
  </div>
  <div class="panel-body">
<form>
  <div class="form-row">

    <div class="form-group col-md-6">
      <label for="inputPassword4">Titulo</label>
      <input type="text" class="form-control" id="tituloGral">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Mensaje</label>
    <textarea class="form-control" id="mensajeGral" rows="3"></textarea>
  </div>
  </div>
  <button type="button" class="btn btn-primary" onclick="guardarNotificacionGral();">Enviar Notificaciones</button>
</form>
</div>
  </div>
</div>
<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="js/js.js"></script>
</body>
</html>
