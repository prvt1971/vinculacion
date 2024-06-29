<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_usuarios.* FROM tit_usuarios INNER JOIN tit_asignaciones on tit_usuarios.id=tit_asignaciones.usuario WHERE tit_asignaciones.rol=2 ORDER BY tit_usuarios.apellidos");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombres'],
                'apellidos' => $Registro['apellidos'],
                'id' => $Registro['id']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>