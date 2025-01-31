<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Plateforme de cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-700 text-white min-h-screen">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Youdemy</h2>
            </div>
            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="./admin.php" class="flex items-center p-3 bg-indigo-800 rounded-lg hover:bg-indigo-900 transition-colors">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a>
                    <a href="./utilisateurs.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chalkboard-teacher w-6"></i>
                        <span>Utilisateurs</span>
                    </a>
                    <a href="./categorie.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-th-list w-6"></i>
                        <span>Add Catégories</span>
                    </a>
                    <a href="./tag.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-tags w-6"></i>
                        <span>Add Tags</span>
                    </a>
                    <a href="./statistique.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Statistiques</span>
                    </a>
                    <a href="../login/signin.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        <span>Se déconnecter</span>
                    </a>
                </div>
            </nav>
        </aside>


        <!-- Main Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex justify-between items-center px-8 py-4">
                    <div class="flex items-center gap-4">
                        <button class="text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div class="relative">
                            <input type="text" placeholder="Rechercher..."
                                class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <img src="../img/houssam.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Moul Chi</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Étudiants</p>
                                <h3 class="text-2xl font-bold">1,257</h3>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> +12% ce mois
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Cours Actifs</p>
                                <h3 class="text-2xl font-bold">84</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-green-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> +5 nouveaux
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Revenus</p>
                                <h3 class="text-2xl font-bold">24,500 €</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-euro-sign text-blue-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> +18% ce mois
                        </p>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Taux de réussite</p>
                                <h3 class="text-2xl font-bold">92%</h3>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chart-line text-purple-600 text-xl"></i>
                            </div>
                        </div>
                        <p class="text-green-500 text-sm mt-4">
                            <i class="fas fa-arrow-up"></i> +2% ce mois
                        </p>
                    </div>
                </div>

                <!-- Recent Courses -->
                <div class="bg-white rounded-lg shadow mb-8">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold">Cours Récents</h2>
                    </div>
                    <div class="p-6">
                        <table class="w-full">
                            <thead>
                                <tr class="text-left text-gray-500">
                                    <th class="pb-4">Cours</th>
                                    <th class="pb-4">Instructeur</th>
                                    <th class="pb-4">Progrès</th>
                                    <th class="pb-4">Étudiants</th>
                                    <th class="pb-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="py-2">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Course" class="w-10 h-10 rounded-lg">
                                            <div>
                                                <p class="font-medium">Introduction à Python</p>
                                                <p class="text-sm text-gray-500">Programmation</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Michel Dupont</td>
                                    <td>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 rounded-full h-2 w-3/4"></div>
                                        </div>
                                    </td>
                                    <td>234</td>
                                    <td>
                                        <button class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="py-2">
                                    <td class="py-4">
                                        <div class="flex items-center gap-3">
                                            <img src="/api/placeholder/40/40" alt="Course" class="w-10 h-10 rounded-lg">
                                            <div>
                                                <p class="font-medium">Web Design Avancé</p>
                                                <p class="text-sm text-gray-500">Design</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Sophie Martin</td>
                                    <td>
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-indigo-600 rounded-full h-2 w-1/2"></div>
                                        </div>
                                    </td>
                                    <td>189</td>
                                    <td>
                                        <button class="text-indigo-600 hover:text-indigo-800">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>