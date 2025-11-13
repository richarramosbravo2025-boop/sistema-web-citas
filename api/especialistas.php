
<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
if (!isset($_SESSION['user'])) {
  http_response_code(401);
  echo json_encode(['error' => 'No autorizado']);
  exit;
}

require_once 'conexion.php';

$mysqli->query("CREATE TABLE IF NOT EXISTS especialistas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  especialidad VARCHAR(100),
  nombre VARCHAR(100),
  horario VARCHAR(100),
  contacto VARCHAR(50)
) ENGINE=InnoDB;");

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') {
  if ($id) {
    $stmt = $mysqli->prepare("SELECT * FROM especialistas WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    echo json_encode($res->fetch_assoc());
  } else {
    $res = $mysqli->query("SELECT * FROM especialistas ORDER BY id ASC");
    $out = [];
    while ($row = $res->fetch_assoc()) $out[] = $row;
    echo json_encode($out);
  }
  exit;
}

$body = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST') {
  $stmt = $mysqli->prepare("INSERT INTO especialistas (nombre, especialidad, horario, contacto) VALUES (?,?,?,?)");
  $stmt->bind_param('ssss', $body['nombre'], $body['especialidad'], $body['horario'], $body['contacto']);
  $stmt->execute();
  echo json_encode(['message' => 'Creado', 'id' => $mysqli->insert_id]);
  exit;
}

if ($method === 'PUT' && $id) {
  $stmt = $mysqli->prepare("UPDATE especialistas SET nombre=?, especialidad=?, horario=?, contacto=? WHERE id=?");
  $stmt->bind_param('ssssi', $body['nombre'], $body['especialidad'], $body['horario'], $body['contacto'], $id);
  $stmt->execute();
  echo json_encode(['message' => 'Actualizado']);
  exit;
}

if ($method === 'DELETE' && $id) {
  $stmt = $mysqli->prepare("DELETE FROM especialistas WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();
  echo json_encode(['message' => 'Eliminado']);
  exit;
}

http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
