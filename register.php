<?php
require 'includes/db.php';
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $email = trim($_POST['email']);
  $fullName = trim($_POST['full_name']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = 'user';
  $token = bin2hex(random_bytes(32));

  $check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
  $check->bind_param("ss", $username, $email);
  $check->execute();
  $check->store_result();

  if ($check->num_rows > 0) {
    $msg = "Username or Email already exists.";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, full_name, verification_token) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $email, $password, $role, $fullName, $token);
    $stmt->execute();

    $verifyLink = "http://localhost/tharunproject/project/verify.php?email=" . urlencode($email) . "&token=$token";

    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'contact.teamfrosto@gmail.com';
      $mail->Password = 'pqra phdr ztsy mfun';       
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;

      $mail->setFrom('contact.teamfrosto@gmail.com', 'Frosto');
      $mail->addAddress($email, $fullName);
      $mail->isHTML(true);
      $mail->Subject = 'Verify your Frosto account';
      $mail->Body = "
        Hi $fullName,<br><br>
        Please verify your account by clicking the link below:<br><br>
        <a href='$verifyLink'>$verifyLink</a><br><br>
        Thanks,<br>Frosto Team
      ";

      $mail->send();
      $msg = " Registered! A verification email was sent to <strong>$email</strong>.";
    } catch (Exception $e) {
      $msg = " Registration failed: {$mail->ErrorInfo}";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register | Frosto</title>
  <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
  <div class="form-container">
    <h2>Register</h2>
    <?php if ($msg): ?>
      <p style="color:green;"><?php echo $msg; ?></p>
    <?php endif; ?>

    <form method="POST">
      <input type="text" name="full_name" placeholder="Full Name" required><br>
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit" class="btn">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
  </div>
</body>
</html>
