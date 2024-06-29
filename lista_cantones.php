<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_cantones.*,tit_provincias.nombre as provincia FROM tit_cantones INNER JOIN tit_provincias ON tit_cantones.provincia=tit_provincias.id WHERE 1 ORDER BY tit_cantones.nombre;");
        $Resultados = array();
        while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
            'nombre' => $Registro['nombre'],
            'provincia' => $Registro['provincia'],
            'id' => $Registro ['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>