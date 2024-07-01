<?PHP // Solo para probar
	include_once("include.php");
    include_once("libreria.php");
	$mensaje= "Desactivado";
	$datos = json_decode($_POST['data'], true);
	if (isset($datos)) {
		$uid = $datos['usuario'];
		$ucodigo = $datos['codigo'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$Registros = $conexionTemporal->query("SELECT tit_usuarios.id FROM tit_usuarios INNER JOIN tit_codigostemporales ON tit_codigostemporales.usuario=tit_usuarios.id WHERE tit_usuarios.id=$uid AND tit_codigostemporales.codigo='$ucodigo';");
		$cantidRegistros = mysqli_num_rows($Registros);
		if ($cantidRegistros >0 ) { //Para saber si existe un usuario registrado y al cual se le haya asignado ese codigo de activacion
			$consulta = "UPDATE tit_usuarios SET tit_usuarios.confirmado=1 WHERE tit_usuarios.id=$uid";
			if ($conexionTemporal->query($consulta)){
				$consulta = "DELETE FROM tit_codigostemporales WHERE tit_codigostemporales.usuario=$uid";
				$conexionTemporal->query($consulta);//Borrar el registro q corresponde al c'odigo temporal
				$mensaje= "Activado";
			}
		}else{
	
		}
		mysqli_close($conexionTemporal);
		$Resultados[] = array($mensaje);
	 
	 $DatoEnviar = json_encode($Resultados);
	 echo $DatoEnviar;
    }
?>