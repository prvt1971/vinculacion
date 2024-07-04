<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$pnombrelargo = $datos['nombrelargo'];
        $pnombrecorto = $datos['nombrecorto'];
		$pinicia = $datos['inicia'];
        $ptermina = $datos['termina'];
		$accion = $datos['accion'];
        $periodo = $datos['periodo'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$Registros = $conexionTemporal->query("SELECT tit_universidades.id FROM tit_universidades WHERE tit_universidades.rector=$userid;");
		$Registro = mysqli_fetch_array($Registros);
		$puniversidad = $Registro['id'];
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			$consulta = "INSERT INTO tit_periodos(titulo_largo,titulo_corto,inicia,termina,universidad) VALUES ('$pnombrelargo','$pnombrecorto','$pinicia','$ptermina',$puniversidad);";
			$mensaje= "registrada";
		}else{//para actualizar los datos del periodo
			$consulta = "UPDATE tit_periodos SET titulo_largo='$pnombrelargo',titulo_corto='$pnombrecorto',inicia='$pinicia',termina='$ptermina' WHERE tit_periodos.id=$periodo;";
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		$conexionTemporal->query($consulta1); //Para insertar en la tabla de asignaciines
		if ($conexionTemporal) {
			echo $consulta;
			if ($file_guardado != "") {
				echo "Voy a guardar";
				subirArchivo($file_guardado,$PATH."/imagenes/",$nombreFoto);
			}
			echo "carrera $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la carrera ";
		}
		mysqli_close($conexionTemporal);
    }
?>