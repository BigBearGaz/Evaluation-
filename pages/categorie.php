<?php 
require_once('./function/main-functions.php');
require_once('./function/categ.func.php');
$categs = caramel();

// Trier le tableau $categs par le nom de la catégorie
usort($categs, function($a, $b) {
    return strcmp($a->name, $b->name);
});
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories et Articles</title>
    <style>
        body {
            background: linear-gradient(45deg, #1a0000, #330000);
            color: #fff;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            text-align: center;
            color: #ff4d4d;
            text-shadow: 0 0 10px #800000;
            font-size: 3em;
            margin-bottom: 30px;
        }

        .category {
            margin-bottom: 20px;
            background: rgba(51, 0, 0, 0.7);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 0 20px rgba(255, 77, 77, 0.5);
            transition: all 0.3s ease;
        }

        .category:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 25px rgba(255, 77, 77, 0.8);
        }

        h3 {
            color: #ff6666;
            text-shadow: 0 0 5px #cc0000;
            border-bottom: 2px solid #ff6666;
            padding-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding-left: 20px;
        }

        a {
            color: #fff;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #ff4d4d;
            text-shadow: 0 0 5px #ff4d4d;
        }

        .flame-effect {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            background: 
                radial-gradient(ellipse at top, rgba(255, 77, 77, 0.3), transparent 70%),
                radial-gradient(ellipse at bottom, rgba(128, 0, 0, 0.3), transparent 70%);
            animation: flicker 5s infinite alternate;
        }

        @keyframes flicker {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
    </style>
</head>
<body>
    <div class="flame-effect"></div>
    <h1>Catégories et Articles</h1>

    <?php
    $currentCateg = null;
    foreach($categs as $item):
        if ($currentCateg !== $item->id):
            if ($currentCateg !== null): ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="category">
                <h3><?= htmlspecialchars($item->name) ?></h3>
                <ul>
            <?php
            $currentCateg = $item->id;
        endif;
        if (!empty($item->article_title)): ?>
            <li>
                <a href="index.php?page=post&id=<?= urlencode($item->article_id) ?>">
                    <?= htmlspecialchars($item->article_title) ?>
                </a>
            </li>
        <?php endif;
    endforeach;
    if ($currentCateg !== null): ?>
        </ul>
    </div>
    <?php endif; ?>

</body>
</html>