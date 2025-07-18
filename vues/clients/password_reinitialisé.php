<?php

$email = $_GET['email'] ?? null;
$token = $_GET['token'] ?? null;

if (!$email || !$token) {
    echo "Lien invalide";
    exit;
}

require_once("../../api/database.php");

$sql = "SELECT id FROM utilisateurs WHERE email = ? AND cle_confirmation = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$email, $token]);

if($stmt->rowCount() === 0){
    echo "Lien expiré ou invalide.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/icons/bootstrap-icons.css">
</head>
<body>

    <div class="reset-container">
        <h1>Réinitialiser votre mot de passe</h1>
        <form id="reset-form" method="post">
            <input type="password" id="new-password" placeholder="Nouveau mot de passe" required>
            <input type="password" id="confirm-password" placeholder="Confirmer le mot de passe" required>
            <button type="submit">Réinitialiser</button>
        </form>
    </div>
    <script src="../../assets/js/password_reinitialisé.js"></script>
</body>
</html>
