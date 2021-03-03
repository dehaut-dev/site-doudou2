<?

switch ($_GET['type']){
	case 'contact':
		sleep(1);
		sendHello();
		break;
}

function sendHello(){

  $to = "office@tbas-distribution.com";
  $subject = "TBAS - Formulaire de contact";
  
  $helloName = $_POST['name'];
  $helloAddress = $_POST['address'];
  $helloEmail = $_POST['email'];
  $helloPhone = $_POST['phone'];
  $helloMessage = $_POST['message'];
  
  $message = '
                          <b>Nom et Prénom: </b>'.$helloName.'<br />
                          <b>Adresse . Adresse de&rsquo;l enterprise: </b>'.$helloAddress.'<br />
                          <b>E-mail: </b>'.$helloEmail.'<br />
                          <b>Téléphone: </b>'.$helloPhone.'<br />
                          <b>Message: </b><br />'.nl2br($helloMessage).'
                  ';
  
  $select = array($helloName,$helloEmail);
  
  $headers  = "From: ".$select[0]." <".$select[1].">\r\n";
  $headers .= "Reply-To: ".$select[0]." <".$select[1].">\r\n";
  $headers .= "Mailed-by: <".$select[1].">\r\n";
  $headers .= "Return-Path: ".$select[0]." <".$select[1].">\r\n";
  $headers .= "Message-ID: <".time()."-".$select[1].">\r\n";
  $headers .= "Date: ".date("r")."\r\n";
  $headers .= "Sender-IP: ".$_SERVER["REMOTE_ADDR"]."\r\n";
  $headers .= "X-Mailer: PHP/".phpversion()."\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                  
  $mail = mail($to, $subject, $message, $headers);
  if(!$mail){
          mail($to, $subject, $message, $headers);
  }

}
?>