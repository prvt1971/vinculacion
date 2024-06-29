<?php
    include_once("include.php");
    include_once("libreria.php");
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
         $Registros = $conexionTemporal->query("SELECT tit_universidades.*,tit_usuarios.nombres AS rector FROM tit_universidades LEFT JOIN tit_usuarios ON tit_universidades.rector=tit_usuarios.id WHERE 1 ORDER BY tit_universidades.nombre");
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['nombre'],
                'email' => $Registro['email'],
                'url' => $Registro['urll'],
                'rector' => $Registro['rector'],
                'logotipo' => $Registro['logotipo'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/'.$Registro['logotipo']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>