<?php include './includes/profil_header.php';?>
    <br/>
    <p class="text-center">Nom : <?php echo $userinfo['nom']; ?></p><br/>
    <p class="text-center">Prenom : <?php echo $userinfo['prenom']; ?> </p><br/>
    <p class="text-center">Email : <?php echo $userinfo['email']; ?></p><br/>
    <p class="text-center">Type de Compte : <?php
    if($userinfo['typeCompte'] == 0){
        echo "Utilisateur";
    } else if($userinfo['isAdmin'] == 1){
        echo "Administrateur";
    } else{
        echo "Agent d'entretient";
    }
    ?></p><br/>
    <p class="text-center">Date de Creation de compte: <?php echo date('d/m/Y', strtotime($userinfo['datecreation'])); ?></p><br/>
    <?php if($userinfo['typeCompte'] == 0){ ?>
    <p class="text-center">Nombre de bien louer : <?php echo NombreLogementUser($userinfo['id']); ?></p>
  <?php }

  if($userinfo['typeCompte'] == 1){
   ?>
   <p class="text-center">Nombre d'intervention effectuer : <?php echo NombreInterventionAgent($userinfo['id']);?></p><br/>
   <p class="text-center">Nombre d'intervention en cours : <?php echo NombreInterventionEnCoursAgent($userinfo['id']);?></p>
 <?php } ?>
</div>
<br/><br/><br/>
<?php include './includes/footer.php';?>
