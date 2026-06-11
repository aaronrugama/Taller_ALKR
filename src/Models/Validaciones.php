<?php
namespace Taller\Alkr\Models;

class Validaciones {
    /**
     * Valida que un valor sea un número positivo (mayor a 0).
     * Usa filter_var para verificar que sea numérico antes de comparar.
     *
     * @param mixed $valor Valor a validar
     * @return bool true si es número positivo, false en caso contrario
     */
    public static function esNumeroPositivo(mixed $valor): bool
    {
        // filter_var verifica que sea un número válido (entero o decimal)
        if (filter_var($valor, FILTER_VALIDATE_FLOAT) === false) {
            return false;
        }
        return (float)$valor > 0;
    }

     /**
     * Valida que un valor sea un entero positivo dentro de un rango permitido.
     * El límite máximo previene desbordamiento en operaciones repetitivas.
     *
     * @param mixed $valor Valor a validar
     * @param int $max Límite máximo permitido (por defecto 1000)
     * @return bool true si es entero positivo dentro del rango
     */
    public static function esEnteroEnRango(mixed $valor, int $max = 1000): bool
    {
        // FILTER_VALIDATE_INT verifica que sea un entero, no decimal
        if (filter_var($valor, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        $numero = (int)$valor;
        return $numero >= 1 && $numero <= $max;
    }

     /**
     * Valida que un valor sea una edad válida (0 a 120).
     * Las edades no pueden ser negativas ni irreales.
     *
     * @param mixed $valor Valor a validar
     * @return bool true si es una edad válida
     */
    public static function esEdadValida(mixed $valor): bool
    {
        if (filter_var($valor, FILTER_VALIDATE_INT) === false) {
            return false;
        }
        $edad = (int)$valor;
        return $edad >= 0 && $edad <= 120;
    }

    /**
     * Valida que un valor sea una nota válida (0 a 100).
     * Las notas pueden ser decimales, por eso usa FILTER_VALIDATE_FLOAT.
     *
     * @param mixed $valor Valor a validar
     * @return bool true si es una nota válida
     */
    public static function esNotaValida(mixed $valor): bool
    {
        if (filter_var($valor, FILTER_VALIDATE_FLOAT) === false) {
            return false;
        }
        $nota = (float)$valor;
        return $nota >= 0 && $nota <= 100;
    }
        /**
     * Valida que un valor sea un número decimal válido para presupuesto.
     * Usa preg_match para verificar el formato: dígitos con punto decimal opcional.
     * Ejemplo válido: 1000, 1000.50, 99999.99
     *
     * @param mixed $valor Valor a validar
     * @return bool true si tiene formato de presupuesto válido
     */
    public static function esPresupuestoValido(mixed $valor): bool
    {
        // preg_match verifica que solo contenga dígitos y opcionalmente decimales
        if (!preg_match('/^\d+(\.\d{1,2})?$/', (string)$valor)) {
            return false;
        }
        return (float)$valor > 0;
    }
}
