<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  require 'db.php';

  $username = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && $password === $user['password']) {
    $_SESSION['user'] = $user['name'];
    $_SESSION['role'] = $user['role'];
    header("Location: index.php");
    exit;
  } else {
    $error = "Invalid username or password.";
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Supermart</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      background: url('assets/background.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.25);
      backdrop-filter: blur(12px);
      padding: 30px;
      border-radius: 18px;
      width: 100%;
      max-width: 360px;
      box-shadow: 0 0 20px rgba(0,0,0,0.25);
      text-align: center;
    }

    .login-container h1 {
      font-size: 32px;
      color: white;
      margin-bottom: 20px;
      text-shadow: 0 0 10px rgba(0,0,0,0.3);
    }

    .login-container form {
      background: white;
      padding: 25px;
      border-radius: 12px;
    }

    form input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #eef3ff;
    }

    form button {
      width: 100%;
      padding: 12px;
      background: #28a745;
      color: white;
      border: none;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    form button:hover {
      background: #218838;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Supermart</h1>
    <form method="POST">
      <h2 style="margin-bottom: 15px;">Login</h2>

      <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <input type="text" name="email" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
