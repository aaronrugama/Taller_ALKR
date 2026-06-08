<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Taller\Alkr\Controllers\ProblemaController;

$datos = ProblemaController::problema2();
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
        <p>La suma de los números del 1 al 1000 es:</p>
        <strong><?= $datos['resultado'] ?></strong>
    </main>
    <?php include __DIR__ . '/../../footer.php'; ?>
</body>
</html>