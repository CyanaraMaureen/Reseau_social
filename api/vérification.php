<?php
header('Content-Type: application/json');
require_once("database.php");

$data= json_decode(file_get_contents("php://input"), true);
$email = $data['email'] ?? null;

if (!$email){
    echo json_encode(["success"=>false, "message"=> "Email manquant."]);
    exit;
}

$sql = "SELECT id, est_confirme FROM utilisateurs WHERE email = ? AND est_confirme = 0";
$stmt = $pdo ->prepare($sql);
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode(["success"=>false,"message"=>"utilisateur non trouvé ou déjà confirmé."]);
    exit;
}

$sql = "UPDATE utilisateurs SET est_confirme = 1 WHERE id = ?";
$stmt = $pdo ->prepare($sql);
$stmt->execute([$user['id']]);

echo json_encode(["success"=> true,"message"=>"Compte vériié avec success"]);
?>