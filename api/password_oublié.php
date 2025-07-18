<?php
header('Content-Type: application/json');
require_once ("database.php");

$data = json_decode(file_get_contents("php://input"), true);
$email=$data ['email'] ?? null;

if (!$email) {
    echo json_encode(["message" => "Email manquant"]);
    exit;
}

$sql = "SELECT id FROM utilisateurs WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email]);


if ($stmt->rowCount() === 0) {
    echo json_encode(["message" => "Email non trouvé."]);
    exit;
}

$token = bin2hex(random_bytes(16));

$sql = "UPDATE utilisateurs SET cle_confirmation = ? WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$token, $email]);

$link = "http://localhost/Mon_projet/Reseau_social/vues/clients/password_reinitialisé.php?email=$email&token=$token";

echo json_encode(["success" => true, "message" => "Voici le lien de réinitialisation généré:", "link" => $link]);
?>
