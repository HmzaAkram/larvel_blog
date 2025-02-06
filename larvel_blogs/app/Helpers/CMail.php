<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class CMail
{
    public static function sendEmail($config)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = config('services.mail.host');
            $mail->SMTPAuth   = true;
            $mail->Username   = config('services.mail.username');
            $mail->Password   = config('services.mail.password');
            $mail->SMTPSecure = config('services.mail.encryption');
            $mail->Port       = config('services.mail.port');

            // Set From Address
            $fromAddress = $config['from_address'] ?? config('services.mail.from_address');
            $fromName = $config['from_name'] ?? config('services.mail.from_name');
            $mail->setFrom($fromAddress, $fromName);

            // Recipient
            $recipientAddress = $config['recipient_address'];
            $recipientName = $config['recipient_name'] ?? null;
            $mail->addAddress($recipientAddress, $recipientName);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = $config['subject'];
            $mail->Body    = $config['body'];

            if ($mail->send()) {
                return true; // Email sent successfully
            } else {
                return false;
            }
        } catch (Exception $e) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}
?>
