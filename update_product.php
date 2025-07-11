<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header('Location: login.php');
  exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
  $name = trim($_POST['name'] ?? '');
  $category = trim($_POST['category'] ?? '');
  $price = (float) ($_POST['price'] ?? 0);
  $quantity = (int) ($_POST['quantity'] ?? 0);

  if ($id > 0 && $name && $category && $price >= 0 && $quantity >= 0) {
    $stmt = $pdo->prepare("UPDATE inventory SET name = ?, category = ?, price = ?, quantity = ? WHERE id = ?");
    $stmt->execute([$name, $category, $price, $quantity, $id]);
  }
}

header("Location: index.php");
exit;
