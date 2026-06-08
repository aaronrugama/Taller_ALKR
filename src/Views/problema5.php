<?php
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 5 - Clasificación de Edades</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="problema-5">

    <header class="header">
        <h1>Problema #5 &mdash; Clasificación de Edades</h1>
        <p class="subtitulo">Clasifica 5 personas por rango etario y genera estadísticas</p>
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

        <!-- Formulario: 5 campos de edad -->
        <div class="tarjeta">
            <p class="tarjeta-titulo">Ingresar edades</p>
            <p class="descripcion">
                Ingresa la edad de 5 personas (0 a 120).
                El sistema las clasificará en: Niño (0-12),
                Adolescente (13-17), Adulto (18-64) o Adulto Mayor (65+).
            </p>

            <form method="POST">
                <div class="grilla-campos">
                    <?php
                    // Recuperar valores previos si los hay (DRY: un solo for para los 5 campos)
                    $previos = $datos['valoresIngresados'] ?? [];

                    for ($i = 0; $i < 5; $i++):
                        $valorPrevio = htmlspecialchars($previos[$i] ?? '', ENT_QUOTES, 'UTF-8');
                        $posicion    = $i + 1;
                    ?>
                        <div class="campo-grupo">
                            <label for="edad<?= $posicion ?>">Persona <?= $posicion ?></label>
                            <input
                                type="text"
                                id="edad<?= $posicion ?>"
                                name="edades[]"
                                value="<?= $valorPrevio ?>"
                                placeholder="ej. <?= $posicion * 10 ?>"
                                autocomplete="off"
                            >
                        </div>
                    <?php endfor; ?>
                </div>

                <button type="submit" class="btn-calcular">Clasificar edades</button>
            </form>
        </div>

        <?php if (!empty($datos['mostrarResultados']) && !empty($datos['resultados'])): ?>
            <?php $r = $datos['resultados']; ?>

            <!-- Tabla de clasificación por persona -->
            <div class="tarjeta resultados">
                <p class="tarjeta-titulo">Clasificación por persona</p>

                <table class="tabla-resultados" aria-label="Clasificación de edades">
                    <thead>
                        <tr>
                            <th>Persona</th>
                            <th>Edad</th>
                            <th>Categoría</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($r['personas'] as $persona): ?>
                            <tr>
                                <td>Persona <?= $persona['persona'] ?></td>
                                <td><?= $persona['edad'] ?> años</td>
                                <!-- La clase css refleja la categoría para poder colorearla -->
                                <td class="categoria categoria-<?= strtolower(str_replace(' ', '-', $persona['categoria'])) ?>">
                                    <?= $persona['categoria'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Estadísticas generales -->
            <div class="tarjeta">
                <p class="tarjeta-titulo">Estadísticas generales</p>

                <table class="tabla-resultados" aria-label="Estadísticas de edades">
                    <thead>
                        <tr>
                            <th>Estadístico</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Edad promedio</td>
                            <td><?= number_format($r['media'], 1) ?> años</td>
                        </tr>
                        <tr>
                            <td>Edad mínima</td>
                            <td><?= $r['minimo'] ?> años</td>
                        </tr>
                        <tr>
                            <td>Edad máxima</td>
                            <td><?= $r['maximo'] ?> años</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Distribución por categoría -->
                <p class="tarjeta-titulo" style="margin-top: 1.5rem;">Distribución por categoría</p>
                <table class="tabla-resultados" aria-label="Conteo por categoría">
                    <thead>
                        <tr>
                            <th>Categoría</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($r['conteoCategoria'] as $cat => $cantidad): ?>
                            <tr>
                                <td><?= htmlspecialchars($cat, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= $cantidad ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Edades repetidas: solo aparece si hay repeticiones -->
            <?php if (!empty($r['repetidas'])): ?>
                <div class="tarjeta">
                    <p class="tarjeta-titulo">Edades repetidas</p>
                    <table class="tabla-resultados" aria-label="Edades repetidas">
                        <thead>
                            <tr>
                                <th>Edad</th>
                                <th>Veces repetida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($r['repetidas'] as $edad => $veces): ?>
                                <tr>
                                    <td><?= $edad ?> años</td>
                                    <td><?= $veces ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <!-- Contenedor de la gráfica -->
            <!-- Los datos se pasan como JSON al JS para que Chart.js los lea -->
            <div class="tarjeta">
                <p class="tarjeta-titulo">Gráfica de distribución</p>
                <div class="grafica-contenedor">
                    <canvas id="graficaEdades"></canvas>
                </div>
            </div>

            <!-- Pasar los datos de PHP a JavaScript de forma segura -->
            <script>
                // json_encode convierte el arreglo PHP a JSON que JS puede leer
                // JSON_HEX_TAG previene XSS dentro de bloques script (OWASP)
                const datosGrafica = <?= json_encode($r['conteoCategoria'], JSON_HEX_TAG) ?>;
            </script>
            <script src="../../Assets/js/graficas.js"></script>

        <?php endif; ?>

        <div class="nav-menu">
            <?= Utilidades::enlaceMenu('../../index.php') ?>
        </div>

    </main>

    <?php require_once __DIR__ . '/../../footer.php'; ?>

</body>
</html>