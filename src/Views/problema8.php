<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Taller\Alkr\Models\Utilidades;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estación del Año</title>
    <link rel="stylesheet" href="../../Assets/css/estiloEstacion.css">
</head>
<body>

    <div class="fondo-estacion" id="fondoEstacion"></div>
    <div class="fondo-overlay"></div>

    <div class="contenido">
        <h1 class="titulo-principal">Estación del Año</h1>
        <p class="subtitulo">Elige una fecha y descubre la estación del año.</p>

        <div class="tarjeta-estacion">
            <label for="fecha">Selecciona una fecha</label>
            <input type="date" id="fecha" name="fecha" required>
            <button class="btn-ver" id="btnVer">Ver estación</button>

            <div id="resultado" style="display:none;">
                <hr class="divisor">
                <p class="resultado-label">Estación correspondiente</p>
                <p class="resultado-estacion" id="nombreEstacion"></p>
                <img class="imagen-resultado" id="imgEstacion" src="" alt="">
            </div>
        </div>
    </div>

    <div class="nav-menu">
        <?= Utilidades::enlaceMenu('../../index.php') ?>
    </div>

    <?php include __DIR__ . '/../../footer.php'; ?>

    <script>


        const baseImg   = '../../Assets/img/estaciones/';
        const fondo     = document.getElementById('fondoEstacion');
        const imgResult = document.getElementById('imgEstacion');

        function actualizarFondo(rutaImagen) {
            fondo.style.opacity = '0';
            setTimeout(() => {
                fondo.style.backgroundImage = `url('${rutaImagen}')`;
                fondo.style.opacity = '1';
            }, 400);
        }

        function actualizarResultado(data) {
            const ruta = baseImg + data.imagen;

            // Fondo
            actualizarFondo(ruta);

            // Icono navbar
            const iconoNavbar = document.getElementById('iconoNavbar');
            if (iconoNavbar) iconoNavbar.textContent = iconos[data.estacion] ?? '🌍';
            // Tarjeta
            const nombreEstacion = document.getElementById('nombreEstacion');
            if (nombreEstacion) nombreEstacion.textContent = data.estacion;

            const faseEstacion = document.getElementById('faseEstacion');
            if (faseEstacion) faseEstacion.textContent = data.fase;

            // Imagen con fade
            imgResult.style.opacity = '0';
            imgResult.src = ruta;
            imgResult.alt = data.estacion;
            imgResult.onload = () => imgResult.style.opacity = '1';

            document.getElementById('resultado').style.display = 'block';
        }

        

        document.getElementById('btnVer').addEventListener('click', async () => {
            const fechaVal = document.getElementById('fecha').value;
            if (!fechaVal) return;

            const [anio, mes, dia] = fechaVal.split('-');

            try {
                const response = await fetch(`../../api/estacion.php?mes=${mes}&dia=${dia}`);
                const data     = await response.json();

                if (data.error) {
                    alert('Fecha inválida');
                    return;
                }


                actualizarResultado(data);
            } catch (err) {
                console.error('Error:', err);
            }
        });
    </script>

</body>
</html>