<?PHP
   // if (isset($_SESSION)) {
   //     session_unset();
   // }else{ 
   //     session_start();
   // }
    include_once("include.php");
    include_once("libreria.php");
    if (isset($_POST['usuario'])) {
		$Cuenta = $_POST['usuario'];
		$Contrasena = $_POST['clave'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
        $query = "SELECT tit_asignaciones.rol as rolid, tit_usuarios.sexo as sexo, tit_tipo_usuarios.nombre as rolname,tit_asignaciones.parametro,tit_asignaciones.valor,tit_usuarios.nombres as nombre1,tit_usuarios.apellidos as apellidos1,tit_usuarios.id as userId,tit_usuarios.foto as foto1,tit_usuarios.confirmado as confirmado,tit_tipo_usuarios.nombre as nombre2,tit_tipo_usuarios.id as tipoId FROM (tit_asignaciones INNER JOIN tit_tipo_usuarios ON (tit_asignaciones.rol = tit_tipo_usuarios.id)) INNER JOIN tit_usuarios ON tit_asignaciones.usuario=tit_usuarios.id WHERE tit_usuarios.usuario='$Cuenta' and tit_usuarios.clave=SHA2('$Contrasena',256);";
        //$Temp = mysqli_query($conexionTemporal,$query);
        $Temp = $conexionTemporal->query($query);
        //$Hilo = $conexionTemporal->thread_id;
        $Datos = array();
   		if (mysqli_num_rows($Temp) != 0) {
			$Result = mysqli_fetch_array($Temp);
            $userid = $Result['userId'];
            //Para determinar si el usuario logueado puedes desplegar los menues
            $identidad = $Result['userId'];
            $rol = $Result['rolid'];
            switch ($rol){
                case 1:
                    break;
                case 2:
                    //Para comprobar si se trata de un rector sin universidad asignada
                    $query1 = "SELECT * FROM tit_universidades INNER JOIN tit_usuarios ON tit_universidades.rector = tit_usuarios.id WHERE tit_usuarios.id = $userid";
                    $Temp1 = $conexionTemporal->query($query1);
                    if (mysqli_num_rows($Temp1) == 0) {
                        //Qué hacer cuando se loguea un usuario con rol de rector pero sin universidad asignada
                        $rol = 7; //Rol que no tiene definida ninguna acción dentro del sistema
                    }   
                    break;
                case 3:
                    //Para comprobar si se trata de un decano sin facultad asignada
                    $query1 = "SELECT * FROM tit_facultades INNER JOIN tit_usuarios ON tit_facultades.decano = tit_usuarios.id WHERE tit_usuarios.id = $userid";
                    $Temp1 = $conexionTemporal->query($query1);
                    if (mysqli_num_rows($Temp1) == 0) {
                        //Qué hacer cuando se loguea un usuario con rol de rector pero sin universidad asignada
                        $rol = 7; //Rol que no tiene definida ninguna acción dentro del sistema
                    } 
                    break;
                case 4:
                    break;
                case 5:
                    break;
                case 6:
                    break;
            }
            $Datos[] = array(
                'nombres' => $Result['nombre1'],
                'apellidos' => $Result['apellidos1'],
                'nombrerol' => $Result['nombre2'],
                'foto' => $Result['foto1'],
                'id' => $Result['userId'],
                'parametro' => $Result['parametro'],
                'valor' => $Result['valor'],
                'rolid' => $rol,
                'rolname' => $Result['rolname'],
                'confirmado' => $Result['confirmado'],
                'sexo' => $Result['sexo']
            );
		}else{
			$Datos[] = array();
        }
        $DatoEnviar = json_encode($Datos); //Para codificar la información que se va a enviar
        echo $DatoEnviar;
        //$Cierre = Desconecta($conexionTemporal,$Hilo);	
    }
?>