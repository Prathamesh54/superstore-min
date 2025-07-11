<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

require 'db.php';

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];

$stmt = $pdo->prepare("INSERT INTO inventory (name, category, price, quantity) VALUES (?, ?, ?, ?)");
$stmt->execute([$name, $category, $price, $quantity]);

header("Location: index.php");
exit;
?>
