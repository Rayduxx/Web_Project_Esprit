<?php
$page_titre = "Blockage User";
include "./includes/header.php";

if(!isset($userinfo['id']))
{
  header("Location: ./login.php");
}
if($userinfo['isAdmin'] == 0){
  header("Location: ./index.php");
}

$selectionUser = $bdd->prepare("SELECT * FROM users");
$selectionUser->execute();

if(isset($_POST['bloquage'])){
  if(!empty($_POST['motif']) && !empty($_POST['uid'])){
    $motif = htmlspecialchars($_POST['motif']);
    $uid = htmlspecialchars($_POST['uid']);
    $query = $bdd->prepare("INSERT INTO ban(userId,motif) VALUES (?,?)");
    $query->execute(array($uid,$motif));
  }
}
if(isset($_POST['debloquage'])){
  if(!empty($_POST['uid'])){
    $uid = htmlspecialchars($_POST['uid']);
    $query = $bdd->prepare("DELETE FROM ban WHERE userId = ?");
    $query->execute(array($uid));
  }
}
?>
<?php

if(isset($_GET['success'])){
  if($_GET['success'] == 0){

  } elseif($_GET['success'] == 1){
  }
}

?>
<div class="card">
  <div class="card-header">
    <h2> Blockage User </h2>
  </div>
  <div class="card-body text-center">
    <ul class="list-group">
      <?php while($userB = $selectionUser->fetch()){ ?>
      <li class="list-group-item padding">
        <p><?php echo $userB['email']?><br/><?php echo $userB['nom']; echo " "; echo $userB['prenom']; ?>
          <?php $selectionBan = $bdd->prepare("SELECT * FROM ban WHERE userid = ?");
          $selectionBan->execute(array($userB['id']));
          $numberBan = $selectionBan->rowCount();
          if($numberBan == 0){ ?>
              <form method="post">
                <input type="text" placeholder="Motif" name="motif" id="motif" />
                <input type="text" name="uid" value="<?php echo $userB['id'];?>" id="uid" hidden />
                <button class="btn btn-danger" name="bloquage" type="submit"> Bloquer </button>
              </form>
          <?php } else {
            $ban = $selectionBan->fetch()?>
            <br/>
            <?php echo $ban['motif'];?>
            <form method="post">
              <input type="text" name="uid" value="<?php echo $userB['id'];?>" id="uid" hidden />
              <button class="btn btn-success" name="debloquage" type="submit"> debloquer </button>
            </form>
          <?php } ?>
         </p>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>

<?php include "./includes/footer.php"; ?>
