<?php
session_start();
require 'connexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM annonces
WHERE id = ?
AND utilisateur_id = ?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $id,
    $_SESSION['user_id']
]);

header("Location: mes_annonces.php");
