<?php
namespace Taller\Alkr\Models;

class Math {
    /**
     * Calcula la media aritmética de un arreglo de números.
     * Evita división por cero verificando que el arreglo no esté vacío.
     *
     * @param array $numeros Arreglo de números
     * @return float Media aritmética
     */
    public static function calcularMedia(array $numeros): float
    {
        $cantidad = count($numeros);
        if ($cantidad === 0) {
            return 0.0;
        }
        return array_sum($numeros) / $cantidad;
    }

    /**
     * Calcula la desviación estándar poblacional de un arreglo.
     * Usa la fórmula: sqrt( suma((xi - media)^2) / n )
     *
     * @param array $numeros Arreglo de números
     * @return float Desviación estándar
     */
    public static function calcularDesviacionEstandar(array $numeros): float
    {
        $cantidad = count($numeros) - 1;
        if ($cantidad === 0) {
            return 0.0;
        }

        $media = self::calcularMedia($numeros);

        // Suma de las diferencias al cuadrado respecto a la media
        $sumaDiferencias = 0.0;
        foreach ($numeros as $num) {
            $sumaDiferencias += ($num - $media) ** 2;
        }

        // sqrt() es la función raíz cuadrada de PHP (equivalente a sqr)
        return sqrt($sumaDiferencias / $cantidad);
    }
    
    /**
     * Retorna el valor mínimo de un arreglo de números.
     *
     * @param array $numeros Arreglo de números
     * @return float|null Mínimo, o null si el arreglo está vacío
     */
    public static function calcularMinimo(array $numeros): ?float
    {
        return empty($numeros) ? null : min($numeros);
    }

    /**
     * Retorna el valor máximo de un arreglo de números.
     *
     * @param array $numeros Arreglo de números
     * @return float|null Máximo, o null si el arreglo está vacío
     */
    public static function calcularMaximo(array $numeros): ?float
    {
        return empty($numeros) ? null : max($numeros);
    }

     /**
     * Genera los primeros N múltiplos de un número base.
     * Retorna un arreglo con cada resultado para que la vista lo recorra.
     *
     * @param int $base  El número del que se calculan los múltiplos (ej: 4)
     * @param int $n     Cantidad de múltiplos a generar
     * @return array     Arreglo de arreglos con 'factor' y 'resultado'
     */
    public static function generarMultiplos(int $base, int $n): array
    {
        $multiplos = [];

        // El for va de 1 hasta N, calculando base * i en cada paso
        for ($i = 1; $i <= $n; $i++) {
            $multiplos[] = [
                'factor'    => $i,
                'resultado' => $base * $i,
            ];
        }

        return $multiplos;
    }

     /**
     * Clasifica una edad en su categoría correspondiente.
     * Usa if/elseif siguiendo los rangos definidos en el problema.
     *
     * @param int $edad Edad a clasificar
     * @return string Nombre de la categoría
     */
    public static function clasificarEdad(int $edad): string
    {
        if ($edad <= 12) {
            return 'Niño';
        } elseif ($edad <= 17) {
            return 'Adolescente';
        } elseif ($edad <= 64) {
            return 'Adulto';
        } else {
            return 'Adulto Mayor';
        }
    }

     /**
     * Cuenta cuántas veces se repite cada edad en el arreglo.
     * Solo retorna las edades que aparecen más de una vez.
     * Usa array_count_values() que cuenta ocurrencias automáticamente.
     *
     * @param array $edades Arreglo de edades enteras
     * @return array Arreglo asociativo [edad => cantidad] solo con repetidas
     */
    public static function contarRepetidas(array $edades): array
    {
        // array_count_values cuenta cuántas veces aparece cada valor
        $conteo = array_count_values($edades);

        // array_filter filtra solo las que aparecen más de una vez
        return array_filter($conteo, fn($cantidad) => $cantidad > 1);
    }

     /**
     * Genera las primeras N potencias de una base dada.
     * Usa el operador ** de PHP para calcular base elevado a exponente.
     *
     * @param int $base     El número base (ej: 4)
     * @param int $cantidad Cuántas potencias generar (ej: 15)
     * @return array        Arreglo con 'exponente' y 'resultado' por cada potencia
     */
    public static function generarPotencias(int $base, int $cantidad): array
    {
        $potencias = [];

        // El for genera desde la potencia 1 hasta la cantidad pedida
        for ($exponente = 1; $exponente <= $cantidad; $exponente++) {
            $potencias[] = [
                'exponente' => $exponente,
                // ** es el operador de potenciación en PHP (equivalente a pow())
                'resultado' => $base ** $exponente,
            ];
        }

        return $potencias;
    }
    
}
    public static function sumaDel1Al1000(): int {
        return array_sum(range(1, 1000));
        // Alternativa con fórmula: return (1000 * 1001) / 2;
        }
        
        public static function sumaPares(): int {
            $suma = 0;
            for ($i = 1; $i <= 200; $i++) {
                if ($i % 2 === 0) $suma += $i;
                }
                return $suma;
        }
        
        public static function sumaImpares(): int {
            $suma = 0;
            for ($i = 1; $i <= 200; $i++) {
                if ($i % 2 !== 0) $suma += $i;
                }
                return $suma;
                }
                public static function calcularPresupuesto(float $total): array {
                return [
                'Ginecología'    => $total * 0.40,
                'Traumatología'  => $total * 0.35,
                'Pediatría'      => $total * 0.25,
    ];
    }
            public static function calcularEstacion(int $mes, int $dia): array {
            $fecha = $mes * 100 + $dia;

            if ($fecha >= 1221 || $fecha <= 320) {
                $mitad = ($fecha >= 1221) ? ($fecha - 1221) : ($fecha + 1079);
                $fase  = $mitad < 45 ? 'empezando' : 'terminando';
                return ['estacion' => 'Verano', 'fase' => $fase];
            } elseif ($fecha >= 321 && $fecha <= 621) {
                $mitad = $fecha - 321;
                $fase  = $mitad < 45 ? 'empezando' : 'terminando';
                return ['estacion' => 'Otoño', 'fase' => $fase];
            } elseif ($fecha >= 622 && $fecha <= 922) {
                $mitad = $fecha - 622;
                $fase  = $mitad < 45 ? 'empezando' : 'terminando';
                return ['estacion' => 'Invierno', 'fase' => $fase];
            } else {
                $mitad = $fecha - 923;
                $fase  = $mitad < 45 ? 'empezando' : 'terminando';
                return ['estacion' => 'Primavera', 'fase' => $fase];
            }
        }
    }
