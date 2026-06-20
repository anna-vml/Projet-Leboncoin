<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
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

    $stmt = $pdo->prepare("UPDATE utilisateurs SET role = 'membre' WHERE id = ?");
    $stmt->execute([$id]);

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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <h1 class="mb-4">Administration des utilisateurs</h1>

    <a href="index.php" class="btn btn-secondary mb-3">
        Retour accueil
    </a>

    <table class="table table-bordered table-striped bg-white">

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

                <td><?= htmlspecialchars($user['role']) ?></td>

                <td>

                    <?php if ($user['role'] !== 'admin'): ?>
                        <a href="admin_utilisateurs.php?admin=<?= $user['id'] ?>" class="btn btn-success btn-sm">
                            Promouvoir admin
                        </a>
                    <?php else: ?>
                        <a href="admin_utilisateurs.php?membre=<?= $user['id'] ?>" class="btn btn-warning btn-sm">
                            Repasser membre
                        </a>
                    <?php endif; ?>

                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                        <a href="admin_utilisateurs.php?supprimer=<?= $user['id'] ?>"
                           class="btn btn-danger btn-sm"
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

</body>
</html>
