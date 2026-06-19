<?php
session_start();
require 'connexion.php';

if(!isset($_SESSION['user_id'])){
    exit("Accès refusé");
}

$titre = $_POST['titre'];
$prix = $_POST['prix'];
$etat = $_POST['etat'];
$description = $_POST['description'];

$image = "";

if(!empty($_FILES['image']['name'])){

    $image = time() . "_" . $_FILES['image']['name'];

    move_uploaded_file(
        $_FILES['image']['tmp_name'],
        "uploads/" . $image
    );
}

$sql = "INSERT INTO annonces
(utilisateur_id,titre,prix,etat,description,image)
VALUES(?,?,?,?,?,?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_SESSION['user_id'],
    $titre,
    $prix,
    $etat,
    $description,
    $image
]);

header("Location: mes_annonces.php");
