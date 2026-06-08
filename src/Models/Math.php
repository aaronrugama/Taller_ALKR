<?php
namespace Taller\Alkr\Models;

class Math {
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
