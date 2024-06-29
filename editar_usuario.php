<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $usuario = $_POST['usuario'];
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_usuarios.* FROM tit_usuarios WHERE tit_usuarios.id=$usuario;");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'cedula' => $Registro['cedula'],
                'apellidos' => $Registro['apellidos'],
                'nombres' => $Registro['nombres'],
                'correo' => $Registro['email'],
                'sexo' => $Registro['sexo'],
                'cuenta' => $Registro['usuario'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/fotos_usuarios/'.$Registro['foto']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>