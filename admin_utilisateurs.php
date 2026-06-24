<?php
session_start();
require_once 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    die("Accès refusé : réservé aux administrateurs.");
}

/* Supprimer un utilisateur */
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];

    if ($id != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: admin_utilisateurs.php");
    exit();
}

/* Promouvoir en admin */
if (isset($_GET['admin'])) {
    $id = $_GET['admin'];

    $stmt = $pdo->prepare("UPDATE utilisateurs SET role = 'admin' WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_utilisateurs.php");
    exit();
}

/* Repasser en membre */
if (isset($_GET['membre'])) {
    $id = $_GET['membre'];

    if ($id != $_SESSION['user_id']) {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET role = 'membre' WHERE id = ?");
        $stmt->execute([$id]);
    }

    header("Location: admin_utilisateurs.php");
    exit();
}

$stmt = $pdo->query("SELECT * FROM utilisateurs ORDER BY id DESC");
$utilisateurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Administration</title>

    <link rel="stylesheet" href="assets/style.css?v=80">
</head>

<body>

<div class="admin-page">

    <div class="admin-header">
        <h1>🛡️ Administration des utilisateurs</h1>

        <a href="index.php" class="btn-retour-accueil">
            ← Retour accueil
        </a>
    </div>

    <div class="admin-card">

        <table class="admin-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($utilisateurs as $user): ?>

                <tr>
                    <td><?= $user['id'] ?></td>

                    <td><?= htmlspecialchars($user['nom']) ?></td>

                    <td><?= htmlspecialchars($user['email']) ?></td>

                    <td>
                        <span class="role-badge <?= $user['role'] === 'admin' ? 'role-admin' : 'role-membre' ?>">
                            <?= htmlspecialchars($user['role']) ?>
                        </span>
                    </td>

                    <td class="admin-actions">

                        <?php if ($user['role'] !== 'admin'): ?>

                            <a href="admin_utilisateurs.php?admin=<?= $user['id'] ?>"
                               class="btn-admin">
                                Promouvoir admin
                            </a>

                        <?php else: ?>

                            <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="admin_utilisateurs.php?membre=<?= $user['id'] ?>"
                                   class="btn-membre">
                                    Repasser membre
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>

                        <?php if ($user['id'] != $_SESSION['user_id']): ?>

                            <a href="admin_utilisateurs.php?supprimer=<?= $user['id'] ?>"
                               class="btn-delete-user"
                               onclick="return confirm('Supprimer cet utilisateur ?');">
                                Supprimer
                            </a>

                        <?php endif; ?>

                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>
