<?php
session_start();
require_once("includes_db.php");

if (!isset($_SESSION['id'])) {
    die("Connectez-vous d'abord.");
}

$id_utilisateur = $_SESSION['id'];
$id_annonce = $_GET['id'];

$sql = "INSERT INTO favoris (id_utilisateur, id_annonce)
        VALUES (?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$id_utilisateur, $id_annonce]);

header("Location: index.php");
exit();
?>
