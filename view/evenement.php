<?php
$page_titre = "titre";
include './includes/header.php';

$selection = $bdd->prepare("SELECT * FROM event WHERE id = ?");
$selection->execute($_GET['id_Event']);

?>

<div class="card">
  <div class="card-header">
  </div>
</div>



<?php include './includes/footer.php';?>
