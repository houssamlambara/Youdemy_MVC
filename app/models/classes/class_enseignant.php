<?php
require_once('class_user.php');
class enseignant extends user
{

    public static function gettopEncient()
    {
        $db = Database::getInstance()->getConnection();
        $req = $db->query('SELECT u.nom, COUNT(c.id) as nbCourse 
        FROM users u
        INNER JOIN cours c ON u.id = c.enseignant_id
        WHERE u.role = 3
        GROUP BY u.nom
        ORDER BY nbCourse DESC
        LIMIT 3');
        return $req->fetchAll();
    }


    public static function getEnseignant($id)
    {
        $db = Database::getInstance()->getConnection();
        $req = $db->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute(array($id));
        return $req->fetch();
    }
}
