<?php
// On démarre une session
session_start();

// Est ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    require_once('connect.php');

    // On nettoie l'id envoyé
    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `liste` WHERE `id` = :id';

    // On prépare la requete
    $query = $db->prepare($sql);

    // On "accroche" les paramètre (id)
    $query->bindValue(':id', $id, PDO::PARAM_INT);

    // On execute la requete
    $query->execute();

    //On récupère le produit
    $produit =$query->fetch();

    // On vérifie que le produit existe
    if(!$produit){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: index.php');
    }

}else{
    $_SESSION['erreur'] = "Url invalide";
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du produit</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Détails du produit <?= $produit['produit'] ?></h1>
                <p>ID :<?= $produit['id'] ?></p>
                <p>Produit :<?= $produit['produit'] ?></p>
                <p>Prix :<?= $produit['prix'] ?></p>
                <p>Nombre :<?= $produit['nombre'] ?></p>
                <p><a href="index.php">Retour</a> <a href="edit.php?id=<?=$produit['id'] ?>">Modifier</a></p>
            </section>
        </div>
    </main>
</body>
</html>