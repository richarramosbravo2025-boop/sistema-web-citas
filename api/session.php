
<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
echo json_encode(['auth' => isset($_SESSION['user']), 'user' => $_SESSION['user'] ?? null]);
