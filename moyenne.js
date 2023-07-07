let ctx = document.getElementById('chart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Nombre total d\'alerte en cours', 'Nombre total d\'alerte terminée', 'Nombre total d\'alerte créée', 'Nombre total de compte créé', 'temps_moyen'],
            datasets: [{
                label: 'Total',
                data: [
                    <?php echo $alerte_en_cours; ?>,
                    <?php echo $alerte_terminee; ?>,
                    <?php echo $totalAlertes; ?>,
                    <?php echo $compte_cree; ?>,
                    <?php echo $temps_moyen; ?>
                ],
                backgroundColor: [
                    'rgb(238, 123, 163)',
                    'rgb(127, 255, 212)',
                    'rgb(173, 255, 47)',
                    'rgb(123, 104, 238)',
                    'rgb(255, 127, 80)'
                ],
                borderColor: [
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)',
                    'rgb(255, 255, 255)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'white' // Couleur des libellés sur l'axe y
                    }
                },
                x: {
                    ticks: {
                        color: 'black' // Couleurd des libellés sur l'axe x
                    }
                }
            }
        }
    });