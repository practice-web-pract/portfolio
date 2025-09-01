<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	/*
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'user@example.com';                     //SMTP username
	$mail->Password   = 'secret';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	*/

	//Від кого лист
	$mail->setFrom('outstaffing-ukraine@gmail.com', 'Outstaffing Ukraine'); // Вказати потрібний E-mail
	//Кому відправити
	$mail->addAddress('website.dewelopment@gmail.com'); // Вказати потрібний E-mail
	//Тема листа
	$mail->Subject = 'Outstaffing Ukraine';

	//Тіло листа
	$body = '<h1>Contact us</h1>';

    if(trim(!empty($_POST['firstname']))){
		$body.='<p><strong>Firstname:</strong> '.$_POST['firstname'].'</p>';
	}
    if(trim(!empty($_POST['lastname']))){
		$body.='<p><strong>Lastname:</strong> '.$_POST['lastname'].'</p>';
	}
	if(trim(!empty($_POST['email-user']))){
		$body.='<p><strong>Email:</strong> '.$_POST['email-user'].'</p>';
	}	
	if(trim(!empty($_POST['phone-number']))){
		$body.='<p><strong>Phone number:</strong> '.$_POST['phone-number'].'</p>';
	}	
	if(trim(!empty($_POST['message']))){
		$body.='<p><strong>Message:</strong> '.$_POST['message'].'</p>';
	}
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Thanks for Your Order';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>