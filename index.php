<?php
$pdo = new PDO("mysql:dbname=Tableau;host=localhost", 'root', 'root', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Tableau Dynamique</title>
</head>
<body>
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
            <tr>
                <td>#1</td>
                <td>Bien 1</td>
                <td>10 000 CDF</td>
                <td>Masina</td>
                <td>Kinshasa</td>
            </tr>
        </tbody>
    </table>
</body>
</html>