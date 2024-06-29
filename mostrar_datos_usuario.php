<?php
    include_once("include.php");
	include_once("libreria.php");
    if (isset($_SESSION['usuario']['cuenta'])){
        $Cuenta=$_SESSION['usuario']['cuenta'];
        $conexionTemporal = Conecta($HOST,$USER,$PASSWORD,$DBNAME);
        $Registro = $conexionTemporal->query("SELECT * from tit_usuarios WHERE usuario='$Cuenta'");
        $Hilo = $conexionTemporal->thread_id;
        if ($Registro->num_rows != 0) {
            $Temp = mysqli_fetch_object($Registro);
            echo $Temp->nombres." ".$Temp->apellidos;
            echo "<div style='width:100px'>";
    			echo "<img style='max-width:100px;' name='logotipo' id='logotipo' src='".$W3DIRECTORY."/imagenes/fotos_usuarios/".$Temp->foto."' alt = 'Salir'>";
    		echo "</div>";
            echo "<div>";
                switch ($Temp->rol){
                    case 1:
                        echo "ADMINISTRADOR";
                        break;
                    case 2:
                        echo "ADMINISTRADOR";
                        break;
                }
            echo "</div>";   
        }else{
            
        }
        $Cierre = Desconecta($conexionTemporal,$Hilo);
    }else{
        
    }
?>