<?php
    include_once("include.php");
    include_once("libreria.php");
    //$datos = json_decode(, true);
    $cedula = $_POST['cedula'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT * FROM tit_usuarios WHERE tit_usuarios.cedula='$cedula'");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombres' => $Registro['nombres'],
                'apellidos' => $Registro['apellidos'],
                'cedula' => $Registro['cedula'],
                'email' => $Registro['email'],
                'cuenta' => $Registro['usuario'],
                'logotipo' => $Registro['foto'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/fotos_usuarios/'.$Registro['foto'],
                'sexo' => $Registro['sexo'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>