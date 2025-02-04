<?php

namespace App\Helpers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

Class CMail 
{
  public static function sendEmail($config){
    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      
    $mail->isSMTP();                                            
    $mail->Host       = config('services.mail.host');                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = config('services.mail.username');                     
    $mail->Password   = config('service.mail.password');                       
    $mail->SMTPSecure = config('service.mail.encrption');           
    $mail->Port       = config('service.mail.port');                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom(
        isset($config['from_address']) ? $config['from_address'] : config('service.mail.from_address'),
        isset($config['from_name'])? $config['from_name'] : config('service.mail.from_name')
    );
    $mail->addAddress($config['recipient_address'], isset($config['recipient_name']) 
    ?
    $config['recipient_name'] : config('service.mail.recipient_name')

);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

  }
}
?>