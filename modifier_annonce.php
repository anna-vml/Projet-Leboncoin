<?php
session_start();
require 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour accéder à cette page");
}

if (!isset($_GET['id'])) {
    die("Annonce introuvable");
}

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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        --texte-muted: #6b6f7d;
        --vert: #2e9e5b;
        --vert-fonce: #237e47;
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
        min-height: 100vh;
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
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
    }

    .logo-bloc {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo-bloc .icone {
        font-size: 1.6rem;
        color: var(--dore-clair);
    }

    .logo-bloc .textes {
        display: flex;
        flex-direction: column;
    }

    .logo-bloc h1 {
        color: #ffffff;
        font-size: 1.7rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .logo-bloc span {
        color: var(--dore-clair);
        font-size: 0.7rem;
        letter-spacing: 1px;
        font-weight: 600;
        text-transform: uppercase;
    }

    nav {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    nav a {
        text-decoration: none;
        background-color: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        color: #ffffff;
        padding: 9px 18px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    nav a:hover {
        background-color: rgba(255, 255, 255, 0.18);
        color: var(--dore-clair);
        transform: translateY(-2px);
    }

    nav a.deconnexion {
        background: linear-gradient(135deg, var(--dore), var(--dore-clair));
        color: var(--bleu-marine);
        border: none;
    }

    nav a.deconnexion:hover {
        color: var(--bleu-marine);
        filter: brightness(1.05);
    }

    /* ===== CONTENU ===== */
    main {
        max-width: 600px;
        margin: 50px auto;
        padding: 0 20px;
    }

    .fil-retour {
        display: inline-block;
        margin-bottom: 18px;
        color: var(--bleu-marine);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: color 0.2s ease;
    }

    .fil-retour:hover {
        color: var(--dore);
    }

    .carte-formulaire {
        background-color: #ffffff;
        border: 1px solid #eceef5;
        border-top: 4px solid var(--dore);
        border-radius: 14px;
        padding: 35px 40px;
        box-shadow: 0 8px 24px rgba(10, 31, 92, 0.10);
    }

    .carte-formulaire h2 {
        color: var(--bleu-marine);
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .carte-formulaire .soustitre {
        color: var(--texte-muted);
        font-weight: 500;
        margin-bottom: 28px;
        font-size: 0.95rem;
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
        line-height: 1.5;
    }

    .boutons {
        display: flex;
        gap: 12px;
        margin-top: 6px;
    }

    button[type="submit"] {
        flex: 1;
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

    a.btn-annuler {
        flex: 0 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 22px;
        border: 2px solid var(--bleu-marine);
        color: var(--bleu-marine);
        font-weight: 700;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    a.btn-annuler:hover {
        background-color: var(--bleu-marine);
        color: #ffffff;
    }

    footer {
        text-align: center;
        padding: 22px 16px;
        color: var(--texte-muted);
        font-size: 0.85rem;
        margin-top: 30px;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 600px) {
        header {
            padding: 16px 20px;
        }

        .carte-formulaire {
            padding: 28px 24px;
        }

        .boutons {
            flex-direction: column;
        }
    }
</style>
</head>
<body>

<header>
    <div class="logo-bloc">
        <span class="icone">🚩</span>
        <div class="textes">
            <h1>Campus Market</h1>
            <span>Achat et vente entre étudiants</span>
        </div>
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
    <a href="mes_annonces.php" class="fil-retour">← Retour à mes annonces</a>

    <div class="carte-formulaire">
        <h2>Modifier l'annonce</h2>
        <p class="soustitre">Mettez à jour les informations de votre annonce</p>

        <form action="update_annonce.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($annonce['id']) ?>">

            <label for="titre">Titre</label>
            <input type="text"
                   id="titre"
                   name="titre"
                   value="<?= htmlspecialchars($annonce['titre']) ?>"
                   required>

            <label for="prix">Prix (€)</label>
            <input type="number"
                   id="prix"
                   step="0.01"
                   min="0"
                   name="prix"
                   value="<?= htmlspecialchars($annonce['prix']) ?>"
                   required>

            <label for="description">Description</label>
            <textarea id="description"
                      name="description"
                      required><?= htmlspecialchars($annonce['description']) ?></textarea>

            <div class="boutons">
                <button type="submit">Enregistrer les modifications</button>
                <a href="mes_annonces.php" class="btn-annuler">Annuler</a>
            </div>
        </form>
    </div>
</main>

<footer>
    &copy; <?= date('Y') ?> Campus Market — La plateforme de petites annonces dédiée aux étudiants.
</footer>

</body>
</html>
