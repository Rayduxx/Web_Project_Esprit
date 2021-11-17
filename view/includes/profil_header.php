<?php 
$page_titre = "Profil";
include 'header.php'; ?>
<br/> <br/> <br/>

    <div class="card">
        <div class="card-header">
            <h2 class="card-title text-center">Bienvennue <?php echo $userinfo['nom']; echo " "; echo $userinfo['prenom']; ?> </h2>
            <nav class="navbar navbar-expand-md navbar-light rounded nav justify-content-center">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <li><a class="nav-link" href="./profil.php">Profil</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./gestion_logement.php">Gestion de votre Logement</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./avis.php">Poster un Avis</a></li>
                    </li>
                    <li class="nav-item">
                        <li><a class="nav-link" href="./modifier_profil.php">Modifier votre profil</a></li>
                    </li>
                </ul>
            </nav>
        </div>