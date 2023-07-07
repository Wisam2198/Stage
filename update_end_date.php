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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $endDate = $_POST['endDate'];
        $endTime = $_POST['endTime'];

        // Mettre à jour la date de fin et l'heure de fin dans la base de données
        $query = "UPDATE storage SET date_fin = :endDate, heure_fin = :endTime WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(':endDate', $endDate);
        $stmt->bindValue(':endTime', $endTime);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        // Vérifier si la mise à jour a été effectuée avec succès
        if ($stmt->rowCount() > 0) {
            // La mise à jour a réussi
            session_start();

            // Récupérer les données de l'alerte en cours depuis la base de données ou toute autre source
            $query = "SELECT * FROM storage WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $alerteEncours = [
                'destinataires' => $row['destinataires'],
                'date_debut' => $row['date_debut'],
                'heure_debut' => $row['heure_debut'],
                'heure_fin' => $endTime,
                'services' => $row['services'],
                'localisation' => $row['localisation'],
                'impact' => $row['impact'],
                'actions_prevues' => $row['actions_prevues'],
                'equipes_mobilisees' => $row['equipes_mobilisees'],
                'responsables' => $row['responsables']
            ];

            // Enregistrer les données dans une variable de session
            $_SESSION['alerte_en_cours.php'] = $alerteEncours;

            // Rediriger vers la page "alerte_terminée.php"
            header('Location: alerte_terminee.php');
            exit();
        } else {
            // La mise à jour a échoué
            http_response_code(500); // Internal Server Error
        }
    } else {
        // Requête invalide
        http_response_code(400); // Bad Request
    }
} catch (PDOException $e) {
    // Erreur de connexion à la base de données
    http_response_code(500); // Internal Server Error
    echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
}
?>
