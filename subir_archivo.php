<?php
include_once("libreria.php");
$data = json_decode(file_get_contents('php://input'), true);
$name = $data['nombre'];
echo "AAAA".$name;
	if (isset($_POST['nombre'])) {
		$nombre = $_POST['nombre'];
		$email = $_POST['email'];
		$url = $_POST['url'];
		$rector = $_POST['rector'];
		$logotipo= $_POST['logotipo'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$file_name = $_FILES['uni-logofile']['name'];
		echo "---->".$file_name;
    }else{
		//echo $_FILES['archivo']['tmp_name'];
		//$nombre = "lola.jpg";
		//subirArchivo($_FILES['archivo']['tmp_name'],$PATH."/imagenes",$nombre);
	}
?>