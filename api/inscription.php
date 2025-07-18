<?php
header('Content-Type: application/json');

require_once("database.php");
$data = json_decode(file_get_contents("php://input"), true);

$nom = $data['nom'] ?? '';
$prenom = $data['prenom'] ?? '';
$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

if (!$nom || !$prenom || !$email || !$password) {
    echo json_encode(["success" => false, "message" => "Tous les champs sont requis."]);
    exit;
}

$sql = "SELECT id FROM utilisateurs WHERE email = ?";
$stmt = $pdo -> prepare($sql);
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo json_encode(["success" => false, "message" => "Email déjà utilisé."]);
    exit;
}

$password_hache = password_hash($password, PASSWORD_DEFAULT);
$est_confirme = 1;

$sql = "INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, est_confirme) VALUES (?, ?, ?, ?, ?)";
$stmt = $pdo -> prepare($sql);
$success = $stmt -> execute([$nom, $prenom, $email, $password_hache, $est_confirme]);
if ($success){
    echo json_encode(["success" => true,
    "message" => "Inscription réussie. Cliquez sur le lien pour vérifier votre compte."]);
     } else {
    echo json_encode(["Success"=> false,"message"=>"Erreur lors de l'inscription."]);
     }
?>
