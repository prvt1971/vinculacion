<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        //$Registros = $conexionTemporal->query("SELECT tit_asignaciones.valor FROM tit_asignaciones WHERE tit_asignaciones.usuario=$userid and tit_asignaciones.parametro='rector';");
    	$Registros = $conexionTemporal->query("SELECT * FROM tit_facultades WHERE tit_facultades.decano=$userid;");
        $Registro = $Registro=mysqli_fetch_array($Registros);
        //Aquì tengo que buscar la facultad a la que dirige el decano logueado
		$facultad = $Registro['id'];  //para identificar a qué universidad pertenecen los decanos que debo mostrar
        $Registros = $conexionTemporal->query("SELECT tit_usuarios.nombres,tit_usuarios.apellidos,tit_usuarios.id FROM tit_usuarios INNER JOIN tit_asignaciones ON tit_usuarios.id=tit_asignaciones.usuario WHERE (tit_asignaciones.valor=$facultad OR tit_asignaciones.valor=0) and tit_asignaciones.rol=4 ORDER BY tit_usuarios.apellidos");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombres'],
                'apellidos' => $Registro['apellidos'],
                'id' => $Registro['id']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>