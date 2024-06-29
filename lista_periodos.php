<?php
    include_once("include.php");
    include_once("libreria.php");
    $userid = $_GET['dato'];
    $conexionTemporal=Conecta($HOST,$USER,$PASSWORD,$DBNAME);
     if ($conexionTemporal){
        $Registros = $conexionTemporal->query("SELECT tit_universidades.id FROM tit_universidades WHERE tit_universidades.rector=$userid;");
		$Registro = $Registro=mysqli_fetch_array($Registros);
		$universidad = $Registro['id'];  //para identificar a qué universidad pertenecen los periodos que debo mostrar
        $Registros = $conexionTemporal->query("SELECT tit_periodos.*  FROM tit_periodos WHERE tit_periodos.universidad=$universidad ORDER BY tit_periodos.inicia");
        $Resultados = array();
        while ($Registro=mysqli_fetch_array($Registros)){
            $Resultados[] = array(
            'nombre' => $Registro['titulo_corto'],
            'inicia' => $Registro['inicia'],
            'termina' => $Registro['termina'],
            'id' => $Registro['id'],
            );
         }
         $DatoEnviar = json_encode($Resultados); //Para codificar la información que se va a enviar
         echo $DatoEnviar; //Respuesta del Servidor
     }
?>