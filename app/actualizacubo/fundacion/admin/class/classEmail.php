<?php
include_once LIBS_DIR . "phpMailer/class.phpmailer.php";

class sendEmail{
	
	function confirmRegister( $emailUser, $nameUser ){
		$urlSite = functionsCustom::Build();
		
		$filename = "./email/registro.html";		
		$gestor = fopen($filename, "r");
		$body = fread($gestor, filesize($filename));
		fclose($gestor);
		
		$body = str_replace("##SRC_IMAGENES##", $urlSite.'images/', $body);		
		// Instanciamos PHPMailer
		$mail = new PHPMailer();
		$mail->IsSMTP();
		/*
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl"; 
		$mail->Host = "smtp.gmail.com"; 
		$mail->Port = 465; 
		$mail->Username = "luis.guerrero@brm.com.co"; 
		$mail->Password = "pass";
		*/
		$mail->From = "cyzonecol@gmail.com"; 
		$mail->FromName = "Cyzone Colombia"; 
		$mail->Subject = "MOONMYST te hara ganadora"; 
		$mail->MsgHTML( $body );
		//$mail->AddAttachment("files/files.zip"); 
		$mail->AddAddress($emailUser, $nameUser);
		// Obligamos que el texto sea en formato html
		$mail->IsHTML(true); 
		// Enviamos el correo
		$mail->Send();
		
	}
}
?>