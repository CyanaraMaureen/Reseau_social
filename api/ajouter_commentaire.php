<?php
session_start();

header('Content-Type: application/json');
require('database.php');   //on fait la connexion à la bdd

if(!isset($_SESSION['utilisateur_id'])) {
    echo json_encode(["success" => false, "message" => "Non connecté"]);
    exit;
}    // on vérifie que l'utilisateur est connecté
$utilisateur_id = $_SESSION['utilisateur_id'];

$article_id = $_POST['article_id'] ?? null ;
$contenu = trim($_POST['contenu'] ?? '');

if(!$article_id || empty($contenu)){
    echo json_encode(["success" => false, "message" => "Champs manquants"]);
    exit;
}

//requête pour insérer un commentaire

$sql ="
INSERT INTO commentaires (utilisateur_id, article_id, contenu)   
VALUES (?, ?, ?)";

$stmt = $pdo -> prepare($sql);
$stmt -> execute([$utilisateur_id, $article_id, $contenu]);

echo json_encode(["success" => true]);
?>