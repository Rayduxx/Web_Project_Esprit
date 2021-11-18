<?php
require '../model/Logement.php';
function NombreLogementDispo(){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM Logement WHERE idLocataire IS NULL");
  $query->execute();
  $result = $query->rowCount();
  return $result;
}
function NombreLogementUser($i){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM Location WHERE idLocataire = ? AND etat = 0");
  $query->execute(array($i));
  $result = $query->rowCount();
  return $result;
}
function NombreInterventionAgent($i){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM entretient WHERE idAgentEntretient = ? AND status = 1");
  $query->execute(array($i));
  $result = $query->rowCount();
  return $result;
}
function NombreInterventionEnCoursAgent($i){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM entretient WHERE idAgentEntretient = ? AND status = 0");
  $query->execute(array($i));
  $result = $query->rowCount();
  return $result;
}
function NombreInterventionLogement($i){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM entretient WHERE idAppartement = ?");
  $query->execute(array($i));
  $result = $query->rowCount();
  return $result;
}
?>
