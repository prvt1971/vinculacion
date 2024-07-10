
<?php // Libreria de funciones y procedimientos que se reutilizan dentro del sitio Web
    //Funcion para subir a la carpeta correspondiente el archivo seleccionado
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;
    function subirArchivo($ArchivoSubir,$Carpeta,$NombreNuevo){
            if(copy($ArchivoSubir, $Carpeta.$NombreNuevo)){
                echo "Archivo guardado con exito";
            }else{
                echo "Archivo no se pudo guardarRRR ".$ArchivoSubir. " en ". $Carpeta."/".$NombreNuevo;
            }
    }

    //Función para establecer lka conexión con la base de datos
    function Conecta($servidor,$usuario,$clave,$db){
        $mysqli = new mysqli($servidor, $usuario, $clave, $db);
        return $mysqli;
    }

    //Función para destruir una conexión a la base de datos
    function Desconecta($conexion,$IdHilo){
        $conexion->kill($IdHilo);
        $conexion->close();  
    }

    //Para leer el contenido de un archivo de texto
    function LeeImprimeArchivo($Fichero){
		$archivo = fopen($Fichero, "r");
				
				// Recorremos todas las lineas del archivo
				while(!feof($archivo)){
					// Leyendo una linea
					$traer = fgets($archivo);
					// Imprimiendo una linea
					echo $traer; 
				}
				fclose($archivo);
	}

    function gmail()
        {
        $data =
        [
            'title' => 'Nuevo mensaje'
        ];
    
        View::render('gmail', $data);
        }
    function enviarcorreo($direccion,$asunto,$mensaje,$adjunto){
        include_once("libreria.php");

        //Load Composer's autoloader
        require 'vendor/autoload.php';
        
        // Contenido del correo
   
        try {

            if (!filter_var($direccion, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Dirección de correo electrónico no válida.');
            }
    
            // Intancia de PHPMailer
            $mail=new PHPMailer();
        
            // Es necesario para poder usar un servidor SMTP como gmail
            $mail->isSMTP();
        
            // Si estamos en desarrollo podemos utilizar esta propiedad para ver mensajes de error
            //SMTP::DEBUG_OFF    = off (for production use) 0
            //SMTP::DEBUG_CLIENT = client messages 1 
            //SMTP::DEBUG_SERVER = client and server messages 2
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        
            //Set the hostname of the mail server
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 465; // o 587
        
            // Propiedad para establecer la seguridad de encripción de la comunicación
            $mail->SMTPSecure    = PHPMailer::ENCRYPTION_SMTPS; // tls o ssl para gmail obligado
        
            // Para activar la autenticación smtp del servidor
            $mail->SMTPAuth      = true;
    
            // Credenciales de la cuenta
            $email              = 'pvaldestamayo@gmail.com';
            $mail->Username     =  $email;
            $mail->Password     = 'nrbtwawoglpnnhqi';
        
            // Quien envía este mensaje
            $mail->setFrom($email, 'Pedro Valdés');
    
            // Si queremos una dirección de respuesta
            $mail->addReplyTo('replyto@panchos.com', 'Pancho Doe');
        
            // Destinatario
            $mail->addAddress($direccion, 'Pedro Valdés');
        
            // Asunto del correo
            $mail->Subject = $asunto;
    
            // Contenido
            $mail->IsHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Body    =  $mensaje;
        
            // Texto alternativo
            $mail->AltBody = 'No olvides suscribirte a nuestro canal.';
    
            // Agregar algún adjunto
            //$mail->addAttachment(IMAGES_PATH.'logo.png');
        
            // Enviar el correo
            if (!$mail->send()) {
            throw new Exception($mail->ErrorInfo);
                //echo "No enviado";
            }else{
                //echo "Enviado";
            }
    
            //Flasher::success(sprintf('Mensaje enviado con éxito a %s', $para));
            //Redirect::back();
    
        } catch (Exception $e) {
            Flasher::error($e->getMessage());
            Redirect::back();
        }
    }

    function generaCodigo(){
        $i=1;
		$codigo = "";
		while ($i < 5) {
			$numero = rand(0,9);
			$codigo = $codigo . strval($numero);
			$i = $i + 1;
		}
		$codigo = "TIT-" . $codigo;
        return $codigo;
    }
    
?>

