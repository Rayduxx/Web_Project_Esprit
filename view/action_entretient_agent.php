<?php include "./includes/profil_header.php";

if($userinfo['typeCompte'] != 1){
  header("Location: ./profil.php");
}
$SelectionMission = $bdd->prepare("SELECT * FROM entretient WHERE id = ?");
$SelectionMission->execute(array($_GET['Ordre']));
$res = $SelectionMission->rowCount();
if ($res == 0){
  header("Location: ./gestion_entretient_agent.php");
}
$Mission = $SelectionMission->fetch();
if($userinfo['id'] != $Mission['idAgentEntretient']){
  header('Location: ./gestion_entretient_agent.php');
}

if($Mission['status'] == 2){
  header('Location: ./gestion_entretient_agent.php');
}
if(isset($_POST['fin'])){
  $update = $bdd->prepare('UPDATE Entretient SET status = 2 WHERE id = ?');
  $update->execute(array($_GET['Ordre']));
  header('Location: ./gestion_entretient_agent.php');
}
if(isset($_POST['formAction'])){
  $prix = htmlspecialchars($_POST['prix']);
  $date = date('Y-m-d H:i:s',strtotime($_POST['date']));
  $maj = $bdd->prepare('UPDATE Entretient SET prix = ?,TimeDateEntretient = ? WHERE id = ?');
  $maj->execute(array($prix,$date,$_GET['Ordre']));
  header('Refresh:0');
}
?>
<div class="col-md-12">
    <div class="card p-3 text-center px-4">
        <div class="user-content">
            <h5 class="mb-0">Facture <br/> Numero : <?php echo $Mission['id'];?></h5><br/>
            <p><?php echo "Prix :"; echo " ";echo $Mission['prix']; echo "TND";?>
            <form method="post">
            <a type="button" class="btn btn-primary" href="./gestion_logement_user.php">Retour au Menu Gestion Entretient</a>
            <button type="submit" class="btn btn-success" name="fin">Entretient Terminer</button>
          </form>
        </div>
    </div>
</div>
<div class="col-md-6 container">
  <form method="post">
    <input type="text" id="prix" class="form-control rounded" name="prix"  value="<?php echo $Mission['prix']; ?>" required/><br/><br/>
    <input type="datetime-local" id="date" class="form-control rounded" name="date"  value="<?php echo date('Y-m-d\TH:i:s', strtotime($Mission['TimeDateEntretient'])); ?>" required/><br/><br/>
    <button type="submit" class="btn btn-success" name="formAction">Validez Modification </button>
  </form>
</div>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php"; ?>
