<?php
$page_titre = "Accueil";
include "./includes/header.php";

?>
  <!---Slides------->
    <div id="slides" class="carousel slide" data-ride="carousel">
      <ul class="carousel-indicators">
        <li data-target="#slides" data-slide-to="0" class="active"></li>
        <li data-target="#slides" data-slide-to="1"></li>
        <li data-target="#slides" data-slide-to="2"></li>
      </ul>
      <div class="carousel-inner active">
        <div class="carousel-item">
          <img src="">
          <div class="carousel-caption">
            <h1 class="display-3">Vous voulez en savoir plus sur nous ?</h1>
            <button type="button" class="btn btn-primary btn-md"> F.A.Q </button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="">
          <div class="carousel-caption">
            <h1 class="display-3">Vous voulez vistez un appartement ?</h1>
            <button type="button" class="btn btn-primary btn-md"> Inscrivez vous </button>
          </div>
        </div>
        <div class="carousel-item">
          <img src="">
          <div class="carousel-caption">
            <h1 class="display-3">Vous voulez participer a un Evenement ?</h1>
            <button type="button" class="btn btn-primary btn-md"> Inscrivez vous </button>
          </div>
        </div>
      </div>
    </div>

  <!---Welcome section--->
  <div class="container-fluid padding">

    <div class="row welcome text-center">
      <hr class="my-4">
      <div class="col-12">
        <h1>Star City </h1>
      </div>
      <div class="col-12">
        <p class="lead">Vivons dans un environnement sain !</p>
      </div>
    </div>
  </div>
  <hr class="my-4">
  <!---Section--->
  <div class="container-fluid padding">
    <div class="row text-center padding">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="Fonctionalite">
        <i class="fas fa-wrench"></i>
        <h3>Entretient Rapide !</h3>
        <p>Nous garantissons un entretient rapide et efficaces sur vos Appartement !</p>
      </div>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="Fonctionalite">
        <i class="fas fa-tree"></i>
        <h3>Sensibilite Ecologique !</h3>
        <p>Nous organisons hebdomadairement des evenement de sensibilisation sur l'ecologie</p>
      </div>
      </div>
      <div class="col-sm-2 col-md-4">
        <div class="Fonctionalite">
        <i class="fas fa-calendar-alt"></i>
        <h3> Administration disponible 24/7 !</h3>
        <p>Avec notre equipe d'administration disponible 24/7 nous garantissons la securite de vos informations sur notre site</p>
      </div>
      </div>
    </div>
    <hr class="my-4">
  </div>
  <!---Testimonies--->
  <div class="container-fluid padding">
    <div class="row welcome text-center">
      <div class="col-12">
        <p class="lead">Temoignage et Avis aleatoire !</p>
        <hr class="my-4">
      </div>
    </div>
  </div>
  <div class="container mt-5 mb-5 ">
    <div class="row g-2">
      <?php
      $i = nombreAvis();
      if($i == 0){ ?>
        <div class="col-md-12">
            <div class="card p-3 text-center px-4">
                <div class="user-content">
                    <h5 class="mb-0">Aucun n'avis existe sur le site</h5>
                </div>
            </div>
        </div>
      <?php } else{

        $selectID = $bdd->query("SELECT id FROM avis ORDER BY rand() LIMIT 1");
        $selectID->execute();
        $A = $selectID->fetch();
        $selectAvis = $bdd->prepare("SELECT * FROM avis WHERE id = ?");
        $selectAvis->execute(array($A['id']));
        $B = $selectAvis->fetch();
        $selectUser = $bdd->prepare("SELECT * FROM users WHERE id = ?");
        $selectUser->execute(array($B['id_user']));
        $C = $selectUser->fetch();

        if(isset($_POST['likeForm'])){
          $avisId = htmlspecialchars($_POST['AvisID']);
          if(!empty($_POST['AvisID'])){
            $insertLike = $bdd->prepare("INSERT INTO likes(id_avis,isLike,id_user) VALUES(?,1,?) ");
            $insertLike->execute(array($avisId,$userinfo['id']));
          }
        }
        if(isset($_POST['dislikeForm'])){
          $avisId = htmlspecialchars($_POST['AvisID']);
          if(!empty($_POST['AvisID'])){
            $insertLike = $bdd->prepare("INSERT INTO likes(id_avis,isLike,id_user) VALUES(?,0,?) ");
            $insertLike->execute(array($avisId,$userinfo['id']));
          }
        }



         ?>
        <div class="col-md-12">
              <div class="card p-3 text-center px-4">
                  <div class="user-image"> <img src="../assets/img/user.png" class="rounded-circle" width="80"> </div>
                  <br/>
                  <div class="user-content">
                      <h5 class="mb-0"><?php
                      echo $C['nom'];echo " "; echo $C['prenom'];?>
                    </h5><br/>
                      <p><?php
                      $selectComment = $bdd->prepare("SELECT * FROM commentaire WHERE id_avis = ?");
                      $selectComment->execute(array($A['id']));
                      $D = $selectComment->fetch();
                       echo $D['commentaire'];?></p>
                  </div>
                  <div class="ratings"><?php
                  $z = 0;
                   while($z < $B['rate']) {
                    $z++;?>
                    <i class="fa fa-star"></i><?php } ?>
                  </div>
                  <?php
                    $veriflikes = $bdd->prepare("SELECT * FROM likes WHERE id_user = ? AND id_avis = ?");
                    $veriflikes->execute(array($userinfo['id'],$A['id']));
                    $verif = $veriflikes->rowCount();
                    if($verif == 0){
                   ?>
                    <form method="post">
                    <?php
                      $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 1 AND id_avis = ?");
                      $countLikeQuery->execute(array($A['id']));
                      $res = $countLikeQuery->rowCount();
                      echo $res;
                     ?>
                    <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                    <button type="submit" name="likeForm" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Like</button>
                  </form>
                  <form method="post">
                    <?php
                      $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 0 AND id_avis = ?");
                      $countLikeQuery->execute(array($A['id']));
                      $res = $countLikeQuery->rowCount();
                      echo $res;
                     ?>
                    <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                    <button type="submit" name="dislikeForm" class="btn btn-danger"><i class="fa fa-thumbs-down"></i> Dislike</button>
                  </form>
                <?php } else {
                    $verifIsLike = $bdd->prepare("SELECT * FROM likes WHERE isLike = 1 AND id_user = ? AND id_avis = ?");
                    $verifIsLike->execute(array($userinfo['id'], $A['id']));
                    $verifIsLikeC = $verifIsLike->rowCount();
                    $verifIsDislikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 0 AND id_user = ? AND id_avis = ?");
                    $verifIsDislikeQuery->execute(array($userinfo['id'], $A['id']));
                    $verifIfDislike = $verifIsDislikeQuery->rowCount();
                    if($verifIsLikeC == 1){
                      if(isset($_POST['RemovelikeForm'])){
                        $avisId = htmlspecialchars($_POST['AvisID']);
                        if(!empty($_POST['AvisID'])){
                          $removeLikeQuery = $bdd->prepare("DELETE FROM likes WHERE id_user = ? AND id_avis = ?");
                          $removeLikeQuery->execute(array($userinfo['id'], $avisId));
                        }
                      }
                      if(isset($_POST['ChangeToDislike'])){
                        $avisId = htmlspecialchars($_POST['AvisID']);
                        if(!empty($_POST['AvisID'])){
                          $ChangeToDislikeQuery = $bdd->prepare("UPDATE likes SET isLike = 0 WHERE id_user = ? AND id_avis = ?");
                          $ChangeToDislikeQuery->execute(array($userinfo['id'], $avisId));
                        }
                      }
                      ?>
                      <form method="post">
                        <?php
                          $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 1 AND id_avis = ?");
                          $countLikeQuery->execute(array($A['id']));
                          $res = $countLikeQuery->rowCount();
                          echo $res;
                         ?>
                         <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                         <button type="submit" name="RemovelikeForm" class="btn btn-success active"><i class="fa fa-thumbs-up"></i> Like</button>
                      </form>
                      <form method="post">
                        <?php
                          $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 0 AND id_avis = ?");
                          $countLikeQuery->execute(array($A['id']));
                          $res = $countLikeQuery->rowCount();
                          echo $res;
                         ?>
                         <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                         <button type="submit" name="ChangeToDislike" class="btn btn-danger"><i class="fa fa-thumbs-down"></i> Dislike</button>
                      </form>
                <?php } else if($verifIfDislike == 1) {
                    if(isset($_POST['changeToLike'])){
                      $avisId = htmlspecialchars($_POST['AvisID']);
                      if(!empty($_POST['AvisID'])){
                        $changeTolikeQuery = $bdd->prepare("UPDATE likes SET isLike = 1 WHERE id_user = ? AND id_avis = ?");
                        $changeTolikeQuery->execute(array($userinfo['id'], $avisId));
                      }
                    }
                    if(isset($_POST['RemoveDislike'])){
                      $avisId = htmlspecialchars($_POST['AvisID']);
                      if(!empty($_POST['AvisID'])){
                        $RemoveDislikeQuery = $bdd->prepare("DELETE FROM likes WHERE id_user = ? AND id_avis = ?");
                        $RemoveDislikeQuery->execute(array($userinfo['id'], $avisId));
                      }
                    }



                  ?>
                  <form method="post">
                    <?php
                      $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 1 AND id_avis = ?");
                      $countLikeQuery->execute(array($A['id']));
                      $res = $countLikeQuery->rowCount();
                      echo $res;
                     ?>
                     <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                     <button type="submit" name="changeToLike" class="btn btn-success"><i class="fa fa-thumbs-up"></i> Like</button>
                  </form>
                  <form method="post">
                    <?php
                      $countLikeQuery = $bdd->prepare("SELECT * FROM likes WHERE isLike = 0 AND id_avis = ?");
                      $countLikeQuery->execute(array($A['id']));
                      $res = $countLikeQuery->rowCount();
                      echo $res;
                     ?>
                     <input type="text" value="<?php echo $A['id']; ?>" name="AvisID" id="AvisID" hidden />
                     <button type="submit" name="RemoveDislike" class="btn btn-danger active"><i class="fa fa-thumbs-down"></i> Dislike</button>
                  </form>
            <?php    }
                  } ?>
                </div>
              </div>
          </div>
        <?php } ?>

      </div>
    </div>
</div>



<?php include "./includes/footer.php"; ?>
