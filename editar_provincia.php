<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $provincia = $_POST['provincia'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_provincias.* FROM tit_provincias WHERE tit_provincias.id=$provincia;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>