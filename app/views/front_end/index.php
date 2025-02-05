<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Plateforme de Cours en Ligne</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3">
                <span class="self-center text-2xl font-bold text-indigo-600">Youdemy</span>
            </a>
            <div class="flex md:order-2 space-x-3">
                <a href="./login/signin.php" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2">
                    Connexion
                </a>
                <a href="./login/signup.php" class="text-indigo-600 bg-white hover:bg-indigo-50 hover:text-indigo-700 font-medium rounded-lg text-sm px-4 py-2 border border-indigo-600">
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
                        <a href="../index.php" class="block py-2 px-3 text-indigo-600" aria-current="page" id="accueil">Accueil</a>
                    </li>
                    <li>
                        <a href="./front_end/cours.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="cours">Cours</a>
                    </li>
                    <li>
                        <a href="./front_end/programmes.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="programmes">Programmes</a>
                    </li>
                    <li>
                        <a href="./front_end/about.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="about">About Youdemy</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 pt-24">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl text-white">Apprenez sans limites avec Youdemy</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-100 lg:mb-8 md:text-lg lg:text-xl">Développez vos compétences avec plus de 1000 cours en ligne créés par des experts du monde entier.</p>
                <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                    <a href="./login/signup.php" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-indigo-600 bg-white rounded-lg hover:bg-indigo-50 focus:ring-4 focus:ring-indigo-300">
                        Commencer gratuitement
                    </a>

                    <a href="./front_end/categorie.php" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:bg-white/10 focus:ring-4 focus:ring-gray-100">
                        Explorer les cours
                    </a>

                </div>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="./img/meet.jpg" alt="mockup" class="rounded-lg">
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="bg-white py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <h3 class="text-4xl font-bold text-indigo-600">1M+</h3>
                    <p class="mt-2 text-gray-600">Étudiants actifs</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold text-indigo-600">1000+</h3>
                    <p class="mt-2 text-gray-600">Cours disponibles</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold text-indigo-600">500+</h3>
                    <p class="mt-2 text-gray-600">Instructeurs experts</p>
                </div>
                <div class="text-center">
                    <h3 class="text-4xl font-bold text-indigo-600">4.8</h3>
                    <p class="mt-2 text-gray-600">Note moyenne</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Courses -->
    <section class="py-16">
        <div class="max-w-screen-xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Cours populaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/Developpeur.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded">Développement</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Développement Web Full-Stack</h3>
                        <p class="text-gray-600 mb-4">Apprenez HTML, CSS, JavaScript et plus encore...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">49.99€</span>
                            <button class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/Marketing digital.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded">Marketing</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Marketing Digital 2024</h3>
                        <p class="text-gray-600 mb-4">Maîtrisez les stratégies marketing modernes...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">59.99€</span>
                            <button class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/UI UX.jpg" alt="course" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <div class="flex items-center mb-2">
                            <span class="bg-indigo-100 text-indigo-600 text-xs px-2 py-1 rounded">Design</span>
                        </div>
                        <h3 class="text-xl font-bold mb-2">UI/UX Design Moderne</h3>
                        <p class="text-gray-600 mb-4">Créez des interfaces utilisateur attractives...</p>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">69.99€</span>
                            <button class="text-white bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg">
                                En savoir plus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<!-- Footer -->
<footer class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white py-12">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center md:text-left">
            <!-- Logo et description -->
            <div>
                <a href="#" class="flex items-center justify-center md:justify-start">
                    <span class="self-center text-2xl font-bold text-white">Youdemy</span>
                </a>
                <p class="mt-4 text-sm text-gray-100">
                    Youdemy est votre plateforme d'apprentissage en ligne pour maîtriser les compétences du futur.
                </p>
            </div>

            <!-- Liens rapides -->
            <div>
                <h4 class="text-lg font-bold mb-4">Liens Rapides</h4>
                <ul class="space-y-2">
                    <li><a href="../index.php" class="text-gray-100 hover:text-indigo-200 transition duration-300">Accueil</a></li>
                    <li><a href="./front_end/cours.php" class="text-gray-100 hover:text-indigo-200 transition duration-300">Cours</a></li>
                    <li><a href="./front_end/programmes.php" class="text-gray-100 hover:text-indigo-200 transition duration-300">Programmes</a></li>
                    <li><a href="./front_end/about.php" class="text-gray-100 hover:text-indigo-200 transition duration-300">À Propos</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="text-lg font-bold mb-4">Contact</h4>
                <ul class="space-y-2">
                    <li class="text-gray-100"><i class="fas fa-phone mr-2"></i>+33 1 23 45 67 89</li>
                    <li class="text-gray-100"><i class="fas fa-envelope mr-2"></i>contact@youdemy.com</li>
                    <li class="text-gray-100"><i class="fas fa-map-marker-alt mr-2"></i>Paris, France</li>
                </ul>
            </div>

            <!-- Réseaux sociaux -->
            <div>
                <h4 class="text-lg font-bold mb-4">Suivez-nous</h4>
                <div class="flex space-x-4 justify-center md:justify-start">
                    <a href="#" class="text-gray-100 hover:text-indigo-200 transition duration-300">
                        <i class="fab fa-facebook text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-100 hover:text-indigo-200 transition duration-300">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-100 hover:text-indigo-200 transition duration-300">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-100 hover:text-indigo-200 transition duration-300">
                        <i class="fab fa-linkedin text-2xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="mt-8 pt-8 border-t border-gray-300/20 text-center">
            <p class="text-sm text-gray-100">
                &copy; 2024 Youdemy. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>

</html>