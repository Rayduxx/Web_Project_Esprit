<?php
$page_titre = "ban";
include './includes/ban_header.php';
if(isset($userinfo['email'])){
$requser = $bdd->prepare('SELECT * FROM ban WHERE userId = ?');
$requser->execute(array($userinfo['id']));
$userexist = $requser->rowCount();
if($userexist == 0) {
  header('Location: ./profil.php');
} else {
  $banInfo = $requser->fetch();
?>
<br/><br/><br/>
<div class="container text-center">
  <div class="alert alert-danger">
    <h2> Votre compte a ete bloquer de facon Permanente </h2>
    <p>Pour le motif : <?php echo $banInfo['motif'];?></p>
  </div>
</div>
<br/><br/><br/>
<?php }
} else{
  header("Location: ./index.php");
} include './includes/footer.php'; ?>
