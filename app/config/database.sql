CREATE DATABASE youdemy_mvc;
USE youdemy_mvc;

CREATE TABLE roles (
    id SERIAL PRIMARY KEY,
    role_name VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    statut VARCHAR(50) CHECK (statut IN ('Actif', 'En_attente', 'Suspendu')) DEFAULT 'En_attente',
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
);

CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL UNIQUE,
    archiver BOOLEAN DEFAULT FALSE
);

CREATE TABLE cours (
    id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    image_url VARCHAR(255),
    video_url VARCHAR(255),
    enseignant_id INT,
    categorie_id INT,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    archiver BOOLEAN DEFAULT FALSE,
    prix DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    FOREIGN KEY (enseignant_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (categorie_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE contenu (
    id SERIAL PRIMARY KEY,
    cours_id INT NOT NULL,
    type VARCHAR(50) CHECK (type IN ('video', 'PDF')) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE
);

CREATE TABLE tags (
    id SERIAL PRIMARY KEY,
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
    id SERIAL PRIMARY KEY,
    etudiant_id INT NOT NULL,
    cours_id INT NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (etudiant_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (cours_id) REFERENCES cours(id) ON DELETE CASCADE,
    UNIQUE (etudiant_id, cours_id)
);

INSERT INTO roles (role_name) VALUES ('Admin'), ('Etudiant'), ('Enseignant');

CREATE VIEW vue_cours AS
SELECT c.*, cat.nom AS categorie_nom
FROM cours c
INNER JOIN categories cat ON c.categorie_id = cat.id;

SELECT * FROM cours
INNER JOIN inscriptions ON cours.id = inscriptions.cours_id
INNER JOIN users ON inscriptions.etudiant_id = users.id
WHERE users.id = 1;
