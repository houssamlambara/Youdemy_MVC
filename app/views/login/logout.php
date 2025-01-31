<?php
require_once('../classes/class_etudiant.php');
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
  $etudiant = new Student($_SESSION['id'], null, null, null, $_SESSION['role']);
    $etudiant->logout();

}