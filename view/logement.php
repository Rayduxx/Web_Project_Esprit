<?php
$page_titre = "Logement";
include "./includes/header.php";

if(isset($_POST['ValiderLocation'])){
  if(!empty($_POST['idAppartementC'])){
    $idAppartementC = htmlspecialchars($_POST['idAppartementC']);
    $fetchAppart = $bdd->prepare("SELECT * FROM logement WHERE id = ?");
    $fetchAppart->execute(array($idAppartementC));
    $Appart = $fetchAppart->fetch();
    $update = $bdd->prepare("UPDATE logement SET idLocataire = ? WHERE id = ?");
    $update->execute(array($userinfo['id'],$idAppartementC));
    $insert = $bdd->prepare("INSERT INTO location(idLogement,idLocataire,prix,etat) VALUES(?,?,?,0)");
    $insert->execute(array($idAppartementC,$userinfo['id'],$Appart['prixLoyer']));
    $success = "Appartement Louer avec Success";
  }
}

if(isset($_POST['ValiderCoupon'])){
  if(!empty($_POST['idAppartementC']) && !empty($_POST['coupon'])){
    $idAppartementC = htmlspecialchars($_POST['idAppartementC']);
    $coupon = htmlspecialchars($_POST['coupon']);
    $verifCoupon = $bdd->prepare("SELECT * FROM coupon WHERE code = ? AND etat = 0");
    $verifCoupon->execute(array($coupon));
    $verif = $verifCoupon->rowCount();
    if($verif == 1){
      $fetchAppart = $bdd->prepare("SELECT * FROM logement WHERE id = ?");
      $fetchAppart->execute(array($idAppartementC));
      $Appart = $fetchAppart->fetch();
      $update = $bdd->prepare("UPDATE logement SET idLocataire = ? WHERE id = ?");
      $update->execute(array($userinfo['id'],$idAppartementC));
      $promo = 10 / 100;
      $nvPrix = $Appart['prixLoyer'] - ($Appart['prixLoyer'] *  $promo);
      $insert = $bdd->prepare("INSERT INTO location(idLogement,idLocataire,prix,etat) VALUES(?,?,?,0)");
      $insert->execute(array($idAppartementC,$userinfo['id'],$nvPrix));
      $majCoupon = $bdd->prepare("UPDATE coupon SET etat = 1 WHERE code = ? AND etat = 0");
      $majCoupon->execute(array($coupon));
      $success = "Appartement Louer avec Success";
    } else {
      $erreur = "Il faut rentrer un code coupon Valide";
    }
  } else {
    $erreur = "Il faut mettre un code coupon";
  }
}

