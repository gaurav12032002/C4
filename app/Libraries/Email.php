<?php
namespace App\Libraries;
$rdir = str_replace("\\", "/", __DIR__);                    //Root Dir
require $rdir.'/PHPMailer/src/Exception.php';
require $rdir.'/PHPMailer/src/PHPMailer.php';
require $rdir.'/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{
    public function sendEmail($to, $subject, $message)
    {
        $mail = new PHPMailer(true);
       
        try {
            //Server settings
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp-pulse.com';                    
            $mail->SMTPAuth   = false;                                  
            $mail->Username   = 'gkthakur2922@gmail.com';              
            $mail->Password   = 'Q4FZXHdsQc7K';                        
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
            $mail->Port       = 587;    
            
            $mail->SMTPDebug = 1;

            //Recipients
            $mail->setFrom('gkthakur2922@gmail.com', 'Gaurav');
            $mail->addAddress($to);    

            // Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $message;

            // Send email
            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}