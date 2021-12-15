<?php
$page_titre = "Event";
include './includes/header.php';
$selection = $bdd->prepare("SELECT * FROM event WHERE id = ?");
$selection->execute(array($_GET['idEvent']));
$evenenement = $selection->fetch();

if(isset($_POST['inscriptionEvent'])){
  if(!empty($_POST['idUser']) && !empty($_POST['idEvent'])){
    $idUser = htmlspecialchars($_POST['idUser']);
    $idEvent = htmlspecialchars($_POST['idEvent']);
    $insert = $bdd->prepare("INSERT INTO participants(eventId,userId) VALUES(?,?)");
    $insert->execute(array($idEvent,$idUser));
    $success = "Inscription Effectuer Avec success";
  }
}

?>
<br/><br/><br/>
<?php if(isset($success)) {
  echo '<div class="col-lg-12 text-center container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
}?>
<div class="card col-lg-10 align-self-center mx-auto">
  <img class="card-img-top" src="./upload/<?php echo $evenenement['image'];?>" width="200" height="300">
  <div class="card-body">
    <h2 class="card-title text-center"><?php echo $evenenement['name']; ?></h2>
    <pre class="text-center"><?php echo $evenenement['description_longue'];?></pre><br/>
    <?php
    if(!isset($userinfo['id'])){ ?>
      <div class="container-fluid align-self-center col-lg-2 mx-auto">
        <a class="btn btn-success" href="./register.php">Inscription au site</a>
      </div>
  <?php  } else {
      $selectionUser = $bdd->prepare("SELECT * FROM participants WHERE eventId = ? AND userId = ?");
      $selectionUser->execute(array($_GET['idEvent'],$userinfo['id']));
      $calc = $selectionUser->rowCount();
      if($calc == 0){
    ?>
    <div class="container-fluid align-self-center col-lg-2 mx-auto">
      <form method="post">
        <input type="text" value="<?php echo $userinfo['id']; ?>" name="idUser" id="idUser" hidden/>
        <input type="text" value="<?php echo $evenenement['id']; ?>" name="idEvent" id="idUser" hidden/>
        <button type="submit" name="inscriptionEvent" class="btn btn-success">Inscription a l'evennement</button>
      </form>
      </div>
    <?php } else {?>
      <div class="container-fluid align-self-center col-lg-2 mx-auto">
        <a class="btn btn-success disabled" href="#">Inscription a l'evennement</a>
      </div>
    <?php }} ?>
  </div>
</div>



<?php include './includes/footer.php';?>
