<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailgun{

    public $msg_error = '';
    public $from = 'service@faninsights.io';
    
    function __construct()
    {
    }

    /*
    */
    public function service_mail($mail_to=null, $mail_title=null, $mail_body=null, $bcc = array(), $FromName=null, $attachment_file=null, $attachment_file_name=null)
    {
        if($mail_to)
        {
            require_once(FCPATH.'includes/PHPMailer/PHPMailerAutoload.php');
            $address = $mail_to;

            $mail = new PHPMailer();
            
            $mail->IsSMTP(); // enable SMTP
            $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            //$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
            $mail->SMTPSecure = 'tls';

            $mail->Host = WWW_SMTP_HOST;
            $mail->Username = WWW_SMTP_USERNAME;   // SMTP username
            $mail->Password = WWW_SMTP_PASSWORD;                           // SMTP password

            $mail->From = $this->from;
            $mail->FromName = $FromName? $FromName:'系統管理員';
            foreach ($bcc as $bcc_email => $name) {
                $mail->addBCC($bcc_email, $name);
            }

            
            $mail->CharSet = 'utf-8';
            $mail->Encoding = 'base64';
            $mail->IsHTML(true);
            $mail->Subject = $mail_title;
            $mail->Body = $mail_body;
            $mail->AddAddress($mail_to);

            if($attachment_file)
            {
                $mail->AddAttachment(
                    $attachment_file,
                    $attachment_file_name,
                    'base64',
                    'mime/type'
                );
            }
            if(!$mail->Send())
            {
                $this->msg_error = "Mailer Error: " . $mail->ErrorInfo;
                // mail error & log
                return false;
            }
            else
            {
                // mail success & log
                return true;
            }
        }
    }
}