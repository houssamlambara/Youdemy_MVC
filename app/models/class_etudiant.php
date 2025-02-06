<?php
require_once('class_user.php');

class Student extends User {

    public function getAllStudents() {
        $db = Database::getInstance()->getConnection();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE role = :role");
        $stmt->bindParam(':role', $role);
        $role = 2; 
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getActiveStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students WHERE statut = 'active' AND MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getNewStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students WHERE MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getcoursStudent(){
        $db = Database::getInstance()->getConnection();
        
        $sql = "SELECT * FROM cours
                INNER JOIN inscriptions ON cours.id = inscriptions.cours_id
                INNER JOIN users ON inscriptions.etudiant_id = users.id
                WHERE users.id = ?";  
    
        $stmt = $db->prepare($sql);
        
       $stmt->execute([$this->getId(),]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // public function getMesCous(){
    //     $db = Database::getInstance()->getConnection();
    //     $sql = "SELECT * FROM cours
    //             INNER JOIN inscriptions ON cours.id = inscriptions.cours_id
    //             INNER JOIN users ON inscriptions.etudiant_id = users.id
    //             WHERE users.id = :id";
    //     $stmt = $db->prepare($sql);
    //     $stmt->bindParam(':id', $this->getId(), PDO::PARAM_INT);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    
    
}

?>
