<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $universidad = $_POST['universidad'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_universidades.*,tit_usuarios.nombres AS rectorNombre,tit_usuarios.id as rectorId FROM tit_universidades LEFT JOIN tit_usuarios ON tit_universidades.rector=tit_usuarios.id WHERE tit_universidades.id=$universidad;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'email' => $Registro['email'],
                'url' => $Registro['urll'],
                'rectorNombre' => $Registro['rectorNombre'],
                'rectorId' => $Registro['rectorId'],
                'logotipo' => $Registro['logotipo'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>