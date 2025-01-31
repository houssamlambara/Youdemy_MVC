<?php

include_once('database.php');

class Categorie
{
    private $id;
    private $nom;

    public function __construct($nom, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function __toString()
    {
        return $this->id . " " . $this->nom;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function save()
    {
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO categories (nom) VALUES (:nom)");

            $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = $db->lastInsertId();
                return true;
            } else {
                echo "Erreur lors de l'exécution de la requête : " . $stmt->errorInfo()[2];
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
        }
    }

    public static function getAllCategorie()
    {
        $categories = [];
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT id, nom FROM categories";
            $stmt = $db->prepare($req);
            $stmt->execute();
            $arry = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($arry as $row) {
                $categories[] = new Categorie($row['nom'], $row['id']);
            }
            return $categories;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des catégories : " . $e->getMessage();
            return [];
        }
    }


    public static function getAll()
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT id, nom FROM categories");
            $categories = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Categorie($row['nom'], $row['id']); 
            }
            return $categories;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des catégories : " . $e->getMessage());
        }
    }


    public static function delete($id)
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }
}
