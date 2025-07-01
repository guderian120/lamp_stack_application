<?php
require_once 'config.php';

// Check if the request is coming from index.php
if (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'], 'index.php') === false) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>