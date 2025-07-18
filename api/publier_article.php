<?php
session_start();

header('Content-Type: application/json');

require_once 'database.php';  

if(!isset($_SESSION['utilisateur_id'])) {
    echo json_encode(["success" => false, "message" => "Utilisateur non connecté"]);
    exit;
}
$utilisateur_id = $_SESSION['utilisateur_id'];


$contenu = $_POST['contenu'] ?? '';
$image = null;

//on vérifie si l'utilisateur a publié quelque chose

if(empty($contenu) && empty($_FILES['image']['tmp_name'])){
    echo json_encode(["success" => false, "message" => "Contenu vide"]);
    exit;
}

//le rechargement des images toujours pour la publication des articles

if(!empty($_FILES['image']['name'])){
    $nomTemporaire = $_FILES['image']['tmp_name'];
    $nom_Fichier = time() . "_" . basename($_FILES['image']['name']);
    $cheminDestination = "../assets/images/" . $nom_Fichier;

    if(move_uploaded_file($nomTemporaire, $cheminDestination)){
    $image = $nom_Fichier;
} else {
    echo json_encode(["success" => false, "message" => "Echec lors de l upload de l image"]);
    exit;
}

}

$sql = "INSERT INTO articles (utilisateur_id, contenu, `image`) VALUES (?, ?, ?)";
$stmt = $pdo -> prepare($sql);
$stmt -> execute([$utilisateur_id, $contenu, $image]);

echo json_encode(["success" => true]);
exit;
?>