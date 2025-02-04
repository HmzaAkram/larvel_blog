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
    $config['recipient_name'] : null);    

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $config['subject'];
    $mail->Body    = $config['body'];

    if($mail->send()){
        return false; 
    }else{
        return true;  // Return true if email sent successfully
    }
    
} catch (Exception $e) {
   return false;
}

  }
}
?>