<?php
require_once('../classes/class_etudiant.php');
require_once('../classes/class_inscription.php');
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role'] != 2) {
    header('location: ../login/signin.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Inscription = new Inscription($_POST['cours_id'], $_POST['etudiant_id']);
    $Inscription->enregistrerInscription();
}
require_once('../classes/class_etudiant.php');
$etudiant = new Student($_SESSION['id'], null, null, null, $_SESSION['role']);
$courses = $etudiant->getcoursStudent();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours - Youdemy</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../index.php" class="flex items-center space-x-3">
                <span class="self-center text-2xl font-bold text-indigo-600">Youdemy</span>
            </a>




            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="../index.php" class="block py-2 px-3 text-indigo-600" aria-current="page" id="accueil">Accueil</a>
                    </li>
                    <li>
                        <a href="./cours.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="cours">Cours</a>
                    </li>
                    <li>
                        <a href="./programmes.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="programmes">Programmes</a>
                    </li>
                    <li>
                        <a href="./about.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="about">About Youdemy</a>

                    </li>
                    <?php
                    if (isset($_SESSION['id'])) {
                        if ($_SESSION['role'] == 2) {
                    ?>
                            <li>
                                <a href="#" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Mes Cours</a>
                            </li>

                    <?php
                        }
                    }
                    ?>

                </ul>

            </div>
            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['role'] == 2) {
            ?>
                    <div class="flex md:order-2 space-x-3">
                        <form action="../login/logout.php" method="post">

                            <button type="submit" name="logout" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2">
                                Déconnexion
                            </button>
                        </form>

                        <!-- <a href="../login/signup.php" class="text-indigo-600 bg-white hover:bg-indigo-50 hover:text-indigo-700 font-medium rounded-lg text-sm px-4 py-2 border border-indigo-600">
                    S'inscrire
                </a> -->
                        <!-- <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100"
                    aria-controls="navbar-sticky" aria-expanded="false">
                    <span class="sr-only">Menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button> -->
                    </div>

                <?php
                }
            } else {
                ?>
                <div class="flex md:order-2 space-x-3">
                    <a href="../login/signin.php" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2">
                        Connexion
                    </a>
                    <a href="../login/signup.php" class="text-indigo-600 bg-white hover:bg-indigo-50 hover:text-indigo-700 font-medium rounded-lg text-sm px-4 py-2 border border-indigo-600">
                        S'inscrire
                    </a>
                    <button data-collapse-toggle="navbar-sticky" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100"
                        aria-controls="navbar-sticky" aria-expanded="false">
                        <span class="sr-only">Menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>
                <?php
            }
                ?>
                </div>
    </nav>


    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mes Cours</h1>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Course Card 1 -->
            <?php
            foreach ($courses as $cours) {

            ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="relative">
                        <img src="<?= $cours['image_url'] ?>" alt="Course thumbnail" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-sm">
                            En cours
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2"><?= $cours["titre"] ?></h3>
                        <p class="text-gray-600 mb-4 line-clamp-2"><?= $cours["description"] ?></p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-indigo-600 h-2 rounded-full" style="width: 45%"></div>
                                </div>
                                <span class="text-sm text-gray-600">45%</span>
                            </div>
                            <a href="#" class="text-indigo-600 hover:text-indigo-800">Lire cours</a>
                        </div>
                    </div>
                </div>
            <?php } ?>



        </div>
    </main>
</body>

</html>