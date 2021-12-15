<?php include "./includes/profil_header.php";

if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}
if(isset($_POST['FormDelete'])){
  if(!empty($_POST['eventIdDelete'])){
    $eventIdDelete = $_POST['eventIdDelete'];
    $delete = $bdd->prepare("DELETE FROM event WHERE id = ?");
    $delete->execute(array($eventIdDelete));
  }
}

if(isset($_POST['formEdit'])){
  if(!empty($_POST['maxParticipantModifier']) && !empty($_POST['DescriptionCourteModifier']) && !empty($_POST['DescriptionLongueModifier']) && !empty($_POST['date']) && !empty($_POST['nomEdit'])){
    $nomEdit = htmlspecialchars($_POST['nomEdit']);
    $maxParticipantModifier = htmlspecialchars($_POST['maxParticipantModifier']);
    $DescriptionCourteModifier = htmlspecialchars($_POST['DescriptionCourteModifier']);
    $DescriptionLongueModifier = htmlspecialchars($_POST['DescriptionLongueModifier']);
    $date = date('Y-m-d H:i:s',strtotime($_POST['date']));
    if(is_numeric($maxParticipantModifier)){
      $dossierUpload = "./upload/";
      $nomFichier =  basename($_FILES['file']['name']);
      $CheminComplet = $dossierUpload . $nomFichier;
      if(move_uploaded_file($_FILES['file']['tmp_name'], $CheminComplet)) {
        $update = $bdd->prepare("UPDATE event SET name = ?, datetime = ?, maxParticipant = ?, image = ?, description = ?, description_longue = ? WHERE id = ?");
        $update->execute(array($nomEdit,$date,$maxParticipantModifier,$nomFichier,$DescriptionCourteModifier,$DescriptionLongueModifier,$_GET['modifierId']));
        $success = "Modification effectué avec success";
        header("Location: ./admin_events.php");
      } else{
        $update = $bdd->prepare("UPDATE event SET name = ?, datetime = ?, maxParticipant = ?, description = ?, description_longue = ? WHERE id = ?");
        $update->execute(array($nomEdit,$date,$maxParticipantModifier,$DescriptionCourteModifier,$DescriptionLongueModifier,$_GET['modifierId']));
        $success = "Modification effectué avec success";
        header("Location: ./admin_events.php");
      }
    } else {
      $erreur = "Il faut mettre des chiffres dans le champs Max Participants";
    }
  } else {
    $erreur = "Veuillez Remplir tout les champs";
  }
}


