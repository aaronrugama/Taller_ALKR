<?php
/**
 * navegacion.php
 * Contiene funciones de navegación reutilizables.
 * Se incluye con require_once donde se necesite un enlace de regreso.
 * Cumple el requisito del PDF: enlace al menú en una función con parámetro URL.
 */

/**
 * Genera un enlace HTML para regresar a una URL dada.
 * Al tenerlo en una función, lo usamos en cualquier vista sin repetir código (DRY).
 *
 * @param string $url  La URL a la que apunta el enlace (por defecto el index)
 * @param string $texto El texto visible del enlace
 * @return void  Imprime el enlace directamente
 */
function enlaceRegresar(string $url = 'index.php', string $texto = 'Volver al Menú'): void
{
    // htmlspecialchars() protege contra XSS si la URL viniera de entrada del usuario
    $urlSegura = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    echo '<a href="' . $urlSegura . '" class="btn-regresar">' . $texto . '</a>';
}