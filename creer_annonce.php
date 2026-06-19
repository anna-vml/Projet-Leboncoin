?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer une annonce</title>
</head>
<body>

<h2>Nouvelle annonce</h2>

<form action="traitement_annonce.php" method="POST" enctype="multipart/form-data">

    <input type="text" name="titre" placeholder="Titre" required><br><br>

    <input type="number" step="0.01" name="prix" placeholder="Prix" required><br><br>

    <select name="etat" required>
        <option value="Neuf">Neuf</option>
        <option value="Bon état">Bon état</option>
        <option value="Correct">Correct</option>
    </select><br><br>

    <textarea name="description" required></textarea><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit">Publier</button>

</form>

</body>
</html>
