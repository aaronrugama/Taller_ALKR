<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 1</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="problema-1">
    <header class="header">
        <h1>Problema #1 &mdash; Estadísticas Básicas</h1>
        <p class="subtitulo">Media, Desviación Estándar, Mínimo y Máximo</p>
    </header>
    <main class="contenedor">
        <?php
        // Código PHP para calcular estadísticas básicas
        //Mostrar errores y validaciones si existen
        if (!empty($datos['errores'])): ?>
            <div class="errores" role="alert">
                <p class="errores-titulo">Corrige los siguientes errores:</p>
                <?php foreach ($datos['errores'] as $error): ?>
                    <!-- Sanitización aplicada en el modelo; aquí htmlspecialchars como capa extra -->
                    <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <!-- Tarjeta del formulario -->
    <div class="tarjeta">
        <p class="tarjeta-titulo">Ingresar 5 números positivos</p>

        <p class="descripcion">
            Ingresa exactamente 5 números positivos. El sistema calculará
            la media aritmética, la desviación estándar, el valor mínimo y el máximo.
        </p>

        <!--
            Formulario con método POST.
            Los campos se nombran numeros[] para enviarse como arreglo PHP.
            No se usa action= para que apunte al mismo archivo.
        -->
        <form method="POST">

            <div class="grilla-campos">
                <?php
                // Recuperar valores previos si los hay (para repoblar el formulario tras error)
                $previos = $datos['valoresIngresados'] ?? [];

                // Generar los 5 campos de forma dinámica (DRY: no repetir el mismo HTML 5 veces)
                for ($i = 0; $i < 5; $i++):
                    $valorPrevio = htmlspecialchars($previos[$i] ?? '', ENT_QUOTES, 'UTF-8');
                    $posicion    = $i + 1;
                ?>
                    <div class="campo-grupo">
                        <label for="num<?= $posicion ?>">Número <?= $posicion ?></label>
                        <input
                            type="text"
                            id="num<?= $posicion ?>"
                            name="numeros[]"
                            value="<?= $valorPrevio ?>"
                            placeholder="ej. <?= $posicion * 3 ?>"
                            autocomplete="off"
                        >
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn-calcular">Calcular estadísticas</button>
        </form>
    </div>

    <?php
    // Mostrar la tabla de resultados solo si el procesamiento fue exitoso
    if (!empty($datos['mostrarResultados']) && !empty($datos['resultados'])):
        $r = $datos['resultados'];
    ?>
        <div class="tarjeta resultados">
            <p class="tarjeta-titulo">Resultados</p>

            <table class="tabla-resultados" aria-label="Estadísticas calculadas">
                <thead>
                    <tr>
                        <th>Estadístico</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Media aritmética</td>
                        <!-- number_format limita los decimales a 4 para legibilidad -->
                        <td><?= number_format($r['media'], 4) ?></td>
                    </tr>
                    <tr>
                        <td>Desviación estándar</td>
                        <td><?= number_format($r['desviacion'], 4) ?></td>
                    </tr>
                    <tr>
                        <td>Valor mínimo</td>
                        <td><?= number_format($r['minimo'], 4) ?></td>
                    </tr>
                    <tr>
                        <td>Valor máximo</td>
                        <td><?= number_format($r['maximo'], 4) ?></td>
                    </tr>
                </tbody>
            </table>

            <!-- Mostrar los números que se usaron en el cálculo -->
            <p class="numeros-ingresados">
                Números procesados:
                <?php foreach ($r['numeros'] as $n): ?>
                    <span><?= number_format($n, 2) ?></span>
                <?php endforeach; ?>
            </p>
        </div>
    <?php endif; ?>

    <!-- Enlace de regreso al menú (centralizado en Utilidades, principio DRY) -->
    <div class="nav-menu">
        <?= Utilidades::enlaceMenu('../../index.php') ?>
    </div>
   
    </main>
</body>
</html>