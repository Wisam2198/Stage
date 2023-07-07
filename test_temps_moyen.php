<?php include 'restriction.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moyenne</title>
    <style>
        body {
            background-color: gray;
            margin: 0; /* Ajout d'une marge nulle pour le corps de la page */
        }

        nav {
            background-color: white;
            height: 75px;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
			text-align: left;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
            margin-top: 30px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            padding: 10px;
        }

        nav ul li a:hover {
            background-color: #E67E30;
        }

        h1 {
            text-decoration: underline;
            color: #191970;
            text-align: center;
        }

        #logo img {
            width: 100px;
            height: auto;
        }

        #logo {
            display: inline-block; /* Affiche le logo en tant qu'élément en ligne */
            vertical-align: middle; /* Aligne le logo verticalement au centre avec les autres éléments */
            float: right;
            margin-top: 15px;;
        }
	</style>
</head>
<body>
<?php if (isset($message)) { echo '<p>' . $message . '</p>'; } ?>
<?php
$host = 'localhost'; // Hôte de la base de données
$port = 5432; // Port de la base de données
$dbname = 'Interventions'; // Nom de la base de données
$user = 'user_php'; // Nom d'utilisateur de la base de données
$password = 'password'; // Mot de passe de la base de données (null si aucun mot de passe)

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    if ($password !== null) {
        $pdo = new PDO($dsn, $user, $password);
    } else {
        $pdo = new PDO($dsn, $user);
    }

} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    // Gérer l'erreur de connexion à la base de données
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du nombre total d'alertes depuis la table "storage"
    $query = "SELECT COUNT(*) as total_alertes FROM storage";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalAlertes = $result['total_alertes'];
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du nombre total d'alertes depuis la table "storage"
    $query = "SELECT COUNT(*) as alerte_terminee FROM storage where date_fin is not null and heure_fin is not NULL";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $alerte_terminee = $result['alerte_terminee'];
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du nombre total d'alertes depuis la table "storage"
    $query = "SELECT COUNT(*) as alerte_en_cours FROM storage where date_fin is null and heure_fin is NULL";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $alerte_en_cours = $result['alerte_en_cours'];
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du nombre total d'alertes depuis la table "storage"
    $query = "SELECT COUNT(*) as compte_cree FROM utilisateurs";
    $stmt = $pdo->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $compte_cree = $result['compte_cree'];
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
<nav>
	<ul>
        <li style="text-align: center;">
			<a href="accueil.php">Accueil</a>
		</li>
		<li style="text-align: center;">
			<a href="intervention.php">Interventions</a>
		</li>
        <li style="text-align: center;">
            <a href="alerte_en_cours.php">Alerte en cours</a>
        </li>
        <li style="display: inline-block; text-align: right;">
            <a href="alerte_terminee.php">Alerte terminée</a>
        </li>
        <li style="display: inline-block; text-align: right;">
            <a href="moyenne.php">Moyenne</a>
        </li> 
        <li style="text-align: left; float: right;">
            <a href="deconnexion.php">Déconnexion</a>
        </li>
        <div id="logo">
            <a href="https://dsim.univ-grenoble-alpes.fr/">
                <img src="DSIM.png" alt="Logo DSIM">
            </a> 
        </div>
	</ul>
</nav><br>
<h1> Moyenne </h1>
    <canvas id="chart"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let ctx = document.getElementById('chart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Nombre total d\'alerte en cours', 'Nombre total d\'alerte terminée', 'Nombre total d\'alerte créée', 'Nombre total de compte créé'],
            datasets: [{
                label: 'Total',
                data: [
                    <?php echo $alerte_en_cours; ?>,
                    <?php echo $alerte_terminee; ?>,
                    <?php echo $totalAlertes; ?>,
                    <?php echo $compte_cree; ?>
                ],
                backgroundColor: [
                    'rgb(238, 123, 163)',
                    'rgb(127, 255, 212)',
                    'rgb(173, 255, 47)',
                    'rgb(123, 104, 238)'
                ],
                borderColor: [
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
</script>
</body>
</html>