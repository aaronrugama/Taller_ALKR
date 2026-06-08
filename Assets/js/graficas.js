// graficas.js
// Maneja todas las gráficas del proyecto.
// Los datos llegan desde PHP via la variable datosGrafica definida en la vista.

// Problema 5: gráfica de barras de distribución por categoría
const canvasEdades = document.getElementById('graficaEdades');

if (canvasEdades && typeof datosGrafica !== 'undefined') {

    // Extraer etiquetas (categorías) y valores (cantidades) del objeto
    const etiquetas = Object.keys(datosGrafica);
    const valores   = Object.values(datosGrafica);

    new Chart(canvasEdades, {
        type: 'bar',
        data: {
            labels: etiquetas,
            datasets: [{
                label: 'Cantidad de personas',
                data: valores,
                backgroundColor: [
                    '#880d1e',
                    '#dd2d4a',
                    '#f26a8d',
                    '#f49cbb',
                    '#cbeef3'
                ],
                borderWidth: 0,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
            },
            scales: {
                y: {
                    beginAtZero: true,
                    // Solo mostrar enteros en el eje Y ya que son conteos
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
}