<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Taller\Alkr\Controllers\ProblemaController;
use Taller\Alkr\Models\Utilidades;

$datos = ProblemaController::problema4();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($datos['titulo']) ?></title>
    <link rel="stylesheet" href="../../Assets/css/estilo.css">
</head>
<body>
    <main>
        <h1><?= htmlspecialchars($datos['titulo']) ?></h1>
        <p>Suma de números <strong>pares</strong> (1–200): <strong><?= $datos['pares'] ?></strong></p>
        <p>Suma de números <strong>impares</strong> (1–200): <strong><?= $datos['impares'] ?></strong></p>
    </main>

    <div class="nav-menu">
        <?= Utilidades::enlaceMenu('../../index.php') ?>
    </div>
        <?php include __DIR__ . '/../../footer.php'; ?>
</body>
</html>