<?php
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($name) && !empty($email) && !empty($password)) {
        $newAdminId = add_admin($name, $email, $password);

        if ($newAdminId) {
            header('Location: admin.php?message=Nouvel administrateur ajouté avec succès');
        } else {
            header('Location: admin.php?error=Erreur lors de l\'ajout de l\'administrateur');
        }
    } else {
        header('Location: admin.php?error=Tous les champs sont requis');
    }
    exit;
}