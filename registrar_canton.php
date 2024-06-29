<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$cnombre = $datos['nombre'];
		$cprovincia = $datos['provincia'];
		$accion = $datos['accion'];
        $canton = $datos['canton'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			$consulta = "INSERT INTO tit_cantones(provincia,nombre) VALUES ($cprovincia,'$cnombre');";
			$mensaje= "registrado";
		}else{//para actualizar los datos del cantón
			$consulta = "UPDATE tit_cantones SET nombre='$cnombre',provincia=$cprovincia WHERE tit_cantones.id=$canton;";
			$mensaje= "actualizado";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		
		if ($conexionTemporal) {
			echo "cantón $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje el cantón ";
		}
		mysqli_close($conexionTemporal);
    }
?>