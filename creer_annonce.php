<?php
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f5f7;
            color: #14213d;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background: linear-gradient(135deg, #14213d 0%, #1a2a6c 100%);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 40px;
            flex-wrap: wrap;
        }

        .navbar .logo h1 {
            color: #ffffff;
            font-size: 26px;
            font-weight: 800;
        }

        .navbar .logo h1 span {
            color: #d4a73a;
        }

        .navbar .logo small {
            display: block;
            color: #d4a73a;
            font-size: 11px;
            letter-spacing: 1px;
            font-weight: 600;
            margin-top: 2px;
        }

        .navbar nav {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .navbar nav a {
            text-decoration: none;
            color: #14213d;
            background-color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .navbar nav a:hover {
            background-color: #e9ecf3;
        }

        .navbar nav a.active {
            background-color: #d4a73a;
            color: #14213d;
        }

        .navbar nav a.deconnexion {
            background-color: #d4a73a;
            color: #14213d;
        }

        .navbar nav a.deconnexion:hover {
            background-color: #c19527;
        }

        /* ===== FORMULAIRE ===== */
        .container {
            display: flex;
            justify-content: center;
            padding: 50px 20px;
        }

        h2 {
            text-align: center;
            color: #14213d;
            font-size: 28px;
            font-weight: 800;
            margin-bottom: 30px;
        }

        form {
            background-color: #ffffff;
            border: 1px solid #d4a73a;
            border-radius: 14px;
            padding: 40px;
            box-shadow: 0 4px 18px rgba(20, 33, 61, 0.08);
            width: 100%;
            max-width: 600px;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"],
        select,
        textarea {
            width: 100%;
            padding: 13px 16px;
            border: 1px solid #cdd3df;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            color: #14213d;
            background-color: #fafbfc;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            color: #9aa0ab;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #d4a73a;
            box-shadow: 0 0 0 3px rgba(212, 167, 58, 0.18);
            background-color: #ffffff;
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='8'%3E%3Cpath d='M1 1l6 6 6-6' stroke='%2314213d' stroke-width='2' fill='none' fill-rule='evenodd'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        input[type="file"] {
            padding: 10px;
            background-color: #fafbfc;
            cursor: pointer;
        }

        button[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #d4a73a;
            color: #14213d;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 800;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        button[type="submit"]:hover {
            background-color: #c19527;
        }

        button[type="submit"]:active {
            transform: scale(0.99);
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }
            .navbar nav {
                width: 100%;
            }
            .navbar nav a {
                flex: 1;
                text-align: center;
                padding: 10px 8px;
            }
            form {
                padding: 24px;
            }
        }
    </style>
</head>
<body>

    <!-- ===== NAVBAR (comme sur les autres pages) ===== -->
    <header class="navbar">
        <div class="logo">
            <h1>Campus <span>Market</span></h1>
            <small>ACHAT ET VENTE ENTRE ÉTUDIANTS</small>
        </div>
        <nav>
            <a href="accueil.php">Accueil</a>
            <a href="profil.php">Profil</a>
            <a href="creer_annonce.php" class="active">Créer annonce</a>
            <a href="mes_annonces.php">Mes annonces</a>
            <a href="favoris.php">Favoris</a>
            <a href="deconnexion.php" class="deconnexion">Déconnexion</a>
        </nav>
    </header>

    <!-- ===== FORMULAIRE D'ORIGINE ===== -->
    <div class="container">
        <form action="traitement_annonce.php" method="POST" enctype="multipart/form-data">
            <h2>Nouvelle annonce</h2>
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
    </div>

</body>
</html>
