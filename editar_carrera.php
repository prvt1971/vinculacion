<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $carrera = $_POST['carrera'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_carreras.* FROM tit_carreras WHERE tit_carreras.id=$carrera;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'coordinador' => $Registro['coordinador'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>