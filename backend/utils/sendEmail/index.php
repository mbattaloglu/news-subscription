<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../vendor/autoload.php';
require "../utils/sendEmail/credentials.php";

function sendEmail(string $email)
{
    //Outlook SMTP settings
    //https://support.microsoft.com/en-gb/office/pop-imap-and-smtp-settings-for-outlook-com-d088b986-291d-42b8-9564-9c414e2aa040

    $credentials = new Credentials();

    //Create a new PHPMailer instance
    $mail = new PHPMailer();

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    //SMTP::DEBUG_OFF = off (for production use)
    //SMTP::DEBUG_CLIENT = client messages
    //SMTP::DEBUG_SERVER = client and server messages
    //These messages are debugged in the browser if you go directly this endpoint
    $mail->SMTPDebug = SMTP::DEBUG_OFF;

    //Set the hostname of the mail server
    $mail->Host = 'smtp-mail.outlook.com';

    //Port
    $mail->Port = 587;

    //Outlook needs STARTTLS
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication
    $mail->Username = $credentials->getSenderEmail();

    //Password to use for SMTP authentication
    $mail->Password = $credentials->getSenderPassword();

    //Sender Information, which user will see
    $mail->setFrom($credentials->getSenderEmail(), $credentials->getSenderName());

    //Set who the message is to be sent to
    $mail->addAddress($email);

    //Set the subject
    $mail->Subject = 'News Subscription';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    $mail->msgHTML(file_get_contents('../utils/sendEmail/contents.html'), '../utils/sendEmail/');

    //Alternative body
    $mail->AltBody = 'Hi! Your subscription is successful.';

    //send the message, check for errors
    if (!$mail->send()) {
        throw new Exception($mail->ErrorInfo);
    }
    return true;
}
