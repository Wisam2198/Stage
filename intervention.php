<?php include 'authentification.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Intervention</title>
    <link href="css/intervention.css" rel="stylesheet">
    <script src="js/intervention.js"></script>
</head>
<body>
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
                <img src="img/DSIM.png" alt="Logo DSIM">
            </a> 
        </div>
	</ul>
</nav>
    <h1>Création d'une alerte pour une intervention</h1><br><br>
    <div class="container">
    <form method="POST" action="">
        <div class="input-group mb-3">
    <span class="Dest" id="basic-addon1">Destinataire(s)</span><br><br>
    <select name="ma_liste_deroulante">
        <?php
        $caracteres = array('DSIM_TOUS', 'Laurent ISS', 'Raoul Dorge', 'Wisam Kallouch'); // Remplacez les caractères par ceux de votre choix

        foreach ($caracteres as $caractere) {
            echo '<option value="' . $caractere . '">' . $caractere . '</option>';
        }
        ?>
    </select>
    </div><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="row"></th>
                <th scope="col">Date de début</th>
                <th scope="col">Heure de début</th>
            </tr>
        </thead>
        <tbody>

            <!-- Date, mois, année -->

            <tr>
                <th scope="row"></th>
                <td style="width: 150px; text-align: center;">
                    <input id="date" type="date" name="date_debut" max="<?php echo date('Y-m-d'); ?>">
                </td>
                <td style="width: 150px; text-align: center;">
                    <input id="heure_debut" type="time" name="heure_debut">
                </td>   
            </tr>
        </tbody>
    </table><br>
    
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon2">Services(s) Impacté(s) :</span><br>
    <input type="text" name="services" class="form-control" placeholder="Service(s)" aria-label="Service(s)" aria-describedby="basic-addon2" required><br><br>
    </div>
    <div class="input-group mb-3">
    <span class="input-group-text">Localisation :</span><br>
    <input type="text" name="localisation" class="form-control" placeholder="Localisation" aria-label="Localisation"><br><br>
    <span class="input-group-text">Impact :</span><br>
    <textarea name="impact" class="form-control" placeholder="Impact" aria-label="Impact"></textarea><br><br>
    <span class="input-group-text">Première(s) action(s) prévue(s) :</span><br>
    <textarea name="actions" class="form-control" placeholder="Premières actions prévues" aria-label="Actions"></textarea><br><br>
    <span class="input-group-text">Equipe(s) Mobilisé(es) :</span><br>
    <input type="text" name="equipes" class="form-control" placeholder="Équipes" aria-label="Équipes"><br><br>
    <span class="Resp" id="basic-addon1">Responsable(s) :</span><br>
    <select name="ma_liste_deroulante2">
        <?php
        $caracteres = array('Laurent ISS', 'Raoul Dorge'); // Remplacez les caractères par ceux de votre choix

        foreach ($caracteres as $caractere) {
            echo '<option value="' . $caractere . '">' . $caractere . '</option>';
        }
        ?>
    </select>
    </div>
</div><br><br>
        <input type="submit" name="save" value="Enregistrer">
    </form>

    <?php
if (isset($_POST['save'])) {
    $fields = [
        'services' => isset($_POST['services']) ? $_POST['services'] : '',
        'localisation' => isset($_POST['localisation']) ? $_POST['localisation'] : '',
        'impact' => isset($_POST['impact']) ? $_POST['impact'] : '',
        'actions' => isset($_POST['actions']) ? $_POST['actions'] : '',
        'equipes' => isset($_POST['equipes']) ? $_POST['equipes'] : '',
    ];

    $isAnyFieldEmpty = false;

    foreach ($fields as $field) {
        if (empty($field)) {
            $isAnyFieldEmpty = true;
            break;
        }
    }

    if ($isAnyFieldEmpty) {
        echo "<script>alert('Veuillez remplir tous les champs !');</script>";
    } else {
        echo "<script>alert('Tout est bon !');</script>";
        $query = "INSERT INTO storage (destinataires, date_debut, heure_debut, services, localisation, impact, actions_prevues, equipes_mobilisees, responsables)
                  VALUES (:destinataires, :date_debut, :heure_debut, :services, :localisation, :impact, :actions, :equipes, :responsables)";
    
        $stmt = $pdo->prepare($query);
    
        $stmt->bindParam(':destinataires', $_POST['ma_liste_deroulante']);
        $stmt->bindParam(':date_debut', $_POST['date_debut']);
        $stmt->bindParam(':heure_debut', $_POST['heure_debut']);
        $stmt->bindParam(':services', $_POST['services']);
        $stmt->bindParam(':localisation', $_POST['localisation']);
        $stmt->bindParam(':impact', $_POST['impact']);
        $stmt->bindParam(':actions', $_POST['actions']);
        $stmt->bindParam(':equipes', $_POST['equipes']);
        $stmt->bindParam(':responsables', $_POST['ma_liste_deroulante2']);
    
        if ($stmt->execute()) {
            // Les données ont été enregistrées avec succès dans la base de données 
            if ($_POST['ma_liste_deroulante'] == 'Wisam Kallouch') {
                $to = "wisam.kallouch@grenet.fr";
            } elseif ($_POST['ma_liste_deroulante'] == 'Raoul Dorge') {
                $to = "raoul.dorge@grenet.fr"; // Remplacez par l'adresse email de Raoul Dorge
            } elseif ($_POST['ma_liste_deroulante'] == 'DSIM_TOUS') {
                $to = "raoul.dorge@grenet.fr, wisam.kallouch@grenet.fr";
            }
        
            $subject = "Alerte";
            $message = "Une nouvelle alerte a été créée. Pour plus d'informations, merci de consulter l'onglet alerte en cours.";
        
            // En-têtes de l'e-mail
            $headers = "From: wisam.kallouch@grenet.fr\r\n";
            $headers .= "Reply-To: wisam.kallouch@grenet.fr\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            // Envoyer l'e-mail
            if (mail($to, $subject, $message, $headers)) {
                echo "<script>alert('L\'e-mail a été envoyé avec succès !');</script>";
            } else {
                echo "<script>alert('Erreur lors de l\'envoi de l\'e-mail !');</script>";
            }
        
            echo "<script>alert('Les données ont été enregistrées avec succès dans la base de données !');</script>";
        } else {
            // Une erreur s'est produite lors de l'exécution de la requête
            echo "<script>alert('Une erreur est survenue lors de l\'enregistrement des données dans la base de données.');</script>";
        }
    }
}    
?>
</body>
</html>