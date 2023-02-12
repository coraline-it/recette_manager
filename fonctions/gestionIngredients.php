<?php
/*
· récupérer tous les ingrédients d’une ingredient
· récupérer un ingrédient suivant son id
· ajouter un ingrédient à une ingredient
· supprimer tous les ingrédients d’une recette
*/

require_once "database.php";

function getIngredients()
{

  $bdd = getDatabase();

  $sql = "select * from ingredient";

  // exécute la requete
  $reponse = $bdd->query($sql);

  // récupère la liste
  $ingredients = $reponse->fetchAll();

  // ferme la connexion
  $reponse->closeCursor();

  return $ingredients;
}

function getIngredient($id)
{

  $bdd = getDatabase();

  $sql = "select * from ingredient where idIngredient = :id";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("id", $id);

  // execute la requete
  $pst->execute();

  // récupère un élément
  $ingredient = $pst->fetch();

  // ferme la connexion
  $pst->closeCursor();

  return $ingredient;
}

/*function addIngredient($nom, $quantite, $unite, $idRecette)
{

  $bdd = getDatabase();

  // requete insert avec les paramètres
  $sql = "insert into ingredient (titre, auteur, description, photo, date_creation) "
    . "values (:titre, :auteur,  :description, :photo, now())";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("titre", $titre);
  $pst->bindValue("idMembre", $idMembre);
  $pst->bindValue("description", $description);
  $pst->bindValue("photo", $photo);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}


function deleteingredient($idingredient)
{

  $bdd = getDatabase();

  // requete delete avec les paramètres
  $sql = "delete from ingredient where idingredient = :idingredient";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("idingredient", $idingredient);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}*/