<?php

function get_post() {
    global $db;

    // Vérifier si l'ID est présent et est un nombre
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        return null; // ou gérer l'erreur comme vous le souhaitez
    }

    $id = intval($_GET['id']); // Convertir en entier pour plus de sécurité

    $stmt = $db->prepare("
        SELECT  posts.id,
                posts.title,
                posts.image,
                posts.content,
                posts.date,
                admins.name
        FROM posts
        JOIN admins ON posts.writer = admins.name
        WHERE posts.id = :id
        AND posts.posted = '1'
    ");

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);
    return $result;
}


function comment($name,$email,$comment){

    global $db;

    $c = array(
        'name'      => $name,
        'email'     => $email,
        'comment'   => $comment,
        'post_id'   => $_GET["id"]

    );

    $sql = "INSERT INTO comments(name,email,comment,post_id,date) VALUES(:name, :email, :comment, :post_id, NOW())";
    $req = $db->prepare($sql);
    $req->execute($c);

}

function get_comments(){

    global $db;
    $req = $db->query("SELECT * FROM comments WHERE post_id = '{$_GET['id']}' ORDER BY date DESC");
    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }

    return $results;


}

