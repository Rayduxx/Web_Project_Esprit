<?php
require '../model/Logement.php';
function NombreLogementDispo(){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM Logement WHERE idLocataire IS NULL");
  $query->execute();
  $result = $query->rowCount();
  return $result;
}
?>
