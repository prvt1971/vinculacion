<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $comunidad = $_POST['comunidad'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_comunidades.* FROM tit_comunidades WHERE tit_comunidades.id=$comunidad;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'parroquia' => $Registro['parroquia'],
                'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>