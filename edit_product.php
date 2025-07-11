<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header('Location: login.php');
  exit;
}

require 'db.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM inventory WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
  echo "Product not found.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: url('assets/overlay.jpg') no-repeat center center ;background-size: cover;background-attachment: fixed; background-color: #f4f4f4; min-height: 100vh; margin: 0; padding: 0;">
  <div class="form-box">
    <h2>Edit Product</h2>
    <form action="update_product.php" method="POST">
      <input type="hidden" name="id" value="<?= $product['id'] ?>">
      <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
      <input type="text" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
      <input type="number" name="price" value="<?= $product['price'] ?>" required min="1">
      <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required min="0">
      <button type="submit">Update Product</button>
    </form>
    <a href="index.php" class="btn">← Back to Dashboard</a>
  </div>
</body>
</html>
