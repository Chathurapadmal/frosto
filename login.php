<?php
session_start();
require 'includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($user = $result->fetch_assoc()) {
    if (!$user['is_verified']) {
      $error = "Please verify your email before logging in.";
    } elseif (password_verify($password, $user['password'])) {
      $_SESSION['user'] = $user;

      if ($user['role'] === 'admin') {
        $_SESSION['admin'] = true;
        header("Location: admin/dashboard.php");
      } else {
        header("Location: index.php");
      }
      exit;
    } else {
      $error = "Incorrect password.";
    }
  } else {
    $error = "User not found.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/login.css">
</head>
<title>Login</title>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
    <form method="POST">
      <input name="username" placeholder="Username" required><br>
      <input name="password" type="password" placeholder="Password" required><br>
      <button type="submit" class="btn">Login</button>
    </form>
  </div>
</body>
</html>
