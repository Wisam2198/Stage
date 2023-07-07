<?php include 'authentification.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerte Terminée</title>
    <link href="css/alerte_terminee" rel="stylesheet">
</head>
<body>
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
                <img src="img/DSIM.png" alt="Logo DSIM">
            </a> 
        </div>
	</ul>
</nav>
<h1>Alerte Terminée</h1><br><br><br><br><br><br>

<?php
$host = 'localhost';
$port = 5432;
$dbname = 'Interventions';
$user = 'user_php';
$password = 'password';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

    if ($password !== null) {
        $pdo = new PDO($dsn, $user, $password);
    } else {
        $pdo = new PDO($dsn, $user);
    }

    $query = "SELECT * FROM storage WHERE date_fin IS NOT NULL AND heure_fin IS NOT NULL";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0) {
        echo '<table style="border-collapse: collapse;">'; // Début du tableau
        echo '<tr>';
        echo '<th style="font-size: 15px; padding-right: 30px; border: 1px solid black;">Date de début<img src="img/trier.png" width="30" height="30" onclick="sortTableByDate()"></th>';
        echo '<th style="font-size: 15px; padding-right: 30px; border: 1px solid black;">Heure de début<img src="img/trier.png" width="30" height="30" onclick="sortTableByTime()"></th>';
        echo '<th style="font-size: 15px; padding-right: 30px; border: 1px solid black;">Services<img src="img/trier.png" width="30" height="30" onclick="sortTableByServices()"></th>';
        echo '<th style="font-size: 15px; padding-right: 30px; border: 1px solid black;">Localisation<img src="img/trier.png" width="30" height="30" onclick="sortTableByLocalisation()"></th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black;">En savoir plus</th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_date_fin">Date de fin<img src="img/trier.png" width="30" height="30" onclick="sortTableByDateFin()"></th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_heure_fin">Heure de fin<img src="img/trier.png" width="30" height="30" onclick="sortTableByHeureFin()"></th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_impact">Impact</th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_actions_prevues">Actions prévues</th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_equipes_mobilisees">Équipes mobilisées</th>';
        echo '<th style="font-size: 15px; padding-right: 20px; border: 1px solid black; display: none;" id="th_responsables">Responsables</th>';
        echo '</tr>';
    
        foreach ($results as $row) {
            echo '<tr>';
            echo '<td style="border: 1px solid black;">' . $row['date_debut'] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row['heure_debut'] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row['services'] . '</td>';
            echo '<td style="border: 1px solid black;">' . $row['localisation'] . '</td>';
            echo '<td style="border: 1px solid black; text-align: center;"><img src="img/loupe.png" width="30" height="30" class="bouton-loupe" onclick="toggleDetails(' . $row['id'] . ')"></td>';
            echo '<td style="border: 1px solid black; display: none;" id="date_fin_' . $row['id'] . '">' . $row['date_fin'] . '</td>';
            echo '<td style="border: 1px solid black; display: none;" id="heure_fin_' . $row['id'] . '">' . $row['heure_fin'] . '</td>';
            echo '<td style="border: 1px solid black; display: none;" id="impact_' . $row['id'] . '">' . $row['impact'] . '</td>';
            echo '<td style="border: 1px solid black; display: none;" id="actions_prevues_' . $row['id'] . '">' . $row['actions_prevues'] . '</td>';
            echo '<td style="border: 1px solid black; display: none;" id="equipes_mobilisees_' . $row['id'] . '">' . $row['equipes_mobilisees'] . '</td>';
            echo '<td style="border: 1px solid black; display: none;" id="responsables_' . $row['id'] . '">' . $row['responsables'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo "Aucune donnée trouvée.";
    }
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
<script src="js/alerte_terminee.js"></script>
</body>
</html>
