<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Taller\Alkr\Controllers\ProblemaController;
use Taller\Alkr\Models\Utilidades;

$datos = ProblemaController::problema2();
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($datos['titulo']) ?></title>
    <link rel="stylesheet" href="../../assets/css/estilo.css">
</head>
<body>
    <main>
        <h1><?= htmlspecialchars($datos['titulo']) ?></h1>
        <p>La suma de los números del 1 al 1000 es:</p>
        <strong><?= $datos['resultado'] ?></strong>
    </main>

    <div class="nav-menu">
        <?= Utilidades::enlaceMenu('../../index.php') ?>
    </div>
    <?php include __DIR__ . '/../../footer.php'; ?>
</body>
</html>