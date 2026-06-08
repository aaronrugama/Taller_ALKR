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


function renderizarGraficaPresupuesto(ginecologia, traumatologia, pediatria) {
    const ctx = document.getElementById('graficaPresupuesto').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Ginecología (40%)', 'Traumatología (35%)', 'Pediatría (25%)'],
            datasets: [{
                data: [ginecologia, traumatologia, pediatria],
                backgroundColor: ['#4f749c', '#919191', '#ff0000'],
            }]
        },
        options: {
            responsive: true,        // <- agrega esto
            maintainAspectRatio: true, // <- y esto
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const valor = context.parsed;
                            return ` $${valor.toLocaleString('es-PA', {minimumFractionDigits: 2})}`;
                        }
                    }
                }
            }
        }
    });
}