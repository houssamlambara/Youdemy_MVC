<?php

require_once('../classes/database.php');
require_once('../classes/class_delete.php');
require_once('../classes/class_vedio.php');
require_once('../classes/class_contenu.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_course'])) {

    $titre = htmlspecialchars($_POST['titre']);
    $description = htmlspecialchars($_POST['description']);
    $categorie_id = htmlspecialchars($_POST['categorie_id']);
    $prix = htmlspecialchars($_POST['prix']);
    // $video_url = '';
    $image_url = '';

    if (isset($_FILES['image_url']) && !empty($_FILES['image_url']['name'])) {
        $dir = '../uploads/';
        $path = basename($_FILES['image_url']['name']);
        $finalPath = $dir . uniqid() . "_" . $path;
        $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'svg'];
        $extension = pathinfo($finalPath, PATHINFO_EXTENSION);

        if (in_array(strtolower($extension), $allowedExtensions)) {
            if (move_uploaded_file($_FILES['image_url']['tmp_name'], $finalPath)) {
                $image_url = $finalPath;
            } else {
                echo "Erreur lors du téléchargement de l'image.";
                exit();
            }
        } else {
            echo "Extension non autorisée pour l'image.";
            exit();
        }
    } else {
        echo "Aucune image téléchargée.";
        exit();
    }
    if($_POST['type']=='video'){
        $video_url = '';
        if (isset($_FILES['video_file']) && !empty($_FILES['video_file']['name'])) {
            $dir = '../uploads/';
            $path = basename($_FILES['video_file']['name']);
            $finalPath = $dir . uniqid() . "_" . $path;
            $allowedExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv'];
            $extension = pathinfo($finalPath, PATHINFO_EXTENSION);
    
            if (in_array(strtolower($extension), $allowedExtensions)) {
                if (move_uploaded_file($_FILES['video_file']['tmp_name'], $finalPath)) {
                    $video_url = $finalPath;
                } else {
                    echo "Erreur lors du téléchargement de la vidéo.";
                    exit();
                }
            } else {
                echo "Extension non autorisée pour la vidéo.";
                exit();
            }
        } else {
            echo "Aucune vidéo téléchargée.";
            exit();
        }
        $cours = new VideoCours($titre, $description, $image_url, $categorie_id, $prix, $video_url);
        if ($cours->save()) {
            echo "Le cours a été ajouté avec succès !";
            header('Location: enseignant_dashboard.php');
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout du cours.";
        }
    }else{
        $contenu_texte = htmlspecialchars($_POST['contenu_texte']);
        $cours = new contenu($titre, $description, $image_url, $categorie_id, $prix, $contenu_texte);
        if ($cours->save()) {
            echo "Le cours a été ajouté avec succès !";
            header('Location: enseignant_dashboard.php');
            exit();
        } else {
            echo "Une erreur s'est produite lors de l'ajout du cours.";
        }
    }

    // $cours = new Cours($titre, $description, $image_url, $categorie_id, $prix);

   
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_cours'])) {
    $coursId = (int)$_POST['delete_id'];

    $delete = new Delete('cours', $coursId);
    if ($delete->execute()) {
        echo "Le tag a été supprimé avec succès.";
        header("Location: enseignant_dashboard.php");
        exit();
    } else {
        echo "Une erreur est survenue lors de la suppression du cours.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Cours - Admin</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
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
                    <a href="./statistique_enseignant.php" class="flex items-center p-3 hover:bg-indigo-800 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Gestion des Cours</h1>
                    <div class="flex items-center gap-4">
                        <button data-modal-toggle="addCourseModal" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Nouveau Cours
                        </button>
                        <div class="flex items-center gap-2">
                            <img src="/api/placeholder/40/40" alt="Profile" class="w-10 h-10 rounded-full">
                            <span class="font-medium">Enseignant</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Formulaire pour ajouter un cours -->
            <?php
            include('../classes/class_categorie.php');

            $categoryModel = new Categorie("");
            $categories = $categoryModel->getAll();

            if (empty($categories)) {
                echo "Aucune catégorie disponible.";
            } else {
            ?>
                <main>
                    <div id="addCourseModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
                        <div class="bg-white p-6 rounded-lg w-2/3 max-w-lg h-auto max-h-[85vh] overflow-y-auto">
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
                                    <label for="categorie" class="block text-gray-600">Catégorie</label>
                                    <select name="categorie_id" id="category" class="w-full px-4 py-2 border rounded-lg">
                                        <?php foreach ($categories as $categorie): ?>
                                            <option value="<?php echo $categorie->getId(); ?>">
                                                <?php echo htmlspecialchars($categorie->getNom()); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="price" class="block text-gray-600">Prix</label>
                                    <input type="number" name="prix" id="prix" class="w-full px-4 py-2 border rounded-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label for="tags" class="block text-gray-600">Tag</label>
                                    <input id="tags" name="tags" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="image_url" class="block text-gray-600">Image</label>
                                    <input type="file" name="image_url" id="image_url" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                                <div class="mb-4">
                                    <label for="type" class="block text-gray-600">Type de contenu</label>
                                    <select name="type" id="type" class="w-full px-4 py-2 border rounded-lg" onchange="toggleContentField()">
                                        <option value="video">Vidéo</option>
                                        <option value="texte">Contenu texte</option>
                                    </select>
                                </div>
                                <div class="mb-4" id="videoField" style="display: none;">
                                    <label for="video_file" class="block text-gray-600">Fichier vidéo</label>
                                    <input type="file" name="video_file" id="video_file" class="w-full px-4 py-2 border rounded-lg">
                                </div>
                                <div class="mb-4" id="texteField" style="display: none;">
                                    <label for="contenu_texte" class="block text-gray-600">Contenu texte</label>
                                    <textarea name="contenu_texte" id="contenu_texte" class="w-full px-4 py-2 border rounded-lg"></textarea>
                                </div>
                                <div class="flex">
                                    <button type="submit" name="add_course" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Ajouter</button>
                                    <button type="button" class="ml-4 text-red-600 hover:underline" onclick="document.getElementById('addCourseModal').classList.add('hidden')">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </main>

                <script>
                    function toggleContentField() {
                        const typeSelect = document.getElementById('type');
                        const videoField = document.getElementById('videoField');
                        const texteField = document.getElementById('texteField');

                        if (typeSelect.value === 'video') {
                            videoField.style.display = 'block';
                            texteField.style.display = 'none';
                        } else if (typeSelect.value === 'texte') {
                            videoField.style.display = 'none';
                            texteField.style.display = 'block';
                        }
                    }

                    document.addEventListener('DOMContentLoaded', function() {
                        toggleContentField();
                    });
                </script>
            <?php
            }
            ?>

            <?php
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $cours = new Cours('', '', '', '', '');
                $cours = $cours->getCoursById($id);

                if ($cours): ?>
                    <main>
                        <div id="editCourseModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
                            <div class="bg-white p-6 rounded-lg w-2/3 max-w-lg h-auto max-h-[85vh] overflow-y-auto">
                                <h3 class="text-xl font-semibold mb-4">Éditer le cours</h3>
                                <form method="POST" action="./edite_cours.php" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $cours->getId(); ?>">

                                    <div class="mb-4">
                                        <label for="course_name" class="block text-gray-600">Nom du cours</label>
                                        <input type="text" name="titre" id="course_name" class="w-full px-4 py-2 border rounded-lg" value="<?= htmlspecialchars($cours->getTitre()); ?>" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="description" class="block text-gray-600">Description</label>
                                        <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg" required><?= htmlspecialchars($cours->getDescription()); ?></textarea>
                                    </div>

                                    <div class="mb-4">
                                        <label for="categorie" class="block text-gray-600">Catégorie</label>
                                        <select name="categorie_id" id="category" class="w-full px-4 py-2 border rounded-lg">
                                            <?php foreach ($categories as $categorie): ?>
                                                <option value="<?= $categorie->getId(); ?>" <?= $categorie->getId() == $cours->getCategorieId() ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($categorie->getNom()); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="mb-4">
                                        <label for="price" class="block text-gray-600">Prix</label>
                                        <input type="number" name="prix" id="prix" class="w-full px-4 py-2 border rounded-lg" value="<?= htmlspecialchars($cours->getPrix()); ?>" required>
                                    </div>

                                    <div class="mb-4">
                                        <label for="image_url" class="block text-gray-600">Image</label>
                                        <input type="file" name="image_url" id="image_url" class="w-full px-4 py-2 border rounded-lg">
                                        <?php if ($cours->getImageUrl()): ?>
                                            <p class="text-sm text-gray-500 mt-2">Image actuelle : <?= $cours->getImageUrl(); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex">
                                        <button action="./edite_cours.php" type="submit" name="update_cours" class="bg-indigo-600 text-white px-4 py-2 rounded-lg">Mettre à jour</button>
                                        <button type="button" class="ml-4 text-red-600 hover:underline" onclick="document.getElementById('editCourseModal').classList.add('hidden')">Annuler</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </main>
                <?php else: ?>
                    <p>Le cours demandé n'a pas été trouvé.</p>
            <?php endif;
            }
            ?>


            <!-- Liste des Cours -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b flex justify-between items-center mt-12">
                    <h2 class="text-xl font-bold text-gray-700">Liste des Cours</h2>
                </div>

                <div class="p-6">
                    <!-- Tableau des cours -->
                    <table class="w-full table-auto border-collapse">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-gray-500 border-b">
                                <th class="py-4 px-6">Cours</th>
                                <th class="py-4 px-6">Catégorie</th>
                                <th class="py-4 px-6">Prix</th>
                                <th class="py-4 px-6">Tag</th>
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
                                                <form action="" method="GET">
                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>" />
                                                    <button type="submit" name="update" class="p-2 text-blue-600 hover:text-blue-800">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </form>

                                                <form action="" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce cours ?');">
                                                    <input type="hidden" name="delete_id" value="<?= $row['id']; ?>" />
                                                    <button type="submit" name="delete_cours" class="p-2 text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <script>
                document.querySelector('[data-modal-toggle="addCourseModal"]').addEventListener('click', function() {
                    document.getElementById('addCourseModal').classList.remove('hidden');
                });


                var input = document.querySelector('#tags ')

                fetch('./JStag.php')
                    .then(response => response.json())
                    .then(tags => {
                        new Tagify(input, {
                            whitelist: tags,
                            userInput: false
                        });
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des tags :', error);
                    });
            </script>

</html>