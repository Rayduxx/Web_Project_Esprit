<?php include "./includes/profil_header.php";

if(isset($_GET['idLocation'])){
  $contrat = $bdd->prepare("SELECT * FROM location WHERE id = ?");
  $contrat->execute(array($_GET['idLocation']));
  $contratLocation = $contrat->fetch();
  $getLogement = $bdd->prepare("SELECT * FROM logement WHERE id = ?");
  $getLogement->execute(array($contratLocation['idLogement']));
  $Logement = $getLogement->fetch();
?>
<div class="col-md-12">
    <div class="card p-3 text-center px-4">
        <div class="user-content">
            <h5 class="mb-0">Action du Logement <br/> Numero : <?php echo $Logement['numero'];?> Bloc : <?php echo $Logement['bloc'];?> Prix : <?php echo $contratLocation['prix'];?> TND</h5><br/>
            <a type="button" class="btn btn-primary" href="./gestion_logement_user.php">Retour au Menu logement</a>
            <a type="button" class="btn btn-warning" href="./action_logement_user.php?idLocation=<?php echo $_GET['idLocation'];?>&demande=1">Demander un Entretient sur votre logement </a>
        </div>
    </div>
</div>
<?php
if(isset($_GET['demande'])) {
  if($_GET['demande'] == 1){
    if(isset($_POST['forMaintenance'])){
      $remarque = htmlspecialchars($_POST['remarque']);
      $remarqueLen = strlen($remarque);
      if($remarqueLen <= 255) {
        if($remarqueLen != 0) {
          $insert = $bdd->prepare("INSERT INTO entretient(TimeDateEntretient,Remarque,prix,idAgentEntretient,idAppartement) VALUES(?, ?, ?, ?, ?)");
          $insert->execute(array(NULL, $remarque, NULL, NULL, $Logement['id']));
          header('Location: ./action_logement_user.php?idLocation='.$_GET['idLocation']);
        } else {
          $erreur = "Veuillez remplir tout les champs !";
        }
      } else {
        $erreur = "la taille de la remarque est superieur 255 characteres !";
      }
    }
?>

<div class="col-md-12">
    <div class="card p-3 text-center px-4">
        <div class="user-content row text-center col-md-6 container">
            <form method="post">
              <input type="text" id="remarque" class="form-control rounded" name="remarque" placeholder="Probleme Rencontrer dans le logement" required/><br/><br/>
              <button type="submit" name="forMaintenance" class="btn btn-success">Soumettre demande de Maintenance </button>
            </form>
        </div>
    </div>
</div>








<?php }} ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">Numero de Facture</th>
      <th scope="col">Remarque</th>
      <th scope="col">prix</th>
      <th scope="col">Agent Entretient</th>
      <th scope="col">Date Entretient</th>
      <th scope="col">Etat</th>
    </tr>
  </thead>
  <?php if(NombreInterventionLogement($Logement['id']) != 0) {
    $getEntretient = $bdd->prepare("SELECT * FROM entretient WHERE idAppartement = ? ORDER BY id");
    $getEntretient->execute(array($Logement['id']));
    while($Entretient = $getEntretient->fetch()){
     ?>
  <tbody>
    <tr>
      <td><?php echo $Entretient['id']; ?></td>
      <td><?php echo $Entretient['Remarque']; ?></td>
      <td><?php if($Entretient['prix'] == NULL) {
        echo "Aucun prix n'a encore ete attriber";
      } else{
        echo $Entretient['prix']; echo " "; echo "TND";
      }

       ?></td>
      <td><?php if($Entretient['idAgentEntretient'] == NULL){
        echo "Aucun agent n'a ete attribuer";
      } else {
        $getAgent = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $getAgent->execute(array($Entretient['idAgentEntretient']));
        $Agent = $getAgent->fetch();
        echo $Agent['nom']; echo " "; echo $Agent['prenom'];}
       ?></td>
      <td><?php
      if($Entretient['TimeDateEntretient'] == NULL){
        echo "Aucune date n'a ete attribuer";
      } else {
        echo date('d/m/Y H:i:s', strtotime($Entretient['TimeDateEntretient']));
      }
       ?></td>
      <td><?php if($Entretient['status'] == 0){
        echo "En Attente";
      } else if($Entretient['status'] == 1){
        echo "En Cours";
      } else {
        echo "Effectuer";
      } ?></td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php } else { ?>
</table>
<div class="col-md-12">
    <div class="card p-3 text-center px-4">
        <div class="user-content">
            <h5 class="mb-0">Aucune intervention n'a eu lieu sur ce logement</h5>
        </div>
    </div>
</div>
<?php } ?>
</table>
</div>
<br/><br/>
<br/>
<?php include "./includes/footer.php";}
else{
  header("Location: ./gestion_logement_user.php");
} ?>
