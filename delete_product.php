<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user']) || !isset($_GET['id'])) {
  header('Location: login.php');
  exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM inventory WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
