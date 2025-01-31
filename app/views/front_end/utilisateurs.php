<?php
require_once '../classes/class_edite.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['student_id'];
    $edit = new Edite($id);
    $edit->execute();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Enseignants - Admin</title>
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
                    <!-- <a href="./admin.php" class="flex items-center p-3 bg-indigo-800 rounded-lg hover:bg-indigo-900 transition-colors">
                        <i class="fas fa-home w-6"></i>
                        <span>Tableau de bord</span>
                    </a> -->
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Enseignants</h1>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-2">
                            <img src="../img/houssam.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Teachers Content -->
            <main class="p-8">
                <!-- Quick Stats -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Total Enseignants</p>
                                <h3 class="text-2xl font-bold">42</h3>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-indigo-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Cours Actifs</p>
                                <h3 class="text-2xl font-bold">156</h3>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-book-open text-green-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Étudiants Total</p>
                                <h3 class="text-2xl font-bold">4,521</h3>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-blue-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500">Satisfaction</p>
                                <h3 class="text-2xl font-bold">4.8/5</h3>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-star text-yellow-600 text-xl"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <!-- <div class="bg-white rounded-lg shadow mb-6 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                            <div class="relative">
                                <input type="text" placeholder="Nom ou spécialité..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Spécialité</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les spécialités</option>
                                <option>Développement Web</option>
                                <option>Design</option>
                                <option>Marketing</option>
                                <option>Business</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Tous les statuts</option>
                                <option>Actif</option>
                                <option>En congé</option>
                                <option>Inactif</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Note</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les notes</option>
                                <option>4.5+</option>
                                <option>4.0+</option>
                                <option>3.5+</option>
                            </select>
                        </div>
                    </div>
                </div> -->

                <!-- Teachers List -->
                <?php
                require_once '../classes/database.php';
                require_once '../classes/class_utilisateurs.php';

                // $student = new Student($_SESSION['id'],$_SESSION['nom'], $_SESSION['prenom'], $_SESSION['email'], $_SESSION['role']);
                $students = Student::getAllUtilisateurs();
                ?>
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b">
                        <h2 class="text-xl font-bold">Liste des Utilisateurs</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <?php if (count($students) > 0): ?>
                                <?php foreach ($students as $enseignant): ?>
                                    <div class="bg-white border rounded-lg overflow-hidden">
                                        <div class="p-6">
                                            <div class="flex justify-between items-start">
                                                <div class="flex items-center gap-4">
                                                    <img src="../img/ayoub.jpg" alt="Teacher" class="w-16 h-16 rounded-full">
                                                    <div>
                                                        <h3 class="font-bold text-lg"><?= htmlspecialchars($enseignant['nom']) ?></h3>
                                                        <h3 class="font-bold text-lg"><?= htmlspecialchars($enseignant['prenom']) ?></h3>
                                                        <div class="flex items-center mt-1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="px-3 py-1 <?= $enseignant['statut'] == 'Suspendu' ? 'bg-red-100 text-red-700' : ($enseignant['statut'] == 'Actif' ? 'bg-green-100 text-green-700' : ($enseignant['statut'] == 'En attente' ? 'bg-blue-300 text-blue-700' : 'bg-gray-100 text-gray-700')) ?> rounded-full text-sm">
                                                    <?= htmlspecialchars($enseignant['statut']) ?>
                                                </span>



                                                <div class="flex gap-2">
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="student_id" value="<?= $enseignant['id']; ?>">
                                                        <button type="submit" name="change_status" class="p-2 text-yellow-600 hover:text-yellow-800">
                                                            <i class="fas fa-sync-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="mt-6 space-y-2">
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-500">Statut</span>
                                                    <span class="font-medium">Etudiant</span>
                                                </div>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-500">Étudiants total</span>
                                                    <span class="font-medium">1,245</span>
                                                </div>
                                                <div class="flex justify-between text-sm">
                                                    <span class="text-gray-500">Taux de complétion</span>
                                                    <span class="font-medium">92%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-gray-500">Aucun enseignant trouvé.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>