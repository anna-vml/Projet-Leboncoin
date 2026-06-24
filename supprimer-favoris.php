<?php
  session_start();
  require_once 'includes/db.php';

    if (!isset($_SESSION['user_id'])) {
     header("Location: connexion.php");
     exit();
    }

    $id_annonce = $_GET['id'];
    $id_utilisateur = $_SESSION['user_id'];

    $sql = "DELETE FROM favoris
    WHERE utilisateur_id = ?
    AND annonce_id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_utilisateur, $id_annonce]);

    header("Location: favoris.php");
    exit();
?>
