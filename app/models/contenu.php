<?php 
class contenu extends Cours{
    private $content;

    public function __construct($titre, $description, $image_url, $categorie_id, $prix, $content) {
        parent::__construct($titre, $description, $image_url, $categorie_id, $prix);
        $this->content = $content;
    }

    public function save() {
        try {
            $db = Database::getInstance()->getConnection();
            
            $stmt = $db->prepare("INSERT INTO cours (titre, description, image_url, categorie_id, prix, contenu) 
                                  VALUES (:titre, :description, :image_url, :categorie_id, :prix, :content)");

            $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
            $stmt->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $this->prix, PDO::PARAM_STR);
            $stmt->bindParam(':content', $this->content, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du cours documentation : " . $e->getMessage();
            return false;
        }
    }

}
