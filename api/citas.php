<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$mysqli->query("CREATE TABLE IF NOT EXISTS citas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  paciente VARCHAR(100),
  especialidad VARCHAR(100),
  fecha DATE,
  hora TIME,
  motivo VARCHAR(200)
) ENGINE=InnoDB;");

$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

if ($method === 'GET') {
    if ($id) {
        $stmt = $mysqli->prepare("SELECT * FROM citas WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        echo json_encode($res->fetch_assoc());
    } else {
        $res = $mysqli->query("SELECT * FROM citas ORDER BY fecha ASC, hora ASC");
        $out = [];
        while ($row = $res->fetch_assoc()) $out[] = $row;
        echo json_encode($out);
    }
    exit;
}

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    $stmt = $mysqli->prepare("INSERT INTO citas (paciente, especialidad, fecha, hora, motivo) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss', $body['paciente'], $body['especialidad'], $body['fecha'], $body['hora'], $body['motivo']);
    $stmt->execute();
    echo json_encode(['message' => 'Cita registrada', 'id' => $mysqli->insert_id]);
    exit;
}

if ($method === 'PUT' && $id) {
    $body = json_decode(file_get_contents('php://input'), true);
    $stmt = $mysqli->prepare("UPDATE citas SET paciente=?, especialidad=?, fecha=?, hora=?, motivo=? WHERE id=?");
    $stmt->bind_param('sssssi', $body['paciente'], $body['especialidad'], $body['fecha'], $body['hora'], $body['motivo'], $id);
    $stmt->execute();
    echo json_encode(['message' => 'Cita actualizada']);
    exit;
}

if ($method === 'DELETE' && $id) {
    $stmt = $mysqli->prepare("DELETE FROM citas WHERE id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    echo json_encode(['message' => 'Cita eliminada']);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Método no permitido']);
