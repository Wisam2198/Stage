<?php
// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['username'])) {
    // Utilisateur non connecté, redirection vers la page de connexion
    header('Location: connexion.php'); // Remplacez index.php par l'URL de votre page de connexion
    exit();
}
?>
