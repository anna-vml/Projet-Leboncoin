<?php

require 'config.php';

if(!isset($_GET['id'])) {
    die("Annonce introuvable");
}

$id = $_GET['id'];

$sql = "SELECT * FROM annonces WHERE id = ?";
$requete = $pdo->prepare($sql);
$requete->execute([$id]);

$annonce = $requete->fetch();

if(!$annonce) {
    die("Annonce inexistante");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Détail annonce</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <div class="container mt-5">

    

        <div class="col-md-6">
        

          <img
             src="uploads/<?= htmlspecialchars($annonce['image']) ?>"
             class="img-fluid rounded-start"
             class="img-fluid rounded-start detail-image"
            >

        </div>

        <div class="col-md-6">

            <div class="card-body">

                <h2><?= htmlspecialchars($annonce['titre']) ?></h2>

                <h3 class="prix">
                    <?= $annonce['prix'] ?> €
                </h3>

                <p>
                    <strong>État :</strong>
                    <?= htmlspecialchars($annonce['etat']) ?>
                </p>

                <hr>

                <p>
                    <?= nl2br(htmlspecialchars($annonce['description'])) ?>
                </p>

                <a href="index.php" class="btn btn-secondary">
                    Retour
                </a>
                <br> 
                <a href="conversation.php?annonce=<?= $annonce['id'] ?>"
                   class="btn btn-success">
                   💬 Contacter le vendeur
                </a>

            </div>

        </div>

    </div>


            


    



</body>
</html>
