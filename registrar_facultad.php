<?PHP
	include_once("include.php");
    include_once("libreria.php");
	$datos = json_decode($_POST['data'], true);
	if (isset($_FILES['archivo']['tmp_name'])){
		$file_guardado = $_FILES['archivo']['tmp_name'];
		$fileName = $_FILES['archivo']['name'];
	}else{
		$file_guardado = "";
		$fileName = "";
	}
	if (isset($datos)) {
		$fnombre = $datos['nombre'];
        $fdecano = $datos['decano'];
		$accion = $datos['accion'];
        $facultad = $datos['facultad'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$caracteres = 'abcdefghijklmnopqrstuvwxyz';//base para general nombre aleatorio
		$nombreFoto = str_shuffle($caracteres);//nombre aletorio
		$Registros = $conexionTemporal->query("SELECT tit_universidades.id FROM tit_universidades WHERE tit_universidades.rector=$userid;");
		$Registro = $Registro=mysqli_fetch_array($Registros);
		$universidad = $Registro['id'];
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			//Para saber si la tabla de universidades está o no vacía
			$Registros = $conexionTemporal->query("SELECT count(*) as cantidad FROM tit_facultades;");
			$Registro = $Registro=mysqli_fetch_array($Registros);
			$cantidadUsuarios = $Registro['cantidad'];
			if ($cantidadUsuarios >0) {//Averiguo su ID para luego general el nombre del logotipo
				$Registros = $conexionTemporal->query("SELECT MAX(id) + 1 AS id_nuevo_registro FROM tit_facultades");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$id_nuevo_registro = $Registro['id_nuevo_registro'];
			}else{
				$conexionTemporal->query("TRUNCATE TABLE tit_facultades");
				$id_nuevo_registro = 1;
			}
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				$nombreFoto = $nombreFoto."_".$id_nuevo_registro.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
				$consulta = "INSERT INTO tit_facultades(nombre,decano,universidad,logotipo) VALUES ('$fnombre','$fdecano',$universidad,'$nombreFoto');";
			}else{
				$consulta = "INSERT INTO tit_facultades(nombre,decano,universidad) VALUES ('$fnombre','$fdecano',$universidad);";
			}
			if ($fdecano > 1){ //Para insertar el rector en la tabla de asiganaciones
				$consulta1 = "UPDATE tit_asignaciones SET valor=$universidad WHERE usuario=$fdecano";
			}
			
			$mensaje= "registrada";
		}else{//para actualizar los datos de la facultad
			//Para determinar el nombre del archivo que corresponde al logotipo de la facultad
			$consulta = "SELECT tit_facultades.logotipo FROM tit_facultades WHERE tit_facultades.id=$facultad;";
			$Registros = $conexionTemporal->query($consulta);
			$Registro = mysqli_fetch_array($Registros);
			$logoViejo =$Registro['logotipo']; //Nombre del logotipo Viejo
			$nombreFoto= $nombreFoto."_".$usuario.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				unlink('imagenes/'.$logoViejo); //Borrar foto vieja
				$consulta = "UPDATE tit_facultades SET nombre='$fnombre',decano=$fdecano,logotipo='$nombreFoto' WHERE tit_facultades.id=$facultad;";
			}else{
				$consulta = "UPDATE tit_facultades SET nombre='$fnombre',decano=$fdecano WHERE tit_facultades.id=$facultad;";
			}
			if ($fdecano > 1){ //Para insertar el rector en la tabla de asiganaciones
				$consulta1 = "UPDATE tit_asignaciones SET valor=$universidad WHERE usuario=$fdecano";
			}
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Registrar  o actualizar la facultad
		$conexionTemporal->query($consulta1); //Asignarle decano a la facultad en la tabla de asignaciones
		if ($conexionTemporal) {
			echo $consulta;
			if ($file_guardado != "") {
				echo "Voy a guardar";
				subirArchivo($file_guardado,$PATH."/imagenes/",$nombreFoto);
			}
			echo "Facultad $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la facultad ";
		}
		mysqli_close($conexionTemporal);
    }
?>