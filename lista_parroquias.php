<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_parroquias.*,tit_cantones.nombre as canton FROM tit_parroquias INNER JOIN tit_cantones ON tit_parroquias.canton=tit_cantones.id WHERE 1 ORDER BY tit_parroquias.nombre;");
        $Resultados = array();
        while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
            'nombre' => $Registro['nombre'],
            'canton' => $Registro['canton'],
            'id' => $Registro ['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>