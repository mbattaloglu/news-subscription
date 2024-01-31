<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
require "../utils/sendEmail/credentials.php";

function sendEmail(string $user)
{
    $credentials = new Credentials();

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    //These messages are debugged in the browser
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server
    $mail->Host = 'smtp-mail.outlook.com';

    $mail->Port = 587;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = $credentials->getSenderEmail();

    //Password to use for SMTP authentication
    $mail->Password = $credentials->getSenderPassword();

    $mail->setFrom($credentials->getSenderPassword());

    //Set who the message is to be sent to
    $mail->addAddress($user);

    //Set the subject line
    $mail->Subject = 'News Subscription';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->msgHTML(file_get_contents('../utils/sendEmail/contents.html'), '../utils/sendEmail/');

    //Replace the plain text body with one created manually
    $mail->AltBody = 'Email';

    //send the message, check for errors
    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
    }
    return true;
}
