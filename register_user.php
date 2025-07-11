<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register User</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="dashboard-bg">
  <div class="form-box">
    <h2>Register New User</h2>
    <form action="save_user.php" method="POST">
      <input type="text" name="name" placeholder="Name" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <select name="role" required>
        <option value="">Select Role</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
      <button type="submit">Register</button>
    </form>
    <a href="index.php" class="btn">← Back to Dashboard</a>
  </div>
</body>
</html>
