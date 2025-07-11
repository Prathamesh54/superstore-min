<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'user') {
  header("Location: login.php");
  exit;
}

require 'db.php';
$products = $pdo->query("SELECT * FROM inventory WHERE quantity > 0 ORDER BY name")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Buy Product</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body class="dashboard-bg"> <!-- ✅ Ensures overlay background -->
  <div class="form-box">
    <h2>Buy a Product</h2>
    <form action="process_purchase.php" method="POST">
      <select name="product_id" required>
        <option value="">Select Product</option>
        <?php foreach ($products as $p): ?>
          <option value="<?= $p['id'] ?>">
            <?= htmlspecialchars($p['name']) ?> (Stock: <?= $p['quantity'] ?>)
          </option>
        <?php endforeach; ?>
      </select>
      <input type="number" name="quantity" placeholder="Quantity" required min="1">
      <button type="submit">Buy</button>
    </form>
    <a href="index.php" class="btn">← Back to Dashboard</a>
  </div>
</body>
</html>
