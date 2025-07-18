<?php
session_start();

header('Content-Type: application/json');
require('database.php');

if(!isset($_SESSION['utilisateur_id'])) {
    echo json_encode(["success" => false, "message" => "Non connecté"]);
    exit;
}    // on vérifie que l'utilisateur est connecté
$utilisateur_id = $_SESSION['utilisateur_id'];


$articleId = $_POST['article_id'] ?? null;
$type = $_POST['type'] ?? null;

if(!$articleId || !in_array($type, ['like','dislike'])){
    echo json_encode(["success" => false, "message" =>"Donnes invalides"]);
    exit ;
}

//verifie si l'utilisateur a deja reagi       

$sql = "
SELECT id,type
FROM likes
WHERE utilisateur_id = ?
AND article_id = ?";

$stmt = $pdo -> prepare($sql);
$stmt -> execute ([$utilisateur_id, $articleId]);
$reaction = $stmt ->fetch(PDO::FETCH_ASSOC);

if($reaction){
    if($reaction['type'] === $type){
        
        $sql = "
        DELETE FROM likes WHERE id = ? ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$reaction['id']]);
    }else{
        $sql = "
        UPDATE likes SET type = ?, date_action = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$type, $reaction['id']]);
    }
}else{
    $sql = "
    INSERT INTO likes (utilisateur_id, article_id, type, date_action) VALUES (?, ?, ?, NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$utilisateur_id, $articleId, $type ]);
}

echo json_encode(["success" => true]);

?>