<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== 'wisam') {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: verification.php');
    exit;
}
?>