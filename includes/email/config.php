<?php

/*$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'agendazy.com.br';
$mail->SMTPAuth = true;
$mail->Username = 'contato@agendazy.com.br';
$mail->Password = 'agendazy2020';
$mail->SMTPSecure = 'true';
$mail->Port = 465;*/

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.hostinger.com';
$mail->SMTPAuth = true;
$mail->Username = 'no-reply@pigeonfy.me';
$mail->Password = '#Pideonmail2022';
$mail->SMTPSecure = 'true';
$mail->Port = 587;
$mail->setFrom('no-reply@pigeonfy.me', utf8_decode('Pigeonfy'));
$mail->isHTML(true);

?>
