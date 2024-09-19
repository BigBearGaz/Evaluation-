<?php
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $writer = $_POST['writer'] ?? '';
    $posted = 1;
    $categorie_id = $_POST['categorie_id'] ?? '';

    // Gestion de l'upload d'image
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Assurez-vous que ce dossier existe et est accessible en écriture
        
        // Créer le dossier s'il n'existe pas
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imageName = uniqid() . '.' . $imageFileType;
        $uploadFile = $uploadDir . $imageName;

        // Vérifier le type de fichier
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image = $uploadFile;
            } else {
                header('Location: home.php?error=Erreur lors de l\'upload de l\'image');
                exit;
            }
        } else {
            header('Location: home.php?error=Le fichier n\'est pas une image valide (jpg, jpeg, png, gif seulement)');
            exit;
        }
    }

    if (!empty($title) && !empty($content) && !empty($categorie_id)) {
        $newPostId = add_post($title, $content, $image, $writer, $posted, $categorie_id);

        if ($newPostId) {
            header('Location: home.php?message=Post ajouté avec succès');
        } else {
            header('Location: home.php?error=Erreur lors de l\'ajout du post');
        }
    } else {
        header('Location: home.php?error=Le titre, le contenu et la catégorie sont requis');
    }
    exit;
}