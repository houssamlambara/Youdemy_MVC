<?php
// require_once('../classes/class_cours.php');
// require_once('../classes/database.php');

// if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {

//     $titre = htmlspecialchars($_POST['titre']);
//     $description = htmlspecialchars($_POST['description']);
//     $categorie_id = htmlspecialchars($_POST['categorie_id']);
//     $prix = htmlspecialchars($_POST['prix']);
//     $image_url = '';

//     if (isset($_FILES['image_url']) && !empty($_FILES['image_url']['name'])) {
//         $dir = '../uploads/';
//         $path = basename($_FILES['image_url']['name']);
//         $finalPath = $dir . uniqid() . "_" . $path;
//         $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
//         $extension = pathinfo($finalPath, PATHINFO_EXTENSION);

//         if (in_array(strtolower($extension), $allowedExtensions)) {
//             if (move_uploaded_file($_FILES['image_url']['tmp_name'], $finalPath)) {
//                 $image_url = $finalPath;
//             } else {
//                 echo "Erreur lors du téléchargement de l'image.";
//             }
//         } else {
//             echo "Extension non autorisée pour l'image.";
//         }

//         $cours = new Cours($titre, $description, $image_url, $categorie_id, $prix);

//         if ($cours->save()) {
//             echo "Le cours a été ajouté avec succès !";
//             header('Location: addcours.php');
//             exit();
//         } else {
//             echo "Une erreur s'est produite lors de l'ajout du cours.";
//         }
//     }
// }
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours - Admin</title>
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
                    <a href="./enseignant_dashboard.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-book w-6"></i>
                        <span>Cours</span>
                    </a>
                    <a href="./etudiant.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-users w-6"></i>
                        <span>Étudiants</span>
                    </a>
                    <a href="./statistique.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
                        <i class="fas fa-chart-line w-6"></i>
                        <span>Statistiques</span>
                    </a>
                    <a href="../index.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Cours</h1>
                    <div class="flex items-center gap-4">
                        <button data-modal-toggle="addCourseModal" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Nouveau Cours
                        </button>
                        <button class="relative text-gray-500 hover:text-gray-700">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Courses Content -->
            <main class="p-8">
                <!-- Formulaire pour ajouter un cours -->
                <!-- Courses Content -->
                <main class="">
                    <!-- Formulaire pour ajouter un cours -->
                    <div id="addCourseModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg w-1/3">
                            <h3 class="text-xl font-semibold mb-4">Ajouter un nouveau cours</h3>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="mb-4">
                                    <label for="course_name" class="block text-gray-600">Nom du cours</label>
                                    <input type="text" name="titre" id="course_name" class="w-full px-4 py-2 border rounded-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="block text-gray-600">Description</label>
                                    <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg" required></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="category" class="block text-gray-600">Catégorie</label>
                                    <select name="categorie_id" id="category" class="w-full px-4 py-2 border rounded-lg">
                                        <option value="1">Informatique</option>
                                        <option value="2">Design</option>
                                        <option value="3">Marketing</option>
                                        <option value="4">UI/UX</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="price" class="block text-gray-600">Prix</label>
                                    <input type="number" name="prix" id="prix" class="w-full px-4 py-2 border rounded-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label for="status" class="block text-gray-600">Statut</label>
                                    <select name="status" id="status" class="w-full px-4 py-2 border rounded-lg">
                                        <option value="Publié">Publié</option>
                                        <option value="Brouillon">Brouillon</option>
                                        <option value="En révision">En révision</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="image_url" class="block text-gray-600">Image</label>
                                    <input type="file" name="image_url" id="image_url" class="w-full px-4 py-2 border rounded-lg">
                                </div>

                                <!-- Section pour les tags -->
                                <div class="mb-4">
                                    <label for="tags" class="block text-gray-600">Tags</label>
                                    <select name="tags[]" id="tags" class="w-full px-4 py-2 border rounded-lg" multiple>
                                        <?php
                                        // On récupère tous les tags existants depuis la base de données
                                        $tags = tag::getAllTags();
                                        foreach ($tags as $tag) {
                                            echo "<option value='{$tag['id']}'>{$tag['nom']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="flex justify-end mt-4">
                                    <button type="submit" name="add_course" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                                    <button type="button" class="ml-4 text-red-600 hover:underline" onclick="document.getElementById('addCourseModal').classList.add('hidden')">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>



                </main>

                <!-- Filters -->
                <div class="bg-white rounded-lg shadow mb-6 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rechercher</label>
                            <div class="relative">
                                <input type="text" placeholder="Nom du cours..."
                                    class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Toutes les catégories</option>
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
                                <option>Publié</option>
                                <option>Brouillon</option>
                                <option>En révision</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Trier par</label>
                            <select class="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <option>Plus récent</option>
                                <option>Plus ancien</option>
                                <option>Plus populaire</option>
                                <option>Mieux noté</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Courses List -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b flex justify-between items-center">
                        <h2 class="text-xl font-bold">Liste des Cours</h2>
                    </div>

                    <div class="p-6">
                        <!-- Tableau -->
                        <table class="w-full table-auto border-collapse">
                            <thead class="bg-gray-100">
                                <tr class="text-left text-gray-500 border-b">
                                    <th class="py-4 px-6">Cours</th>
                                    <th class="py-4 px-6">Catégorie</th>
                                    <th class="py-4 px-6">Prix</th>
                                    <th class="py-4 px-6">Étudiants</th>
                                    <th class="py-4 px-6">Dernière mise à jour</th>
                                    <th class="py-4 px-6">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <?php
                                require_once '../classes/database.php';
                                require_once '../classes/class_cours.php';

                                $error = '';

                                $res = Cours::showAllcours();

                                if (!empty($res)):
                                    foreach ($res as $row):
                                ?>
                                        <tr>
                                            <td class="py-4 px-6">
                                                <div class="flex items-center gap-3">
                                                    <img src="../img/<?= htmlspecialchars($row['image_url']); ?>" alt="Course" class="w-12 h-12 rounded-lg object-cover">
                                                    <div>
                                                        <p class="font-medium"><?= htmlspecialchars($row['titre']); ?></p>
                                                        <p class="text-sm text-gray-500"><?= htmlspecialchars($row['description']); ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm">
                                                    <?= htmlspecialchars($row['nom']); ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-6"><?= number_format($row['prix'], 2, ',', ' ') . ' €'; ?> </td>
                                            <td class="py-4 px-6"></td>
                                            <td class="py-4 px-6"><?= date('d-m-Y', strtotime($row['date_creation'])); ?> </td>
                                            <td class="py-4 px-6">
                                                <div class="flex gap-2">
                                                    <button class="p-2 text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="p-2 text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                    ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Aucun cours trouvé.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="flex justify-between items-center mt-6">
                            <p class="text-gray-500">Affichage de 1-10 sur 48 cours</p>
                            <div class="flex gap-2">
                                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Précédent</button>
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">1</button>
                                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">2</button>
                                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">3</button>
                                <button class="px-4 py-2 border rounded-lg hover:bg-gray-50">Suivant</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    document.querySelector('[data-modal-toggle="addCourseModal"]').addEventListener('click', function() {
                        document.getElementById('addCourseModal').classList.remove('hidden');
                    });
                </script>

</html>