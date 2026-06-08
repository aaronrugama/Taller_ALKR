<?php
namespace Taller\Alkr\Controllers;

use Taller\Alkr\Models\Utilidades;
use Taller\Alkr\Models\Validaciones;
use Taller\Alkr\Models\Math;

class ProblemaController {
    /** @var array Datos preparados para la vista */
    private array $datosVista = [];

    /**
     * Punto de entrada principal del controlador.
     * Determina si se debe mostrar el formulario o procesar los datos.
     *
     * @return void
     */
    public function manejarSolicitud(int $numeroproblema = 1): void
    {
        switch ($numeroproblema) {
            case 1:
                // Problema 1: procesa arreglo de 5 números
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $this->procesarFormulario();
                } else {
                    $this->datosVista['mostrarFormulario']  = true;
                    $this->datosVista['mostrarResultados']  = false;
                    $this->datosVista['errores']            = [];
                    $this->datosVista['valoresIngresados']  = [];
                }
                break;

            case 3:
                // Problema 3: procesa un solo valor N
                $this->manejarProblema3();
                break;

            case 5:
                $this->manejarProblema5();
                break;

            case 7:
                $this->manejarProblema7();
                break;

            case 9: 
                $this->manejarProblema9();
                break;

            default:
                // Problema sin implementar aún
                $this->datosVista['mostrarFormulario']  = false;
                $this->datosVista['mostrarResultados']  = false;
                $this->datosVista['errores']            = ['Este problema aún no está implementado.'];
                break;
        }
    }

    /**
     * Punto de entrada principal del controlador.
     * Determina si se debe mostrar el formulario o procesar los datos.
     *
     * @return void
     */
    private function procesarFormulario(): void
    {
        // Obtener el arreglo de números del POST
        $entradasCrudas = $_POST['numeros'] ?? [];

        if (!is_array($entradasCrudas)) {
            $entradasCrudas = [];
        }

        // El controlador valida y acumula errores él mismo
        $errores  = [];
        $numeros  = [];

        foreach ($entradasCrudas as $indice => $valorCrudo) {
            // Primero sanitizar (OWASP), luego validar
            $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);

            if (!Validaciones::esNumeroPositivo($valorLimpio)) {
                $posicion  = $indice + 1;
                $errores[] = "El valor en la posición #{$posicion} no es un número positivo válido.";
            } else {
                $numeros[] = (float)$valorLimpio;
            }
        }

        $this->datosVista['mostrarFormulario']  = true;
        $this->datosVista['valoresIngresados']  = $entradasCrudas;
        $this->datosVista['errores']            = $errores;

        if (empty($errores)) {
            // Solo calcular si no hay errores
            $this->datosVista['mostrarResultados'] = true;
            $this->datosVista['resultados'] = [
                'media'      => Math::calcularMedia($numeros),
                'desviacion' => Math::calcularDesviacionEstandar($numeros),
                'minimo'     => Math::calcularMinimo($numeros),
                'maximo'     => Math::calcularMaximo($numeros),
                'numeros'    => $numeros,
            ];
        } else {
            $this->datosVista['mostrarResultados'] = false;
        }
    }

    /**
     * Retorna los datos preparados para ser consumidos por la vista.
     *
     * @return array
     */
    public function obtenerDatosVista(): array
    {
        return $this->datosVista;
    }

    public static function problema2(): array {
        $resultado = Math::sumaDel1Al1000();
        return [
            'titulo'    => 'Suma del 1 al 1000',
            'resultado' => $resultado,
        ];
    }

     /**
     * Maneja la solicitud del Problema 3: múltiplos de 4.
     * Se llama desde menu.php cuando problema=3.
     *
     * @return void
     */
    public function manejarProblema3(): void
    {
        // Inicializar datos base para la vista
        $this->datosVista['mostrarFormulario']  = true;
        $this->datosVista['mostrarResultados']  = false;
        $this->datosVista['errores']            = [];
        $this->datosVista['valorIngresado']     = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Leer y sanitizar el valor de N del formulario
            $valorCrudo = $_POST['n'] ?? '';
            $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);

            $this->datosVista['valorIngresado'] = $valorLimpio;

            // Validar que sea un entero entre 1 y 1000
            if (!Validaciones::esEnteroEnRango($valorLimpio)) {
                $this->datosVista['errores'][] = 'Ingresa un número entero entre 1 y 1000.';
            } else {
                // Sin errores: generar los múltiplos
                $n = (int)$valorLimpio;
                $this->datosVista['mostrarResultados'] = true;
                $this->datosVista['resultados'] = [
                    'n'        => $n,
                    'multiplos' => Math::generarMultiplos(4, $n),
                ];
            }
        }
    }

    public static function problema4(): array {
    return [
        'titulo'   => 'Suma de pares e impares del 1 al 200',
        'pares'    => Math::sumaPares(),
        'impares'  => Math::sumaImpares(),
    ];
    }

     /**
     * Maneja la solicitud del Problema 5: clasificación de edades.
     * Procesa 5 edades, las clasifica y detecta repeticiones.
     *
     * @return void
     */
    private function manejarProblema5(): void
    {
        $this->datosVista['mostrarFormulario']  = true;
        $this->datosVista['mostrarResultados']  = false;
        $this->datosVista['errores']            = [];
        $this->datosVista['valoresIngresados']  = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $entradasCrudas = $_POST['edades'] ?? [];

            if (!is_array($entradasCrudas)) {
                $entradasCrudas = [];
            }

            $errores = [];
            $edades  = [];

            foreach ($entradasCrudas as $indice => $valorCrudo) {
                // Sanitizar primero, luego validar (OWASP)
                $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);
                $posicion    = $indice + 1;

                if (!Validaciones::esEdadValida($valorLimpio)) {
                    $errores[] = "La edad #{$posicion} debe ser un número entero entre 0 y 120.";
                } else {
                    $edades[] = (int)$valorLimpio;
                }
            }

            $this->datosVista['valoresIngresados'] = $entradasCrudas;
            $this->datosVista['errores']           = $errores;

            if (empty($errores) && count($edades) === 5) {

                // Clasificar cada edad usando Math::clasificarEdad()
                $personas = [];
                foreach ($edades as $i => $edad) {
                    $personas[] = [
                        'persona'    => $i + 1,
                        'edad'       => $edad,
                        'categoria'  => Math::clasificarEdad($edad),
                    ];
                }

                // Contar categorías para la gráfica
                // array_column extrae solo la columna 'categoria' del arreglo
                $categorias      = array_column($personas, 'categoria');
                $conteoCategoria = array_count_values($categorias);

                // Detectar edades repetidas para las estadísticas
                $repetidas = Math::contarRepetidas($edades);

                $this->datosVista['mostrarResultados'] = true;
                $this->datosVista['resultados'] = [
                    'personas'        => $personas,
                    'repetidas'       => $repetidas,
                    'conteoCategoria' => $conteoCategoria,
                    // Estadísticas generales de las edades
                    'media'           => Math::calcularMedia($edades),
                    'minimo'          => Math::calcularMinimo($edades),
                    'maximo'          => Math::calcularMaximo($edades),
                ];
            } elseif (empty($errores) && count($edades) !== 5) {
                $this->datosVista['errores'][] = 'Debes ingresar exactamente 5 edades.';
            } else {
                $this->datosVista['mostrarResultados'] = false;
            }
        }
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

    /**
     * Maneja la solicitud del Problema 7: calculadora de notas.
     * Tiene dos fases:
     *   Fase 1 — el usuario indica cuántas notas quiere ingresar.
     *   Fase 2 — el usuario ingresa las notas y se calculan las estadísticas.
     *
     * @return void
     */
    private function manejarProblema7(): void
    {
        $this->datosVista['mostrarFormulario']  = true;
        $this->datosVista['mostrarResultados']  = false;
        $this->datosVista['errores']            = [];
        $this->datosVista['fase']               = 1;
        $this->datosVista['cantidad']           = 0;
        $this->datosVista['valoresIngresados']  = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Leer en qué fase estamos (1 = pedir cantidad, 2 = pedir notas)
            $fase = (int)($_POST['fase'] ?? 1);

            if ($fase === 1) {
                // El usuario envió la cantidad de notas
                $valorCrudo  = $_POST['cantidad'] ?? '';
                $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);

                // Validar que sea un entero entre 1 y 50
                if (!Validaciones::esEnteroEnRango($valorLimpio, 50)) {
                    $this->datosVista['errores'][] = 'Ingresa un número entero entre 1 y 50.';
                    $this->datosVista['fase']      = 1;
                } else {
                    // Sin errores: pasar a la fase 2 con la cantidad confirmada
                    $this->datosVista['fase']     = 2;
                    $this->datosVista['cantidad'] = (int)$valorLimpio;
                }

            } elseif ($fase === 2) {
                // El usuario envió las notas
                $cantidad       = (int)($_POST['cantidad'] ?? 0);
                $entradasCrudas = $_POST['notas'] ?? [];

                if (!is_array($entradasCrudas)) {
                    $entradasCrudas = [];
                }

                $errores = [];
                $notas   = [];

                // foreach recorre la colección de notas (requisito del PDF)
                foreach ($entradasCrudas as $indice => $valorCrudo) {
                    $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);
                    $posicion    = $indice + 1;

                    if (!Validaciones::esNotaValida($valorLimpio)) {
                        $errores[] = "La nota #{$posicion} debe ser un número entre 0 y 100.";
                    } else {
                        $notas[] = (float)$valorLimpio;
                    }
                }

                // Conservar cantidad y valores para repoblar si hay error
                $this->datosVista['fase']              = 2;
                $this->datosVista['cantidad']          = $cantidad;
                $this->datosVista['valoresIngresados'] = $entradasCrudas;
                $this->datosVista['errores']           = $errores;

                if (empty($errores) && count($notas) === $cantidad) {
                    $this->datosVista['mostrarResultados'] = true;
                    $this->datosVista['resultados'] = [
                        'cantidad'   => $cantidad,
                        'notas'      => $notas,
                        'promedio'   => Math::calcularMedia($notas),
                        'desviacion' => Math::calcularDesviacionEstandar($notas),
                        'minima'     => Math::calcularMinimo($notas),
                        'maxima'     => Math::calcularMaximo($notas),
                    ];
                } else {
                    $this->datosVista['mostrarResultados'] = false;
                }
            }
        }
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

     /**
     * Maneja la solicitud del Problema 9: potencias de un número.
     * El usuario ingresa un número del 1 al 9 y se generan sus 15 primeras potencias.
     *
     * @return void
     */
    private function manejarProblema9(): void
    {
        $this->datosVista['mostrarFormulario']  = true;
        $this->datosVista['mostrarResultados']  = false;
        $this->datosVista['errores']            = [];
        $this->datosVista['valorIngresado']     = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $valorCrudo  = $_POST['numero'] ?? '';
            $valorLimpio = Utilidades::sanitizar((string)$valorCrudo);

            $this->datosVista['valorIngresado'] = $valorLimpio;

            // Reutilizamos esEnteroEnRango con max=9 para validar del 1 al 9
            if (!Validaciones::esEnteroEnRango($valorLimpio, 9)) {
                $this->datosVista['errores'][] = 'Ingresa un número entero entre 1 y 9.';
            } else {
                $numero = (int)$valorLimpio;
                $this->datosVista['mostrarResultados'] = true;
                $this->datosVista['resultados'] = [
                    'numero'    => $numero,
                    'potencias' => Math::generarPotencias($numero, 15),
                ];
            }
        }
    }
}


