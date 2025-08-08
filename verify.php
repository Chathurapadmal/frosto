<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'contact.teamfrosto@gmail.com';     
  $mail->Password = 'pqra phdr ztsy mfun';            
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  $mail->setFrom('contact.teamfrosto@gmail.com', 'frosto');
  $mail->addAddress($email, $fullName);

  
  $mail->isHTML(true);
  $mail->Subject = 'Verify Your Account';
  $mail->Body    = "Hi $fullName,<br><br>
    Please verify your account by clicking the link below:<br>
    <a href='$verifyLink'>$verifyLink</a><br><br>Thanks,<br>Frosto Team";

  $mail->send();
  $msg = "Registered! A verification email has been sent to <strong>$email</strong>.";
} catch (Exception $e) {
  $msg = " Error sending email: {$mail->ErrorInfo}";
}

?>

