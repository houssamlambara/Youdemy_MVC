<?php
require_once __DIR__ . '/../models/Cours.php';
require_once __DIR__ . '/../models/Categorie.php';
require_once __DIR__ . '/../models/tag.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Student.php';

class UserController extends BaseController
{
    private $courseModel;
    private $categoryModel;
    private $tagModel;
    private $userModel;
    private $studentModel;

    function __construct()
    {
        $this->courseModel = new Cours(null, null, null, null, null, null, null, null, null);
        $this->categoryModel = new Categorie(null, null);
        $this->tagModel = new tag(null, null);
        $this->userModel = new User(null, null, null, null, null);
        $this->studentModel = new Student(null, null, null, null, null, null, null, null, null);
    }
}
