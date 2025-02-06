<?php

require_once('database.php');

class User
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $role;
    private $statut;
    private $passwordHash;

    public function __construct($id, $nom, $prenom, $email, $role, $passwordHash = null, $statut = 'En_attente')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role  = $role;
        $this->statut = $statut;
        $this->passwordHash = $passwordHash;
    }

    public function __toString()
    {
        return $this->nom . " " . $this->prenom;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getrole()
    {
        return $this->role;
    }
    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($statut)
    {
        $this->statut = $statut;
    }


    private function setPasswordHash($password)
    {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    // Save user to the database
    public function save()
    {
        $db = Database::getInstance()->getConnection();
        try {
            if ($this->id) {
                $stmt = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, role = :role, statut = :statut WHERE id = :id");
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':role', $this->role, PDO::PARAM_INT); 
                $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR); 
                $stmt->execute();
            } else {
                if ($this->passwordHash === null) {
                    throw new Exception("Password is required for new users.");
                }

                $stmt = $db->prepare("INSERT INTO users (nom, prenom, email, password, role,statut) VALUES (:nom, :prenom, :email, :password, :role, :statut)");
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':role', $this->role, PDO::PARAM_INT); 
                $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
                $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR); 
                $stmt->execute();
                $this->id = $db->lastInsertId(); 
            }
            return $this->id;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());

            throw new Exception("An error occurred while saving the user. SQL error: " . $e->getMessage());
        }
    }
    public function validerEnseignant()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET statut = 'Actif' WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function searchUserByName($name)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE nom LIKE :name OR prenom LIKE :name");
        $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($results as $result) {
            $users[] = new User(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['password']
            );
        }

        return $users;
    }

    public function getUserById($id)
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['password']
            );
        }

        return null; 
    }

    public static function findByEmail($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['role'], $result['password'], $result['statut']);
        }

        return null;
    }


    public static function signup($nom, $prenom, $email, $password, $role)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format de l'email invalide");
        }

        if (strlen($password) < 3) {
            throw new Exception("Le mot de passe doit comporter au moins 3 caractères");
        }

        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);
        if (self::findByEmail($email)) {
            throw new Exception("Cet email est déjà enregistré");
        }

        $statut = ($role == 3) ? 'En_attente' : 'Actif';

        $user = new User(null, $nom, $prenom, $email, $role, null, $statut);
        $user->setPasswordHash($password);
        return $user->save();
    }

    public static function signin($email, $password)
    {
        $user = self::findByEmail($email);

        if (!$user) {
            throw new Exception("Email ou mot de passe invalide");
        }

        if (!password_verify($password, $user->passwordHash)) {
            throw new Exception("Email ou mot de passe invalide");
        }

        if ($user->getStatut() === 'En_attente') {
            throw new Exception("Votre compte est en attente de validation par un administrateur.");
        } elseif ($user->getStatut() === 'Suspendu') {
            throw new Exception("Votre compte est suspendu. Veuillez contacter l'administrateur.");
        }

        return $user;
    }



    public function changePassword($newPassword)
    {
        $this->setPasswordHash($newPassword); 
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function banir()
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("UPDATE users SET statut = 'Suspendu' WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}
