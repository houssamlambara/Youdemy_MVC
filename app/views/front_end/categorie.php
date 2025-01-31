<?php
include_once('../classes/class_categorie.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_categorie'])) {
    $nom = htmlspecialchars($_POST['nom']);
    $categorie = new Categorie($nom);

    if ($categorie->save()) {
        header("Location: categorie.php");
        exit();
    } else {
        echo "Erreur lors de l'ajout de la catégorie.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cat'])) {
    $categorieId = (int)$_POST['delete_id'];

    if (Categorie::delete($categorieId)) {
        echo "La catégorie a été supprimée avec succès.";
        header("Location: categorie.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de la suppression de la catégorie.";
    }
}

$categories = Categorie::getAll();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories - Plateforme de Cours</title>
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Catégories</h1>
                    <div class="flex items-center gap-4">
                        <button data-modal-toggle="addCategorieModal" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Ajouter une Catégorie
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="../img/houssam.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Admin</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Categories Content -->
            <main class="p-8">
                <!-- Categories Table -->
                <table class="min-w-full bg-white shadow rounded-lg">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-gray-600">ID</th>
                            <th class="px-6 py-3 text-left text-gray-600">Nom de la Catégorie</th>
                            <th class="px-6 py-3 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $categories = Categorie::getAllCategorie();
                        foreach ($categories as $categorie): ?>
                            <tr class="border-b">
                                <td class="px-6 py-3"><?= htmlspecialchars($categorie->getId()) ?></td>
                                <td class="px-6 py-3"><?= htmlspecialchars($categorie->getNom()) ?></td>
                                <td class="px-6 py-3">
                                    <form action="" method="POST" style="display:inline;">
                                        <input type="hidden" name="delete_id" value="<?= $categorie->getId() ?>">
                                        <button type="submit" name="delete_cat" class="ml-4 text-red-600 hover:underline">
                                            <i class="fas fa-trash-alt"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Modal for adding a category -->
    <div id="addCategorieModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h3 class="text-xl font-semibold mb-4">Ajouter une nouvelle catégorie</h3>
            <form method="POST">
                <div class="mb-4">
                    <label for="nom" class="block text-gray-600">Nom de la catégorie</label>
                    <input type="text" name="nom" id="category_name" class="w-full px-4 py-2 border rounded-lg" required>
                </div>
                <button type="submit" name="add_categorie" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                <button type="button" class="ml-4 text-red-600 hover:underline" onclick="document.getElementById('addCategorieModal').classList.add('hidden')">Annuler</button>
            </form>
        </div>
    </div>

    <script>
        document.querySelector('[data-modal-toggle="addCategorieModal"]').addEventListener('click', function() {
            document.getElementById('addCategorieModal').classList.remove('hidden');
        });

        // Après l'envoi du formulaire, vous pouvez fermer le modal
        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById('addCategorieModal').classList.add('hidden');
        });
    </script>
</body>

</html>