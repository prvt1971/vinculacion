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
	$consulta1 = "";
	if (isset($datos)) {
        $ucedula = $datos['cedula'];
		$unombres = $datos['nombres'];
        $uapellidos = $datos['apellidos'];
		$ucorreo = $datos['correo'];
		$usexo = $datos['sexo'];
		$ucuenta = $datos['cuenta'];
        $uclave = $datos['clave'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$accion = $datos['accion'];
		$usuario = $datos['usuario'];
		$tipousuario = $datos['tipo'];
		$userid = $datos['userid'];//id del usuario logueado en el sistema
		$conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
		$caracteres = 'abcdefghijklmnopqrstuvwxyz';//base para general nombre aleatorio
		$nombreFoto = str_shuffle($caracteres);//nombre aletorio
		$parametro = "global";
		$confirmado = 1; //Valor predeterminado de confirmación cuando el registro lo hace alg{un responsable
		$valor = 0;
			switch ($tipousuario){//Para construir la consulta que voy a ejecutar para insertar datos de acuerdo al tipo de usuario
			case 2: //Un rector
				$parametro = "rector";
				break;
			case 3: //Un decano
				$Registros = $conexionTemporal->query("SELECT tit_universidades.id FROM tit_universidades WHERE tit_universidades.rector=$userid;");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$parametro = "universidad";
				$valor = $Registro['id'];  //para identificar a qué universidad pertenecen las facultades que debo mostrar
				break;
			case 4: //Un coordinador
				$Registros = $conexionTemporal->query("SELECT tit_facultades.id FROM tit_facultades WHERE tit_facultades.decano=$userid;");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$parametro = "facultad";
				$valor = $Registro['id'];  //para identificar a qué universidad pertenecen las facultades que debo mostrar
				break;
			case 5: //Un profesor responsable
				$Registros = $conexionTemporal->query("SELECT * FROM tit_carreras WHERE tit_carreras.coordinador=$userid;");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$parametro = "carrera";
				$valor = $Registro['id'];  //para identificar a qué universidad pertenecen las facultades que debo mostrar
				break;
			case 6: //Un estudiante
				if ($userid == 0){
					$parametro = "carrera";
					$valor = 0;
					$confirmado = 0;
				}else{
					$Registros = $conexionTemporal->query("SELECT * FROM tit_asignaciones WHERE tit_asignaciones.usuario=$userid and tit_asignaciones.rol=5;");
					$Registro = $Registro=mysqli_fetch_array($Registros);
					$parametro = "carrera";
					$valor = $Registro['valor'];  //para identificar a qué universidad pertenecen las facultades que debo mostrar
				}		
				break;
		}		
		//En dependencia de la etiquera que tenga el botón principal del formulario es la acción a realizar
		switch ($accion){
			case "Aceptar":
				//Para saber si la tabla de tit_usuarios está o no vacía
				$Registros = $conexionTemporal->query("SELECT count(*) as cantidad FROM tit_usuarios;");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$cantidadUsuarios = $Registro['cantidad'];
				if ($cantidadUsuarios >0) {//Averiguo su ID para luego general el nombre del logotipo
				}else{
					$conexionTemporal->query("TRUNCATE TABLE tit_usuarios");
					$id_nuevo_registro = 1;
				}
				if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
					$nombreFoto = $nombreFoto.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
					$consulta = "INSERT INTO tit_usuarios(cedula,apellidos,nombres,email,sexo,usuario,clave,foto,confirmado) VALUES ('$ucedula','$uapellidos','$unombres','$ucorreo',$usexo,'$ucuenta',SHA2('$uclave',256),'$nombreFoto',$confirmado);";
				}else{
					$consulta = "INSERT INTO tit_usuarios(cedula,apellidos,nombres,email,sexo,usuario,clave,confirmado) VALUES ('$ucedula','$uapellidos','$unombres','$ucorreo',$usexo,'$ucuenta',PASSWORD('$uclave',256),$confirmado);";
				}
				//codigo para generar el codigo de confirmacion que se enviara al estudiante
				if ($confirmado == 0){
					$codigo = generaCodigo();
					$asunto = "Codigo de confirmacion";
					$mensaje = "Su codigo de confirmacion es: " . $codigo;
				}else{

				}
				if ($conexionTemporal->query($consulta)) {;//Insertar el Nuevos registro
					if ($confirmado == 0){ //Si se trata de un estudiante paso un correo de confirmacion
						enviarcorreo($ucorreo,$asunto,$mensaje,"");
					}
				}else{
					//echo "No se puso registrar el nuevo usuario";
				}
					//determinar el Id del último registro insertado
				$Registros = $conexionTemporal->query("SELECT MAX(id) + 1 AS id_nuevo_registro FROM tit_usuarios");
				$Registro = $Registro=mysqli_fetch_array($Registros);
				$id_nuevo_registro = $Registro['id_nuevo_registro']-1;
				//Para insertar el registro el la tabla de asignaciones
				$consulta1 = "INSERT INTO tit_asignaciones(usuario,valor,rol) VALUES($id_nuevo_registro,$valor,$tipousuario)";
				$conexionTemporal->query($consulta1);//insertar en la tabla secundaria correspondiente
				$consulta3 = "INSERT INTO tit_codigostemporales(usuario,codigo,fecha) VALUES($id_nuevo_registro,'$codigo',CURRENT_TIME())";
				$conexionTemporal->query($consulta3);//insertar el codigo temporal asignador al usuario q se acaba de registrar
				$mensaje= "registrado";
				break;
			case "Aplicar":
				$id_nuevo_registro = $usuario;
				//Para insertar el registro el la tabla de asignaciones
				//$consulta1 = "INSERT INTO tit_asignaciones(usuario,parametro,valor,rol) VALUES($id_nuevo_registro,'$parametro',$valor,$tipousuario)";
				$consulta1 = "INSERT INTO tit_asignaciones(usuario,valor,rol) VALUES($id_nuevo_registro,$valor,$tipousuario)";
				$conexionTemporal->query($consulta1);//insertar en la tabla secundaria correspondiente
				$mensaje= "registrado";
				break;
			case "Actualizar":
				//Para determinar el nombre del archivo que corresponde al logotipo de la universidad
				$consulta = "SELECT tit_usuarios.foto FROM tit_usuarios WHERE tit_usuarios.id=$usuario;";
				$Registros = $conexionTemporal->query($consulta);
				$Registro = mysqli_fetch_array($Registros);
				$logoViejo =$Registro['foto']; //Nombre del logotipo Viejo
				$nombreFoto= $nombreFoto.".".pathinfo($fileName, PATHINFO_EXTENSION);//construyo el nombre de la foto quwe voy a subir
				if ($file_guardado != ""){//para determinar si se ha seleccionado o no el logotipo
					unlink('imagenes/fotos_usuarios/'.$logoViejo); //Borrar foto vieja
					$consulta = "UPDATE tit_usuarios SET cedula='$ucedula',nombres='$unombres',apellidos='$uapellidos',email='$ucorreo',sexo=$usexo,usuario='$ucuenta',clave=PASSWORD('$uclave'),foto='$nombreFoto' WHERE tit_usuarios.id=$usuario;";
				}else{
					$consulta = "UPDATE tit_usuarios SET cedula='$ucedula',nombres='$unombres',apellidos='$uapellidos',email='$ucorreo',sexo=$usexo,usuario='$ucuenta',clave=PASSWORD('$uclave') WHERE tit_usuarios.id=$usuario;";
				}
				$mensaje= "actualizado";
				$conexionTemporal->query($consulta);
				break;

		}
		//if ($accion == "Aceptar") { //Para saber si voy a insertar uno nuevo o a actualizar
			
		//}else{//para actualizar los datos de la universidad
			
		//}

		 
		if ($conexionTemporal) {
			if ($file_guardado != "") {
				subirArchivo($file_guardado,$PATH."/imagenes/fotos_usuarios/",$nombreFoto);
			}
			//echo "Usuario $mensaje correctamente";
		}else{
			//echo "Problemas al $mensaje el usuario";
		}
		echo $id_nuevo_registro;
		mysqli_close($conexionTemporal);
    }
?>