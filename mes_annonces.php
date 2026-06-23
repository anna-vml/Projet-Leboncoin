<?php
session_start();
require 'connexion.php';

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour accéder à cette page");
}

$sql = "SELECT * FROM annonces
        WHERE utilisateur_id = ?
        ORDER BY date_creation DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$annonces = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mes annonces - Campus Market</title>
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
        --rouge: #d9534f;
        --rouge-fonce: #b8403c;
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
        max-width: 900px;
        margin: 50px auto;
        padding: 0 20px;
    }

    .entete-page {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 28px;
    }

    .entete-page h2 {
        color: var(--bleu-marine);
        font-size: 1.8rem;
        font-weight: 800;
    }

    .entete-page p {
        color: var(--texte-muted);
        font-size: 0.95rem;
        margin-top: 4px;
    }

    .btn-ajouter {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: var(--bleu-marine);
        color: #ffffff;
        text-decoration: none;
        font-weight: 700;
        padding: 12px 22px;
        border-radius: 8px;
        white-space: nowrap;
        transition: background-color 0.2s ease, transform 0.15s ease;
    }

    .btn-ajouter:hover {
        background-color: var(--dore);
        color: var(--bleu-marine);
        transform: translateY(-2px);
    }

    /* ===== LISTE DES ANNONCES ===== */
    .liste-annonces {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .carte-annonce {
        background-color: #ffffff;
        border: 1px solid #eceef5;
        border-left: 4px solid var(--dore);
        border-radius: 12px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        flex-wrap: wrap;
        box-shadow: 0 4px 14px rgba(10, 31, 92, 0.06);
        transition: box-shadow 0.2s ease, transform 0.2s ease;
    }

    .carte-annonce:hover {
        box-shadow: 0 8px 22px rgba(10, 31, 92, 0.12);
        transform: translateY(-2px);
    }

    .infos-annonce h3 {
        color: var(--bleu-marine);
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .infos-annonce .prix {
        color: var(--dore);
        font-weight: 800;
        font-size: 1.15rem;
    }

    .actions-annonce {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .actions-annonce a {
        text-decoration: none;
        font-weight: 700;
        font-size: 0.9rem;
        padding: 10px 18px;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .btn-modifier {
        background-color: rgba(10, 31, 92, 0.08);
        color: var(--bleu-marine);
        border: 1px solid var(--bleu-marine);
    }

    .btn-modifier:hover {
        background-color: var(--bleu-marine);
        color: #ffffff;
    }

    .btn-supprimer {
        background-color: rgba(217, 83, 79, 0.08);
        color: var(--rouge-fonce);
        border: 1px solid var(--rouge);
    }

    .btn-supprimer:hover {
        background-color: var(--rouge);
        color: #ffffff;
    }

    /* ===== ETAT VIDE ===== */
    .etat-vide {
        background-color: #ffffff;
        border: 1px dashed var(--gris-bordure);
        border-radius: 12px;
        padding: 50px 20px;
        text-align: center;
        color: var(--texte-muted);
    }

    .etat-vide p {
        margin-bottom: 18px;
        font-size: 1rem;
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

        .carte-annonce {
            flex-direction: column;
            align-items: flex-start;
        }

        .actions-annonce {
            width: 100%;
        }

        .actions-annonce a {
            flex: 1;
            text-align: center;
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
    <div class="entete-page">
        <div>
            <h2>Mes annonces</h2>
            <p><?= count($annonces) ?> annonce<?= count($annonces) > 1 ? 's' : '' ?> publiée<?= count($annonces) > 1 ? 's' : '' ?></p>
        </div>
        <a href="creer_annonce.php" class="btn-ajouter">+ Ajouter une annonce</a>
    </div>

    <?php if (count($annonces) > 0) { ?>
        <div class="liste-annonces">
            <?php foreach ($annonces as $annonce) { ?>
                <div class="carte-annonce">
                    <div class="infos-annonce">
                        <h3><?= htmlspecialchars($annonce['titre']) ?></h3>
                        <span class="prix"><?= number_format((float)$annonce['prix'], 2, ',', ' ') ?> €</span>
                    </div>
                    <div class="actions-annonce">
                        <a href="modifier_annonce.php?id=<?= $annonce['id'] ?>" class="btn-modifier">
                            ✎ Modifier
                        </a>
                        <a href="supprimer_annonce.php?id=<?= $annonce['id'] ?>"
                           class="btn-supprimer"
                           onclick="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
                            🗑 Supprimer
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <div class="etat-vide">
            <p>Vous n'avez publié aucune annonce pour le moment.</p>
            <a href="creer_annonce.php" class="btn-ajouter">+ Créer ma première annonce</a>
        </div>
    <?php } ?>
</main>

<footer>
    &copy; <?= date('Y') ?> Campus Market — La plateforme de petites annonces dédiée aux étudiants.
</footer>

</body>
</html>
