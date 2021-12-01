<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Gestion Offres</title>

</head>
<body>
 <h1>Ajouter un Offre</h1>
 <?php require_once 'AjoutOffres.php';?>
 <?php
if (isset($_SESSION['message'])): ?>
<div class="alert alert-<?=$_SESSION['msg_type']?>" >
<?php 
echo $_SESSION['message'];
unset($_SESSION['message']);
?>
</div>
<?php endif ?>
 <div class="container">
 <?php $mysqli = new mysqli('localhost','root','','projet_web') or die(mysqli_error($mysqli));
 $result = $mysqli->query("SELECT * FROM offres") or die($mysqli->error);
 //pre_r($result);
 ?>
 <div class="row justify-content-center">
     <table class="table">
         <thead>
             <tr>
                 <th>IdLogement</th>
                 <th>Type de Logement</th>
                 <th>Promotion</th>
                 <th>Prix Initilae</th>
                 <th>Prix Finale</th>
                 <th>La date </th>
                 <th colspan="2">Action</th>
             </tr>
        </thead>    
        <?php
        while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['idLogement']; ?></td>
            <td><?php echo $row['promotion']; ?></td>
            <td><?php echo $row['PrixInitiale']; ?></td>
            <td><?php echo $row['PrixFinale']; ?></td>
            <td><?php echo $row['DateFin']; ?></td>
            <td><?php echo $row['typeLogement']; ?></td>
            <td>
                <a href="offres.php?edit=<?php echo $row['id'];?>"
                class="btn btn-info">Edit</a>
                <a href="AjoutOffres.php?delete=<?php echo $row['id']; ?>" 
                class="btn btn-danger">Delete</a>
            </td>
        </tr>
         <?php endwhile; ?>
     </table>
     </div>
 <?php  

 function pre_r( $array ) {
     echo '<pre>';
     print_r($array);
     echo '</pre>';
 }
 ?>
 <div class="row justify-content-center">
    <form action="AjoutOffres.php" method="post"> 
        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
     <div class="form-group" >
    <label for="type">Ajouter le type de logement</label>
    <input id="type" type="text" name="type" class="form-control" 
    value="<?php echo $typeLogement ?>" placeholder="Enter the type">
    </div>
    <div class="form-group" >
    <label for="idLogement">Ajouter un Idlogement</label>
    <input id="idl" type="text" name="idl" class="form-control" 
    value="<?php echo $idLogement ?>" placeholder="Enter Id">
    </div>
    <div class="form-group" >
    <label for="promo">Ajouter une promotion</label>
    <input id="pr" type="text" name="promo" class="form-control" 
    value="<?php echo $promotion ?>" placeholder="Enter the promotion">
    </div>
    <div class="form-group" >
    <label for="prixi">Ajouter le prix initiale</label>
    <input id="pri" type="text" name="prixi" class="form-control" 
    value="<?php echo $PrixInitiale ?>" placeholder="Enter the First price">
    </div>
    <div class="form-group" >
    <label for="prixf">Ajouter le prix finale</label>
    <input id="prf" type="int"name="prixf" class="form-control" 
    value="<?php echo $PrixFinale ?>" placeholder="Enter the promo Price">
    </div>
    <div class="form-group" >
    <label for="date">Ajouter une date</label>
    <input id="date" type="date" name="date" 
    value="<?php echo $DateFin ?>" class="form-control">
    </div>
    
    <div class="form-group">
    <?php 
    if ($update == true):
    ?>
    <button type="submit" class="btn btn-info" name="update">Update</button>
    <?php else: ?>
    <button type="submit" class="btn btn-primary"  name="save">Save</button>
    <?php endif; ?>
</div>
    

    </div>
    </form>
    </div>
    </div>
</body>

</html>
