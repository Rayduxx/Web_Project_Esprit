<?php
$page_titre = "offres";
include "./includes/header.php";

function NombreOffre($i){
  $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
  $query = $bdd->prepare("SELECT * FROM offres WHERE idLogement = ?");
  $query->execute(array($i));
  $result = $query->rowCount();
  return $result;
}
 ?>
 <br/><br/>
 <div class="card container text-center">
     <?php
     $selection = $bdd->prepare("SELECT * FROM offres WHERE idLogement = ?");
     $selection->execute(array($_GET['idLogement']));
     $A = $selection->fetch();
     if(isset($_GET['idLogement'])) {
       if(NombreOffre($_GET['idLogement']) == 0){ ?>
         <div class="alert alert-danger">
           <h2> Aucune Offre n'est disponible sur ce Logement</h2>
         </div>
       <?php } else { ?>
       <div class="card-header"><h2>Nos offres sur cet <?php echo $A['typeLogement']; ?></h2></div>
        <div class="card-body">
         <table class="table">
           <thead>
            <tr>
              <th scope="col">Promotion</th>
              <th scope="col">Prix Initiale</th>
              <th scope="col">Prix Finale</th>
              <th scope="col">Date Expiration</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $A['promotion']; ?> % </td>
              <td><?php echo $A['PrixInitiale']; ?></td>
              <td> <?php echo $A['PrixFinale']; ?></td>
              <td><?php
               echo date('d/m/Y H:i:s', strtotime($A));
               ?></td>
            </tr>
          </tbody>
         </table>
       <?php } ?>
     <?php } else {
       header('Location: ./logement.php');
     }?>

   </div>
 </div>

 <?php include "./includes/footer.php"; ?>
