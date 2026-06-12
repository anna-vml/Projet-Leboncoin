<?php
require_once '../includes/db.php';
require_once '../includes/auth_guard.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $userId = $_SESSION['user_id'];

    if (!empty($_POST['password'])) {
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ?, mot_de_passe = ? WHERE id = ?");
        $stmt->execute([$nom, $email, $passwordHash, $userId]);
    } else {
        $stmt = $pdo->prepare("UPDATE utilisateurs SET nom = ?, email = ? WHERE id = ?");
        $stmt->execute([$nom, $email, $userId]);
    }

    $_SESSION['user_nom'] = $nom;
    $_SESSION['user_email'] = $email;

    header('Location: ../profil.php?success=1');
    exit();
}
?>