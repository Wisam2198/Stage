<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    header('Location: intervention.php');
    exit();
}

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST['login'])) {
    // Récupérer les valeurs des champs de formulaire
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    // Connexion à la base de données PostgreSQL
    $host = 'localhost'; // Nom d'hôte
    $dbname = 'Interventions'; // Nom de la base de données
    $username = 'user_php'; // Nom d'utilisateur de la base de données
    $password = 'password'; // Mot de passe de la base de données

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête pour récupérer l'utilisateur correspondant à l'identifiant fourni
        $query = "SELECT * FROM utilisateurs WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['username' => $Username]);
        $user = $stmt->fetch();

        if ($user && password_verify($Password, $user['password'])) {
            // Les identifiants sont valides
            $_SESSION['username'] = $Username; // Initialiser la variable de session
            header('Location: intervention.php');
            exit();
        } else {
            echo '<script>afficherPopup();</script>'; // Appel de la fonction JavaScript pour afficher la fenêtre contextuelle
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Intervention</title>
    <link href="css/connexion.css" rel="stylesheet">
    <script>
        function afficherPopup() {
            alert("Identifiant ou mot de passe incorrect.");
        }
    </script>
</head>
<body>
    <h1>Veuillez vous identifier ci-dessous</h1><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form class="login" method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" name="login" id="connect" value="Se connecter">
    </form><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div id="inscrire">
        <a href="inscrire.php">S'inscrire</a>
    </div>
</body>
</html>