<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Log;

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

            // Set Reply-To (Optional)
            if (!empty($config['reply_to_address'])) {
                $mail->addReplyTo($config['reply_to_address'], $config['reply_to_name'] ?? '');
            }

            // Recipient
            if (empty($config['recipient_address'])) {
                throw new Exception("Recipient address is required.");
            }

            $recipientAddress = $config['recipient_address'];
            $recipientName = $config['recipient_name'] ?? '';
            $mail->addAddress($recipientAddress, $recipientName);

            // Email Content
            if (empty($config['subject']) || empty($config['body'])) {
                throw new Exception("Email subject and body are required.");
            }

            $mail->isHTML(true);
            $mail->Subject = $config['subject'];
            $mail->Body    = $config['body'];

            // Attachments (Optional)
            if (!empty($config['attachments']) && is_array($config['attachments'])) {
                foreach ($config['attachments'] as $attachment) {
                    if (file_exists($attachment)) {
                        $mail->addAttachment($attachment);
                    }
                }
            }

            // Send email
            if ($mail->send()) {
                return true;
            } else {
                throw new Exception("Email sending failed.");
            }
        } catch (Exception $e) {
            Log::error("Email Error: " . $e->getMessage());
            return false;
        }
    }
}
?>
