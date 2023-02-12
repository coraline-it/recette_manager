<?php

require './fonctions/gestionRecette.php';
require './fonctions/gestionIngredients.php';
require './fonctions/gestionMembre.php';

$id = (int) $_GET['id'];
$recette = getRecette($id);
$ingredients = getIngredients();
$membre = getMembre($id);

?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>
    <title>
    Recette Manager
    </title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<?php include('navbar.php'); ?>
<body>
    <div class="container">

        <div class="row">

            <div class="col-10 card shadow mx-auto mt-3">

                <div class="card-header text-center bg-dark text-light mt-2">
                    <h3>INFORMATION RECETTE</h3>
                </div>
                <div class="card-content">

                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="30%">ID :</td>
                                <td><?= $recette['idRecette'] ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Photo :</td>
                                <td><img src="./img/<?= $recette['photo'] ?>" width="200" height="160" /></td>
                            </tr>
                            <tr>
                                <td width="30%">Titre :</td>
                                <td><?= $recette['titre'] ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Description :</td>
                                <td><?= $recette['description'] ?></td>
                            </tr>
                            <tr>
                                <td width="30%">Auteur :</td>
                                <td><?= $membre['nom'] ?></td>
                            </tr>                            
                            <tr>
                                <td width="30%">Date création :</td>
                                <td><?= $recette['date_creation'] ?></td>
                            </tr>     
                            <tr>
                                <td width="30%">Ingrédients :</td>
                                <td>
                                  <?php foreach($ingredients as $ingredient) { ?>
                                    <ul>
                                        <li><?= $ingredient['nom']." ".$ingredient['quantite']." ".$ingredient['unite']?></li>
                                    </ul>
                                  <?php } ?>
                                </td>
                            </tr>                                                                                                                                                                  
                        </tbody>                        
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
</body>
</html>
