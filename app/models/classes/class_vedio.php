<?php
require_once 'class_cours.php';
class VideoCours extends Cours {
    private $video_url;

    public function __construct($titre, $description, $image_url, $categorie_id, $prix, $video_url) {
        parent::__construct($titre, $description, $image_url, $categorie_id, $prix);
        $this->video_url = $video_url;
    }

    public function save() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("INSERT INTO cours (titre, description, image_url, categorie_id, prix, video_url) 
                                  VALUES (:titre, :description, :image_url, :categorie_id, :prix, :video_url)");

            $stmt->bindParam(':titre', $this->titre);
            $stmt->bindParam(':description', $this->description);
            $stmt->bindParam(':image_url', $this->image_url);
            $stmt->bindParam(':categorie_id', $this->categorie_id);
            $stmt->bindParam(':prix', $this->prix);
            $stmt->bindParam(':video_url', $this->video_url);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du cours vidéo : " . $e->getMessage();
            return false;
        }
    }
}