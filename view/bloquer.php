<?php
include "../config.php";

if(isset($_SESSION['id'])){
  if($_SESSION['isAdmin'] == 1) {
    if(isset($_GET['idBan'])){
      $query = $bdd->prepare("INSERT INTO ban(userid) VALUES(?)");
      $query->execute(array($_GET['userid']));
      header("Location: ./blockage_user.php?success=1");
    } else {
      header("Location: ./blockage_user.php?success=0");
    }
  }else{
    header("Location: ./index.php");
  }
} else{
  header("Location: ./index.php");
}

 ?>
