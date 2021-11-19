<?php include "./includes/profil_header.php"; ?>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Numero de facture</th>
        <th scope="col">Info Logement</th>
        <th scope="col">Remarque</th>
        <th scope="col">Locataire</th>
        <th scope="col">Status</th>
        <th scope="col"></th>
      </tr>
    </thead>
<?php if(NombreInterventionGestion($userinfo['id']) == 0) { ?>
</table>
<?php } else {
  $selectionMissions = $bdd->prepare("SELECT * FROM entretient WHERE idAgentEntretient = ?");
  $selectionMissions->execute(array($userinfo['id']));
  while($A = $selectionMissions->fetch()){
    $SelectionLogement = $bdd->prepare("SELECT * FROM Logement WHERE id = ?");
    $SelectionLogement->execute(array($A['idAppartement']));
    $Logement = $SelectionLogement->fetch();
  ?>
    <tbody>
      <tr>
        <td><?php echo $A['id']; ?></td>
        <td><?php echo $Logement['bloc']; echo $Logement['numero']; ?></td>
        <td><?php echo $A['Remarque']; ?></td>
        <td><?php
        if($Logement['idLocataire'] == NULL){
          echo "Aucun Locataire";
        } else {
        $SelectionLocataire = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $SelectionLocataire->execute(array($Logement['idLocataire']));
        $Locataire = $SelectionLocataire->fetch();
        echo $Locataire['nom']; echo " "; echo $Locataire['prenom'];
      }
         ?></td>
         <td><?php
         if($A['status'] == 1){
           echo "En Cours";
         } elseif ($A['status'] == 2) {
           echo "Terminer";
         } else {
           echo "Erreur !";
         }

          ?></td>
          <?php if($A['status'] != 2) {?>
        <td><a type="button" class="btn btn-warning" href="./action_entretient_agent.php?Ordre=<?php echo $A['id'];?>">Plus d'action</a></td>
      <?php } else { ?>
        <td><a type="button" class="btn btn-warning disabled"  role="button" href="#" aria-disabled="true">Plus d'action</a></td>
      <?php } ?>
      </tr>
    <?php } ?>
    </tbody>
  </table>


<?php } ?>
</div>
<br/><br/><br/>

<?php include "./includes/footer.php"; ?>
