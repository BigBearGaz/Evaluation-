<?php
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $writer = $_POST['writer'] ?? '';
    $posted = 1;

    // Gestion de l'upload d'image
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Assurez-vous que ce dossier existe et est accessible en écriture
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $imageName = uniqid() . '.' . $imageFileType;
        $uploadFile = $uploadDir . $imageName;

        // Vérifiez si le fichier est une image valide
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $image = $uploadFile;
            } else {
                header('Location: home.php?error=Erreur lors de l\'upload de l\'image');
                exit;
            }
        } else {
            header('Location: home.php?error=Le fichier n\'est pas une image valide');
            exit;
        }
    }

    if (!empty($title) && !empty($content)) {
        $newPostId = add_post($title, $content, $image, $writer, $posted);

        if ($newPostId) {
            header('Location: home.php?message=Post ajouté avec succès');
        } else {
            header('Location: home.php?error=Erreur lors de l\'ajout du post');
        }
    } else {
        header('Location: home.php?error=Le titre et le contenu sont requis');
    }
    exit;
}