
<?php
$DB_HOST = getenv('DB_HOST') ?: '127.0.0.1';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_NAME = getenv('DB_NAME') ?: 'clinica_db';

$mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS);
if ($mysqli->connect_errno) {
  http_response_code(500);
  echo json_encode(['error' => 'No se pudo conectar al servidor MySQL']);
  exit;
}
$mysqli->query("CREATE DATABASE IF NOT EXISTS `$DB_NAME` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
$mysqli->select_db($DB_NAME);
$mysqli->set_charset("utf8mb4");
?>
