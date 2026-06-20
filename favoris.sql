CREATE TABLE favoris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_utilisateur INT NOT NULL,
    id_annonce INT NOT NULL,

    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (id_annonce) REFERENCES annonces(id) ON DELETE CASCADE
