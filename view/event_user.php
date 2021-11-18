<?php include "./includes/profil_header.php";
if(isset($_GET['success'])){
  if($_GET['success'] == 0){
?>
<div class="alert alert-danger text-center" role="alert"> Une erreur est survenu lors de l'annulation de votre inscription a l'evenement</div>
<?php }
if($_GET['success'] == 1) { ?>
  <div class="alert alert-success text-center" role="alert"> votre Inscription a ete annuler avec sucess</div>

<?php }} ?>
  <table class="table">
    <thead>
    <tr>
      <th scope="col">Date de l'evennement</th>
      <th scope="col">Nom de l'evennement</th>
      <th scope="col">Description de l'evennement</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
<?php
  if(NombreEventsUser($userinfo['id']) == 0){
  ?>
</table>
<div class="col-md-12">
    <div class="card p-3 text-center px-4 alert-danger">
        <div class="user-content">
            <h5 class="mb-0">Vous ne participer a aucun evenement</h5>
            <a href="./events.php">Voulez vous voir nos evenements ? </a>
        </div>
    </div>
</div>
<?php } else {
  $selectParticipation = $bdd->prepare("SELECT * FROM participants WHERE userId = ? ORDER BY id");
  $selectParticipation->execute(array($userinfo['id']));
  while($A = $selectParticipation->fetch()){
  $selectionEvent = $bdd->prepare("SELECT * FROM event WHERE id = ?");
  $selectionEvent->execute(array($A['eventId']));
  $event = $selectionEvent->fetch();
  if($event['isComplete'] == 0){
   ?>
  <tbody>
    <tr>
      <td><?php echo date('d/m/Y H:i:s', strtotime($event['datetime'])); ?></td>
      <td><?php echo $event['name']; ?></td>
      <td><?php echo $event['description']; ?></td>
      <td><a class="btn btn-danger" type="button" href="./annulation.php?InscriptionId=<?php echo $A['id'];?>">Annuler l'inscription</a></td>
      <td><a class="btn btn-warning" type="button" href="./evenement.php?idEvent=<?php echo $A['eventId']; ?>">En savoir plus</a></td>
    </tr>
  </tbody>
  </table>
<?php }}} ?>
</table>
</div>
<br/><br/><br/>
<?php include './includes/footer.php';?>
