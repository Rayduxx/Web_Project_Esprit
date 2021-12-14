<?php include './includes/profil_header.php';

if(isset($_POST['soumettreAvis'])){
  $rating = htmlspecialchars($_POST['rating']);
  $comment = htmlspecialchars($_POST['commentaire']);
  if(!empty($_POST['rating']) && !empty($_POST['commentaire'])){
    $selectionAvis = $bdd->prepare("SELECT * FROM avis WHERE id_user = ?");
    $selectionAvis->execute(array($userinfo['id']));
    $reqavis = $selectionAvis->rowCount();
    if($reqavis == 0){
      $insertAvis = $bdd->prepare("INSERT INTO avis(id_user, rate) VALUES(?, ?)");
      $insertAvis->execute(array($userinfo['id'], $rating));
      $selectionAvisID = $bdd->prepare("SELECT id FROM avis WHERE id_user = ?");
      $selectionAvisID->execute(array($userinfo['id']));
      $a = $selectionAvisID->fetch();
      $insertComment = $bdd->prepare("INSERT INTO commentaire(commentaire,id_avis) VALUES(?,?)");
      $insertComment->execute(array($comment,$a['id']));
      $success = "Avis Poster avec success";
    } else{
      $erreur = "Vous avez deja un Avis de poster sur le site";
    }
  } else {
    $erreur = "Il faut completer tout les champs";
  }
}

if(isset($_POST['deleteComment'])){
  $ratingId = htmlspecialchars($_POST['rateD']);
  $commentID = htmlspecialchars($_POST['commentD']);
  if(!empty($_POST['rateD']) && !empty($_POST['commentD'])){
    $suppressionAvis = $bdd->prepare("DELETE FROM avis WHERE id = ?");
    $suppressionAvis->execute(array($ratingId));
    $suppressionComment = $bdd->prepare("DELETE FROM commentaire WHERE id = ?");
    $suppressionComment->execute(array($commentID));
    $success = "Commentaire supprimer avec success";
  }

}

?>
<br/><br/>
<?php if(isset($erreur)) {
  echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu lors de votre la mise de votre avis :' .$erreur.'</div></div>';
}?>
<?php if(isset($success)) {
  echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
}?>

<?php
  $verif = $bdd->prepare("SELECT * FROM avis WHERE id_user = ?");
  $verif->execute(array($userinfo['id']));
  $reqAvis = $verif->rowCount();
  if($reqAvis == 0){
?>

    <div class="card align-self-center col-lg-6">
        <form method="post" class="form-row col-lg-offset-4">
          <input type="number" id="rating" name="rating" placeholder="5/5" class="form-control rounded" /><br/>
          <input type="text" id="commentaire" name="commentaire" placeholder="commentaire" class="form-control rounded align-self-center" /><br/>
          <button type="submit" name="soumettreAvis" class="btn btn-success align-self-center">Soumettre Avis</button>
        </form>
    </div>
<?php } else {
  $Opinion = $verif->fetch();
  $commentaireSelection = $bdd->prepare("SELECT * FROM commentaire WHERE id_avis = ?");
  $commentaireSelection->execute(array($Opinion['id']));
  $comment = $commentaireSelection->fetch();
  ?>
    <div class="card align-self-center col-lg-6">
          <input type="number" id="rating" name="rating" placeholder="<?php echo $Opinion['rate'];?>" class="form-control rounded disabled" disabled/><br/>
          <input type="text" id="commentaire" name="commentaire" placeholder="<?php echo $comment['commentaire'];?>" class="form-control rounded align-self-center disabled" disabled/><br/>
    <form method="post">
        <input type="text" name="rateD" id="rateD" value="<?php echo $Opinion['id'];?>" hidden />
        <input type="text" name="commentD" id="commentD" value="<?php echo $comment['id'];?>" hidden />
        <button type="submit" name="deleteComment" class="btn btn-danger">Supprimer Commentaire</button>
    </form>
    </div>
<?php } ?>
    </div>
<br/><br/><br/>
<?php include './includes/footer.php';?>
