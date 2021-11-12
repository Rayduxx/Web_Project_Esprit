<?php
require '../model/avis.php';
class AvisC {
  public function afficherAvis(){
    $sql = "SELECT * FROM avis";
    $db = config::getConnection();
    try{
      $affichage = $db->query($sql);
      return $affichage;
    } catch (Exception $e){
      die('Erreur :'. $e->getMessage());
    }
  }
}
 function nombreAvis(){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM avis");
  $query->execute();
  $result = $query->rowCount();
  return $result;
}
 ?>
