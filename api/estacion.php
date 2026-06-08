<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Taller\Alkr\Controllers\ProblemaController;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$mes = isset($_GET['mes']) ? (int)$_GET['mes'] : 0;
$dia = isset($_GET['dia']) ? (int)$_GET['dia'] : 0;

if ($mes < 1 || $mes > 12 || $dia < 1 || $dia > 31) {
    http_response_code(400);
    echo json_encode(['error' => 'Fecha inválida']);
    exit;
}

echo json_encode(ProblemaController::problema8Json($mes, $dia));