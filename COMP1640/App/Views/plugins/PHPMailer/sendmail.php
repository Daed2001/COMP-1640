<?php
include  APPROOT . '/Views/plugins/PHPMailer/PHPmailer/PHPMailer.php';
include  APPROOT . '/Views/plugins/PHPMailer/PHPmailer/SMTP.php';
include  APPROOT . '/Views/plugins/PHPMailer/PHPmailer/Exception.php';
include  APPROOT . '/Views/plugins/PHPMailer/PHPmailer/OAuth.php';
include  APPROOT . '/Views/plugins/PHPMailer/PHPmailer/POP3.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendmails($subject,$body,$receive){
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'thisismyprojecttest@gmail.com';                 // SMTP username
    $mail->Password = 'ratrzyljgsuzpaii';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
 
    //Recipients
    $mail->setFrom('thisismyprojecttest@gmail.com', 'Mailer');
    foreach ($receive as $row){
        $mail->addAddress(''.$row['email'].'', ''.$row['fullname'].'');
    }
         // Add a recipient
    // $mail->addAddress('janegeftlick893@gmail.com','John');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('thisismyprojecttest@gmail.com');
    $mail->addCC('janegeftlick893@gmail.com');
    // $mail->addBCC('bcc@example.com');
 
    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 
    $mail->send();
    
} catch (Exception $e) {
    
}
}
?>