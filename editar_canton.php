<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $canton = $_POST['canton'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_cantones.* FROM tit_cantones WHERE tit_cantones.id=$canton;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'provincia' => $Registro['provincia'],
                'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>