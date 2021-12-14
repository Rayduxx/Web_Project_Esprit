<?php include "./includes/profil_header.php";

if($userinfo['typeCompte'] == 0){
  header("Location: ./profil.php");
}
$j = NombreInterventionNull();
if ($j == 0){
?>
<div class="col-md-12">
    <div class="card p-3 text-center px-4 alert-danger">
        <div class="user-content">
            <h5 class="mb-0">Aucun entretient n'est en attente</h5>
        </div>
    </div>
</div>
</div>
<br/><br/><br/>
<?php
  include "./includes/footer.php";
} else {
$selection = $bdd->prepare("SELECT * FROM entretient WHERE status = 0");
$selection->execute();
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col"># intervention</th>
      <th scope="col">Locataire</th>
      <th scope="col">Description du probleme</th>
      <th scope="col">Bloc</th>
      <th scope="col"> Numero Logement</th>
      <th scope="col"> Type Logement </th>
      <th scope="col">Prendre Intervention</th>
    </tr>
  </thead>
  <tbody>
    <?php while($A = $selection->fetch()){
      $SelectionLogement = $bdd->prepare("SELECT * FROM logement WHERE id = ?");
      $SelectionLogement->execute(array($A['idAppartement']));
      $L = $SelectionLogement->fetch();
      $SelectionLocataire = $bdd->prepare("SELECT * FROM users WHERE id = ?");
      $SelectionLocataire->execute(array($L['idLocataire']));
      $Loca = $SelectionLocataire->fetch();
       ?>
    <tr>
      <td><?php echo $A['id'];?></td>
      <td><?php echo $Loca['nom']; echo " "; echo $Loca['prenom'];?></td>
      <td><?php echo $A['Remarque'];?></td>
      <td><?php echo $L['bloc'];?></td>
      <td><?php echo $L['numero'];?></td>
      <td><?php echo $L['type'];?></td>
      <td><a type="button" class="btn btn-success" href="getIntervention.php?F=<?php echo $A['id'];?>">Prendre Intervention</a></td>

    </tr>
  <?php } ?>
  </tbody>
</table>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php"; }?>
