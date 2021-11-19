
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Offres</title>

</head>
<body>
 <h1>Ajouter un Offre</h1>
    <form action="AjoutOffres.php" method="post">  
    <p>
    <label for="idLogement">Ajouter un Idlogement</label>
    <input id="idl" type="text" name="idl">
    </p>
    <p>
    <label for="promo">Ajouter une promotion</label>
    <input id="pr" type="text" name="promo">
    </p>
    <p>
    <label for="prixi">Ajouter le prix initiale</label>
    <input id="pri" type="text" name="prixi">
    </p>
    <p>
    <label for="prixf">Ajouter le prix finale</label>
    <input id="prf" type="int"name="prixf">
    </p>
    <p>
    <label for="date">Ajouter une date</label>
    <input id="date" type="text" name="date">
    </p>
    <p>
    <label for="type">Ajouter le type de logement</label>
    <input id="type" type="text" name="type">
    </p>
    <p> 
    <input type="submit" value="Enregistrer">
    </p>
    

   
    </form>
</body>

</html>
