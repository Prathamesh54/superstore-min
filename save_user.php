<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

require 'db.php';

$name     = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password']; // Plain text
$role     = $_POST['role'];

$stmt = $pdo->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $username, $password, $role]);

header("Location: index.php");
exit;
?>
