<?php
namespace Taller\Alkr\Models;

class Utilidades {
        /**
     * Sanitiza una entrada del usuario contra ataques XSS.
     * Usa htmlspecialchars() según recomendación OWASP A03:2021.
     *
     * @param string $valor Valor crudo del formulario
     * @return string Valor sanitizado
     */
    public static function sanitizar(string $valor): string
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Genera el enlace para regresar al menú principal.
     * Centraliza la navegación en un solo lugar (principio DRY).
     *
     * @param string $url Ruta del menú principal
     * @return string HTML del enlace de regreso
     */
    public static function enlaceMenu(string $url = '../index.php'): string
    {
        $urlSanitizada = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
        return '<a href="' . $urlSanitizada . '" class="btn-menu">Volver al Menú</a>';
    }
}