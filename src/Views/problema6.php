<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Taller\Alkr\Controllers\ProblemaController;

$datos = ProblemaController::problema6();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($datos['titulo']) ?></title>
    <link rel="stylesheet" href="../../Assets/css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <main>
        <h1><?= htmlspecialchars($datos['titulo']) ?></h1>

        <form method="POST">
            <label for="presupuesto">Presupuesto anual ($):</label>
            <input type="number" id="presupuesto" name="presupuesto" min="1" step="0.01"
                   value="<?= htmlspecialchars($datos['presupuesto'] ?? '') ?>" required>
            <button type="submit">Calcular</button>
        </form>

        <?php if ($datos['resultado']): ?>
            <h2>Distribución del presupuesto: $<?= number_format($datos['presupuesto'], 2) ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Área</th>
                        <th>Porcentaje</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos['resultado'] as $area => $monto): ?>
                    <tr>
                        <td><?= htmlspecialchars($area) ?></td>
                        <td><?= match($area) {
                            'Ginecología'   => '40%',
                            'Traumatología' => '35%',
                            'Pediatría'     => '25%',
                        } ?></td>
                        <td>$<?= number_format($monto, 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div style="width: 300px; height: 300px;">
            <canvas id="graficaPresupuesto"></canvas>
            </div>

            <script src="../../Assets/js/graficas.js"></script>
            <script>
                renderizarGraficaPresupuesto(
                    <?= $datos['resultado']['Ginecología'] ?>,
                    <?= $datos['resultado']['Traumatología'] ?>,
                    <?= $datos['resultado']['Pediatría'] ?>
                );
            </script>
        <?php endif; ?>
    </main>
</body>
</html>