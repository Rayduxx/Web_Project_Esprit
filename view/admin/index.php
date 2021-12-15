<?php
require("../../config.php");
if(isset($userinfo['email'])){
$requser = $bdd->prepare('SELECT * FROM ban WHERE userId = ?');
$requser->execute(array($userinfo['id']));
$userexist = $requser->rowCount();
if($userexist == 1) {
  header('Location: ../ban.php');
}}
if(!isset($userinfo['id'])){
  header("Location: ../login.php");
}
if($userinfo['isAdmin'] != 1){
  header("Location: ../profil.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@200&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Display&display=swap" rel="stylesheet">

    <title></title>

</head>
<body>
    <section>

</div>
    <div class="navbar">
       <div class="menu">
            <ul>
                <li><a href="../profil.php">Profil</a> </li>
                <li><a href="../users.php">Gestions Users</a> </li>
                <li><a href="../logement_admin.php">Gestion Logement</a> </li>
                <li><a href="./offres.php">Gestions Offres</a> </li>
                <li><a href="../admin_avis.php">Gestion Avis</a> </li>
                <li><a href="../admin_events.php">Gestion Event</a> </li>
            </ul>
        </div>
        <div class="logo">
                <a><img src="" alt=""></a>
       </div>
    </div>

    </section>


<br><br><br>

<section>
    <div class="corps">
 <div class="vis"><h2><a href="">Les Visiteurs<br/><?php
 $nombreUsers = $bdd->prepare("SELECT * FROM users");
 $nombreUsers->execute();
 $nombreU = $nombreUsers->rowCount();
 echo $nombreU;
  ?>
 </a></h2></div>
 <div class="avis"><h2><a href="">Les Avis<br/><?php
 $nombreAvis = $bdd->prepare("SELECT * FROM avis");
 $nombreAvis->execute();
 $nombreA = $nombreAvis->rowCount();
 echo $nombreA;
  ?></a></h2></div>
 <div class="offres"><h2><a href="">Les Offres<br/><?php
 $nombreOffres = $bdd->prepare("SELECT * FROM offres");
 $nombreOffres->execute();
 $nombreO = $nombreOffres->rowCount();
 echo $nombreO;
  ?></a></h2></div>
<div class="loge"><h2><a href="">Les logements<br/><?php
$nombreLo = $bdd->prepare("SELECT * FROM logement");
$nombreLo->execute();
$nombreL = $nombreLo->rowCount();
echo $nombreL;
 ?></a></h2></div>
</div>
</section>


<section>
<div class="footer">
<h4>&copy 2021-BACKSTAGE GROUPE</h4>
</div>
</section>
