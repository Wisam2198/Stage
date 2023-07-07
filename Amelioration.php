<!DOCTYPE html>
<html>
<head>
    <title>Ma page</title>
    <style> 
        body {
            background-color: grey;
            background-size: cover;
        }
        nav {
            background-color: chocolate;
            height: 50px;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            margin-right: 10px;
        }

        nav ul li a {
            color: black;
            text-decoration: none;
            padding: 10px;
        }

        nav ul li a:hover {
            background-color: green;
        }

        #déconnexion {
            text-align: right;
        }

        h1 {
            text-decoration: underline;
            color: aqua;
        }

        #tableau {
            margin-padding: 100px;
        }

        .container {
        border: 2px solid #000;
        padding: 10px;
        width: 1000px;
        height: 500px;
        }

        .Dest {
            text-decoration: underline;
            color: yellow;
            text-decoration: bold;
        }
    </style>
</head>
<body>
<?php
$host = 'localhost'; // Hôte de la base de données
$port = 5432; // Port de la base de données
$dbname = 'Interventions'; // Nom de la base de données
$user = 'postgres'; // Nom d'utilisateur de la base de données
$password = null; // Mot de passe de la base de données (null si aucun mot de passe)

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    
    if ($password !== null) {
        $pdo = new PDO($dsn, $user, $password);
    } else {
        $pdo = new PDO($dsn, $user);
    }
    
    // Le reste de votre code pour interagir avec la base de données
} catch (PDOException $e) {
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
    // Gérer l'erreur de connexion à la base de données
}
?>
<nav>
    <ul><br>
        <div id="déconnexion">
            <li><a href="deconnexion.php">Déconnexion</a></li>
        </div> 
    </ul>
</nav>
    </nav>
    <h1>Renseignement des informations d'interventions</h1>
    <div class="container">
    <form method="POST" action="">
        <div class="input-group mb-3">
    <span class="Dest" id="basic-addon1">Destinataire</span><br><br>
    <select name="ma_liste_deroulante">
    <?php
    $caracteres = array('DSIM_TOUS', 'Laurent ISS', 'Quentin Burger'); // Remplacez les caractères par ceux de votre choix

    foreach ($caracteres as $caractere) {
        echo '<option value="' . $caractere . '">' . $caractere . '</option>';
    }
    ?>
</select>
    </div><br><br>
    <table class="table">
        <thead>
            <tr>
                <th scope="row"></th>
                <th scope="col">Date</th>
                <th scope="col">Heure de début</th>
                <th scope="col">Heure de fin</th>
            </tr>
        </thead>
        <tbody>

            <!-- Date, mois, année -->

            <tr>
                <th scope="row"></th>
                <td>
                    <select name="date1">
                        <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                    
                    <select name="mois1">
                        <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>

                    <select name="année1">
                        <?php
                            for ($i = 2000; $i <= 2023; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="heure_debut1">
                        <?php
                            for ($i = 1; $i <= 24; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>

                    <select name="minute_debut1">
                        <?php
                            for ($i = 0; $i <= 59; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="heure_fin1">
                        <?php
                            for ($i = 1; $i <= 24; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>

                    <select name="minute_fin1">
                        <?php
                            for ($i = 0; $i <= 59; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                        ?>
                    </select>
                </td>    
            </tr>
        </tbody>
    </table><br>
    
    <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon2">Service(s) Impacté(s)</span><br>
    <input type="text" name="service" class="form-control" placeholder="Service(s)" aria-label="Service(s)" aria-describedby="basic-addon2"><br><br>
    </div>
    <div class="input-group mb-3">
    <span class="input-group-text">Localisation :</span><br>
    <input type="text" name="localisation" class="form-control" placeholder="Localisation" aria-label="Localisation"><br><br>
    <span class="input-group-text">Impact :</span><br>
    <input type="text" name="impact" class="form-control" placeholder="Impact" aria-label="Impact"><br><br>
    <span class="input-group-text">Premières actions préves :</span><br>
    <input type="text" name="actions" class="form-control" placeholder="Actions" aria-label="Actions"><br><br>
    <span class="input-group-text">Equipes Mobilisées :</span><br>
    <input type="text" name="equipes" class="form-control" placeholder="Equipes" aria-label="Equipes"><br><br>
    <span class="input-group-text">Responsables :</span><br>
    <input type="text" name="responsables" class="form-control" placeholder="Responsables" aria-label="Responsables"><br><br><br>
    </div>
</div>
        <input type="submit" name="save" value="Enregistrer">
    </form>

    <?php
    if (isset($_POST['save'])) {
        $fields = [
            'service' => isset($_POST['service']) ? $_POST['service'] : '',
            'localisation' => isset($_POST['localisation']) ? $_POST['localisation'] : '',
            'impact' => isset($_POST['impact']) ? $_POST['impact'] : '',
            'actions' => isset($_POST['actions']) ? $_POST['actions'] : '',
            'equipes' => isset($_POST['equipes']) ? $_POST['equipes'] : '',
            'responsables' => isset($_POST['responsables']) ? $_POST['responsables'] : '',
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
            $query = "INSERT INTO interventions (destinataire, date, heure_debut, heure_fin, service_impacte, localisation, impact, actions_preves, equipes_mobilisees, responsables)
              VALUES (:destinataire, :date, :heure_debut, :heure_fin, :service, :localisation, :impact, :actions, :equipes, :responsables)";
    
            $stmt = $pdo->prepare($query);
            
            $stmt->bindParam(':destinataire', $_POST['ma_liste_deroulante']);
            $stmt->bindParam(':date', $_POST['date1'].'-'.$_POST['mois1'].'-'.$_POST['annee1']);
            $stmt->bindParam(':heure_debut', $_POST['heure_debut1'].':'.$_POST['minute_debut1']);
            $stmt->bindParam(':heure_fin', $_POST['heure_fin1'].':'.$_POST['minute_fin1']);
            $stmt->bindParam(':service', $_POST['service']);
            $stmt->bindParam(':localisation', $_POST['localisation']);
            $stmt->bindParam(':impact', $_POST['impact']);
            $stmt->bindParam(':actions', $_POST['actions']);
            $stmt->bindParam(':equipes', $_POST['equipes']);
            $stmt->bindParam(':responsables', $_POST['responsables']);
            
            if ($stmt->execute()) {
                echo "<script>alert('Les données ont été enregistrées avec succès dans la base de données !');</script>";
            } else {
                echo "<script>alert('Une erreur est survenue lors de l'enregistrement des données dans la base de données. Veuillez réessayer.');</script>";
            }
            }
        }
        ?>
</body>
</html>