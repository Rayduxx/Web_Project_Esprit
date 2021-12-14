<?php
include "./includes/profil_header.php";
if(isset($userinfo['id'])){
  if(isset($_GET['F']) && !empty($_GET['F'])){
    if($userinfo['typeCompte'] == 1){
      $query = $bdd->prepare("UPDATE entretient SET idAgentEntretient = ?, status = ? WHERE id = ?");
      $query->execute(array($userinfo['id'],1,$_GET['F']));
      header("Location: ./action_entretient_agent.php?Ordre=".$_GET['F']);
    }else{
      header("Location: ./profil.php");
    }
  } else{
    header("Location: ./liste_entretient_agent.php");
  }
} else {
  header("Location: ./login.php");
}
 ?>
