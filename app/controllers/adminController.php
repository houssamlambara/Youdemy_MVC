<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Cours.php';
require_once __DIR__ . '/../models/Categorie.php';
require_once __DIR__ . '/../models/tag.php';

class AdminController extends BaseController{

    private $adminModel;
    private $courseModel;
    private $categoryModel;
    private $tagModel;

    function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'admin') {
            $_SESSION['message'] = 'You must be logged in as an admin to access this page';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
        $this->adminModel = new User(null, null, null, null, null, null, null, null, null);
        $this->courseModel = new Cours(null, null, null, null, null, null, null, null, null);
        $this->categoryModel = new Categorie(null, null);
        $this->tagModel = new tag(null, null);

    }
}