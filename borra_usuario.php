<?php
    include_once("include.php");
    include_once("libreria.php");
    $Id = $_POST['usuario'];
    $conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $consulta = "SELECT tit_usuarios.foto FROM tit_usuarios WHERE tit_usuarios.id=$Id;";
	$Registros = $conexionTemporal->query($consulta);
	$Registro = mysqli_fetch_array($Registros);
	$logoViejo =$Registro['foto'];
    if (!$conexionTemporal){
        die("Imposible conectar con la base de datos");
    }
    $Resultado = $conexionTemporal->query("DELETE FROM tit_asignaciones WHERE tit_asignaciones.usuario=$Id");
    $Resultado2 = $conexionTemporal->query("UPDATE tit_universidades set tit_universidades.rector=0 WHERE  tit_universidades.rector=$Id");
    $Resultado3 = $conexionTemporal->query("UPDATE tit_facultades set tit_facultades.decano=0 WHERE  tit_facultades.decano=$Id");
    $Resultado4 = $conexionTemporal->query("UPDATE tit_carreras set tit_carreras.coordinador=0 WHERE  tit_carreras.coordinador=$Id");
    //$Resultado2 = $conexionTemporal->query("DELETE FROM tit_activistas WHERE tit_activistas.usuario=$Id");
    //$Resultado = $conexionTemporal->query("DELETE FROM tit_usuarios WHERE id=$Id");
    if (!$Resultado){
        die("No se ejecutó la consulta...");
    }
    echo "Usuario eliminado correctamente";
    //unlink('imagenes/fotos_usuarios/'.$logoViejo);
?>