<?PHP
	include_once("include.php");
    include_once("libreria.php");
	if (isset($_POST['userid'])) {
		$userid = $_POST['userid'];
		$codigo = generaCodigo();
		$asunto = "Codigo de confirmacion";
		$mensaje = "Su codigo de confirmacion es: " . $codigo;
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		echo "SELECT tit_usuarios.email as email FROM tit_usuarios WHERE tit_usuarios.id=$userid;";
		$Registros = $conexionTemporal->query("SELECT tit_usuarios.email as email FROM tit_usuarios WHERE tit_usuarios.id=$userid;");
		$cantidRegistros = mysqli_num_rows($Registros);
		if ($cantidRegistros >0 ) { //Para saber si existe un usuario registrado y al cual se le haya asignado ese codigo de activacion
			$Registro = $Registro=mysqli_fetch_array($Registros);
			$email = $Registro['email'];
			enviarcorreo($email,$asunto,$mensaje,"");
		}
		//Para eliminar el codigotemporal viejo
		$conexionTemporal->query("DELETE FROM tit_codigostemporales WHERE tit_codigostemporales.usuario=$userid;");
		//Para insertar el nuevo codigotemporal
		$conexionTemporal->query("INSERT INTO tit_codigostemporales(usuario,codigo,fecha) VALUES($userid,'$codigo',CURRENT_TIME());");
	 	echo "Enviado";
    }
?>