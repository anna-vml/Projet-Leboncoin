<?php
session_start();
require 'connexion.php';

$id = $_POST['id'];

$sql = "SELECT * FROM annonces WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$annonce = $stmt->fetch();

if($annonce['utilisateur_id'] != $_SESSION['user_id']){
    die("Accès refusé");
}

$sql = "UPDATE annonces
SET titre=?, prix=?, description=?
WHERE id=?";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['titre'],
    $_POST['prix'],
    $_POST['description'],
    $id
]);

header("Location: mes_annonces.php");
