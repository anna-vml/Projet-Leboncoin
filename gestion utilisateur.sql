CREATE DATABASE gestion_utilisateurs CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE gestion_utilisateurs;

CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('utilisateur', 'admin') DEFAULT 'utilisateur',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
