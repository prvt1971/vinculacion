<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $parroquia = $_POST['parroquia'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_parroquias.* FROM tit_parroquias WHERE tit_parroquias.id=$parroquia;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'canton' => $Registro['canton'],
                'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>