<?php include "./includes/profil_header.php";
if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}

if(isset($_POST['deletingForm'])){
  $commentID = htmlspecialchars($_POST['deletecomment']);
  $ratingID = htmlspecialchars($_POST['deleteavis']);
  if(!empty($_POST['deletecomment']) && !empty($_POST['deleteavis'])){
    $suppressionAvis = $bdd->prepare("DELETE FROM avis WHERE id = ?");
    $suppressionAvis->execute(array($ratingID));
    $suppressionComment = $bdd->prepare("DELETE FROM commentaire WHERE id = ?");
    $suppressionComment->execute(array($commentID));
    $success = "Avis supprimer avec success";
    header("Location: ./admin_avis.php");
  }
}
if(isset($_POST['FormEdit'])){
  $ratingEdit = htmlspecialchars($_POST['ratingEdit']);
  $comentEdit = htmlspecialchars($_POST['comentEdit']);
  $userIDEdit = htmlspecialchars($_POST['UserEdit']);
  $dateEdit = date('Y-m-d H:i:s',strtotime($_POST['dateEdit']));
  if(!empty($_POST['ratingEdit']) && !empty($_POST['comentEdit']) && !empty($_POST['UserEdit']) && !empty($_POST['dateEdit'])){
    $updateAvis = $bdd->prepare("UPDATE avis SET id_user = ?, rate = ?, date_avis = ? WHERE id = ?");
    $updateAvis->execute(array($userIDEdit, $ratingEdit, $dateEdit, $_GET['editid']));
    $updateComment = $bdd->prepare("UPDATE commentaire SET commentaire = ? WHERE id_avis = ?");
    $updateComment->execute(array($comentEdit, $_GET['editid']));
    $success = "Modification Effectuer avec success";
    header("Location: ./admin_avis.php");
  } else {
    $erreur = "Il faut completer tout les champs !";
  }

}
?>
<br/><br/>
<?php if(isset($erreur)) {
  echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu :' .$erreur.'</div></div>';
}?>
<?php if(isset($success)) {
  echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
}?>
    <div class="card col-lg-10 align-self-center">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id avis</th>
            <th scope="col">id commentaire</th>
            <th scope="col">Rating</th>
            <th scope="col">Commentaire</th>
            <th scope="col">Nom Prenom</th>
            <th scope="col">Date</th>
            <th scope="col">Supprimmer</th>
            <th scope="col">Modifier</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $avisFetch = $bdd->prepare("SELECT * FROM avis");
            $avisFetch->execute();
            while($avis = $avisFetch->fetch()){
              $commentFetch = $bdd->prepare("SELECT * FROM commentaire WHERE id_avis = ?");
              $commentFetch->execute(array($avis['id']));
              $coment = $commentFetch->fetch();
              $userFetch = $bdd->prepare("SELECT * FROM users WHERE id = ?");
              $userFetch->execute(array($avis['id_user']));
              $user = $userFetch->fetch();
           ?>
          <tr>
            <td><?php echo $avis['id']; ?></td>
            <td><?php echo $coment['id']; ?></td>
            <td><?php echo $avis['rate']; ?></td>
            <td><?php echo $coment['commentaire']; ?></td>
            <td><?php echo $user['nom']; echo " "; echo $user['prenom'];?></td>
            <td><?php echo date('d/m/Y H:i:s', strtotime($avis['date_avis']));?></td>
            <td>
              <form method="post">
                <input type="text" name="deleteavis" id="deleteavis" value="<?php echo $avis['id']; ?>" hidden />
                <input type="text" name="deletecomment" id="deletecomment" value="<?php echo $coment['id']; ?>" hidden />
                <button type="submit" name="deletingForm" class="btn btn-danger">Supprimer</button>
            </td>
            <td><a class="btn btn-warning" type="button" href="./admin_avis.php?editid=<?php echo $avis['id'];?>">Modifier</a></td>
          </tr>
          <?php
          if(isset($_GET['editid'])){
            if($_GET['editid'] == $avis['id']){ ?>
              <tr>
                <td><?php echo $avis['id']; ?></td>
                <td><?php echo $coment['id']; ?></td>
                <td><input type="number" value="<?php echo $avis['rate']; ?>" name="ratingEdit" id="ratingEdit" /></td>
                <td><input type="text" value="<?php echo $coment['commentaire'];?>" name="comentEdit" id="comentEdit"/></td>
                <td>
                  <select id="userEdit" name="UserEdit">
                    <?php
                      $userFetchEdit = $bdd->prepare("SELECT id,nom,prenom FROM users");
                      $userFetchEdit->execute();
                      while($userEdit = $userFetchEdit->fetch()){
                     ?>
                    <option value="<?php echo $userEdit['id']; ?>" <?php if($userEdit['id'] == $user['id']){ ?> selected <?php }?>> <?php echo $userEdit['nom']; echo " "; echo $userEdit['prenom'];?> </option>
                  <?php } ?>
                  </select>
                </td>
                <td><input type="datetime-local" id="dateEdit" name="dateEdit"  value="<?php echo date('Y-m-d\TH:i:s', strtotime($avis['date_avis'])); ?>"/></td>
                <td><a class="btn btn-danger disabled" href="#" type="button">Supprimer</a></td>
                <td><button type="submit" name="FormEdit" class="btn btn-success">Valider Modifications</a></td>
              </tr>
          <?php  }
          } ?>
        <?php } ?>
        </tbody>
      </table>

    </div>
</div><br/><br/><br/>
<?php include "./includes/footer.php"; ?>
