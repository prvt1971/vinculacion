<?PHP
	include_once("include.php");
    include_once("libreria.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	//Load Composer's autoloader
	require 'vendor/autoload.php';
	function gmail()
	{
	  $data =
	  [
		'title' => 'Nuevo mensaje'
	  ];
   
	  View::render('gmail', $data);
	}
  	// Contenido del correo
	$datos = json_decode($_POST['data'], true);
	$asunto    = $datos['asunto'];
	$contenido = $datos['cuerpo'];
	$para      = $datos['direccion'];
	  try {

		if (!filter_var($para, FILTER_VALIDATE_EMAIL)) {
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
		$mail->addAddress($para, 'OtrPedro Valdés');
	 
		// Asunto del correo
		$mail->Subject = $asunto;
   
		// Contenido
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Body    = sprintf('<h1>El mensaje es:</h1><br><p>%s</p>', $contenido);
	 
		// Texto alternativo
		$mail->AltBody = 'No olvides suscribirte a nuestro canal.';
   
		// Agregar algún adjunto
		//$mail->addAttachment(IMAGES_PATH.'logo.png');
	 
		// Enviar el correo
		if (!$mail->send()) {
		  //throw new Exception($mail->ErrorInfo);
		  //echo "No enviado";
		}else{
			//echo "Enviado";
		}
   
		//Flasher::success(sprintf('Mensaje enviado con éxito a %s', $para));
		//Redirect::back();
   
	  } catch (Exception $e) {
		//Flasher::error($e->getMessage());
		//Redirect::back();
	}
?>