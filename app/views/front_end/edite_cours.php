<?php
require_once('../classes/database.php');
require_once('../classes/class_cours.php');
require_once('../classes/class_inscription.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['update_cours'])) {
    $id = intval($_POST['id']);
    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $categorie_id = htmlspecialchars($_POST['categorie_id']);
    $prix = htmlspecialchars($_POST['prix']);

    $cours=new Cours(null,null,null,null,null);
    $cours->setId($id);
    if($cours->update($titre,$description,$prix,$categorie_id)){
        header('Location: enseignant_dashboard.php');
        exit();
    } else{
        die("Erreur lors de la mise à jour du cours");
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscrire'])){
    $incrire=new Inscription($_POST['cours_id'],$_POST['etudiant_id']);
    $incrire->enregistrerInscription();

   
}

?>
