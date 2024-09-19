<?php
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_POST['image'];
    $posted = 1; // Assurez-vous que c'est la valeur correcte pour un article publié

    edit_vrmtposts($id, $title, $content, $image, $posted);

    header('Location: home.php');
    exit;
}

