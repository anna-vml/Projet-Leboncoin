<?php
require 'config.php';

$recherche = "";

if(isset($_GET['recherche'])) {
    $recherche = $_GET['recherche'];
}

$sql = "SELECT * FROM annonces
        WHERE titre LIKE ?
        ORDER BY date_creation DESC";

$requete = $pdo->prepare($sql);
$requete->execute(["%$recherche%"]);

$annonces = $requete->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leboncoin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h1 class="text-center mb-4">
        Dernières annonces
    </h1>

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="recherche"
                class="form-control"
                placeholder="Rechercher une annonce..."
                value="<?= htmlspecialchars($recherche) ?>"
            >

            <button class="btn btn-primary">
                Rechercher
            </button>

        </div>

    </form>

    <div class="row">

        <?php foreach($annonces as $annonce): ?>

            <div class="col-md-4 mb-4">

                <div class="card h-100">

                    <img
                        src="uploads/<?= $annonce['image'] ?>"
                        class="card-img-top"
                        style="height:220px; object-fit:cover;"
                    >

                    <div class="card-body">

                        <h5>
                            <?= htmlspecialchars($annonce['titre']) ?>
                        </h5>

                        <p class="fw-bold text-success">
                            <?= $annonce['prix'] ?> €
                        </p>

                        <a
                            href="detail_annonce.php?id=<?= $annonce['id'] ?>"
                            class="btn btn-primary"
                        >
                            Voir l'annonce
                        </a>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>
