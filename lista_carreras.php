<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_facultades.id FROM tit_facultades WHERE tit_facultades.decano=$userid;");
        $Registro = $Registro=mysqli_fetch_array($Registros);
        $facultad = $Registro['id'];  //para identificar a qu茅 facultad pertenecen las carreras que debo mostrar
         $Registros = $conexionTemporal->query("SELECT tit_carreras.*,tit_usuarios.nombres,tit_usuarios.apellidos  FROM tit_carreras LEFT JOIN tit_usuarios ON tit_carreras.coordinador=tit_usuarios.id WHERE tit_carreras.facultad=$facultad ORDER BY tit_carreras.nombre");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'coordinador' => $Registro['apellidos']." ".$Registro['nombres'],
                'logotipo' => $Registro['logotipo'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la informaci贸n que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>