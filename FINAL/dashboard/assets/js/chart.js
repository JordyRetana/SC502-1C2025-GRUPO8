
document.addEventListener('DOMContentLoaded', function() {
    const chartCanvases = document.querySelectorAll('.chart-container canvas');
    
    if (chartCanvases.length > 0) {
        if (typeof Chart === 'undefined') {
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/chart.js';
            script.onload = initializeCharts;
            document.head.appendChild(script);
        } else {
            initializeCharts();
        }
    }
    
    function initializeCharts() {
        const ctx = document.getElementById('mainChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
                    datasets: [{
                        label: 'Ventas 2023',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }
});