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