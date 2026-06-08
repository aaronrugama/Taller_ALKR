<?php
// La vista usa $datos preparados por el controlador desde menu.php
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 3 - Múltiplos de 4</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="problema-3">

    <header class="header">
        <h1>Problema #3 &mdash; Múltiplos de 4</h1>
        <p class="subtitulo">Genera los primeros N múltiplos de 4</p>
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

        <!-- Formulario: pide un solo número N -->
        <div class="tarjeta">
            <p class="tarjeta-titulo">Ingresa el valor de N</p>
            <p class="descripcion">
                Ingresa un número entero entre 1 y 1000.
                El sistema generará los primeros N múltiplos de 4.
                El límite de 1000 previene desbordamiento en los cálculos.
            </p>

            <form method="POST">
                <div class="campo-unico">
                    <label for="n">Cantidad de múltiplos (N)</label>
                    <input
                        type="text"
                        id="n"
                        name="n"
                        value="<?= htmlspecialchars($datos['valorIngresado'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        placeholder="ej. 10"
                        autocomplete="off"
                    >
                </div>
                <button type="submit" class="btn-calcular">Generar múltiplos</button>
            </form>
        </div>

        <?php if (!empty($datos['mostrarResultados']) && !empty($datos['resultados'])): ?>
            <?php $r = $datos['resultados']; ?>

            <div class="tarjeta resultados">
                <p class="tarjeta-titulo">
                    Primeros <?= $r['n'] ?> múltiplos de 4
                </p>

                <table class="tabla-resultados" aria-label="Múltiplos de 4">
                    <thead>
                        <tr>
                            <th>Operación</th>
                            <th>Resultado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($r['multiplos'] as $multiplo): ?>
                            <tr>
                                <td>4 &times; <?= $multiplo['factor'] ?></td>
                                <td><?= $multiplo['resultado'] ?></td>
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