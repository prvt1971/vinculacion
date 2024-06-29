<?php
    include_once("include.php");
    include_once("libreria.php");
    $tipo = $_GET['dato'];
    //$parametro = $_GET['parametro'];
    $valor = $_GET['valor'];
    $usuario_logueado = $_GET['usuario'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    switch ($tipo){
        case 1:
            $parametro = "rector";
            break;
        case 2:
            $parametro = "universidad";
            break;
        case 3:
            $parametro = "facultad";
            //Para determinar la facultad asignada al decano logueado
            $consulta = "SELECT * FROM tit_facultades WHERE tit_facultades.decano=$usuario_logueado;";
            $Registros = $conexionTemporal->query($consulta);
			$Registro = mysqli_fetch_array($Registros);
			$valor =$Registro['id'];
            break;
        case 4:
            $parametro = "carrera";
            //Para determinar la carrera asignada al coordinador logueado
            $consulta = "SELECT * FROM tit_carreras WHERE tit_carreras.coordinador=$usuario_logueado;";
            $Registros = $conexionTemporal->query($consulta);
			$Registro = mysqli_fetch_array($Registros);
			$valor =$Registro['id'];
            break;
        //case 4:
          //  $parametro = "carrera";
          //  break;
    }
    
    if ($valor==0) {
        //echo "Vlaor es cero";
        $consulta = "SELECT tit_usuarios.* FROM tit_usuarios INNER JOIN tit_asignaciones ON tit_usuarios.id=tit_asignaciones.usuario WHERE tit_asignaciones.rol=2";
    } else {
        //echo "Valor no es cero";
        $consulta = "SELECT tit_usuarios.* FROM tit_usuarios INNER JOIN tit_asignaciones ON tit_usuarios.id=tit_asignaciones.usuario WHERE (tit_asignaciones.valor=$valor OR tit_asignaciones.valor=0) and tit_asignaciones.rol=$tipo+1";
    }
    //$consulta = "SELECT tit_usuarios.* FROM tit_usuarios INNER JOIN tit_asignaciones ON tit_usuarios.id=tit_asignaciones.usuario WHERE tit_asignaciones.parametro='$parametro' and tit_asignaciones.valor=$valor and tit_asignaciones.rol=$tipo+1";
    if ($conexionTemporal){
         $Registros = $conexionTemporal->query($consulta);
         $Resultados = array();
         while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
                'nombre' => $Registro['apellidos']." ".$Registro['nombres'],
                'cedula' => $Registro['cedula'],
                'email' => $Registro['email'],
                'logotipo' => $Registro['foto'],
                'id' => $Registro['id'],
                'path'=> $W3DIRECTORY.'/imagenes/fotos_usuarios/'.$Registro['foto']
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>