<?php
    include_once("include.php");
    include_once("libreria.php");
    $Id = $_POST['universidad'];
    $conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $consulta = "SELECT tit_universidades.logotipo FROM tit_universidades WHERE tit_universidades.id=$Id;";
	$Registros = $conexionTemporal->query($consulta);
	$Registro = mysqli_fetch_array($Registros);
	$logoViejo =$Registro['logotipo'];
    if (!$conexionTemporal){
        die("Imposible conectar con la base de datos");
    }
    $Resultado = $conexionTemporal->query("DELETE FROM tit_universidades WHERE id=$Id");
    $Resultado1 = $conexionTemporal->query("DELETE FROM tit_asignaciones WHERE tit_asignaciones.parametro='rector' and tit_asignaciones.valor=$Id");
    if (!$Resultado){
        die("No se ejecutó la consulta...");
    }
    echo "Universidad eliminada correctamente correctamente";
    unlink('imagenes/'.$logoViejo);
?>