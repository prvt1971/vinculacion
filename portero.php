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
            $Datos[] = array(
                'nombres' => $Result['nombre1'],
                'apellidos' => $Result['apellidos1'],
                'nombrerol' => $Result['nombre2'],
                'foto' => $Result['foto1'],
                'id' => $Result['userId'],
                'parametro' => $Result['parametro'],
                'valor' => $Result['valor'],
                'rolid' => $Result['rolid'],
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