<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Le Bon Coin Étudiant</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
.hero{
    background: linear-gradient(135deg,#0d6efd,#4dabf7);
    color:white;
    padding:80px 20px;
    text-align:center;
}

.card{
    transition:0.3s;
}

.card:hover{
    transform:scale(1.05);
}

body{
    background-color:#f8f9fa;
}
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
             Le Bon Coin Étudiant
        </a>
    </div>
</nav>

<!-- Bannière -->
<section class="hero">
    <div class="container">
        <h1 class="display-4">Bienvenue sur Le Bon Coin Étudiant</h1>
        <p class="lead">
            Trouvez facilement des stages, alternances, logements et services étudiants.
        </p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
                <input type="text" class="form-control form-control-lg"
                       placeholder="🔍 Rechercher une annonce">
            </div>
        </div>
    </div>
</section>

<!-- Annonces -->
<div class="container my-5">

    <h2 class="text-center mb-4">Dernières annonces</h2>

    <div class="row">

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">💻 Stage Développeur Web</h5>
                    <p class="card-text">
                        Recherche stagiaire en développement web pour 3 mois.
                    </p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">📈 Alternance Marketing</h5>
                    <p class="card-text">
                        Entreprise recrute un alternant en communication digitale.
                    </p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h5 class="card-title">🏠 Logement Étudiant</h5>
                    <p class="card-text">
                        Studio meublé à proximité de l'université.
                    </p>
                    <a href="#" class="btn btn-primary">Voir plus</a>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center p-3">
    © 2026 Le Bon Coin Étudiant
</footer>

</body>
</html>
