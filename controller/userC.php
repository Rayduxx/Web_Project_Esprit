<?php
require '../config.php'
class UserC{
  function afficherUser(){
    $sql = "SELECT * FROM users";
    $db = config::getConnection();
    try{
      $affichage = $db->query($sql);
      return $affichage;
    } catch (Exception $e){
      die('Erreur :'. $e->getMessage());
    }
  }
}

 ?>
