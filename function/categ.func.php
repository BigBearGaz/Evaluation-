<?php 

function caramel(){
    
    global $db;
    
    $req = $db->query("SELECT * FROM categories");

    $results = $req->fetchAll(PDO::FETCH_ASSOC);
    
    return $results;
     
}
 ?>
