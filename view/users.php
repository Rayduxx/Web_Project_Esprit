<?php include "./includes/profil_header.php";
if($userinfo['isAdmin'] == 0){
  header("Location: ./profil.php");
}

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
<br/><br/>
  <div class="card row-md-6">
    <div class="card-header text-center">
      <h1>Gestion Utilisateurs</h1>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Email</th>
            <th scope="col">Admin</th>
            <th scope="col">Type Compte</th>
            <th scope="col">Bloquage/Debloquage</th>
            <th scope="col">Modifier </th>
          </tr>
          <tbody>
            <?php
              $SelectionUser = $bdd->prepare("SELECT * FROM users ORDER BY id");
              $SelectionUser->execute();

              while($user = $SelectionUser->fetch()){
                ?>
            <tr>
              <td><?php echo $user['id']; ?></td>
              <td><?php echo $user['nom']; ?></td>
              <td><?php echo $user['prenom']; ?></td>
              <td><?php echo $user['email']; ?></td>
              <td><?php if($user['isAdmin'] == 1){echo "oui";}else{echo "non";} ?></td>
              <td><?php if($user['typeCompte'] == 1){echo "Agent Entretient";} else{echo "User";} ?></td>
              <td>
                <?php
              $selectionBan = $bdd->prepare("SELECT * FROM ban WHERE userId = ?");
              $selectionBan->execute(array($user['id']));
              $banexist = $selectionBan->rowCount();
              if($banexist == 0){?>
                <form method="post">
                  <input type="text" name="uid" value="<?php echo $user['id'];?>" id="uid" hidden />
                  <input type="text" placeholder="Motif" name="motif" id="motif" />
                  <button class="btn btn-danger" name="bloquage" type="submit"> Bloquer </button>
                </form>
              <?php
              } else{
                $ban = $selectionBan->fetch();
              ?>
              <form method="post">
                <input type="text" name="uid" value="<?php echo $user['id'];?>" id="uid" hidden />
                <input type="text" value="<?php echo $ban['motif'];?>" name="motif" id="motif" disabled/>
                <button class="btn btn-success" name="debloquage" type="submit"> Debloquer </button>
              </form>
              <?php
              }
              ?>
              </td>
              <td><a type="button" class="btn btn-warning" href="./users.php?editMode=1&editid=<?php echo $user['id'];?>">Modifier</a></td>
            </tr>
            <?php if(isset($_GET['editMode']) && !empty($_GET['editMode']) && isset($_GET['editid']) && !empty($_GET['editid'])){
              if($_GET['editid'] == $user['id']){
                if(isset($_POST['FormEdit'])){
                  if(!empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
                    $email = htmlspecialchars($_POST['email']);
                    $nom = htmlspecialchars($_POST['nom']);
                    $prenom = htmlspecialchars($_POST['prenom']);
                    $isAdmin = htmlspecialchars($_POST['isAdmin']);
                    $typeCompte = htmlspecialchars($_POST['typeCompte']);

                    $update = $bdd->prepare('UPDATE users SET nom = ?, prenom = ?, email = ?, isAdmin = ?, typeCompte = ? WHERE id = ?');
                    $update->execute(array($nom, $prenom, $email,$isAdmin,$typeCompte, $user['id']));
                    echo "<script>location.href = './users.php'</script>";

                  }
                }
                ?>
                <tr>
                  <form method="post">
                    <td><?php echo $user['id'];?></td>
                    <td><input type="text" id="nom" name="nom" value="<?php echo $user['nom'];?>"/></td>
                    <td><input type="text" id="prenom" name="prenom" value="<?php echo $user['prenom'];?>"/></td>
                    <td><input type="email" id="email" name="email" value="<?php echo $user['email'];?>"/></td>
                    <td>
                      <select id="isAdmin" name="isAdmin">
                        <option value="1" <?php if($user['isAdmin'] == 1 ){?>selected<?php }?>>Oui</option>
                        <option value="0" <?php if($user['isAdmin'] == 0 ){?>selected<?php }?>>Non</option>
                      </select>
                    </td>
                    <td>
                      <select id="typeCompte" name="typeCompte">
                        <option value="1"<?php if($user['typeCompte'] == 1 ){?>selected<?php }?>>Agent Entretient</option>
                        <option value="0"<?php if($user['typeCompte'] == 0 ){?>selected<?php }?>>User</option>
                      </select>
                    </td>
                    <td class="text-center">-</td>
                    <td><button type="submit" name="FormEdit" class="btn btn-success">Valider Modification</button></td>
                  </form>
                </tr>
            <?php }
            } ?>
          <?php } ?>
          </tbody>
      </table>
    </div>
  </div>
<div><br/><br/><br/>
<?php include "./includes/footer.php"; ?>
