<?php
$page_titre = "Logement";
include "./includes/header.php";

 ?>
 <br/><br/>
 <div class="card container">
   <div class="card-body text-center">
       <?php
        $i = NombreLogementDispo();
        if($i == 0){
        ?>
         <div class="alert alert-danger">
           <h2> Aucun Logement n'est disponible </h2>
         </div>
     <?php } else {?>
       <div class="card-title text-center">
         <h1> Logement</h1>
       </div>
       <ul class="list-group">
         <?php
         $selection = $bdd->query('SELECT * FROM Logement WHERE idLocataire IS NULL ORDER BY id');
          while($A = $selection->fetch()) {
            ?>
           <li class="list-group-item padding">
             <div class="row align-items col-md-12">
               <div class="row col-md-3">
                 <img src="<?php echo $A['image'];?>" />
              </div>
              <div class="row col-md-3 padding">
               <p> <?php echo $A['description'];
                ?>
                <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>
              </p>
              </div>
              <div class="row col-md-3 padding">
                <p>S+<?php echo $A['nbChambre']; ?> </p>
              </div>
              <div class="row col-md-3 padding">
                <p><?php echo $A['prixLoyer'];?> TND / mois</p>
              </div>
              </div>
              </div>
           </li>
         <?php } ?>
       </ul>
       <br/><br/>
     <?php }?>
   </div>
 </div>
<br/><br/>
 <?php
 include "./includes/footer.php"; ?>
