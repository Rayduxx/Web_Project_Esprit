<?php
function NombreEventsActif (){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM event");
  $query->execute();
  $result = 0;
  while($A = $query->fetch()){
    $calculTime = strtotime($A['datetime']) - time();
    if($calculTime > 0){
      $result = $result + 1;
    }
  }
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

function NombreParticipantsEvent($E){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM participants WHERE eventId = ?");
  $query->execute(array($E));
  $result = $query->rowCount();
  return $result;
}

 ?>
