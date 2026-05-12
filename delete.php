<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied";
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM pickups WHERE id = ?");
$stmt->execute([$id]);

header("Location: admin.php");
exit();