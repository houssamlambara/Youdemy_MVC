<?php 
require_once('../classes/class_enseignant.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Plateforme de cours</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
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
                    <h1 class="text-2xl font-bold text-gray-800">Statistiques Globales</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <img src="../img/houssam.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Statistics Content -->
            <main class="p-8">
                <!-- Total Courses Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700">Total des Cours</h3>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="flex items-end gap-2">
                            <span class="text-3xl font-bold">248</span>
                            <span class="text-green-500 text-sm mb-1">
                                <i class="fas fa-arrow-up"></i> +12% ce mois
                            </span>
                        </div>
                        <div class="mt-4 flex gap-4">
                            <div>
                                <p class="text-gray-500 text-sm">Actifs</p>
                                <p class="font-semibold">186</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">En création</p>
                                <p class="font-semibold">62</p>
                            </div>
                        </div>
                    </div>

                    <!-- Most Popular Course -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Cours le Plus Populaire</h3>
                        <div class="flex items-center gap-4">
                            <img src="/api/placeholder/80/80" alt="Course" class="w-20 h-20 rounded-lg">
                            <div>
                                <h4 class="font-semibold">Développement Web Full-Stack</h4>
                                <p class="text-gray-500">Par Michel Dupont</p>
                                <div class="mt-2 flex items-center gap-2">
                                    <i class="fas fa-user-graduate text-indigo-600"></i>
                                    <span class="font-semibold">1,247 étudiants</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top 3 Teachers -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Top 3 Enseignants</h3>
                        <div class="space-y-4">
                            <?php 
                            $prof=enseignant::gettopEncient();
                            foreach($prof as $p){
                            ?>
                            <div class="flex items-center gap-3">
                                <span class="text-xl font-bold text-indigo-600">1</span>
                                <img src="/api/placeholder/40/40" alt="Teacher" class="w-10 h-10 rounded-full">
                                <div>
                                    <p class="font-semibold"><?= $p['nom']?></p>
                                    <p class="text-sm text-gray-500">12 cours - 2,845 étudiants</p>
                                </div>
                            </div>
                           <?php } ?>
                        </div>
                    </div>
                </div>

                <!-- Course Categories Distribution -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Categories Chart -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Répartition par Catégorie</h3>
                        <canvas id="categoriesChart" height="300"></canvas>
                    </div>

                    <!-- Categories Details -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Détails par Catégorie</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-indigo-500"></div>
                                    <span>Développement Web</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-500">82 cours</span>
                                    <span class="font-semibold">33%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                    <span>Design</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-500">54 cours</span>
                                    <span class="font-semibold">22%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <span>Marketing Digital</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-500">45 cours</span>
                                    <span class="font-semibold">18%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                    <span>Business</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-500">37 cours</span>
                                    <span class="font-semibold">15%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-3 h-3 rounded-full bg-purple-500"></div>
                                    <span>Autres</span>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-gray-500">30 cours</span>
                                    <span class="font-semibold">12%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('categoriesChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Développement Web', 'Design', 'Marketing Digital', 'Business', 'Autres'],
                datasets: [{
                    data: [33, 22, 18, 15, 12],
                    backgroundColor: [
                        '#6366f1',
                        '#22c55e',
                        '#eab308',
                        '#ef4444',
                        '#a855f7'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</body>

</html>