<?php

header('Content-Type: application/json');

require('database.php');

$article_id = $_GET['article_id'] ?? null ;

if(!$article_id){
    echo json_encode(["success" => false, "message" => "ID manquant"]);
    exit;
}

$sql = "
SELECT c.contenu, c.date_creation, u.nom, u.prenom 
FROM commentaires c 
JOIN utilisateurs u 
ON c.utilisateur_id = u.id
WHERE c.article_id = ? 
ORDER BY c.date_creation ASC  
";

$stmt = $pdo -> prepare($sql);
$stmt -> execute([$article_id]);
$commentaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($commentaires);

?>