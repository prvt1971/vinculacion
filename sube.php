<?php 
require_once("formularios/include.php");

$nombre=$_FILES['logofile']['name'];
$guardado=$_FILES['logofile']['tmp_name'];
$unombre=$POST['nombre'];
$uemail=$POST['email'];
$uURL=$POST['url'];

subirArchivo($guardado,$W3DIRECTORY."/titulacion_imagenes/",$nombre);

?>