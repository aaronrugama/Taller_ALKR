<?php
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 9 - Potencias</title>
    <link rel="stylesheet" href="../../Assets/css/style.css">
</head>
<body class="problema-9">

    <header class="header">
        <h1>Problema #9 &mdash; Potencias</h1>
        <p class="subtitulo">Las 15 primeras potencias de un número del 1 al 9</p>
    </header>

    <main class="contenedor">

        <?php if (!empty($datos['errores'])): ?>
            <div class="errores" role="alert">
                <p class="errores-titulo">Corrige los siguientes errores:</p>
                <?php foreach ($datos['errores'] as $error): ?>
                    <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario: un solo campo del 1 al 9 -->
        <div class="tarjeta">
            <p class="tarjeta-titulo">Ingresa la base</p>
            <p class="descripcion">
                Ingresa un número entero entre 1 y 9.
                El sistema calculará sus 15 primeras potencias.
            </p>

            <form method="POST">
                <div class="campo-unico">
                    <label for="numero">Número base (1 al 9)</label>
                    <input
                        type="text"
                        id="numero"
                        name="numero"
                        value="<?= htmlspecialchars($datos['valorIngresado'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="ej. 4"
                        autocomplete="off"
                    >
                </div>
                <button type="submit" class="btn-calcular">Generar potencias</button>
            </form>
        </div>

        <?php if (!empty($datos['mostrarResultados']) && !empty($datos['resultados'])): ?>
            <?php $r = $datos['resultados']; ?>

            <div class="tarjeta resultados">
                <p class="tarjeta-titulo">
                    15 primeras potencias de <?= $r['numero'] ?>
                </p>

                <table class="tabla-resultados" aria-label="Potencias">
                    <thead>
                        <tr>
                            <th>Expresión</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($r['potencias'] as $potencia): ?>
                            <tr>
                                <!-- number_format con 0 decimales para números enteros grandes -->
                                <td><?= $r['numero'] ?> <sup><?= $potencia['exponente'] ?></sup></td>
                                <td><?= number_format($potencia['resultado']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

        <div class="nav-menu">
            <?= Utilidades::enlaceMenu('../../index.php') ?>
        </div>

    </main>

    <?php require_once __DIR__ . '/../../footer.php'; ?>

</body>
</html>