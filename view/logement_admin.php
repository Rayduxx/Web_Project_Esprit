<?php include "./includes/profil_header.php";
if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}
if(isset($_POST['FormEdit'])){
  if(!empty($_POST['num']) && !empty($_POST['bloc']) && !empty($_POST['type']) && !empty($_POST['idLocataire']) && !empty($_POST['description']) && !empty($_POST['nbChambre']) && !empty($_POST['prix'])){
    $num = htmlspecialchars($_POST['num']);
    $bloc = htmlspecialchars($_POST['bloc']);
    $type = htmlspecialchars($_POST['type']);
    $idLocataire = htmlspecialchars($_POST['idLocataire']);
    $description = htmlspecialchars($_POST['description']);
    $nbChambre = htmlspecialchars($_POST['nbChambre']);
    $prixLoyer = htmlspecialchars($_POST['prix']);
    $dossierUpload = "./upload/";
    $nomFichier =  basename($_FILES['file']['name']);
    $CheminComplet = $dossierUpload . $nomFichier;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $CheminComplet)) {
      $update = $bdd->prepare("UPDATE logement SET numero = ?, bloc = ?, type = ?, nbChambre = ?, prixLoyer = ?, idLocataire = ?, description = ?, image = ? WHERE id = ?");
      $update->execute(array($num,$bloc,$type,$nbChambre,$prixLoyer,$idLocataire,$description,$nomFichier,$_GET['editid']));
      $success = "Modification effectué avec success";
      header("Location: ./logement_admin.php");
    } else{
      $update = $bdd->prepare("UPDATE logement SET numero = ?, bloc = ?, type = ?, nbChambre = ?, prixLoyer = ?, idLocataire = ?, description = ? WHERE id = ?");
      $update->execute(array($num,$bloc,$type,$nbChambre,$prixLoyer,$idLocataire,$description,$_GET['editid']));
      $success = "Modification effectué avec success";
      header("Location: ./logement_admin.php");
    }
  }
  else{
    $erreur = "Tout les champs ne sont pas complet";
  }
}

if(isset($_POST['delete'])){
  if(!empty($_POST['deleteID'])){
    $deleteID = htmlspecialchars($_POST['deleteID']);

    $delete = $bdd->prepare("DELETE FROM logement WHERE id = ?");
    $delete->execute(array($deleteID));
    $success = "Suppression effectué avec success";
    header("Location: ./logement_admin.php");
  } else {
    $erreur = "Il faut Mettre un logement";
  }
}

if(isset($_POST['ajouter'])){
  if(!empty($_POST['bloc']) && !empty($_POST['numero']) && !empty($_POST['type']) && !empty($_POST['nbChambre']) && !empty($_POST['prixLoyer']) && !empty($_POST['description'])){
    $bloc = htmlspecialchars($_POST['bloc']);
    $numero = htmlspecialchars($_POST['numero']);
    $type = htmlspecialchars($_POST['type']);
    $nbChambre = htmlspecialchars($_POST['nbChambre']);
    $prixLoyer = htmlspecialchars($_POST['prixLoyer']);
    $description = htmlspecialchars($_POST['description']);
    $dossierUpload = "./upload/";
    $nomFichier =  basename($_FILES['file']['name']);
    $CheminComplet = $dossierUpload . $nomFichier;
      if(move_uploaded_file($_FILES['file']['tmp_name'], $CheminComplet)) {
        $insert = $bdd->prepare("INSERT INTO logement(bloc,numero,type,nbChambre,image,description,	prixLoyer) VALUES(?,?,?,?,?,?,?)");
        $insert->execute(array($bloc,$numero,$type,$nbChambre,$nomFichier,$description,$prixLoyer));
        $success = "Ajout effectué avec success";
        header("Location: ./logement_admin.php");
      } else{
        $erreur = "Fichier non upload";
      }

  } else {
    $erreur = "Il faut completer tout les champs";
  }
}

