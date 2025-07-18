<?php
session_start();
header('Content-Type: application/json');

require_once("database.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = $data['email'] ?? '';
$password = $data['password'] ?? '';

//demander l'email et le mot_de_passe pour se connecter

if (!$email || !$password) {
    echo json_encode(["success" => false, "message" => "Champs requis."]);
    exit;
}

$sql = "SELECT id, nom, prenom, mot_de_passe FROM utilisateurs WHERE email = ? AND est_confirme = 1";
$stmt = $pdo -> prepare($sql);
$stmt->execute([$email]);

//on vérifie le mdp entré par l'utilisateur

$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || !password_verify($password, $user['mot_de_passe'])){
     echo json_encode(["success" => false, "message" => "Email ou mot de passe incorrect."]);
    exit;
}

$_SESSION['utilisateur_id']=$user['id'];

echo json_encode([
    "success" => true,
    "message" => "Connexion réussie.",
    "user" => [
        "id" => $user['id'],
        "nom" => $user['nom'],
        "prenom" => $user['prenom'],
        "email" => $email
    ]
]);
?>
