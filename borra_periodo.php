<?php
    include_once("include.php");
    include_once("libreria.php");
    $Id = $_POST['periodo'];
    $conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
    if (!$conexionTemporal){
        die("Imposible conectar con la base de datos");
    }
    $Resultado = $conexionTemporal->query("DELETE FROM tit_periodos WHERE id=$Id");
    if (!$Resultado){
        die("No se ejecutó la consulta...");
    }
    echo "Período eliminado correctamente";
?>