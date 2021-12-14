<?php include "./includes/profil_header.php";
if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}
?>
<br/><br/>
<div class="card row-md-6">
  <div class="card-header text-center">
    <h1>Gestion Logement</h1>
  </div>
  <div class="card-body">
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
          <td><a href="./logement_admin.php?editMode=1&editid=<?php echo $logement['id'];?>" class="btn btn-warning" type="button">Modifier</a></td>
        </tr>
          <?php if(isset($_GET['editMode']) && !empty($_GET['editMode']) && isset($_GET['editid']) && !empty($_GET['editid'])){
              if($_GET['editid'] == $logement['id']){
                if(isset($_POST['FormEdit'])){
                  if(!empty($_POST['num']) && !empty($_POST['bloc']) && !empty($_POST['type']) && !empty($_POST['idLocataire']) && !empty($_POST['description']) && !empty($_POST['nbChambre']) && !empty($_POST['prixLoyer']) ){
                  }
                }
            ?>
        <tr>
          <form method="post">
            <td><input type="number" id="num" name="num" value="<?php echo $logement['numero'];?>"/></td>
            <td><input type="text" id="bloc" name="bloc" value="<?php echo $logement['bloc'];?>"/></td>
            <td>
              <select id="type" name="type">
                <option value="Maison" <?php if($logement['type'] == "Maison"){?> selected<?php } ?>>Maison</option>
                <option value="Appartement"<?php if($logement['type'] == "Appartement"){?> selected<?php } ?>>Appartement</option>
              </select>
            </td>
            <td>
              <select id="idLocataire" name="idLocataire">
                <?php
                  $selectUM = $bdd->prepare("SELECT * FROM users ORDER BY id");
                  $selectUM->execute();
                  while($UM = $selectUM->fetch()){
                ?>
                <option value="<?php echo $UM['id'] ?>"><?php echo $UM['nom']; echo " "; echo $UM['prenom'];?></option>
              <?php } ?>
              </select>
            </td>
            <td><input type="text" id="description" name="description" value="<?php echo $logement['description'];?>"/></td>
            <td>S+<input type="number" id="nbChambre" name="nbChambre" value="<?php echo $logement['nbChambre'];?>"/></td>
            <td><input type="number" id="prix" name="prix" value="<?php echo $logement['prixLoyer'];?>" /></td>
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