?>
 <br/><br/>
 <?php if(isset($erreur)) {
   echo '<div class="col-lg-6 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu :' .$erreur.'</div></div>';
 }?>
 <?php if(isset($success)) {
   echo '<div class="col-lg-6 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
 }?>
 <div class="card container">
   <div class="card-body text-center">
       <?php
        $i = NombreLogementDispo();
        if($i == 0){
        ?>
         <div class="alert alert-danger">
           <h2> Aucun Logement n'est disponible </h2>
         </div>
     <?php } else { ?>
       <div class="card-title text-center">
         <h1> Logement</h1>
         <a href="./logement.php?filtre=1" class="btn btn-outline-secondary">Filtre</a>
       </div>
       <?php
        if(isset($_GET['filtre'])){ ?>
          <div class="col-lg-6 card self-align-center mx-auto">
            <form method="get">
              <input type="text" class="form-control rounded" name="size" id="size" placeholder="S + ?" /><br/>
              <input type="number" class="form-control rounded" name="minPrice" id="minPrice" placeholder="Prix Minimum" /><br/>
              <input type="number" class="form-control rounded" name="maxPrice" id="maxPrice" placeholder="Prix Maximum" /><br/>
              <button type="submit" name="filtreVal" class="btn btn-outline-success">Valider Filtre </button>
            </form>
          </div>
          <br/>
      <?php  }
        ?>
        <?php if(!isset($_GET['size']) && !isset($_GET['minPrice']) && !isset($_GET['maxPrice'])){?>
       <ul class="list-group">
         <?php
         $selection = $bdd->query('SELECT * FROM Logement WHERE idLocataire IS NULL ORDER BY id');
          while($A = $selection->fetch()) {
            ?>
           <li class="list-group-item padding">
             <div class="row align-items col-md-12">
               <div class="row col-md-3">
                 <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
              </div>
              <div class="row col-md-3 padding">
               <p> <?php echo $A['description'];
                ?></p>
                <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

              </div>
              <div class="row col-md-3 padding">
                <p>S+<?php echo $A['nbChambre']; ?> </p>
                <?php if(isset($userinfo['id'])){ ?>
                <form method="post">
                  <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                  <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                  <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                </form>
              <?php } else{ ?>
                  <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
              <?php } ?>
              </div>
              <div class="row col-md-3 padding">
                <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                <?php if(isset($userinfo['id'])){ ?>
                <form method="post">
                  <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                  <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                </form>
              <?php } else { ?>
                <a class="btn btn-success" href="./login.php">Se connecter</a>
              <?php } ?>
              </div>
              </div>
              </div>
           </li>
         <?php } ?>
       </ul>
     <?php } else {
       if(empty($_GET['size']) && empty($_GET['minPrice']) && empty($_GET['maxPrice'])) {
        ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->query('SELECT * FROM Logement WHERE idLocataire IS NULL ORDER BY id');
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php } ?>
        </ul>
      <?php } else if(!empty($_GET['size']) && empty($_GET['minPrice']) && empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND nbChambre = ? ORDER BY id');
          $selection->execute(array($_GET['size']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php } else if(empty($_GET['size']) && !empty($_GET['minPrice']) && empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer >= ? ORDER BY id');
          $selection->execute(array($_GET['minPrice']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php } else if(empty($_GET['size']) && empty($_GET['minPrice']) && !empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer <= ? ORDER BY id');
          $selection->execute(array($_GET['maxPrice']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php } else if(!empty($_GET['size']) && !empty($_GET['minPrice']) && empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer >= ? AND nbChambre = ? ORDER BY id');
          $selection->execute(array($_GET['minPrice'],$_GET['size']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php  } else if(!empty($_GET['size']) && empty($_GET['minPrice']) && !empty($_GET['maxPrice'])) { ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer <= ? AND nbChambre = ? ORDER BY id');
          $selection->execute(array($_GET['maxPrice'],$_GET['size']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php } else if(empty($_GET['size']) && !empty($_GET['minPrice']) && !empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer >= ? AND prixLoyer <= ? ORDER BY id');
          $selection->execute(array($_GET['maxPrice'],$_GET['minPrice']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
      <?php } else if(!empty($_GET['size']) && !empty($_GET['minPrice']) && !empty($_GET['maxPrice'])){ ?>
        <ul class="list-group">
          <?php
          $selection = $bdd->prepare('SELECT * FROM Logement WHERE idLocataire IS NULL AND prixLoyer >= ? AND nbChambre = ? AND prixLoyer <= ? ORDER BY id');
          $selection->execute(array($_GET['minPrice'],$_GET['size'],$_GET['maxPrice']));
          if($selection->rowCount() == 0){?>
            <div class="alert alert-danger">
              <h2> Aucun Logement n'est disponible avec les caracteristique demander </h2>
            </div>
          <?php } else {
           while($A = $selection->fetch()) {
             ?>
            <li class="list-group-item padding">
              <div class="row align-items col-md-12">
                <div class="row col-md-3">
                  <img src="./upload/<?php echo $A['image'];?>" width="30" height="150" />
               </div>
               <div class="row col-md-3 padding">
                <p> <?php echo $A['description'];
                 ?></p>
                 <a class="btn btn-info" type="button" href="./offres.php?idLogement=<?php echo $A["id"]; ?>"> Nos offres sur <br/> cet <?php echo $A['type'];?> </a>

               </div>
               <div class="row col-md-3 padding">
                 <p>S+<?php echo $A['nbChambre']; ?> </p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <input type="text" placeholder="coupon de reduction 10%" name="coupon" id="coupon" /><br/><br/>
                   <button type="submit" class="btn btn-primary" name="ValiderCoupon">Valider Et Prendre Appartement</button>
                 </form>
               <?php } else{ ?>
                   <a class="btn btn-primary" href="./register.php">S'inscrire au site</a>
               <?php } ?>
               </div>
               <div class="row col-md-3 padding">
                 <p><?php echo $A['prixLoyer'];?> TND / mois</p>
                 <?php if(isset($userinfo['id'])){ ?>
                 <form method="post">
                   <input type="text" value="<?php echo $A['id'];?>" name="idAppartementC" id="idAppartementC" hidden />
                   <button type="submit" class="btn btn-success" name="ValiderLocation">Prendre Appartement</button>
                 </form>
               <?php } else { ?>
                 <a class="btn btn-success" href="./login.php">Se connecter</a>
               <?php } ?>
               </div>
               </div>
               </div>
            </li>
          <?php }} ?>
        </ul>
     <?php }} ?>
       <br/><br/>
     <?php }?>
   </div>
 </div>
<br/><br/>
 <?php
 include "./includes/footer.php"; ?>
