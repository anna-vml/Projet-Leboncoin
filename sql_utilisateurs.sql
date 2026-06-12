CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('membre', 'admin') DEFAULT 'membre',
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);