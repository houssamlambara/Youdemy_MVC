<?php

class Delete
{
    private $table;  
    private $id;     

    public function __construct($table, $id)
    {
        $this->table = $table;
        $this->id = $id;
    }

    public function execute()
    {
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("DELETE FROM " . $this->table . " WHERE id = :id");

            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Erreur lors de la suppression de l'enregistrement.");
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}
?>
