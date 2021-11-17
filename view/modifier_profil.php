<?php include './includes/profil_header.php';


if(isset($_POST['formModification'])){
    if(!empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom'])){
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);

        $namelength = strlen($nom);
        $prenomlength = strlen($prenom);
        if($namelength <= 255 && $prenomlength <= 255) {
            if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $update = $bdd->prepare('UPDATE users SET nom = ?, prenom = ?, email = ? WHERE id = ?');
                $update->execute(array($nom, $prenom, $email, $userinfo['id']));
                $success = "Votre Modification a été effectué avec succés";
                header('Location: ./profil.php');
            } else {
                $erreur = "l'adresse mail saisit n'est pas Valide !";
            }
        } else {
            $erreur = "le nom et prenom depasse les 255 charactéres !";
        }
    } else {
        $erreur = "Veuillez garder tout les champs remplis !";
    }
}
?>
    <form method ="POST">
        <div class="row text-center">
        <?php if(isset($erreur)) {
			    echo '<div class="col-md-12 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu lors de la modification de votre profil :' .$erreur.'</div></div>';
			}?>
	    <?php if(isset($success)) {
			echo '<div class="col-md-12 container"><div class="alert alert-success" role="alert">' .$success.'</div></div>';
		}?>
        <div class="col-md-6 container">
            <input type="text" id="nom" class="form-control rounded" name="nom"  value="<?php echo $userinfo['nom']; ?>" required/><br/><br/>
            <input type="text" id="prenom" class="form-control rounded" name="prenom"  value="<?php echo $userinfo['prenom']; ?>" required/><br/><br/>
            <input type="email" id="email" class="form-control rounded" name="email"  value="<?php echo $userinfo['email']; ?>" required/><br/><br/>
            <button type="submit" name="formModification" class="btn btn-success">Modifier Profil </button>
        </div>
    </div>
    </form>

</div>
<br/><br/><br/>
<?php include './includes/footer.php';?>