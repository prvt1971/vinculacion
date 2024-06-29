<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$cnombre = $datos['nombre'];
		$cparroquia = $datos['parroquia'];
		$accion = $datos['accion'];
        $comunidad = $datos['comunidad'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			$consulta = "INSERT INTO tit_comunidades(parroquia,nombre) VALUES ($cparroquia,'$cnombre');";
			$mensaje= "registrada";
		}else{//para actualizar los datos del cantón
			$consulta = "UPDATE tit_comunidades SET nombre='$cnombre',parroquia=$cparroquia WHERE tit_comunidades.id=$comunidad;";
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		
		if ($conexionTemporal) {
			echo "comunidad $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la comunidad ";
		}
		mysqli_close($conexionTemporal);
    }
?>