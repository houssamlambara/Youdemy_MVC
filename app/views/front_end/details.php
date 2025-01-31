<?php
require_once '../classes/class_cours.php';
session_start();
$coursdetail = null; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['cours_id']) && !empty($_GET['cours_id'])) {
        $cours = new Cours(NULL, NULL, NULL, NULL, NULL);

        $cours_id = intval(trim($_GET['cours_id']));
        $coursdetail = $cours->getCoursById($cours_id);

        if ($coursdetail === null) {
            $errorMessage = "Cours non trouvé.";
        }
    } else {
        $errorMessage = "ID de cours manquant.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Plateforme de Cours en Ligne</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">

    <!-- Message de succès -->
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg" id="success-message">
        Message de succès ici
    </div>

    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../index.php" class="flex items-center space-x-3">
                <span class="self-center text-2xl font-bold text-indigo-600">Youdemy</span>
            </a>
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
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white">
                    <li>
                        <a href="../index.php" class="block py-2 px-3 text-indigo-600" aria-current="page">Accueil</a>
                    </li>
                    <li>
                        <a href="./cours.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Cours</a>
                    </li>
                    <li>
                        <a href="./programmes.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">Programmes</a>
                    </li>
                    <li>
                        <a href="./enseignant.php" class="block py-2 px-3 text-gray-900 hover:text-indigo-600">About Youdemy</a>
                    </li>
                       
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-16">
            <!-- Détails du cours -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <img src="<?= htmlspecialchars($coursdetail->getImageUrl()) ?>" alt="Image du Cours" class="w-full h-74 object-cover">
                <div class="p-8">
                        <?php if ($coursdetail): ?>
                            <div class="flex items-center justify-between mb-6">
                                <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($coursdetail->getTitre()) ?></h1>
                                <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">12 semaines</span>
                            </div>

                            <div class="prose max-w-none">
                                <p class="text-gray-600 leading-relaxed"><?= htmlspecialchars($coursdetail->getDescription()) ?></p>
                            </div>

                            <div class="mt-8">
                                <h2 class="text-2xl font-semibold mb-4">Ce que vous apprendrez</h2>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                        <span>Point clé 1</span>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                        <span>Point clé 2</span>
                                    </div>
                                    <div class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-3"></i>
                                        <span>Point clé 3</span>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-red-500">Cours non trouvé ou non disponible.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Formulaire d'inscription -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-4">

                    <form  action="./mycours.php" method="POST" class="space-y-4">
                        <input type="hidden" name="cours_id" value="<?= htmlspecialchars($coursdetail->getId()) ?>">
                        <input type="hidden" name="etudiant_id" value="<?= $_SESSION['id']?>">
                        <button name="inscrire" type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-all">S'inscrire maintenant</button>
                    </form>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-undo-alt mr-3"></i>
                            <span>30 jours satisfait ou remboursé</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-infinity mr-3"></i>
                            <span>Accès à vie au contenu</span>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-certificate mr-3"></i>
                            <span>Certificat à la fin du cours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-gray-900 to-black text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center">
                <div>
                    <img src="https://via.placeholder.com/150x50?text=RoadRover" alt="RoadRover Logo" class="mb-4 mx-auto transform hover:scale-110 transition duration-300">
                    <p class="text-sm text-gray-400">RoadRover - Votre partenaire de confiance pour la location de voitures de luxe.</p>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Liens Rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="hover:text-yellow-400 transition duration-300">Accueil</a></li>
                        <li><a href="#cars" class="hover:text-yellow-400 transition duration-300">Véhicules</a></li>
                        <li><a href="#reservation" class="hover:text-yellow-400 transition duration-300">Réservation</a></li>
                        <li><a href="#about" class="hover:text-yellow-400 transition duration-300">À Propos</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Contact</h4>
                    <ul class="space-y-2">
                        <li><i class="fas fa-phone mr-2 text-yellow-500"></i>+33 1 23 45 67 89</li>
                        <li><i class="fas fa-envelope mr-2 text-yellow-500"></i>contact@roadrover.com</li>
                        <li><i class="fas fa-map-marker-alt mr-2 text-yellow-500"></i>Paris, France</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4 text-yellow-500">Suivez-nous</h4>
                    <div class="flex space-x-4 justify-center">
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-400 transform hover:scale-125 transition duration-300"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-gray-800 text-center">
                <p class="text-sm text-gray-400">&copy; 2024 Youdemy. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Animation du message de succès
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.opacity = '0';
                successMessage.style.transition = 'opacity 0.5s ease-out';
                setTimeout(() => successMessage.remove(), 500);
            }, 3000);
        }
    </script>

</body>

</html>