<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_universidades.id FROM tit_universidades WHERE tit_universidades.rector=$userid;");
		$Registro = $Registro=mysqli_fetch_array($Registros);
		$universidad = $Registro['id'];  //para identificar a qué universidad pertenecen las facultades que debo mostrar
         $Registros = $conexionTemporal->query("SELECT tit_facultades.*,tit_usuarios.nombres,tit_usuarios.apellidos  FROM tit_facultades LEFT JOIN tit_usuarios ON tit_facultades.decano=tit_usuarios.id WHERE tit_facultades.universidad=$universidad ORDER BY tit_facultades.nombre");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'decano' => $Registro['apellidos']." ".$Registro['nombres'],
                'logotipo' => $Registro['logotipo'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>