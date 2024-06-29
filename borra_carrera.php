<?php
    include_once("include.php");
    include_once("libreria.php");
    $Id = $_POST['carrera'];
    $conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    $consulta = "SELECT tit_carreras.logotipo FROM tit_carreras WHERE tit_carreras.id=$Id;";
	$Registros = $conexionTemporal->query($consulta);
	$Registro = mysqli_fetch_array($Registros);
	$logoViejo =$Registro['logotipo'];
    if (!$conexionTemporal){
        die("Imposible conectar con la base de datos");
    }
    $Resultado = $conexionTemporal->query("DELETE FROM tit_carreras WHERE id=$Id");
    if (!$Resultado){
        die("No se ejecutó la consulta...");
    }
    echo "facultad eliminada correctamente";
    unlink('imagenes/'.$logoViejo);
?>