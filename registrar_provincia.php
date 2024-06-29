<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$pnombre = $datos['nombre'];
		$accion = $datos['accion'];
        $provincia = $datos['provincia'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			$consulta = "INSERT INTO tit_provincias(pais,nombre) VALUES (1,'$pnombre');";
			$mensaje= "registrada";
		}else{//para actualizar los datos del periodo
			$consulta = "UPDATE tit_provincias SET nombre='$pnombre' WHERE tit_provincias.id=$provincia;";
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		
		if ($conexionTemporal) {
			echo "provincia $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la provincia ";
		}
		mysqli_close($conexionTemporal);
    }
?>