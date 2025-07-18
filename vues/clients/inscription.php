
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../../assets/icons/bootstrap-icons.css">
</head>
<body>
<div class="register-container">
        <h2 class="text-center mb-4">Inscription</h2>
        <form id="inscription-form">
            <div class="mb-3">
                <label for="firstname" class="form-label">Prénom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Votre prénom" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Nom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Votre nom" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre e-mail" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Confirmez le mot de passe" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-2">S'inscrire</button>
        </form>
        <div class="text-center mt-3">
            <span class="text-muted small">Déjà un compte ?</span>
            <a href="connexion.php" class="small text-primary">Se connecter</a>
        </div>
    </div>
    <script src="../../assets/js/inscription.js"></script>

</body>
</html>