<?php
/**
 * menu.php
 * Punto de entrada único para todos los problemas.
 * Lee el parámetro ?problema= de la URL y carga la vista correspondiente.
 * Así cada vista no necesita instanciar su propio controlador.
 */

require_once __DIR__ . '/../../vendor/autoload.php';

use Taller\Alkr\Controllers\ProblemaController;

// Leer el número de problema desde la URL (?problema=1)
// filter_input es más seguro que $_GET directo
$numeroproblema = filter_input(INPUT_GET, 'problema', FILTER_VALIDATE_INT);

// Validar que sea un número entre 1 y 9
if (!$numeroproblema || $numeroproblema < 1 || $numeroproblema > 9) {
    // Si el parámetro no es válido, regresar al menú
    header('Location: ../../index.php');
    exit;
}

// El controlador maneja la lógica sin importar qué problema sea
$controlador = new ProblemaController();
$controlador->manejarSolicitud($numeroproblema);
$datos = $controlador->obtenerDatosVista();

// Cargar la vista del problema correspondiente
// __DIR__ apunta a src/Views/ donde están los archivos
$vistaArchivo = __DIR__ . '/problema' . $numeroproblema . '.php';

if (!file_exists($vistaArchivo)) {
    header('Location: ../../index.php');
    exit;
}

require_once $vistaArchivo;