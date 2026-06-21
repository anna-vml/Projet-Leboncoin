<?php
  require 'config.php';

  $recherche = "";

   if(isset($_GET['recherche'])) {
      $recherche = $_GET['recherche'];
    }

    $sql = "SELECT annonces.*, utilisateurs.nom
        FROM annonces
        LEFT JOIN utilisateurs
        ON annonces.utilisateur_id = utilisateurs.id
        WHERE annonces.titre LIKE ?
        ORDER BY annonces.date_creation DESC";

    $requete = $pdo->prepare($sql);
    $requete->execute(["%$recherche%"]);
    $annonces = $requete->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leboncoin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css?v=2">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">

           <a class="navbar-brand fw-bold logo-campus" href="index.php">
              
               <div>
                 <div> 🎓 Campus  <span>Market</span></div>
                 <small>ACHAT ET VENTE ENTRE ÉTUDIANTS</small>
             </div>
          </a>

        </div>
    </nav>
    <div class="container mt-4">

        <div class="campus-banner">
           <h2 class="titre-campus">
              Bienvenue sur 
              <br>
              <span>Campus Market</span>
           </h2>
           <p class="text-muted">
              La plateforme de petites annonces dédiée aux étudiants.
            </p>

           

        </div>

    </div>

    <div class="container mt-4">

    
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
        <h2 class="section-title">Dernières annonces</h2>
        <div class="row">
           <?php if (empty($annonces)): ?>

                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        Aucune annonce trouvée.
                    </div>
                </div>

            <?php else: ?>
          
                <?php foreach($annonces as $annonce): ?>

                   <div class="col-md-3 mb-4">

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

                                <p class="text-muted small">
                                   Publié le <?= date('d/m/Y à H:i', strtotime($annonce['date_creation'])) ?>
                               </p>

                                <p class="text-muted small">
                                  Publié par <?= htmlspecialchars($annonce['nom'] ?? 'Utilisateur') ?>
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
            <?php endif; ?>
        </div>

    </div>

</body>

</html>
