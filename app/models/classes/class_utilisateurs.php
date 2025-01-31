<?php
class Student {

    public static function getAllUtilisateurs() {
        $db = Database::getInstance()->getConnection();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE role IN (:role1, :role2)");
        
        $role1 = 2;  
        $role2 = 3; 
        $stmt->bindParam(':role1', $role1);
        $stmt->bindParam(':role2', $role2);
        
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getTotalStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM enseignant";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getActiveStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM enseignant WHERE statut = 'active' AND MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getNewStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM enseignant WHERE MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>
