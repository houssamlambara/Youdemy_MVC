<?php
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Cours.php';
require_once __DIR__ . '/../models/Categorie.php';
require_once __DIR__ . '/../models/tag.php';

class TeacherController extends BaseController{
    private $teacherModel;
    private $courseModel;
    private $categoryModel;
    private $tagModel;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'teacher') {
            $_SESSION['message'] = 'You must be logged in as a teacher to access this page';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
        $this->teacherModel = new Student(null, null, null, null, null, null, null, null, null);
        $this->courseModel = new Cours(null, null, null, null, null, null, null, null, null);
        $this->categoryModel = new Categorie(null, null);
        $this->tagModel = new tag(null, null);

    }

}