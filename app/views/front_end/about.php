<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <title>À propos - Youdemy</title>
    <style>
        /* Animation pour les sections */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white border-gray-200 shadow-sm fixed w-full z-50">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../index.php" class="flex items-center space-x-3">
                <span class="self-center text-2xl font-bold text-indigo-600">Youdemy</span>
            </a>
            <div class="flex md:order-2 space-x-3">
                <a href="../login/signin.php" class="text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 transition duration-300">
                    Connexion
                </a>
                <a href="../login/signup.php" class="text-indigo-600 bg-white hover:bg-indigo-50 hover:text-indigo-700 font-medium rounded-lg text-sm px-4 py-2 border border-indigo-600 transition duration-300">
                    S'inscrire
                </a>
                <button data-collapse-toggle="navbar-sticky" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 transition duration-300"
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
                        <a href="./cours.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="cours">Cours</a>
                    </li>
                    <li>
                        <a href="./programmes.php" class="block py-2 px-3 text-black hover:text-indigo-600" id="programmes">Programmes</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 text-black hover:text-indigo-600" id="about">About Youdemy</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-blue-600 h-96">
        <img src="images/hero.jpg" alt="Education en ligne" class="absolute w-full h-full object-cover opacity-20">
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="text-white fade-in">
                <h1 class="text-5xl font-bold mb-4">Découvrez Youdemy</h1>
                <p class="text-xl">Votre plateforme d'apprentissage en ligne pour l'informatique, le design et le marketing digital</p>
            </div>
        </div>
    </div>

    <!-- Notre Mission -->
    <section class="py-20 bg-white fade-in">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6">Notre Mission</h2>
                    <p class="text-gray-600 leading-relaxed">
                        Chez Youdemy, nous croyons que l'apprentissage doit être accessible à tous.
                        Notre mission est de fournir une éducation de qualité dans les domaines technologiques
                        les plus demandés, permettant à chacun de développer ses compétences à son propre rythme.
                    </p>
                </div>
                <div class="relative h-64">
                    <img src="images/mission.jpg" alt="Mission Youdemy" class="rounded-lg shadow-lg h-full w-full object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Nos Domaines d'Expertise -->
    <section class="py-20 bg-gray-50 fade-in">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">Nos Domaines d'Expertise</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Informatique -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <img src="images/informatique.jpg" alt="Cours d'informatique" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Informatique</h3>
                        <p class="text-gray-600">
                            Développement web, programmation, bases de données, cybersécurité et plus encore.
                        </p>
                    </div>
                </div>

                <!-- Design -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <img src="images/design.jpg" alt="Cours de design" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Design</h3>
                        <p class="text-gray-600">
                            Design graphique, UX/UI design, conception web et outils de création.
                        </p>
                    </div>
                </div>

                <!-- Marketing Digital -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <img src="images/marketing.jpg" alt="Cours de marketing" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4">Marketing Digital</h3>
                        <p class="text-gray-600">
                            SEO, médias sociaux, publicité en ligne et stratégie digitale.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-blue-600 fade-in">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Rejoignez notre Communauté d'Apprenants</h2>
            <p class="text-white text-xl mb-8">
                Commencez votre voyage d'apprentissage dès aujourd'hui !
            </p>
            <button class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:bg-blue-50 transition duration-300">
                Découvrir nos cours
            </button>
        </div>
    </section>
</body>

</html>