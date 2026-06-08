<?php
/**
 * footer.php
 * Pie de página compartido por todas las vistas.
 * Se incluye con require_once al final de cada página.
 * La fecha se genera dinámicamente con date() cada vez que se carga.
 */

// date() devuelve la fecha actual del servidor en el formato que le indiques
// 'd/m/Y' = día/mes/año (ej: 27/05/2026)
$fechaHoy = date('d/m/Y');
?>

<footer>
    <p>Desarrollo Web VII &mdash; Universidad Tecnológica de Panamá</p>
    <p>Fecha de ejecución: <?= $fechaHoy ?></p>
    <p>Aaron López <br>Kevyn Reyes</p>
</footer>