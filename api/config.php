<?php
// 🔧 AJUSTA ESTOS DATOS A TU MYSQL
$host    = 'localhost';
$db      = 'clinica';       // nombre de tu base de datos
$user    = 'root';          // usuario MySQL
$pass    = '';              // contraseña MySQL (si tienes)

// --------------------------------------------
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'error_db';
    exit;
}
