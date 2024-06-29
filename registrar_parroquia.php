<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$pnombre = $datos['nombre'];
		$pcanton = $datos['canton'];
		$accion = $datos['accion'];
        $parroquia = $datos['parroquia'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			$consulta = "INSERT INTO tit_parroquias(canton,nombre) VALUES ($pcanton,'$pnombre');";
			$mensaje= "registrada";
		}else{//para actualizar los datos del cantón
			$consulta = "UPDATE tit_parroquias SET nombre='$pnombre',canton=$pcanton WHERE tit_parroquias.id=$parroquia;";
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		
		if ($conexionTemporal) {
			echo "parroquia $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la parroquia ";
		}
		mysqli_close($conexionTemporal);
    }
?>