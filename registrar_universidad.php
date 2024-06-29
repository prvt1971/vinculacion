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
		$unombre = $datos['nombre'];
		$uemail = $datos['email'];
		$uurl = $datos['url'];
		$urector = $datos['rector'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$accion = $datos['accion'];
		$universidad = $datos['universidad'];
		$conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$caracteres = 'abcdefghijklmnopqrstuvwxyz';//base para general nombre aleatorio
		$nombre = str_shuffle($caracteres);//nombre aletorio
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			//Para saber si la tabla de universidades está o no vacía
			$Registros = $conexionTemporal->query("SELECT count(*) as cantidad FROM tit_universidades;");
			$Registro = $Registro=mysqli_fetch_array($Registros);
			$cantidadUniversidades = $Registro['cantidad'];
			if ($cantidadUniversidades >0) {//Averiguo su ID para luego general el nombre del logotipo
				$Registros = $conexionTemporal->query("SELECT MAX(id) + 1 AS id_nuevo_registro FROM tit_universidades");
				$Registro = mysqli_fetch_array($Registros);
				$id_nuevo_registro = $Registro['id_nuevo_registro'];
			}else{
				$conexionTemporal->query("TRUNCATE TABLE tit_universidades");
				$id_nuevo_registro = 1;
			}
			
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				$nombre = $nombre."_".$id_nuevo_registro.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
				$consulta = "INSERT INTO tit_universidades(nombre,email,urll,rector,logotipo) VALUES ('$unombre','$uemail','$uurl',$urector,'$nombre');";
			}else{
				$consulta = "INSERT INTO tit_universidades(nombre,email,urll,rector) VALUES ('$unombre','$uemail','$uurl',$urector);";
			}
			if ($urector > 1){ //Para insertar el rector en la tabla de asiganaciones
				$consulta1 = "UPDATE tit_asignaciones SET valor=$id_nuevo_registro WHERE usuario=$urector";
			}	
			$mensaje= "registrada";
		}else{//para actualizar los datos de la universidad
			//Para determinar el nombre del archivo que corresponde al logotipo de la universidad
			$consulta = "SELECT tit_universidades.logotipo FROM tit_universidades WHERE tit_universidades.id=$universidad;";
			$Registros = $conexionTemporal->query($consulta);
			$Registro = mysqli_fetch_array($Registros);
			$logoViejo =$Registro['logotipo']; //Nombre del logotipo Viejo
			$nombre= $nombre."_".$universidad.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				unlink('imagenes/'.$logoViejo); //Borrar el logoViejo
				$consulta = "UPDATE tit_universidades SET nombre='$unombre',email='$uemail',urll='$uurl',rector=$urector,logotipo='$nombre' WHERE tit_universidades.id=$universidad;";
			}else{
				$consulta = "UPDATE tit_universidades SET nombre='$unombre',email='$uemail',urll='$uurl',rector=$urector WHERE tit_universidades.id=$universidad;";
			}
			if ($urector > 1){ //Para insertar el rector en la tabla de asiganaciones
				$consulta2 = "UPDATE tit_asignaciones SET valor=0 WHERE valor=$universidad and rol=2";
				$conexionTemporal->query($consulta2);//Para quitar el rol de rector al rector
				$consulta1 = "UPDATE tit_asignaciones SET valor=$universidad WHERE usuario=$urector";
			}
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); 
		$conexionTemporal->query($consulta1);
		if ($conexionTemporal) {
			echo "Hay conexión";
			if ($file_guardado != "") {
				echo "Voy a guardar";
				subirArchivo($file_guardado,$PATH."/imagenes",$nombre);
			}
			echo "Universidad $mensaje correctamente";
		}else{
			echo "Problemas al $mensaje la universidad";
		}
		mysqli_close($conexionTemporal);
    }

?>