<?php
namespace Taller\Alkr\Controllers;

use Taller\Alkr\Models\Math;
use Taller\Alkr\Models\Utilidades;
use Taller\Alkr\Models\Validaciones;

class ProblemaController {

    public static function problema2(): array {
        $resultado = Math::sumaDel1Al1000();
        return [
            'titulo'    => 'Suma del 1 al 1000',
            'resultado' => $resultado,
        ];
    }

    public static function problema4(): array {
    return [
        'titulo'   => 'Suma de pares e impares del 1 al 200',
        'pares'    => Math::sumaPares(),
        'impares'  => Math::sumaImpares(),
    ];
    }

    public static function problema6(): array {
    $datos = [
        'titulo' => 'Problema 6 — Distribución de presupuesto hospitalario',
        'resultado' => null,
        'presupuesto' => null,
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $presupuesto = floatval($_POST['presupuesto'] ?? 0);
        if ($presupuesto > 0) {
            $datos['presupuesto'] = $presupuesto;
            $datos['resultado']   = Math::calcularPresupuesto($presupuesto);
        }
    }

            return $datos;
        }
        
public static function problema8Json(int $mes, int $dia): array {
    $resultado    = Math::calcularEstacion($mes, $dia);
    $fase         = $resultado['fase'] === 'temprana' ? 'Empezando' : 'Terminando';
    $nombreImagen = $resultado['estacion'] . $fase . '.png';

    return [
        'estacion' => $resultado['estacion'],
        'fase'     => $resultado['fase'],
        'imagen'   => $nombreImagen,
    ];
}
}


