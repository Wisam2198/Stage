<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link href="css/accueil.css" rel="stylesheet">
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
    <div id="logo">
        <a href="https://dsim.univ-grenoble-alpes.fr/">
            <img src="img/DSIM.png" alt="Logo DSIM">
        </a> 
    </div>
</ul>
</nav>
<h1>Page d'accueil</h1><br><br>
<div id="image">
        <img src="img/DSIM_accueil.jpg">
</div>
<p>Bienvenue sur le site de création et de gestion d'alerte de la DSIM.</p>
<p>Vous pourrez une fois votre compte créer grâce au lien disponible en bas de page, créer et gérer les alertes de la DSIM.
    Toutes les informations saisies seront stockées dans une base de donnée et vos mot de passe seront hashés.
</p>
<p>Le fonctionnement est simple une fois votre compte créer et que vous êtes connecté vous serez automatiquement
    redirigé vers la page de création d'alerte du nom de intervention.</p>
<p>Vous pourrez alors depuis cette page créer votre alerte en y renseignant vos informations dans les champs. Ils doivent tous être complétés.</p>
<p>Ensuite vous pourrez consulter votre alerte créer dans la page (alerte en cours). Dessus vous aurez la possibilité d'y ajouter 
    la date et l'heure de fin de l'alerte une fois celle-ci réglé.</p>
<p>Enfin vous aurez aussi accès a la page (alerte terminée), où vous pourrez y retrouver dessus toutes vos anciennes alertes créer et terminer.</p>  
<footer>
    <a href="connexion.php">Se connecter</a>
    <a href="inscrire.php">S'inscrire</a>
</footer>
</body>
</html>
