<?php
	header('Content-Type: text/html; charset=utf-8');
	
	/*Ya no muestra warnings y facilita el json parsing*/
	ini_set("display_errors", 0);

	session_start();
	$_SESSION["error"] = "<ul>";
	$_errors = 0;

	// $_POST["name"] = "Ivan Ramírez";
	// $_POST["email"] = "iramirez@fabricadesoluciones.com";
	// $_POST["subject"] = "Asunto de prueba";
	// $_POST["msg"] = "Mensaje de prueba.";


	if( !isset($_POST["name"]) && empty($_POST["name"]) ) {
		$_errors++;
		$_SESSION["error"] .= "<li>El campo <b>Nombre</b> es requerido.</li>";
	}
	if( !isset($_POST["phone"]) && empty($_POST["phone"]) ) {
		$_errors++;
		$_SESSION["error"] .= "<li>El campo <b>Teléfono</b> es requerido.</li>";
	}
	if( !isset($_POST["email"]) && empty($_POST["email"]) ) {
		$_errors++;
		$_SESSION["error"] .= "<li>El campo <b>E-Mail</b> es requerido.</li>";
	}
	$pattern = "([A-Za-z0-9_.-]+@[A-Za-z0-9_.-]+\.[A-Za-z0-9_-]+)";
	if( !preg_match($pattern, $_POST["email"], $result) ) {
  	$_errors++;
  	$_SESSION["error"] .= "<li>El correo proporcionado no es válido.</li>";
	}
	if( !isset($_POST["company"]) && empty($_POST["company"]) ) {
		$_errors++;
		$_SESSION["error"] .= "<li>El campo <b>Empresa</b> es requerido.</li>";
	}
	if( !isset($_POST["msg"]) && empty($_POST["msg"]) ) {
		$_errors++;
		$_SESSION["error"] .= "<li>El campo <b>Mensaje</b> es requerido.</li>";
	}

	if( isset($_POST["recaptcha"]) && $_POST["recaptcha"]==1 ) {
		if( isset($_POST["g-recaptcha-response"]) && !empty($_POST["g-recaptcha-response"]) ) {} else {
			$_errors++;
			$_SESSION["error"] .= "<li> Por favor da click en el reCaptcha. </li>";
		}
	}

	// print_r($_errors);
	// exit();

	if( $_errors==0 ) {
		//web site secret key
		$secret = "6LfhZE4UAAAAANxb8W5mzUGrS0XjZtIm_zpXtv-d";
		//get verify response data
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$params = array( "secret"=>$secret, "response"=>$_POST["g-recaptcha-response"] );
		curl_setopt( $ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify" );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($params) );
		$result = curl_exec( $ch );
		$response_data = json_decode( $result );

		/*Success*/
		if( $response_data ) {
			$name = $_POST["name"];
			$usr_mail = $_POST["email"];
			$telefono = $_POST["phone"];
			$empresa = $_POST["company"];
			$mensaje = $_POST["msg"];
			$production = false;

			$noreply = "info@pantuflasfinas.com.mx";
			$company = "Pantuflas Finas";

			// GMail account
			// noreply.usogas@gmail.com
			// 0Nq2Hrvo

			if( $production )
				$webmaster = "info@pantuflasfinas.com.mx";
			else
				$webmaster = "iramirez@fabricadesoluciones.com";
			
			$body_msg_webmaster = "
				Recientemente $name se puso en contacto.
				<p></p>
				<b>Datos:</b><br>
				<b>Nombre:</b> $name<br>
				<b>Correo:</b> $usr_mail<br>
				<b>Teléfono:</b> $telefono<br>
				<b>Empresa:</b> $empresa<br>
				<b>Mensaje:</b> <br><br>$mensaje";

			$subject_webmaster = "Contacto Sitio Web ".$company;

			$body_msg_user = "
				¡Muchas gracias por su interés! En breve nos comunicaremos con usted.
				</br>
				Saludos<br>
				<strong>$company</strong>
			";

			$subject_usr = "Contacto ".$company;

			$headers_usr = "MIME-Version: 1.0"."\r\n".
										 "Content-type: text/html; charset=utf-8"."\r\n".
										 "From: Contacto Web - ".$company."<".$noreply.">\r\n".
										 "X-Mailer: PHP/".phpversion();

			$headers_webmaster = "MIME-Version: 1.0"."\r\n".
													 "Content-type: text/html; charset=utf-8"."\r\n".
													 "From: Contacto Web - ".$company."<".$noreply.">\r\n".
													 "X-Mailer: PHP/".phpversion();

			/*Mail to user*/
			$mail_usr = mail($usr_mail, $subject_usr, $body_msg_user, $headers_usr);

			/*Mail to webmaster*/
			$mail_webmaster = mail($webmaster, $subject_webmaster, $body_msg_webmaster, $headers_webmaster);

			unset( $_SESSION["error"] );
			$_SESSION["thanks"] = true;
			header("Location: ../../gracias");
			echo "pasa header D:";
			exit();
		} else { /*error*/
			$_SESSION["error"] .= "<li>Ocurrió un error al verificar el reCaptcha, por favor intentalo de nuevo.</li>";
			$_SESSION["error"] .= "</ul>";
			header("Location: ../../index#contacto");
		}
	} else {
		$_SESSION["error"] .= "</ul>";
	}

	header("Location: ../../index#contacto");
?>