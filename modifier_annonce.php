<?php
session_start();
require 'connexion.php';

$id = $_GET['id'];
$sql = "SELECT * FROM annonces WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
$annonce = $stmt->fetch();

if (!$annonce) {
    die("Annonce introuvable");
}

if ($annonce['utilisateur_id'] != $_SESSION['user_id']) {
    die("Accès refusé");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier l'annonce - Campus Market</title>
<style>
    :root {
        --bleu-marine: #0a1f5c;
        --bleu-fonce: #0c2a7a;
        --dore: #d4a843;
        --dore-clair: #f0c869;
        --gris-clair: #f5f6fa;
        --gris-bordure: #e0e0e0;
        --texte-fonce: #1a1a2e;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Arial, sans-serif;
        background-color: var(--gris-clair);
        color: var(--texte-fonce);
    }

    /* ===== HEADER ===== */
    header {
        background: linear-gradient(135deg, var(--bleu-marine), var(--bleu-fonce));
        padding: 18px 40px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }

    .logo-bloc {
        display: flex;
        flex-direction: column;
    }

    .logo-bloc h1 {
        color: #ffffff;
        font-size: 1.7rem;
        font-weight: 800;
    }

    .logo-bloc span {
        color: var(--dore-clair);
        font-size: 0.7rem;
        letter-spacing: 1px;
        font-weight: 600;
    }

    nav {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    nav a {
        text-decoration: none;
        background-color: #ffffff;
        color: var(--bleu-marine);
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    nav a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }

    nav a.deconnexion {
        background-color: var(--dore);
        color: var(--bleu-marine);
    }

    /* ===== CONTENU ===== */
    main {
        max-width: 600px;
        margin: 40px auto;
        padding: 0 20px;
    }

    .carte-formulaire {
        background-color: #ffffff;
        border: 1px solid var(--dore);
        border-radius: 14px;
        padding: 35px 40px;
        box-shadow: 0 4px 18px rgba(10, 31, 92, 0.08);
    }

    .carte-formulaire h2 {
        color: var(--bleu-marine);
        font-size: 1.6rem;
        margin-bottom: 6px;
    }

    .carte-formulaire .soustitre {
        color: var(--dore);
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 1rem;
    }

    label {
        display: block;
        font-weight: 600;
        color: var(--bleu-marine);
        margin-bottom: 6px;
        font-size: 0.9rem;
    }

    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid var(--gris-bordure);
        border-radius: 8px;
        font-size: 1rem;
        font-family: inherit;
        margin-bottom: 20px;
        transition: border-color 0.15s ease, box-shadow 0.15s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        outline: none;
        border-color: var(--dore);
        box-shadow: 0 0 0 3px rgba(212, 168, 67, 0.2);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    button[type="submit"] {
        width: 100%;
        background-color: var(--bleu-marine);
        color: #ffffff;
        border: none;
        padding: 14px;
        font-size: 1.05rem;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.15s ease, transform 0.15s ease;
    }

    button[type="submit"]:hover {
        background-color: var(--dore);
        color: var(--bleu-marine);
        transform: translateY(-1px);
    }
</style>
</head>
<body>

<header>
    <div class="logo-bloc">
        <h1>Campus Market</h1>
        <span>ACHAT ET VENTE ENTRE ÉTUDIANTS</span>
    </div>
    <nav>
        <a href="accueil.php">Accueil</a>
        <a href="profil.php">Profil</a>
        <a href="creer_annonce.php">Créer annonce</a>
        <a href="mes_annonces.php">Mes annonces</a>
        <a href="favoris.php">Favoris</a>
        <a href="deconnexion.php" class="deconnexion">Déconnexion</a>
    </nav>
</header>

<main>
    <div class="carte-formulaire">
        <h2>Modifier l'annonce</h2>
        <p class="soustitre">Mettez à jour les informations de votre annonce</p>

        <form action="update_annonce.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($annonce['id']) ?>">

            <label for="titre">Titre</label>
            <input type="text"
                   id="titre"
                   name="titre"
                   value="<?= htmlspecialchars($annonce['titre']) ?>">

            <label for="prix">Prix (€)</label>
            <input type="number"
                   id="prix"
                   step="0.01"
                   name="prix"
                   value="<?= htmlspecialchars($annonce['prix']) ?>">

            <label for="description">Description</label>
            <textarea id="description" name="description"><?= htmlspecialchars($annonce['description']) ?></textarea>

            <button type="submit">Modifier l'annonce</button>
        </form>
    </div>
</main>

</body>
</html>
