<?php

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
</head>
<body>

    <div class="forgot-container">
        <h1>Mot de passe oublié</h1>
        <form id="forgot-form">
            <input type="email" id="email" placeholder="Votre email" required>
            <button type="submit">Envoyer un lien de réinitialisation</button>
        </form>
        <p><a href="connexion.php">Retour à la connexion</a></p>
    </div>
    <script src="../../assets/js/password_oublié.js"></script>
</body>
</html>
