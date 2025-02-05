<?php
require_once('database.php');

class Cours
{
    protected $id;  
    protected $titre;
    protected $description;
    protected $image_url;
    protected $categorie_id;
    protected $prix;


    public function __construct($titre, $description, $image_url, $categorie_id, $prix)
    {
        // $this->db = Database::getInstance()->getConnection();
        $this->titre = $titre;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->categorie_id = $categorie_id;
        $this->prix = $prix;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getImageUrl()
    {
        return $this->image_url;
    }

    public function setImageUrl($image_url)
    {
        $this->image_url = $image_url;
    }

    public function getCategorieId()
    {
        return $this->categorie_id;
    }

    public function setCategorieId($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    // public function save()
    // {
    //     try {
    //         $db = Database::getInstance()->getConnection();

    //         $stmt = $db->prepare("INSERT INTO cours (titre, description, image_url, categorie_id, prix) 
    //                           VALUES (:titre, :description, :image_url, :categorie_id, :prix)");

    //         $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
    //         $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
    //         $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
    //         $stmt->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);
    //         $stmt->bindParam(':prix', $this->prix, PDO::PARAM_STR);

    //         return $stmt->execute();
    //     } catch (PDOException $e) {
    //         echo "Erreur lors de l'ajout du cours : " . $e->getMessage();
    //         return false;
    //     }
    // }

    public static function showAllcours()
    {
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT * FROM vue_cours";
            $stmt = $db->prepare($req);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des cours : " . $e->getMessage();
            return [];
        }
    }

    public function totalcours()
    {
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT COUNT(*) as total FROM cours";
            $stmt = $db->prepare($req);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors du comptage des cours : " . $e->getMessage();
            return [];
        }
    }

    public function pagination($page)
    {
        $db = Database::getInstance()->getConnection();
        $parpage = 6;
        $premier = ($page * $parpage) - $parpage;

        try {
            $req = "SELECT * FROM cours LIMIT :premier, :parpage";
            $stmt = $db->prepare($req);
            $stmt->bindParam(':premier', $premier, PDO::PARAM_INT);
            $stmt->bindParam(':parpage', $parpage, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des cours paginés : " . $e->getMessage();
            return [];
        }
    }

    public function getCoursById($id)
    {
        $db = Database::getInstance()->getConnection();
        $query = "SELECT * FROM cours WHERE id = :id"; 
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->id = $result['id'];
            $this->titre = $result['titre'];
            $this->description = $result['description'];
            $this->image_url = $result['image_url'];
            $this->categorie_id = $result['categorie_id'];
            $this->prix = $result['prix'];
            return $this; 
        } else {
            return null;  
        }
    }

    public function update($newtitre,$newdescription,$newprix,$newcategorie_id)
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("UPDATE cours SET titre = :titre, description = :description, prix = :prix, categorie_id = :categorie_id  WHERE id = :id");

            $stmt->bindParam(':titre', $newtitre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $newdescription, PDO::PARAM_STR);
            // $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
            $stmt->bindParam(':categorie_id', $newcategorie_id, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $newprix, PDO::PARAM_STR);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);  

            if ($stmt->execute()) {
                return true;
            } else {
                echo "Échec de la mise à jour du cours.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du cours : " . $e->getMessage();
            return false;
        }
    }
}
