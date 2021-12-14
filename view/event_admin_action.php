<?php include "./includes/profil_header.php";

if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}

?>
  <br/><br/>
  <div class="card row-md-6">
    <div class="card-header text-center">
      <h1> Gestion Evenements</h1>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col"># event</th>
            <th scope="col">Max Participant</th>
            <th scope="col">description</th>
            <th scope="col">Modifier</th>
            <th scope="col">Plus d'action</th>

          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
  <br/>
</div>
<br/><br/><br/>
<?php include "./includes/footer.php";?>
