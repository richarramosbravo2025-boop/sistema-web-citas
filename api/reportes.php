<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$tipo = $_GET['tipo'] ?? '';


if ($tipo === 'citas_por_especialidad') {
  $sql = "SELECT especialidad, COUNT(*) AS total
            FROM citas
            GROUP BY especialidad
            ORDER BY total DESC";

  $res = $mysqli->query($sql);
  $out = [];
  while ($row = $res->fetch_assoc()) {
    $out[$row['especialidad']] = (int)$row['total'];
  }
  echo json_encode($out, JSON_UNESCAPED_UNICODE);
  exit;
}


if ($tipo === 'citas_por_mes') {
  $sql = "SELECT MONTH(fecha) AS mes, COUNT(*) AS total
            FROM citas
            GROUP BY MONTH(fecha)
            ORDER BY mes";

  $res = $mysqli->query($sql);

  $mesesTxt = [
    1 => 'Enero',
    2 => 'Febrero',
    3 => 'Marzo',
    4 => 'Abril',
    5 => 'Mayo',
    6 => 'Junio',
    7 => 'Julio',
    8 => 'Agosto',
    9 => 'Septiembre',
    10 => 'Octubre',
    11 => 'Noviembre',
    12 => 'Diciembre'
  ];

  $labels = [];
  $totales = [];

  while ($row = $res->fetch_assoc()) {
    $labels[] = $mesesTxt[(int)$row['mes']];
    $totales[] = (int)$row['total'];
  }

  echo json_encode(['meses' => $labels, 'totales' => $totales], JSON_UNESCAPED_UNICODE);
  exit;
}

echo json_encode(['error' => 'Tipo de reporte no válido']);
exit;
