<?php 

require_once ('config.php');

$db=db_connect();

function get_posts(){

    global $db;

    $req = $db->query("
        SELECT  posts.id,
                posts.title,
                posts.image,
                posts.date,
                posts.content,
                admins.name
        FROM posts
        JOIN admins
        ON posts.writer=admins.name
        WHERE posted='1'
        ORDER BY date DESC
        LIMIT 0,50

    ");

    $results = array();

    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
   
    return $results;
    
}

function edit_posts($id) {
    global $db;

    $stmt = $db->prepare("
        SELECT * FROM posts WHERE id = :id
    ");

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);
   
    return $result;
}

function edit_vrmtposts($id, $newtitle, $newcontent, $newimage, $newposted) {
    global $db;

    $stmt = $db->prepare("
        UPDATE posts
        SET title = :title, content = :content, image = :image, posted = :posted
        WHERE id = :id
    ");

    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $newtitle, PDO::PARAM_STR);
    $stmt->bindParam(':content', $newcontent, PDO::PARAM_STR);
    $stmt->bindParam(':image', $newimage, PDO::PARAM_STR);
    $stmt->bindParam(':posted', $newposted, PDO::PARAM_INT);

    $stmt->execute();

    return $stmt->rowCount();
}
function add_post($title, $content, $image, $writer, $categorie_id, $posted = 1) {
    global $db;

    try {
        $stmt = $db->prepare("
            INSERT INTO posts (title, content, image, writer, categorie_id, posted, date)
            VALUES (:title, :content, :image, :writer, :categorie_id, :posted, NOW())
        ");

        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':writer', $writer, PDO::PARAM_STR);
        $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
        $stmt->bindParam(':posted', $posted, PDO::PARAM_INT);

        $stmt->execute();

        return $db->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du post : " . $e->getMessage());
        return false;
    }
}

function delete_post($id) {
    global $db;

    try {
        $stmt = $db->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    } catch (PDOException $e) {
        error_log("Erreur lors de la suppression du post : " . $e->getMessage());
        return false;
    }
}

function addd_admin($name, $email, $password) {
    global $db;

    try {
        // Hachage du mot de passe
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("
            INSERT INTO admins (name, email, password)
            VALUES (:name, :email, :password)
        ");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);

        $stmt->execute();

        return $db->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de l'administrateur : " . $e->getMessage());
        return false;
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>