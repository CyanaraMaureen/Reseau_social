<?php
session_start();

header('Content-Type: application/json');

require_once 'database.php';  //  le lien vers la bdd

if(!isset($_SESSION['utilisateur_id'])) {
    echo json_encode(["erreur" => "Non connecté"]);
    exit;
}
$utilisateur_id = $_SESSION['utilisateur_id'];


//requête pour récupérer les articles publiées, les likes et dislikes associés

$sql = "
SELECT a.id, a.utilisateur_id, a.contenu, a.image, a.date_creation, u.nom, u.prenom, u.photo_profil, 
        (SELECT COUNT(*) FROM likes WHERE article_id = a.id AND type = 'like') AS likes,
        (SELECT COUNT(*) FROM likes WHERE article_id = a.id AND type = 'dislike') AS dislikes
FROM articles a
JOIN utilisateurs u ON 
a.utilisateur_id = u.id
ORDER BY a.date_creation DESC";


$stmt = $pdo -> prepare($sql);
$stmt -> execute();
$articles = $stmt -> fetchAll(PDO::FETCH_ASSOC);

echo json_encode($articles);
exit;
?>
