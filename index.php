<?php
include 'function/main-functions.php';

session_start();

$pages = scandir('pages/');
if (isset($_GET['page']) && !empty($_GET['page'])) {
    if (in_array($_GET['page'] . '.php', $pages)) {
        $page = $_GET['page'];
    } else {
        $page = "error";
    }
} else {
    $page = "home";
}

$pages_functions = scandir('function/');
if (in_array($page . '.func.php', $pages_functions)) {
    include 'function/' . $page . '.func.php';
}
?>




<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/style.css" media="screen,projection" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>
    <?php
    include "body/topbar.php";

    ?>





    <div class="container">
        <?php include 'pages/' . $page . '.php'; ?>



    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
    <?php 
    $pages_js = scandir('js/');
    if (in_array($page . '.func.js', $pages_js)) {
        ?>
        <script type="text/javascript" src="js/<?= $page ?>.func.js"></script>
    <?php
    }
    ?>

</body>

</html>