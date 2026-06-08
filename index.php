<?php
/**
 * index.php
 * Menú principal del proyecto.
 * Desde aquí el usuario navega a cada uno de los 9 problemas.
 * Es la primera página que se carga al abrir el proyecto.
 */
require_once __DIR__ . '/vendor/autoload.php';

// Incluimos la navegación por si queremos usar sus funciones aquí en el futuro
require_once __DIR__ . '/navigation.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller - Mini Proyecto</title>
    <link rel="stylesheet" href="assets/css/menu.css">
</head>
<body>

    <header class="menu-header">
        <h1>Mini Proyecto</h1>
        <p>Desarrollo de Software VII &mdash; Universidad Tecnológica de Panamá</p>
    </header>

    <main>
        <h2>Selecciona un problema</h2>

        <nav class="menu-problemas">
            <?php
            /**
             * Generamos los 9 enlaces del menú con un bucle for.
             * Así no repetimos el mismo HTML 9 veces (principio DRY).
             * Cada enlace apunta a Views/ProblemaN.php
             */
            for ($i = 1; $i <= 9; $i++):
            ?>
                <a href="src/Views/menu.php?problema=<?= $i ?>" class="btn-problema">
                    <span class="btn-numero"><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?></span>
                    <span class="btn-etiqueta">Problema #<?= $i ?></span>
                </a>
            <?php endfor; ?>
        </nav>
    </main>

    <?php
    // Footer externo con la fecha dinámica
    require_once 'footer.php';
    ?>

</body>
</html>