<?php
 session_start();
$id='';
 $mysqli = new mysqli('localhost','root','','projet_web') or die(mysqli_error($mysqli));
 $update = false;
 $idLogement='';
$promotion='';
 $PrixInitiale='';
 $PrixFinale='';
 $DateFin='';
 $typeLogement='';
 if (isset($_POST['save'])){
       $idLogement = $_POST['idl'];
       $promotion = $_POST['promo'];
       $PrixInitiale = $_POST['prixi'];
       $PrixFinale = $_POST['prixf'];
       $DateFin = $_POST['date'];
       $typeLogement = $_POST['type'];
       $mysqli->query("INSERT INTO offres (idLogement,promotion,PrixInitiale,PrixFinale,DateFin,typeLogement) Values('$idLogement', '$promotion', '$PrixInitiale', '$PrixFinale', '$DateFin', '$typeLogement')") or 
       die($mysqli->error);
       $_SESSION['message'] ="Record has been saved!";
       $_SESSION['msg_type'] = "success";

       header("location: offres.php");
   }
   if(isset($_GET['delete'])){
       $id = $_GET['delete'];
       $mysqli->query("DELETE FROM offres WHERE id=$id") or die($mysqli->error());
       $_SESSION['message'] ="Record has been deleted!";
       $_SESSION['msg_type'] = "danger";

       header("location: offres.php");
   }
   if (isset($_GET['edit'])){
       $id = $_GET['edit'];
       $update = true ;
       $result = $mysqli->query("SELECT * FROM offres WHERE id=$id") or die($mysqli->error);
       if (is_countable($result)==1){
        $row = $result->fetch_array();
       $idLogement = $row['idLogement'];
       $promotion = $row['promotion'];
       $PrixInitiale = $row['PrixInitiale'];
       $PrixFinale = $row['PrixFinale'];
       $DateFin = $row['DateFin'];
       $typeLogement = $row['typeLogement'];
       }
   }
   if (isset($_POST['update'])){
    $idLogement = $_POST['idl'];
    $promotion = $_POST['promo'];
    $PrixInitiale = $_POST['prixi'];
    $PrixFinale = $_POST['prixf'];
    $DateFin = $_POST['date'];
    $typeLogement = $_POST['type'];

    $mysqli->query("UPDATE offres SET idLogement='$idLogement, promotion='$promotion, PrixInitiale='$PrixInitiale, PrixFinale='$PrixFinale, DateFin='$DateFin WHERE id=$id")
    or die($mysqli->error);
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    header('location: offres.php');

   }


?>