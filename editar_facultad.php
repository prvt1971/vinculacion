<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $facultad = $_POST['facultad'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_facultades.* FROM tit_facultades WHERE tit_facultades.id=$facultad;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'decano' => $Registro['decano'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>