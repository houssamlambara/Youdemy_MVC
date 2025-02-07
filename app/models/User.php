<?php

require_once __DIR__ . '/../config/database.php';

class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $role;
    private $statut;
    private $passwordHash;

    public function __construct($id, $nom, $prenom, $email, $role, $passwordHash = null, $statut = 'En_attente') {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = (int) $role;
        $this->statut = $statut;
        $this->passwordHash = $passwordHash;
    }

    public function __toString() {
        return $this->nom . " " . $this->prenom;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getStatut() {
        return $this->statut;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function setStatut($statut) {
        $this->statut = $statut;
    }

    public function setPasswordHash($password) {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    public function save() {
        $db = Database::getInstance()->getConnection();
        try {
            if ($this->id) {
                $stmt = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, role = :role, statut = :statut WHERE id = :id");
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            } else {
                if (!$this->passwordHash) {
                    throw new Exception("Le mot de passe est requis pour les nouveaux utilisateurs.");
                }

                $stmt = $db->prepare("INSERT INTO users (nom, prenom, email, password, role, statut) VALUES (:nom, :prenom, :email, :password, :role, :statut)");
                $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
            }

            $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':role', $this->role, PDO::PARAM_INT);
            $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR);
            $stmt->execute();

            if (!$this->id) {
                $this->id = $db->lastInsertId();
            }

            return $this->id;
        } catch (PDOException $e) {
            error_log("Erreur BD: " . $e->getMessage());
            throw new Exception("Erreur lors de l'enregistrement de l'utilisateur.");
        }
    }

    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['role'],
                $result['password'],
                $result['statut']
            );
        }

        return null;
    }

    public function changePassword($newPassword) {
        $this->setPasswordHash($newPassword);
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function banir() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET statut = 'Suspendu' WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
}
