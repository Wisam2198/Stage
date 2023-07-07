<script>
        function afficherPopup() {
            alert("Votre compte n\'est pas autorisé à accéder à cette page.");
        }
</script>
<?php
// Démarrer la session
session_start();

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier les informations d'identification
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier si les identifiants sont valides
    if ($username === 'wisam' && $password === 'kallouch') {
        // Authentification réussie, définir la session de l'utilisateur
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        // Rediriger vers la page protégée
        header('Location: moyenne.php');
        exit;
    } else {
        // Identifiants invalides, afficher un message d'erreur
        echo '<script>afficherPopup();</script>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Intervention</title>
    <link href="css/verification.css" rel="stylesheet">
</head>
<body>
    <h1>Avez-vous les droits d'entrer dans cette page ?</h1><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <form class="login" method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required><br><br>
        <input type="submit" name="login" id="connect" value="Se connecter">
    </form><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<a href="accueil.php">Accueil</a>
</body>
</html>