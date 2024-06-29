<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $periodo = $_POST['periodo'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_periodos.* FROM tit_periodos WHERE tit_periodos.id=$periodo;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'titulolargo' => $Registro['titulo_largo'],
                'titulocorto' => $Registro['titulo_corto'],
                'fechainicio' => $Registro['inicia'],
                'fechatermina' => $Registro['termina'],
                'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>