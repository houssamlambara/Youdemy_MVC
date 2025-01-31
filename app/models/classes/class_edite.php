<?php
require_once('database.php');
class Edite
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function execute()
    {
        try {
            $db = Database::getInstance()->getConnection();
            
            $stmt = $db->prepare("SELECT statut FROM users WHERE id = ?");
            $stmt->execute([$this->id]);
            $user = $stmt->fetch();

            if ($user) {
                $newStatus = ($user['statut'] == 'Suspendu') ? 'Actif' : 'Suspendu';

                $stmt = $db->prepare("UPDATE users SET statut = ? WHERE id = ?");
                $stmt->execute([$newStatus, $this->id]);
                
                return true;
            } else {
                echo "Utilisateur non trouvé.";
                return false;
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
