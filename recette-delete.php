<?php
require "./fonctions/gestionRecette.php";

$id = (int) $_GET['id'];

deleteRecette($id);

header("location:recettes.php");
?>
