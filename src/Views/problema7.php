<?php
/** @var array $datos */
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 7 - Calculadora de Notas</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body class="problema-7">

    <header class="header">
        <h1>Problema #7 &mdash; Calculadora de Notas</h1>
        <p class="subtitulo">Estadísticas de un conjunto de notas ingresadas por el usuario</p>
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

        <?php
        // $datos['fase'] determina qué formulario mostrar.
        // Fase 1: pedir cantidad. Fase 2: pedir las notas.
        $fase = $datos['fase'] ?? 1;
        ?>

        <?php if ($fase === 1): ?>
            <!-- Fase 1: el usuario indica cuántas notas quiere ingresar -->
            <div class="tarjeta">
                <p class="tarjeta-titulo">Paso 1 de 2 — Cantidad de notas</p>
                <p class="descripcion">
                    Indica cuántas notas deseas ingresar (entre 1 y 50).
                </p>

                <form method="POST">
                    <!-- Campo oculto que le dice al controlador en qué fase estamos -->
                    <input type="hidden" name="fase" value="1">

                    <div class="campo-unico">
                        <label for="cantidad">Cantidad de notas</label>
                        <input
                            type="text"
                            id="cantidad"
                            name="cantidad"
                            value="<?= htmlspecialchars($_POST['cantidad'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                            placeholder="ej. 5"
                            autocomplete="off"
                        >
                    </div>

                    <button type="submit" class="btn-calcular">Continuar</button>
                </form>
            </div>

        <?php elseif ($fase === 2 && empty($datos['mostrarResultados'])): ?>
            <!-- Fase 2: el usuario ingresa las notas -->
            <div class="tarjeta">
                <p class="tarjeta-titulo">Paso 2 de 2 — Ingresar <?= (int)$datos['cantidad'] ?> notas</p>
                <p class="descripcion">
                    Ingresa cada nota entre 0 y 100. Pueden ser decimales (ej. 85.5).
                </p>

                <form method="POST">
                    <!-- Enviamos fase y cantidad para que el controlador sepa el contexto -->
                    <input type="hidden" name="fase"     value="2">
                    <input type="hidden" name="cantidad" value="<?= (int)$datos['cantidad'] ?>">

                    <div class="grilla-campos">
                        <?php
                        $cantidad = (int)$datos['cantidad'];
                        $previos  = $datos['valoresIngresados'] ?? [];

                        // foreach recorre la cantidad de notas pedidas (requisito del PDF)
                        // range() genera un arreglo [0, 1, 2, ..., cantidad-1]
                        foreach (range(0, $cantidad - 1) as $i):
                            $valorPrevio = htmlspecialchars($previos[$i] ?? '', ENT_QUOTES, 'UTF-8');
                            $posicion    = $i + 1;
                        ?>
                            <div class="campo-grupo">
                                <label for="nota<?= $posicion ?>">Nota <?= $posicion ?></label>
                                <input
                                    type="text"
                                    id="nota<?= $posicion ?>"
                                    name="notas[]"
                                    value="<?= $valorPrevio ?>"
                                    placeholder="ej. 75"
                                    autocomplete="off"
                                >
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" class="btn-calcular">Calcular estadísticas</button>
                </form>
            </div>

        <?php endif; ?>

        <!-- Resultados: solo aparece cuando mostrarResultados es true -->
        <?php if (!empty($datos['mostrarResultados']) && !empty($datos['resultados'])): ?>
            <?php $r = $datos['resultados']; ?>

            <div class="tarjeta resultados">
                <p class="tarjeta-titulo">Estadísticas de <?= $r['cantidad'] ?> notas</p>

                <table class="tabla-resultados" aria-label="Estadísticas de notas">
                    <thead>
                        <tr>
                            <th>Estadístico</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Promedio</td>
                            <td><?= number_format($r['promedio'], 2) ?></td>
                        </tr>
                        <tr>
                            <td>Desviación estándar</td>
                            <td><?= number_format($r['desviacion'], 2) ?></td>
                        </tr>
                        <tr>
                            <td>Nota mínima</td>
                            <td><?= number_format($r['minima'], 2) ?></td>
                        </tr>
                        <tr>
                            <td>Nota máxima</td>
                            <td><?= number_format($r['maxima'], 2) ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Mostrar las notas ingresadas -->
                <p class="numeros-ingresados">
                    Notas ingresadas:
                    <?php foreach ($r['notas'] as $nota): ?>
                        <span><?= number_format($nota, 1) ?></span>
                    <?php endforeach; ?>
                </p>
            </div>

            <!-- Botón para calcular con notas diferentes sin recargar todo -->
            <div class="tarjeta">
                <p class="tarjeta-titulo">Calcular de nuevo</p>
                <form method="POST">
                    <input type="hidden" name="fase" value="1">
                    <button type="submit" class="btn-calcular">Ingresar nuevas notas</button>
                </form>
            </div>

        <?php endif; ?>

        <div class="nav-menu">
            <?= Utilidades::enlaceMenu('../../index.php') ?>
        </div>

    </main>

    <?php require_once __DIR__ . '/../../footer.php'; ?>

</body>
</html>