<?php
require_once 'database.php';
class Inscription {
 
    private $table = 'inscriptions';

    
    private $cours_id;
    private $etudiant_id;

   function __construct($cours_id, $etudiant_id) {
        $this->cours_id = $cours_id;
        $this->etudiant_id = $etudiant_id;
    }

    public function enregistrerInscription() {
        $conn = Database::getInstance()->getConnection();
        try {
            $query = "INSERT INTO " . $this->table . " (etudiant_id, cours_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
    
            $stmt->bindValue(1, $this->etudiant_id, PDO::PARAM_STR);
            $stmt->bindValue(2, $this->cours_id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            }
    
            return false;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de l'inscription : " . $e->getMessage());
        }
    }
    
}
?>
