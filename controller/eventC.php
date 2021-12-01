<?php
function NombreEventsActif (){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM event WHERE isComplete = 0");
  $query->execute();
  $result = $query->rowCount();
  return $result;
}

function NombreEventsUser($u)
{
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM participants WHERE userId = ?");
  $query->execute(array($u));
  $result = $query->rowCount();
  return $result;
}
function NombreEvents (){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM event");
  $query->execute();
  $result = $query->rowCount();
  return $result;
}

function nombrePlaceVide($id){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM event WHERE id = ?");
  $query->execute(array($id));
  $evenement = $query->fetch();
  $selectionP = $bdd->prepare("SELECT FROM participants WHERE eventId = ?");
  $selectionP->execute(array($id));
  $comptage = $selectionP->rowCount();
  $res = $evenement['maxParticipant'] - $comptage;
  return $res;
}

 ?>
