<?php
  require "./fonctions/gestionRecette.php";
  require "./fonctions/gestionMembre.php";
  $errors = "";

  $membres = getMembres();

  $titre = isset($_POST['titre']) ? $_POST['titre'] : "";
  $idMembre = isset($_POST['membre']) ? $_POST['membre'] : "";
  $description = isset($_POST['description']) ? $_POST['description'] : "";
  $photo = isset($_POST['photo']) ? $_POST['photo'] : "";

if (isset($_POST['ajouter'])) {
  if (empty($titre)) {
    $errors .= "Le titre doit être renseigné<br>";
  }
  if (empty($idMembre)) {
    $errors .= "L'auteur doit être renseigné<br>";
  }
  if (empty($description)) {
    $errors .= "La description doit être renseignée<br>";
  }
  if (empty($photo)) {
    $errors .= "Le mot de passe doit être renseigné<br>";
  }

  if (empty($errors)) {
    addRecette($titre, $description, $photo ,$idMembre);
    header("location:recettes.php");
  }
}
?>
<!DOCTYPE>
<html>
<head>
    <meta charset="utf-8"/>
    <title>
    Recette Manager
    </title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<?php include('navbar.php'); ?>
<body>

<div class="container">

    <div class="row">

        <div class="col-10 card shadow mx-auto mt-3">

            <div class="card-header text-center bg-dark text-light mt-2">
                <h3>AJOUT D'UNE RECETTE</h3>
            </div>

            <div class="card-content mt-3">

                <div class="alert alert—infok mb-3">
                  <?= $errors ?>
                </div>

                <form method="post" action="recette-add.php">

                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" value="<?= $titre ?>" placeholder="Titre de la recette.">
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="description" value="<?= $description ?>" placeholder="Description de la recette.">
                    </div>                    

                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="text" class="form-control" name="photo" id="photo" value="<?= $photo ?>" placeholder="Photo de la recette.">
                    </div>

                    <div class="mb-3">
                        <label for="membre" class="form-label">Auteur</label>
                          <select name="membre" class="selectpicker">
                            <?php foreach($membres as $membre) { ?>
                              <option value="<?= $membre['idMembre'] ?>"><?= $membre['nom']?></option>
                            <?php } ?>
                          </select>
                    </div>

                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button type="submit" name="ajouter" class="btn btn-dark">AJOUTER</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

</body>
</html>
