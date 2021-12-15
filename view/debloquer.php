<?php

include "./includes/header.php";
if(isset($userinfo['id'])){
  if($userinfo['isAdmin'] == 1){
    if(isset($_GET['idBan'])){
      $query = $bdd->prepare("DELETE FROM ban WHERE userid = ?");
      $query->execute(array($_GET['userid']));
    } else{
      header("./blockage_user.php?success=0");
    }
  }else{
    header("Location: ./index.php");
  }
} else{
  header("Location: ./index.php");
}
include "./includes/footer.php";

?>
