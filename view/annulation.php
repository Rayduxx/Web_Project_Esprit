<?php
include '../config.php';
if(isset($_GET['InscriptionId'])) {
  $verif = $bdd->prepare("SELECT * FROM participants WHERE id = ?");
  $verif->execute(array($_GET['InscriptionId']));
  $eventExist = $verif->rowCount();
  if($eventExist == 1){
    $inscription = $verif->fetch();
    if($inscription['userId'] == $userinfo['id']){
      $suppression = $bdd->prepare("DELETE FROM participants WHERE id = ?");
      $suppression->execute(array($inscription['id']));
      header("Location: ./event_user.php?success=1");
    } else{
      header("Location: ./event_user.php?success=0");
    }
  } else{
      header("Location: ./event_user.php?success=0");
  }
} else {
  header("Location: ./event_user.php?success=0");
}





 ?>
