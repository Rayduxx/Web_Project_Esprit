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


 ?>
