<?php

require_once "database.php";

/*
· récupérer tous les membres
· récupérer un membre suivant son id
· ajouter un membre
· mettre à jour un membre
· supprimer un membre
*/

function getMembres()
{

  $bdd = getDatabase();

  $sql = "select * from membre";

  // exécute la requete
  $reponse = $bdd->query($sql);

  // récupère la liste
  $membres = $reponse->fetchAll();

  // ferme la connexion
  $reponse->closeCursor();

  return $membres;
}

function getMembre($id)
{

  $bdd = getDatabase();

  $sql = "select * from membre where idMembre = :id";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("id", $id);

  // execute la requete
  $pst->execute();

  // récupère un élément
  $membre = $pst->fetch();

  // ferme la connexion
  $pst->closeCursor();

  return $membre;
}

function addMembre($pseudo, $nom, $email, $mdp)
{

  $bdd = getDatabase();

  // requete insert avec les paramètres
  $sql = "insert into membre (pseudo, nom, email, mdp, date_inscription) "
    . "values (:pseudo, :nom,  :email, :mdp, now())";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("pseudo", $pseudo);
  $pst->bindValue("nom", $nom);
  $pst->bindValue("email", $email);
  $pst->bindValue("mdp", $mdp);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}

function updateMembre($idMembre, $pseudo, $nom, $email, $mdp)
{

  $bdd = getDatabase();

  // requete update avec les paramètres
  $sql = "update membre set pseudo = :pseudo, 
    nom = :nom, 
    email = :email, 
    mdp = :mdp
    where idMembre = :idMembre";

  echo $idMembre . " " . $pseudo . " " . $nom . " " . $email . " " . $mdp;

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("idMembre", $idMembre);
  $pst->bindValue("pseudo", $pseudo);
  $pst->bindValue("nom", $nom);
  $pst->bindValue("email", $email);
  $pst->bindValue("mdp", $mdp);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();   
}

function deleteMembre($idMembre)
{

  $bdd = getDatabase();

  // requete delete avec les paramètres
  $sql = "delete from membre where idMembre = :idMembre";

  // prépare la requete
  $pst = $bdd->prepare($sql);

  // bind les valeurs avec les paramètres de la requete
  $pst->bindValue("idMembre", $idMembre);

  // execute la requete
  $pst->execute();

  // ferme la connexion
  $pst->closeCursor();
}