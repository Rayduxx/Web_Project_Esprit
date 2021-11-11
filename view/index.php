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
  <!-----Section--->
  <div class="container-fluid padding">
    <div class="row text-center padding">
      <div class="col-xs-12 col-sm-6 col-md-4">
        <i class="fas fa-wrench"></i>
        <h3>Fonctionalite 1 !</h3>
        <p>Lorem ipsum</p>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
        <i class="fas fa-tree"></i>
        <h3>Fonctionalite 2 !</h3>
        <p>Lorem ipsum</p>
      </div>
      <div class="col-sm-2 col-md-4">
        <i class="fas fa-tree"></i>
        <h3>Fonctionalite 3 !</h3>
        <p>Lorem ipsum</p>
      </div>
    </div>
    <hr class="my-4">
  </div>
  <!-----Testimonies--->
  <div class="container-fluid padding">
    <div class="row welcome text-center">
      <div class="col-12">
        <p class="lead">Temoignages et Avis !</p>
        <hr class="my-4">
      </div>
    </div>
  </div>
  <div class="container mt-5 mb-5">
    <div class="row g-2">
        <div class="col-md-4">
            <div class="card p-3 text-center px-4">
                <div class="user-image"> <img src="" class="rounded-circle" width="80"> </div>
                <div class="user-content">
                    <h5 class="mb-0">Nom Prenom</h5>
                    <p>Lorem ipsum</p>
                </div>
                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-center px-4">
                <div class="user-image"> <img src="" class="rounded-circle" width="80"> </div>
                <div class="user-content">
                    <h5 class="mb-0">Nom Prenom</h5>
                    <p>Lorem ipsum</p>
                </div>
                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 text-center px-4">
                <div class="user-image"> <img src="" class="rounded-circle" width="80"> </div>
                <div class="user-content">
                    <h5 class="mb-0">Nom Prenom</h5>
                    <p>Lorem ipsum</p>
                </div>
                <div class="ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div>
            </div>
        </div>
    </div>
</div>



<?php include "./includes/footer.php"; ?>
