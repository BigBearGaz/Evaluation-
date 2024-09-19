<?php
require_once('config.php');
require_once('functions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    
    $result = delete_post($id);
    
    if ($result) {
        header('Location: index.php?message=Post supprimé avec succès');
    } else {
        header('Location: index.php?error=Erreur lors de la suppression du post');
    }
} else {
    header('Location: index.php?error=ID du post non fourni');
}
exit;