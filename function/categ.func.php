<?php 
function connect() {
    $dbhost = 'localhost';
    $dbname = 'blog';
    $dbuser = 'root';
    $dbpswd = '';

    try {
        $db = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpswd, array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));
        return $db; // Retourner l'objet PDO
    } catch(PDOException $e) {
        die("Une erreur est survenue lors de la connexion à la base de données : " . $e->getMessage());
    }
}

function caramel() {
    $db = connect(); // Obtenir la connexion
    
    try {
        $req = $db->query("SELECT c.*, p.id AS article_id, p.title AS article_title
FROM categorie c
LEFT JOIN posts p ON c.id = p.categorie_id
ORDER BY c.id, p.title");
        return $req->fetchAll(PDO::FETCH_OBJ); // Récupérer tous les résultats en une fois
    } catch(PDOException $e) {
        die("Erreur lors de la récupération des catégories : " . $e->getMessage());
    }
}
?>