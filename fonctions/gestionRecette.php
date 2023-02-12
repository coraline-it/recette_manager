<?php

/*
· récupérer toutes les recettes
· récupérer une recette suivant son id
· ajouter une recette
· mettre à jour une recette
· supprimer une recette
*/

require "database.php";

function getRecettes()
{

  $bdd = getDatabase();

  $sql = "select * from recette";

  // exécute la requete
  $reponse = $bdd->query($sql);

  // récupère la liste
  $recettes = $reponse->fetchAll();

  // ferme la connexion
  $reponse->closeCursor();

  return $recettes;
}

function getRecette($id)
{

  $bdd = getDatabase();

  $sql = "select * from recette where idRecette = :id";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("id", $id);

  // execute la requete
  $pst->execute();

  // récupère un élément
  $recette = $pst->fetch();

  // ferme la connexion
  $pst->closeCursor();

  return $recette;
}

function addRecette($titre, $description, $photo, $idMembre)
{

  $bdd = getDatabase();

  // requete insert avec les paramètres
  $sql = "insert into recette (titre, description, photo, date_creation, idMembre) "
    . "values (:titre, :description, :photo, now(), :idMembre)";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("titre", $titre);
  $pst->bindValue("description", $description);
  $pst->bindValue("photo", $photo);
  $pst->bindValue("idMembre", $idMembre);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}

function updateRecette($idRecette, $titre, $description, $photo, $idMembre)
{

  $bdd = getDatabase();

  // requete update avec les paramètres
  $sql = "update recette set titre = :titre, 
    description = :description, 
    photo = :photo,
    idMembre = :idMembre
    where idRecette = :idRecette";

  echo $idRecette . " " . $titre . " " . $description . " " . $photo . " " . $idMembre;

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("idRecette", $idRecette);
  $pst->bindValue("titre", $titre);
  $pst->bindValue("description", $description);
  $pst->bindValue("photo", $photo);
  $pst->bindValue("idMembre", $idMembre);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}

function deleteRecette($idRecette)
{

  $bdd = getDatabase();

  // requete delete avec les paramètres
  $sql = "delete from recette where idRecette = :idRecette ON DELETE CASCADE";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("idRecette", $idRecette);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}