<?php
require_once '../db.php';
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($posts);