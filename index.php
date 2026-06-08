<?php
/**
 * index.php
 * Menú principal del proyecto.
 * Desde aquí el usuario navega a cada uno de los 9 problemas.
 * Es la primera página que se carga al abrir el proyecto.
 */

// Incluimos la navegación por si queremos usar sus funciones aquí en el futuro
require_once 'navigation.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taller - Mini Proyecto #2</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>

    <header>
        <h1>Mini Proyecto #2</h1>
        <p>Sentencias de Control y Clases &mdash; Desarrollo Web VII</p>
    </header>

    <main>
        <h2>Selecciona un problema</h2>

        <nav class="menu-problemas">
            <?php
            /**
             * Generamos los 9 enlaces del menú con un bucle for.
             * Así no repetimos el mismo HTML 9 veces (principio DRY del PDF).
             * Cada enlace apunta a Views/ProblemaN.php
             */
            for ($i = 1; $i <= 9; $i++):
            ?>
                <a href="Views/problema<?= $i ?>.php" class="btn-problema">
                    Problema #<?= $i ?>
                    <br>
                </a>
            <?php endfor; ?>
        </nav>
    </main>

    <?php
    // Footer externo con la fecha dinámica (requisito del PDF)
    require_once 'footer.php';
    ?>

</body>
</html>