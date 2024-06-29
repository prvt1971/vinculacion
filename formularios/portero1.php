<?php
    require_once("include.php");
    if (isset($_POST['cuenta'])) {
		$Cuenta = $_POST['cuenta'];
		$Contrasena = $_POST['contrasena'];
		$mysqli = new mysqli($HOST, $USER, $PASSWORD);
		//@$link=mysql_connect($HOST,$USER,$PASSWORD) or die("Hay problemas con la conexi�n a la base de datos");
		$mysqli->select_db($DBNAME);
		$Temp=$mysqli->query("select * from tit_usuarios where usuario='$Cuenta' and clave=password('$Contrasena')");
		if (mysqli_num_rows($Temp) != 0) {
			$Result = mysqli_fetch_object($Temp);
			session_start();
			$_SESSION["usuario"] = array ("cuenta" => $Cuenta, "clave" => $Contrasena, "privilegio" => $Result->rol);
	        //session_register("usuario");
			echo "<font size='1' face='verdana' color = '#CC0000'>";
			switch ($Result->rol){
                case 1:
                    echo "Administrador"; 
                    break;
                default:  
			}
		}else{
			header("Location: form_login.php");
        }
		mysqli_close($mysqli);
		header("Location: form_login.php");
    }
	;
?>