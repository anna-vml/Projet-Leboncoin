<?php
   session_start();
   require_once 'includes/db.php';

    if (!isset($_SESSION['user_id'])) {
      header("Location: connexion.php");
      exit();
    }

    $sql = "SELECT annonces.*
    FROM favoris
    INNER JOIN annonces ON favoris.annonce_id = annonces.id
    WHERE favoris.utilisateur_id = ?
    ORDER BY favoris.date_ajout DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $favoris = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mes favoris</title>
    <link rel="stylesheet" href="assets/style.css?v=20">
</head>
<body>

<div class="favoris-page">

    <div class="favoris-header">
        <h1>❤️ Mes favoris</h1>
        <a href="index.php">← Retour à l'accueil</a>
    </div>

    <?php if (empty($favoris)) { ?>

        <p>Aucun favori pour le moment.</p>

    <?php } else { ?>

        <div class="favoris-grid">

            <?php foreach ($favoris as $annonce) { ?>

                <div class="favoris-card">

                    <?php if (!empty($annonce['image'])) { ?>
                        <img src="uploads/<?= htmlspecialchars($annonce['image']) ?>">
                    <?php } ?>

                    <div class="favoris-body">
                        <h3><?= htmlspecialchars($annonce['titre']) ?></h3>

                        <p class="favoris-prix">
                            <?= $annonce['prix'] ?> €
                        </p>

                        <a href="detail_annonce.php?id=<?= $annonce['id'] ?>" class="btn-voir">
                            Voir l'annonce
                        </a>

                        <a href="supprimer_favoris.php?id=<?= $annonce['id'] ?>"
                           class="btn-retirer"
                           onclick="return confirm('Retirer cette annonce des favoris ?');">
                           ❤️ Retirer des favoris
                        </a>
                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } ?>

</div>

</body>
</html>
