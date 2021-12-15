<?php include "./includes/profil_header.php";

if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}
if(isset($_POST['ajouterParticipant'])){
  if(!empty($_POST['eventIdAjout']) && !empty($_POST['UserIdAjout']) && !empty($_POST['dateAjout'])){
    $eventIdAjout = htmlspecialchars($_POST['eventIdAjout']);
    $UserIdAjout = htmlspecialchars($_POST['UserIdAjout']);
    $dateAjout = date('Y-m-d H:i:s',strtotime($_POST['dateAjout']));
    $insert = $bdd->prepare("INSERT INTO participants(eventId,userId,dateInscription) VALUES (?,?,?)");
    $insert->execute(array($eventIdAjout,$UserIdAjout,$dateAjout));
    header("Location: ./admin_participants.php");
  } else {
    $erreur = "Il faut completer tout les champs";
  }
}
if(isset($_POST['deleteParticipant'])){
  if(!empty($_POST['idDelete'])){
    $idDelete = htmlspecialchars($_POST['idDelete']);
    $delete = $bdd->prepare("DELETE FROM participants WHERE id = ?");
    $delete->execute(array($idDelete));
    $success = "Suppression Effectuer avec success";
  }
}

if(isset($_POST['modifierParticipant'])){
    if(!empty($_POST['evendIdEdit']) && !empty($_POST['UserIdEdit']) && !empty($_POST['dateEdit'])){
      $eventIdEdit = htmlspecialchars($_POST['evendIdEdit']);
      $UserIdEdit = htmlspecialchars($_POST['UserIdEdit']);
      $dateEdit = date('Y-m-d H:i:s',strtotime($_POST['dateEdit']));

      $update = $bdd->prepare("UPDATE participants SET eventId = ? userId = ?, dateInscription = ? WHERE id = ?");
      $update->execute(array($eventIdEdit,$UserIdEdit,$dateEdit,$_GET['editId']));
      $success = "Modification effectué avec success";
    } else {
      $erreur = "il faut completer tout les champs";
    }
}
?>
  <br/><br/>
  <div class="card row-md-6">
    <div class="card-header text-center">
      <h1> Gestion Participants</h1>
    </div>
    <div class="card-body">
      <?php if(isset($erreur)) {
        echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu :' .$erreur.'</div></div>';
      }?>
      <?php if(isset($success)) {
        echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
      }?>
      <div class="container-fluid align-self-center col-lg-6 mx-auto">
        <a href="./admin_participants.php?ajouter=1" class="btn btn-success" type="button">Ajouter un participant</a>
        <a href="./admin_events.php" class="btn btn-info" type="button">Gestion Events</a>
      </div>
      <?php
        if(isset($_GET['ajouter'])){

            ?>

            <div class="card align-self-center mx-auto col-lg-6">
              <form method="post">
                <select class="form-select rounded" id="eventIdAjout" name="eventIdAjout">
                  <?php
                    $selectionEventsAjout = $bdd->prepare("SELECT id,name FROM event");
                    $selectionEventsAjout->execute();
                    while($eventAjout = $selectionEventsAjout->fetch()){
                   ?>
                  <option value="<?php echo $eventAjout['id'];?>"><?php echo $eventAjout['name'];?></option>
                  <?php } ?>
                </select><br/>
                <select id="UserIdAjout" name="UserIdAjout" class="form-select rounded">
                  <?php
                    $selectionUserAjout = $bdd->prepare("SELECT id,nom,prenom FROM users");
                    $selectionUserAjout->execute();
                    while($UserAjout = $selectionUserAjout->fetch()){
                  ?>
                  <option value="<?php echo $UserAjout['id'];?>"><?php echo $UserAjout['nom']; echo " "; echo $UserAjout['prenom'];?></option>
                <?php } ?>
              </select><br/>
              <input type="datetime-local" value="<?php echo date('Y-m-d\TH:i:s', time()); ?>" id="dateAjout" name="dateAjout" class="form-control rounded"/><br/>
                <button type="submit" name="ajouterParticipant" class="btn btn-success">Valider Ajout</button>
                <button type="reset" class="btn btn-danger">Vider Champs </button>
                <a type="button" class="btn btn-secondary" href="./admin_participants.php">Annulez Ajout</a>
              </form>
            </div>
      <?php    }

      ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col"># Inscription</th>
            <th scope="col">Event </th>
            <th scope="col">Nom Prenom</th>
            <th scope="col">Date Inscription</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $SelectUsers = $bdd->prepare("SELECT * FROM participants");
            $SelectUsers->execute();
            while($participant = $SelectUsers->fetch()){
           ?>
           <tr>
             <td><?php echo $participant['id']; ?></td>
             <td><?php
             $selectionEvent = $bdd->prepare("SELECT name FROM event WHERE id = ?");
             $selectionEvent->execute(array($participant['eventId']));
             $Event = $selectionEvent->fetch();
             echo $Event['name'];
             ?></td>
             <td>
               <?php
               $selectionUserAffichage = $bdd->prepare("SELECT nom,prenom FROM users WHERE id = ?");
               $selectionUserAffichage->execute(array($participant['userId']));
               $UserAffichage = $selectionUserAffichage->fetch();
               echo $UserAffichage['nom']; echo " "; echo $UserAffichage['prenom'];
                ?>
             </td>
             <td><?php echo date('d/m/Y - H:i:s', strtotime($participant['dateInscription']));?></td>
             <td><a class="btn btn-warning" href="./admin_participants.php?editId=<?php echo $participant['id'];?>" />Modifier</a></td>
             <td>
               <form method="post">
                 <input type="number" id="idDelete" name="idDelete" value="<?php echo $participant['id'];?>" hidden/>
                 <button type="submit" name="deleteParticipant" class="btn btn-danger">Supprimer Participant</button>
               </form>
             </td>
           </tr>
           <?php
           if(isset($_GET['editId'])){
             if(!empty($_GET['editId']) && $_GET['editId'] == $participant['id']){ ?>
               <tr>
                <form method="post">
                 <td><?php echo $participant['id'];?></td>
                 <td>
                   <select class="form-select rounded" id="evendIdEdit" name="eventIdEdit">
                     <?php
                       $selectionEventsEdit = $bdd->prepare("SELECT id,name FROM event");
                       $selectionEventsEdit->execute();
                       while($eventEdit = $selectionEventsEdit->fetch()){
                      ?>
                     <option value="<?php echo $eventEdit['id'];?>" <?php if($eventEdit['id'] == $participant['eventId']){ ?> selected <?php } ?>><?php echo $eventEdit['name'];?></option>
                     <?php } ?>
                   </select>
                 </td>
                 <td>
                   <select id="UserIdEdit" name="UserIdEdit" class="form-select rounded">
                     <?php
                       $selectionUserEdit = $bdd->prepare("SELECT id,nom,prenom FROM users");
                       $selectionUserEdit->execute();
                       while($UserEdit = $selectionUserEdit->fetch()){
                     ?>
                     <option value="<?php echo $UserEdit['id'];?>" <?php if($UserEdit['id'] == $participant['userId']){?> selected <?php }?> ><?php echo $UserEdit['nom']; echo " "; echo $UserEdit['prenom'];?></option>
                   <?php } ?>
                 </select>
                 </td>
                 <td><input type="datetime-local" name="dateEdit" class="form-control rounded" id="dateEdit" value="<?php echo date('Y-m-d\TH:i:s', strtotime($participant['dateInscription']))?>" /></td>
                 <td><button type="submit" name="modifierParticipant" class="btn btn-success">Valider Modification</button></td>
                 <td><a class="btn btn-danger disabled" href="#">Supprimer Participant</a></td>
               </form>
               </tr>
          <?php }} ?>
         <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <br/>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php";?>
