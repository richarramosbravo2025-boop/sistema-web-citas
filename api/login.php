
<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
require_once 'conexion.php';

$input = json_decode(file_get_contents('php://input'), true);
$usuario = $input['usuario'] ?? '';
$contrasena = $input['contrasena'] ?? '';

$mysqli->query("CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario VARCHAR(50) UNIQUE,
  contraseña VARCHAR(255) NOT NULL
) ENGINE=InnoDB;");

$res = $mysqli->query("SELECT COUNT(*) c FROM usuarios");
$row = $res->fetch_assoc();
if ((int)$row['c'] === 0) {
  $hash = password_hash('admin123', PASSWORD_DEFAULT);
  $mysqli->query("INSERT INTO usuarios(usuario, contraseña) VALUES('admin', '{$hash}')");
}

$stmt = $mysqli->prepare("SELECT id, usuario, contraseña FROM usuarios WHERE usuario=? LIMIT 1");
$stmt->bind_param('s', $usuario);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($contrasena, $user['contraseña'])) {
  $_SESSION['user'] = ['id' => $user['id'], 'usuario' => $user['usuario']];
  echo json_encode(['auth' => true]);
} else {
  http_response_code(401);
  echo json_encode(['auth' => false, 'message' => 'Credenciales inválidas']);
}
