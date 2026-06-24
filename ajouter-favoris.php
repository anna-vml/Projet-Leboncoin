<?php
  session_start();
  require_once 'includes/db.php';

  if (!isset($_SESSION['user_id'])) {
    header("Location: connexion.php");
    exit();
  }

  if (!isset($_GET['id'])) {
    die("Annonce introuvable");
  }

  $id_utilisateur = $_SESSION['user_id'];
  $id_annonce = $_GET['id'];

  $sql = "INSERT IGNORE INTO favoris (utilisateur_id, annonce_id)
       VALUES (?, ?)";

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$id_utilisateur, $id_annonce]);

  header("Location: favoris.php");
  exit();
?>
