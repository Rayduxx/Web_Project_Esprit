<?php
$page_titre = "Profil";
include 'header.php';
if(!isset($userinfo['id'])){
  header("Location: ./login.php");
}
?>
<br/> <br/> <br/>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Bienvennue <?php echo $userinfo['nom']; echo " "; echo $userinfo['prenom']; ?> </h2>
            <nav class="navbar navbar-expand-md navbar-light rounded nav justify-content-center">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <li><a class="nav-link" href="./profil.php">Profil</a></li>
                    </li>
                    <?php if($userinfo['typeCompte'] == 0)  {?>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./gestion_logement_user.php">Gestion de vos Logement</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./event_user.php">Evenement</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./avis.php">Poster un Avis</a></li>
                    </li>
                  <?php } else { ?>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./gestion_entretient_agent.php">Liste d'Intervention</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./liste_entretient_agent.php">Intervention En Attente</a></li>
                    </li>
                  <?php } if($userinfo['isAdmin'] == 1){ ?>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./admin">Admin Dashboard</a></li>
                    </li>
                  <?php } ?>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./modifier_profil.php">Modifier votre profil</a></li>
                    </li>

                </ul>
            </nav>
        </div>
