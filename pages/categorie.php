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
        .category {
            margin-bottom: 20px;
        }
        h3 {
            color: #333;
            border-bottom: 1px solid #ccc;
        }
        ul {
            list-style-type: none;
            padding-left: 20px;
        }
    </style>
</head>
<body>
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