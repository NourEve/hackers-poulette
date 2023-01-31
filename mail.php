<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_mail($to)
{
    $mail = new PHPMailer(true);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.mailtrap.io';
    $mail->SMTPAuth   = true;

    require "./config.php";
    $mail->Username   = $USER_NAME;
    $mail->Password   = $PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 2525;

    //Recipients
    $mail->setFrom($FROM_ADRESS, 'Hackers Poulette');
    $mail->addAddress($to);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Order confirmation';
    //$mail->Body    = 'We have received your order, it will be delivery soon !';
    $mail->Body = file_get_contents('./mail-template.php');
    $mail->send();
}
