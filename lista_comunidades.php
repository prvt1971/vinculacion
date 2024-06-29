<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_comunidades.*,tit_parroquias.nombre as parroquia FROM tit_comunidades INNER JOIN tit_parroquias ON tit_comunidades.parroquia=tit_parroquias.id WHERE 1 ORDER BY tit_comunidades.nombre;");
        $Resultados = array();
        while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
            'nombre' => $Registro['nombre'],
            'parroquia' => $Registro['parroquia'],
            'id' => $Registro ['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>