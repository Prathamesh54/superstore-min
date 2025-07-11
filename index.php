<?php
session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

require 'db.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$sql = "SELECT * FROM inventory";
$params = [];

if ($search !== '') {
  $sql .= " WHERE name LIKE ? OR category LIKE ?";
  $params = ["%$search%", "%$search%"];
}

$sql .= " ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Inventory Dashboard</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body style="background: url('assets/overlay.jpg') no-repeat center center ;background-size: cover;background-attachment: fixed; background-color: #f4f4f4; min-height: 100vh; margin: 0; padding: 0;">
  <div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center;">
      <h1>Inventory Dashboard</h1>
      <span style="font-size: 22px; font-weight: bold; color: #007bff;">Supermart</span>
    </div>

    <p>Welcome, <strong><?= htmlspecialchars($_SESSION['user']) ?> (<?= $_SESSION['role'] ?>)</strong></p>

    <div style="margin-bottom: 10px;">
      <?php if ($_SESSION['role'] === 'admin'): ?>
        <a href="add_product.php" class="btn">+ Add Product</a>
        <a href="register_user.php" class="btn">+ Register New User</a>
      <?php else: ?>
        <a href="buy_product.php" class="btn">Buy Product</a>
      <?php endif; ?>
      <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <form method="GET" style="margin-top: 15px;">
      <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($search) ?>">
      <button type="submit">Search</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price (₹)</th>
          <th>Quantity</th>
          <?php if ($_SESSION['role'] === 'admin'): ?><th>Actions</th><?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php if (count($products) > 0): ?>
          <?php foreach ($products as $product): ?>
            <tr class="<?= $product['quantity'] < 5 ? 'low-stock' : '' ?>">
              <td><?= $product['id'] ?></td>
              <td><?= htmlspecialchars($product['name']) ?></td>
              <td><?= htmlspecialchars($product['category']) ?></td>
              <td><?= $product['price'] ?></td>
              <td><?= $product['quantity'] ?></td>
              <?php if ($_SESSION['role'] === 'admin'): ?>
                <td>
                  <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn-small">Edit</a>
                  <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn-small red" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="<?= $_SESSION['role'] === 'admin' ? '6' : '5' ?>">No products found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