?>
<br/><br/>
<div class="card row-md-6">
  <div class="card-header text-center">
    <h1>Gestion Logement</h1>
  </div>
  <div class="card-body">
    <?php if(isset($erreur)) {
      echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu :' .$erreur.'</div></div>';
    }?>
    <?php if(isset($success)) {
      echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
    }?>
    <div class="container col-lg-6 align-self-center mx-auto">
      <a class="btn btn-success" href="./logement_admin.php?ajouter=1"> Ajouter Logement </a>
      <a class="btn btn-danger" href="./logement_admin.php?supprimer=1"> supprimer Logement </a>
      <a class="btn btn-info disabled" href="#"> Gestion Entretient </a>
      <a class="btn btn-primary disabled" href="#"> Gestion Contrats </a>

    </div>
    <?php if(isset($_GET['supprimer'])){ ?>
      <div class="card col-lg-6 align-self-center mx-auto">
        <form method="post">
          <select id="deleteID" name="deleteID" class="form-select rounded">
            <?php
              $deletePrepare = $bdd->prepare("SELECT * FROM Logement ORDER BY id");
              $deletePrepare->execute();
              while($delete = $deletePrepare->fetch()){
             ?>
             <option value="<?php echo $delete['id']; ?>"><?php echo $delete['bloc']; echo " "; echo $delete['numero'];?></option>
           <?php } ?>
          </select>
          <button type="submit" name="delete" class="btn btn-danger">Confirmer Suppression</button>
          <a href="./logement_admin.php" class="btn btn-secondary" type="button">Annuler Suppression</a>
        </form>
      </div>
    <?php } ?>
    <?php if(isset($_GET['ajouter'])){ ?>
      <div class="card col-lg-6 align-self-center mx-auto">
        <form method="post" enctype="multipart/form-data">
          <input type="text" id="bloc" name="bloc" class="form-control rounded" placeholder="bloc" /><br/>
          <input type="number" id="numero" name="numero" class="form-control rounded" placeholder="numero" /><br/>
          <select id="type" name="type" class="form-select rounded">
            <option value="Maison">Maison</option>
            <option value="Appartement">Appartement</option>
          </select><br/>
          <input type="number" id="nbChambre" name="nbChambre" class="form-control rounded" placeholder="Nombre de Chambre" /><br/>
          <input type="number" id="prixLoyer" name="prixLoyer" class="form-control rounded" placeholder="Prix Loyer en TND" /><br/>
          <input type="text" id="description" name="description" class="form-control rounded" placeholder="description" /><br/>
          <label for="file">Image </label>
          <input type="file" id="file" name="file" class="form-control rounded" /><br/>
          <button type="submit" name="ajouter" class="btn btn-success">Ajouter Appartement</button>
          <a href="./logement_admin.php" class="btn btn-secondary" type="button">Annuler Ajout</a>
          <button type="reset" class="btn btn-danger">Renitialiser les champs</button>
        </form>
      </div>
    <?php  } ?>
    <table class="table">
      <thead>
        <tr>
          <th scope="col"># Logement</th>
          <th scope="col">Bloc</th>
          <th scope="col">Type</th>
          <th scope="col">Locataire</th>
          <th scope="col">Description</th>
          <th scope="col">Taille</th>
          <th scope="col">Prix</th>
          <th scope="col"> Modifier Image </th>
          <th scope="col">Modifier</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $selectionLogement = $bdd->prepare("SELECT * FROM Logement ORDER BY id");
          $selectionLogement->execute();
          while($logement = $selectionLogement->fetch()){
            $selectionU = $bdd->prepare("SELECT nom,prenom FROM users WHERE id = ?");
            $selectionU->execute(array($logement['idLocataire']));
            $u = $selectionU->fetch();

        ?>
        <tr>
          <td><?php echo $logement['numero'];?></td>
          <td><?php echo $logement['bloc'];?></td>
          <td><?php echo $logement['type'];?></td>
          <td><?php if($logement['idLocataire'] != NULL){ echo $u['nom']; echo " "; echo $u['prenom'];} else {echo "aucun Locataire";} ?></td>
          <td><?php echo $logement['description'];?></td>
          <td>S+<?php echo $logement['nbChambre'];?></td>
          <td><?php echo $logement['prixLoyer'];?></td>
          <td class="text-center">-</td>
          <td><a href="./logement_admin.php?editMode=1&editid=<?php echo $logement['id'];?>" class="btn btn-warning" type="button">Modifier</a></td>
        </tr>
          <?php if(isset($_GET['editMode']) && !empty($_GET['editMode']) && isset($_GET['editid']) && !empty($_GET['editid'])){
              if($_GET['editid'] == $logement['id']){

            ?>
        <tr>
          <form method="post" enctype="multipart/form-data">
            <td><input type="number" class="form-control rounded" id="num" name="num" value="<?php echo $logement['numero'];?>"/></td>
            <td><input type="text" class="form-control rounded" id="bloc" name="bloc" value="<?php echo $logement['bloc'];?>"/></td>
            <td>
              <select id="type" class="form-select rounded" name="type">
                <option value="Maison" <?php if($logement['type'] == "Maison"){?> selected<?php } ?>>Maison</option>
                <option value="Appartement"<?php if($logement['type'] == "Appartement"){?> selected<?php } ?>>Appartement</option>
              </select>
            </td>
            <td>
              <select id="idLocataire" class="form-select rounded" name="idLocataire">
                <option value="">Aucun Locataire</option>
                <?php
                  $selectUM = $bdd->prepare("SELECT * FROM users ORDER BY id");
                  $selectUM->execute();
                  while($UM = $selectUM->fetch()){
                ?>
                <option value="<?php echo $UM['id'] ?>"><?php echo $UM['nom']; echo " "; echo $UM['prenom'];?></option>
              <?php } ?>
              </select>
            </td>
            <td><input type="text" class="form-control rounded" id="description" name="description" value="<?php echo $logement['description'];?>"/></td>
            <td>S+<input type="number" class="form-control rounded" id="nbChambre" name="nbChambre" value="<?php echo $logement['nbChambre'];?>"/></td>
            <td><input type="number" class="form-control rounded" id="prix" name="prix" value="<?php echo $logement['prixLoyer'];?>" /></td>
            <td><input type="file" class="form-control rounded" id="file" name="file" class="form-control rounded" /></td>
            <td><button type="submit" name="FormEdit" class="btn btn-success">Valider Modification</button></td>
          </form>
        </tr>
      <?php }}} ?>
      </tbody>
    </table>
  </div>
</div>
</div><br/><br/><br/>
<?php include "./includes/footer.php"; ?>
