<?php include "./includes/profil_header.php";


if($userinfo['typeCompte'] == 0){
$j = NombreLogementUser($userinfo['id']);
 ?>
  <table>
    <thead>
      <tr>
        <th scope="col"># du logement</th>
        <th scope="col"># de contrat</th>
        <th scope="col">type</th>
        <th scope="col">Bloc</th>
        <th scope="col">Prix du loyer</th>
        <th scope="col">Date de debut</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <?php if($j > 0){ ?>
    <tbody>
      <?php
        $selection = $bdd->prepare("SELECT * FROM location WHERE idLocataire = ? AND etat = 0 ORDER BY id");
        $selection->execute(array($userinfo['id']));
        while($A = $selection->fetch()){
          $selectLogement = $bdd->prepare("SELECT * FROM logement WHERE id = ?");
          $selectLogement->execute(array($A['idLogement']));
          $B = $selectLogement->fetch();
      ?>
      <tr>
        <td><?php echo $B['numero'];?></td>
        <td><?php echo $A['id'];?></td>
        <td><?php echo $B['type'];?></td>
        <td><?php echo $B['bloc'];?></td>
        <td><?php echo $A['prix'];?></td>
        <td><?php echo $A['DebutLocation'];?></td>
        <td><a class="btn btn-warning" type="button" href="action_logement_user.php?idLocation=<?php echo $A['id'];?>">Plus d'action</a></td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
<?php } else { ?>
</table>
<div class="col-md-12">
    <div class="card p-3 text-center px-4 alert-danger">
        <div class="user-content">
            <h5 class="mb-0">Vous ne detenez aucun logement</h5>
            <a href="./logement.php">Voulez vous voir nos logements ? </a>
        </div>
    </div>
</div>

<?php } ?>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php"; }
else {
  header("Location: ./gestion_entretient_agent.php");
}?>
