<?php
header('Content-Type: application/json');
require_once("database.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? null ; 
$token = $data['token'] ?? null ; 
$password = $data['password'] ?? null ;

if (!$email || !$token || !$password ) {
    echo json_encode(["success" => false, "message" => "Champs requis manquants"]);
    exit;
}

$sql = "SELECT id FROM utilisateurs WHERE email = ? AND cle_confirmation = ?";
$stmt = $pdo -> prepare($sql);
$stmt->execute([$email, $token]);

if($stmt->rowCount() === 0){
    echo json_encode(["success" =>false, "message" =>"Lien invalide ou expiré"]);
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "UPDATE utilisateurs SET mot_de_passe = ?, cle_confirmation = NULL WHERE email = ?";
$stmt = $pdo -> prepare($sql);
$success = $stmt->execute([$hash, $email]);

if($success){
    echo json_encode(["success" => true, "message" => "Mot de passe réinitialisé avec succès."]);
}else{
    echo json_encode(["success" => false, "message" => "Ecehc de la mise à jour du mot de passe."]);
}
?>
