<?php
session_start();
require 'connexion.php';

$id = $_GET['id'];

$sql = "SELECT * FROM annonces WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

$annonce = $stmt->fetch();

if($annonce['utilisateur_id'] != $_SESSION['user_id']){
    die("Accès refusé");
}
?>

<form action="update_annonce.php" method="POST">

    <input type="hidden" name="id" value="<?= $annonce['id'] ?>">

    <input type="text"
           name="titre"
           value="<?= $annonce['titre'] ?>">

    <br><br>

    <input type="number"
           step="0.01"
           name="prix"
           value="<?= $annonce['prix'] ?>">

    <br><br>

    <textarea name="description"><?= $annonce['description'] ?></textarea>

    <br><br>

    <button type="submit">Modifier</button>

</form>
