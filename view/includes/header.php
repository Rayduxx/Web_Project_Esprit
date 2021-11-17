<?php
require("../config.php");
require("../controller/avisC.php");
require("../controller/LogementC.php");

?>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <title>Sky City - <?php echo $page_titre;?></title>
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	  <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	  <link href="../../assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/tejtrab.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
  <body>
    <header class="sticky-top">
      <nav class="navbar navbar-expand-md nav nav-tabs navbar-light">
        <div class="container-fluid navbar-inner">
          <a class="navbar-brand" href="./index.php"><img src="#"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
  					     <span class="navbar-toggler-icon"></span>
  			   </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
							<li><a class="nav-link text-light" href="./Logement.php">Nos Logement</a></li>
						</li>
            <li class="nav-item">
							<li><a class="nav-link text-light" href="./events.php">Nos Evenement</a></li>
						</li>
            <?php if (!isset($_SESSION['email'])) { ?>
            <li class="nav-item">
              <li><a class="nav-link text-light" target="_blank" href="./login.php">Connection</a></li>
            </li>
            <li class="nav-item">
              <li><a class="nav-link text-light" target="_blank" href="./register.php">Inscription</a></li>
            </li>
            </ul>
          <?php } else { ?>
            
            
						<li class="nav-item">
							<li><a class="nav-link text-light" href="./profil.php"><?php echo $userinfo['prenom']; ?></a></li>
						</li>
            </ul>
            <ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<li><a class="nav-link text-light" href="./logout.php">SE DECONNECTER</a></li>
						</li>
					</ul>
        <?php } ?>
          
          </div>
        </div>
      </nav>
    </header>