?>
  <br/><br/>
  <div class="card row-md-6">
    <div class="card-header text-center">
      <h1> Gestion Evenements</h1>
    </div>
    <div class="card-body">
      <?php if(isset($erreur)) {
        echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu :' .$erreur.'</div></div>';
      }?>
      <?php if(isset($success)) {
        echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
      }?>
      <div class="container-fluid align-self-center col-lg-6 mx-auto">
        <a href="./admin_events.php?ajouter=1" class="btn btn-success" type="button">Ajouter un evennement</a>
        <a href="./admin_participants.php" class="btn btn-info" type="button">Gestion Participants</a>
      </div>
      <?php
        if(isset($_GET['ajouter'])){
          if(!empty($_GET['ajouter'])){
            if(isset($_POST['ajouterEvent'])){
              if(!empty($_POST['nom']) && !empty($_POST['maxParticipant']) && !empty($_POST['descriptionCourte']) && !empty($_POST['descriptionLongue']) && !empty($_POST['date'])){
                $nom = htmlspecialchars($_POST['nom']);
                $maxParticipant = htmlspecialchars($_POST['maxParticipant']);
                $descriptionCourte = htmlspecialchars($_POST['descriptionCourte']);
                $descriptionLongue = htmlspecialchars($_POST['descriptionLongue']);
                $date = date('Y-m-d H:i:s',strtotime($_POST['date']));
                if(is_numeric($maxParticipant)){
                $dossierUpload = "./upload/";
                $nomFichier =  basename($_FILES['file']['name']);
                $CheminComplet = $dossierUpload . $nomFichier;
                  if(move_uploaded_file($_FILES['file']['tmp_name'], $CheminComplet)) {
                    $insert = $bdd->prepare("INSERT INTO event(name,datetime,maxParticipant,participant,image,description,description_longue) VALUES(?,?,?,0,?,?,?)");
                    $insert->execute(array($nom,$date,$maxParticipant,$nomFichier,$descriptionCourte,$descriptionLongue));
                    $success = "Ajout effectué avec success";
                    header("Location: ./admin_events.php");
                  } else{
                    $erreur = "Fichier non upload";
                  }
                } else{
                  $erreur = "Le nombre de participant doit etre numerique";
                }
              } else{
                $erreur = "Tout les champs doivent etre complet !";
              }
            }
            ?>

            <div class="card align-self-center mx-auto col-lg-6">
              <form method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Nom" id="nom" name="nom" class="form-control rounded" /><br/>
                <input type="number" placeholder="Nombre de Participant" class="form-control rounded" id="maxParticipant" name="maxParticipant" /><br/>
                <input type="text" placeholder="description courte" class="form-control rounded" id="descriptionCourte" name="descriptionCourte" /><br/>
                <input type="text" placeholder="description longue" class="form-control rounded" id="descriptionLongue" name="descriptionLongue" /><br/>
                <input type="datetime-local" class="form-control rounded" id="date" name="date" value="<?php echo date('Y-m-d\TH:i:s', time()); ?>" /><br/>
                <label for="file">Image Principale </label><br/>
                <input type="file" id="file" name="file" class="form-control rounded" /><br/>
                <button type="submit" name="ajouterEvent" class="btn btn-success">Valider Ajout</button>
                <button type="reset" class="btn btn-danger">Vider Champs </button>
                <a type="button" class="btn btn-secondary" href="./admin_events.php">Annulez Ajout</a>
              </form>
            </div>
      <?php    }
        }
      ?>
      <table class="table">
        <thead>
          <tr>
            <th scope="col"># event</th>
            <th scope="col">Nom </th>
            <th scope="col">Participants</th>
            <th scope="col">Max Participant</th>
            <th scope="col">description</th>
            <th scope="col">description Longue</th>
            <th scope="col">Modifier Image </th>
            <th scope="col">Date</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>

          </tr>
        </thead>
        <tbody>
          <?php
            $evenement = $bdd->prepare("SELECT * FROM event");
            $evenement->execute();
            while($event = $evenement->fetch()){

          ?>
          <tr>
            <td><?php echo $event['id'];?></td>
            <td><?php echo $event['name'];?></td>
            <td><?php
              $particpants = $bdd->prepare("SELECT * FROM participants WHERE eventId = ?");
              $particpants->execute(array($event['id']));
              echo $particpants->rowCount();
            ?></td>
            <td><?php echo $event['maxParticipant'];?></td>
            <td><?php echo $event['description'];?></td>
            <td><?php echo $event['description_longue'];?></td>
            <td class="text-center"> - </td>
            <td><?php echo date('d/m/Y - H:i:s', strtotime($event['datetime']));?></td>
            <td> <a class="btn btn-warning" href="./admin_events.php?modifierId=<?php echo $event['id'];?>" type="button">Modifier</a></td>
            <td>
              <form method="post">
                <input type="text" value="<?php echo $event['id']?>" name="eventIdDelete" id="eventIdDelete" hidden />
                <button type="submit" name="FormDelete" class="btn btn-danger">Supprimer</button>
              </form>
            </td>
          </tr>
          <?php if(isset($_GET['modifierId'])){
            if($_GET['modifierId'] == $event['id']){ ?>
              <tr>
                <form method="post" enctype="multipart/form-data">
                <td> <?php echo $event['id'];?> </td>
                <td><input type="text" class="form-control rounded" value="<?php echo $event['name'];?>" name="nomEdit" id="nomEdit" /></td>
                <td> <?php
                  $particpants = $bdd->prepare("SELECT * FROM participants WHERE eventId = ?");
                  $particpants->execute(array($event['id']));
                  echo $particpants->rowCount();
                ?> </td>
                <td><input type="number" value="<?php echo $event['maxParticipant'];?>" class="form-control rounded" name="maxParticipantModifier" id="maxParticipantModifier" /> </td>
                <td><input type="text" value="<?php echo $event['description'];?>" class="form-control rounded" name="DescriptionCourteModifier" id="DescriptionCourteModifier" /> </td>
                <td><textarea id="descriptionLongueModifier" name="DescriptionLongueModifier" class="form-control rounded"><?php echo $event['description_longue'];?></textarea> </td>
                <td><input type="file" id="file" name="file" class="form-control rounded" /> </td>
                <td><input type="datetime-local" name="date" class="form-control rounded" id="date" value="<?php echo date('Y-m-d\TH:i:s', strtotime($event['datetime']))?>" /></td>
                <td><button type="submit" name="formEdit" class="btn btn-success">Valider Modifications</button></td>
                <td><a class="btn btn-danger disabled" href="#" disabled>Supprimer</a></td>
                </form>
              </tr>


          <?php  }
          } ?>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <br/>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php";?>
