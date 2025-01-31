CREATE DATABASE Youdemy;
USE Youdemy;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role INT (11) NOT NULL, 
    statut ENUM('Actif','En_attente','Suspendu'),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role) REFERENCES roles(id)
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    archiver BOOLEAN DEFAULT FALSE
);

CREATE TABLE cours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    video_url VARCHAR(255),
    enseignant_id INT,
    categorie_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    archiver BOOLEAN DEFAULT FALSE,     
    prix DECIMAL(10, 2),    
    FOREIGN KEY (enseignant_id) REFERENCES users(id) ON DELETE SET NULL, 
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);


SELECT * from cours
INNER join inscriptions
ON cours.id = inscriptions.cours_id
INNER join users
ON inscriptions.etudiant_id = users.id
WHERE users.id = 1;

CREATE TABLE contenu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cour INT, 
    type ENUM('video', 'PDF') NOT NULL,
    file_path VARCHAR(255),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_cour) REFERENCES cours(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE cours_tags (
    cours_id INT,
    tag_id INT,
    PRIMARY KEY (cours_id, tag_id),
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

CREATE TABLE inscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etudiant_id INT,
    cours_id INT,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);

INSERT INTO roles (role_name) VALUES ('Admin');
INSERT INTO roles (role_name) VALUES ('Etudiant');
INSERT INTO roles (role_name) VALUES ('Enseignant');

INSERT INTO cours (titre, description, image_url, enseignant_id, categorie_id, prix)
VALUES
('JavaScript Moderne', 'Maîtrisez JavaScript ES6+ et les concepts modernes.', '../img/JS.jpg', 1, 1, 49.95),
('Marketing Digital Avancé', 'Stratégies de marketing digital efficaces.', '../img/Marketing digital.jpg', 2, 2, 59.95),
('UX Design Complet', 'De débutant à expert en UX Design.', '../img/UI UX.jpg', 3, 2, 69.95),
('Python pour Débutants', 'Apprenez Python de zéro.', '../img/Developpeur.jpg', 3, 2, 44.95),
('Gestion d\'Entreprise', 'Stratégies avancées de gestion.', '../img/gestion d\'entreprise.jpg', 3, 1, 79.95),
('Introduction à la Data Science', 'Analyse de données avec Python.', '../img/Data Science.jpg', 3, 1, 64.95),
('React.js Professionnel', 'Développement dapplications modernes.', '../img/React.jpg', 3, 1, 69.95);

CREATE VIEW vue_cours AS
SELECT c.*, cat.nom
FROM cours c
INNER JOIN categories cat
ON c.categorie_id = cat.id;
