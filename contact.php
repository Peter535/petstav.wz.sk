<?php session_start(); ?>
<?php
$field_name = $_POST['cf_meno'];
$field_email = $_POST['cf_email'];
$field_message = $_POST['cf_sprava'];

$mail_to = 'mail@mail.sk';
$subject = 'Sprava od navstevnika '.$field_name;
$from = 'info@info.sk';

$body_message = 'From: '.$field_name."\n";
$body_message .= 'E-mail: '.$field_email."\n";
$body_message .= 'Message: '.$field_message;

$headers = 'From: '.$from."\r\n";
$headers .= 'Reply-To: '.$field_email."\r\n";

include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';
$securimage = new Securimage();

if ($securimage->check($_POST['captcha_code']) == false) {
 // the code was incorrect
  // you should handle the error so that the form processor doesn't continue
 
  // or you can use the following code if there is no validation or you do not know how
  echo "Text zadany z obrazku je nespravny.<br /><br />";
  echo "Prosim kliknite <a href='javascript:history.go(-1)'>spat</a> a skuste opat.";
  exit;
}

$mail_status = mail($mail_to, $subject, $body_message, $headers);

if ($mail_status) { ?>
	<script language="javascript" type="text/javascript">
		alert('Dakujeme za vasu spravu.');
		window.location = 'index.html';
	</script>
<?php
}
else { ?>
	<script language="javascript" type="text/javascript">
		alert('Odoslanie zlyhalo. Poslite prosim email na iveta.simunova@kuty.sk');
		window.location = 'index.html';
	</script>
<?php

}
?>