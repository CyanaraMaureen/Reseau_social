<?php
session_start();

header('Content-Type: application/json');
require('database.php');

if(!isset($_GET["article_id"])){
    echo json_encode(["error" => "Article non specifie"]);
    exit;
}

$articleId = (int) $_GET['article_id'];
$utilisateurId = $_SESSION['utilisateur_id'] ?? null;

//compter les likes

$sqlLikes = "
SELECT COUNT(*)
FROM likes 
WHERE article_id = ?
AND type = 'like'";

$stmtLikes = $pdo -> prepare($sqlLikes);
$stmtLikes -> execute ([$articleId]);
$likes = (int) $stmtLikes -> fetchColumn();

//Compter les dislikes

$sqlDislikes = "
SELECT COUNT(*)
FROM likes 
WHERE article_id = ?
AND type = 'dislike'";

$stmtDislikes = $pdo -> prepare($sqlDislikes);
$stmtDislikes -> execute ([$articleId]);
$dislikes = (int) $stmtDislikes -> fetchColumn();

//savoir si lutilisateur a reagi

$aime = null;
if($utilisateurId){
    $sql = "
    SELECT type
    FROM likes
    WHERE article_id = ?
    AND utilisateur_id = ?";

    $stmt = $pdo -> prepare($sql);
    $stmt -> execute ([$articleId, $utilisateurId]);
    $aime = $stmt ->fetchColumn() ?:null;
}

echo json_encode([
    "likes" => $likes,
    "dislikes" => $dislikes,
    "aime" => $aime
]);

?>