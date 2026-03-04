<?php

use App\NumberHelper;
use App\URLHelper;

require 'vendor/autoload.php';
$pdo = new PDO("mysql:dbname=Tableau;host=localhost", 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

define('PER_PAGE', 10);

$query = "SELECT * FROM products";
$queryCount = "SELECT COUNT(id) as count FROM products";
$params = [];

// Recherche par ville
if (!empty($_GET['q'])) {
    $query .= " WHERE city LIKE :city";
    $queryCount .= " WHERE city LIKE :city";
    $params['city'] = '%' . $_GET['q'] . '%';
}

// Pagination
$page = (int)($_GET['p'] ?? 1);
$offset = ($page-1) * PER_PAGE;

$query .= " LIMIT " . PER_PAGE . " OFFSET $offset";

$statement = $pdo->prepare($query);
$statement->execute($params);
$products = $statement->fetchAll();

$statement = $pdo->prepare($queryCount);
$statement->execute($params);
$count = (int)$statement->fetch()['count'];
$pages = ceil($count / PER_PAGE);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Tableau Dynamique</title>
</head>
<body class="p-4">

    <h1>Les biens immobiliers</h1>
    
    <form action="" method="get" class="mb-4">
        <div class="form-group">
            <input type="text" name="q" id="" placeholder="Rechercher par ville" value="<?= htmlentities($_GET['q'] ?? null) ?>" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <td>ID</td>
                <td>Nom</td>
                <td>Prix</td>
                <td>Ville</td>
                <td>Adresse</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
                <tr>
                    <td>#<?= $product['id'] ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= NumberHelper::price($product['price']); ?></td>
                    <td><?= $product['city'] ?></td>
                    <td><?= $product['address'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <?php if($pages > 1 && $page > 1): ?>
        <a href="?<?= URLHelper::withParam("p", $page - 1) ?>" class="btn btn-primary">Page précedente</a>
    <?php endif ?>

    <?php if($pages > 1 && $page < $pages): ?>
        <a href="?<?= URLHelper::withParam("p", $page + 1) ?>" class="btn btn-primary">Page suivante</a>
    <?php endif ?>
</body>
</html>