<?php 
require_once 'includes/auth_guard.php'; 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Mon Profil</h2>
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="actions/action_profil.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nom ou Pseudo</label>
                        <input type="text" class="form-control" name="nom" value="<?= htmlspecialchars($_SESSION['user_nom']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($_SESSION['user_email']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe (laisser vide si inchangé)</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    <a href="actions/action_deconnexion.php" class="btn btn-danger float-end">Se déconnecter</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>