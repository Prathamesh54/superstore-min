<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
  header('Location: login.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: url('assets/overlay.jpg') no-repeat center center ;background-size: cover;background-attachment: fixed; background-color: #f4f4f4; min-height: 100vh; margin: 0; padding: 0;">
  <div class="form-box">
    <h2>Add New Product</h2>
    <form action="insert_product.php" method="POST">
      <input type="text" name="name" placeholder="Product Name" required>
      <input type="text" name="category" placeholder="Category" required>
      <input type="number" name="price" placeholder="Price" required min="1">
      <input type="number" name="quantity" placeholder="Quantity" required min="0">
      <button type="submit">Save Product</button>
    </form>
    <a href="index.php" class="btn">← Back to Dashboard</a>
  </div>
</body>
</html>
