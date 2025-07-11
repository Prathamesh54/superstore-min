<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

require 'db.php';

$product_id = $_POST['product_id'];
$buy_qty    = (int)$_POST['quantity'];

// Get stock
$stmt = $pdo->prepare("SELECT quantity FROM inventory WHERE id = ?");
$stmt->execute([$product_id]);
$product = $stmt->fetch();

if (!$product || $product['quantity'] < $buy_qty) {
  echo "Insufficient stock or product not found.";
  exit;
}

// Update stock
$new_qty = $product['quantity'] - $buy_qty;
$stmt = $pdo->prepare("UPDATE inventory SET quantity = ? WHERE id = ?");
$stmt->execute([$new_qty, $product_id]);

header("Location: index.php");
exit;
?>
