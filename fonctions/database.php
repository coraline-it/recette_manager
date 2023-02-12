<?php

function getDatabase()
{
  $url = "mysql:host=localhost;port=8889;dbname=recette_blog;charset=utf8";
  $login = "root";
  $password = "root";

  try {
    $bdd = new PDO($url, $login, $password);
  } catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
  }

  return $bdd;
}
