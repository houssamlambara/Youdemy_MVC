<?php
require_once __DIR__ . '/../models/Student.php';
require_once __DIR__ . '/../models/Cours.php';

class StudentController extends BaseController
{

    private $studentModel;
    private $courseModel;

    function __construct()
    {
        $this->studentModel = new Student(null, null, null, null, null, null, null, null, null);
        $this->courseModel = new Cours(null, null, null, null, null, null, null, null, null);
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'student') {
            $_SESSION['message'] = 'You must be logged in as a student to access this page';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
    }

    public function enregistrerInscription(){
        if (isset($_POST['cours_id'])) {
            $cours_id = $_POST['cours_id'];
            $etudiant_id = $_SESSION['user']['id'];
            $inscription = new Inscription($cours_id, $etudiant_id);
            if ($inscription->enregistrerInscription()) {
                $_SESSION['message'] = 'Inscription enregistrée avec succès';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'enregistrement de l\'inscription';
                $_SESSION['message_type'] = 'error';
            }
        }
        header('Location: /student/courses');
        exit();
    }
    
}