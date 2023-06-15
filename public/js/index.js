// En tu archivo index.js
// Aquí puedes acceder a las variables topUsers y followersCounts y utilizarlas para generar el gráfico de barras
const ctx = document.getElementById('barChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: topUsers.map(user => user.login),
        datasets: [{
            label: 'Número de Seguidores',
            data: followersCounts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
