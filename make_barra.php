<?PHP
    include_once("include.php");
    include_once("libreria.php");
    if (isset($_POST['rolid'])) {
        $rolid=$_POST['rolid'];
        $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
        $query = "SELECT tit_funciones.nombre AS funcion,tit_acciones.nombre AS accion,tit_acciones.codigo as codigo FROM tit_funciones INNER JOIN tit_acciones ON (tit_funciones.id=tit_acciones.funcion) WHERE tit_acciones.rol=$rolid ORDER BY tit_acciones.funcion;";
        //$Temp = mysqli_query($conexionTemporal,$query);
        $Temp = $conexionTemporal->query($query);
        //$Hilo = $conexionTemporal->thread_id;
        $Datos = array();
   		if (mysqli_num_rows($Temp) != 0) {
            while ($Result = mysqli_fetch_array($Temp)){
                $Datos[] = array(
                    'funcion' => $Result['funcion'],
                    'accion' => $Result['accion'],
                    'codigo' => $Result['codigo']
                );
            }
		}else{
			$Datos[] = array();
        }
        $DatoEnviar = json_encode($Datos); //Para codificar la información que se va a enviar
        echo $DatoEnviar;
        //$Cierre = Desconecta($conexionTemporal,$Hilo);	
    }
?>