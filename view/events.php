<?php
$page_titre = "Events";
 include './includes/header.php';?>

  <div class="card container">
    <div class="card-body text-center">
      <?php
       $i = NombreEventsActif();
       if($i == 0){
       ?>
        <div class="alert alert-danger">
          <h2> Aucun Evenement n'est en cours </h2>
        </div>
    <?php } else {?>
      <div id="slides" class="carousel slide" data-ride="carousel">
     <ul class="carousel-indicators">
      <li data-target="#slides" data-slide-to="0" class="active"></li>
     </ul>
     <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets/img/img2.jpg">
        <div class="carousel-caption">
          <h1 class="display-2">Sky City !</h1>
          <h3>Welcome To SkyCity !</h3>
          <a type="button" class="btn btn-primary btn-lg" href="./index.php">Retour a l'accueil</a>
          <a type="button" class="btn btn-secondary btn-lg" href="./Logements.php">Voir nos logements</a>
        </div>
      </div>
     </div>
     </div>
      <div class="card-title text-center">
        <h1> Evennements</h1>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
           <tr>
             <th scope="col"> </th>
             <th scope="col">Description</th>
             <th scope="col">Date de l'evenement</th>
             <th scope="col">Nombre de participant</th>
             <th scope="col"> </th>
           </tr>
         </thead>
         <tbody>
           <?php
           $selection = $bdd->prepare('SELECT * FROM event');
           $selection->execute();
           while($A = $selection->fetch()) {
             $calcul = strtotime($A['datetime']) - time();
             if($calcul > 0) {
             ?>
             <tr>
               <td><img src="<?php echo $A['image']?>"></td>
               <td><?php echo $A['description'];?></td>
               <td><?php echo date('H:i:s d/m/y', strtotime($A['datetime'])); ?></td>
               <td><?php echo NombreParticipantsEvent($A['id']);?> / <?php echo $A['maxParticipant'];?> </td>
               <td><a type="button" href="evenement.php?idEvent=<?php echo $A['id'];?>" class="btn btn-warning">En savoir plus</a></td>
             </tr>
           <?php }
              } ?>
         </tbody>
        </table>
      </div>
    <?php } ?>
    </div>
  </div>



<?php include './includes/footer.php';?>
