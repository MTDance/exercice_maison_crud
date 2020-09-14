<?php

// On inclut la connexion à la base
require_once('connect.php');

$sql = 'SELECT * FROM `liste`';

// On prépare la requete
$query = $db->prepare($sql);

// On exécute la reqête
$query->execute();

// On stocke le résultat dans un tableau associatif
$result = $query->fetchAll(PDO::FETCH_ASSOC);

require_once('close.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des produits</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php 
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                        '.$_SESSION['erreur'].'
                      </div>';
                      $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Listes des produits</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Nombre</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <?php
                        // ON boucle sur la variable résult
                        foreach ($result as $produit) {
                        ?>
                            <tr>
                                <td><?= $produit['id'] ?></td>
                                <td><?=$produit['produit']?></td>
                                <td><?=$produit['nombre']?></td>
                                <td><?=$produit['prix']?></td>
                                <td><a href="details.php?id=<?= $produit ['id'] ?>">Voir</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="add.php" class="btn btn-primary">Ajouter un produit</a>
            </section>
        </div>
    </main>
</body>

</html>