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
		$cnombre = $datos['nombre'];
		if ($datos['coordinador'] == 0){
			$ccoordinador = "NULL";
		}else{
			$ccoordinador = $datos['coordinador'];
		}
        
		$accion = $datos['accion'];
        $carrera = $datos['carrera'];
		$userid = $datos['userid']; //Para identificar el Id del usuario logueado, que es un rector
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$caracteres = 'abcdefghijklmnopqrstuvwxyz';//base para general nombre aleatorio
		$nombreFoto = str_shuffle($caracteres);//nombre aletorio
		$Registros = $conexionTemporal->query("SELECT tit_facultades.id FROM tit_facultades WHERE tit_facultades.decano=$userid;");
		$Registro = $Registro=mysqli_fetch_array($Registros);
		$facultad = $Registro['id'];
		if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			//Para saber si la tabla de universidades está o no vacía
			$Registros = $conexionTemporal->query("SELECT count(*) as cantidad FROM tit_carreras;");
			$Registro = $Registro=mysqli_fetch_array($Registros);
			$cantidadUsuarios = $Registro['cantidad'];
			if ($cantidadUsuarios >0) {//Averiguo su ID para luego general el nombre del logotipo
				$Registros = $conexionTemporal->query("SELECT MAX(id) + 1 AS id_nuevo_registro FROM tit_carreras");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$id_nuevo_registro = $Registro['id_nuevo_registro'];
			}else{
				$conexionTemporal->query("TRUNCATE TABLE tit_carreras");
				$id_nuevo_registro = 1;
			}
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				$nombreFoto = $nombreFoto."_".$id_nuevo_registro.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
				$consulta = "INSERT INTO tit_carreras(nombre,coordinador,facultad,logotipo) VALUES ('$cnombre',$ccoordinador,$facultad,'$nombreFoto');";
			}else{
				$consulta = "INSERT INTO tit_carreras(nombre,coordinador,facultad) VALUES ('$cnombre',$ccoordinador,$facultad);";
			}
			if ($ccoordinador > 1){ //Para insertar el rector en la tabla de asiganaciones
				$consulta1 = "UPDATE tit_asignaciones SET valor=$facultad WHERE usuario=$ccoordinador";
			}
			$mensaje= "registrada";
		}else{//para actualizar los datos de la carrera
			//Para determinar el nombre del archivo que corresponde al logotipo de la facultad
			$consulta = "SELECT tit_carreras.logotipo FROM tit_carreras WHERE tit_carreras.id=$carrera;";
			$Registros = $conexionTemporal->query($consulta);
			$Registro = mysqli_fetch_array($Registros);
			$logoViejo =$Registro['logotipo']; //Nombre del logotipo Viejo
			$nombreFoto= $nombreFoto."_".$usuario.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
			if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
				unlink('imagenes/'.$logoViejo); //Borrar foto vieja
				$consulta = "UPDATE tit_carreras SET nombre='$cnombre',coordinador=$ccoordinador,logotipo='$nombreFoto' WHERE tit_carreras.id=$carrera;";
			}else{
				$consulta = "UPDATE tit_carreras SET nombre='$cnombre',coordinador=$ccoordinador WHERE tit_carreras.id=$carrera;";
			}
			if ($ccoordinador > 1){ //Para insertar el rector en la tabla de asiganaciones
				//Para determinar el coordinador actual de la carrera en cuestión
				$consulta3 = "SELECT tit_carreras.coordinador FROM tit_carreras WHERE tit_carreras.id=$carrera;";
				$Registros = $conexionTemporal->query($consulta3);
				$Registro = mysqli_fetch_array($Registros);
				$coordinadorViejo =$Registro['coordinador'];
				$consulta2 = "UPDATE tit_asignaciones SET valor=NULL WHERE usuario=$coordinadorViejo and rol=4";
				$conexionTemporal->query($consulta2);//Para quitar el rol de coordinador al coordinador anterior
				$consulta1 = "UPDATE tit_asignaciones SET valor=$facultad WHERE usuario=$ccoordinador";
				$conexionTemporal->query($consulta1);
			}
			$mensaje= "actualizada";
		}
		$conexionTemporal->query($consulta); //Insertar y/o actualizar en la tabla de carreras
		 //Para insertar en la tabla de asignaciines
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