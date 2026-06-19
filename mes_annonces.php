<?php
session_start();
require 'connexion.php';

$sql = "SELECT * FROM annonces
        WHERE utilisateur_id = ?
        ORDER BY date_creation DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);

$annonces = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mes annonces</title>
</head>
<body>

<h2>Mes annonces</h2>

<a href="creer_annonce.php">Ajouter une annonce</a>

<hr>

<?php foreach($annonces as $annonce){ ?>

    <h3><?= htmlspecialchars($annonce['titre']) ?></h3>

    <p><?= $annonce['prix'] ?> €</p>

    <a href="modifier_annonce.php?id=<?= $annonce['id'] ?>">
        Modifier
    </a>

    |

    <a href="supprimer_annonce.php?id=<?= $annonce['id'] ?>">
        Supprimer
    </a>

    <hr>

<?php } ?>

</body>
</html>
