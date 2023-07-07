<?php
// Vérifier si le formulaire a été soumis
if (isset($_POST['register'])) {
    // Récupérer les valeurs des champs de formulaire
    $Username = $_POST['username'];
    $Password = $_POST['password'];

    // Hacher le mot de passe
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    // Connexion à la base de données PostgreSQL
    $host = 'localhost'; // Nom d'hôte
    $dbname = 'Interventions'; // Nom de la base de données
    $username = 'user_php'; // Nom d'utilisateur de la base de données
    $password = 'password'; // Mot de passe de la base de données

    try {
        $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête d'insertion de l'utilisateur avec le mot de passe haché
        $query = "INSERT INTO utilisateurs (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['username' => $Username, 'password' => $hashedPassword]);

        // Redirection vers une nouvelle page après l'inscription réussie
        header('Location: connexion.php');
        exit; // Assurez-vous d'utiliser exit pour arrêter l'exécution du script
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Intervention</title>
    <link href="css/inscrire.css" rel="stylesheet">
    <script>
        function afficherPopup() {
            alert("Identifiant ou mot de passe incorrect.");
        }
    </script>
</head>
<body>
    <!-- Formulaire d'inscription -->
    <h1>Inscription</h1><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form class="inscription" method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" name="register" id="connect" value="S'inscrire">
    </form><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div id="connecter">
        <a href="connexion.php">Se connecter</a>
    </div>
</body>
</html>
