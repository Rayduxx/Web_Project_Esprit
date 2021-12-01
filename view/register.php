<?php
$page_titre="Inscription";
include './includes/header.php';

if (isset($_SESSION['name'])) {
	header("Location: /index.php");
} else {

if(isset($_POST['forminscription'])) {
	$email = htmlspecialchars($_POST['email']);
	$email2 = htmlspecialchars($_POST['email2']);
  $prenom = htmlspecialchars($_POST['prenom']);
  $nom = htmlspecialchars($_POST['nom']);
	$password = sha1($_POST['password']);
	$password2 = sha1($_POST['password2']);
	if(!empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['password']) AND !empty($_POST['password2'])) {
		$namelength = strlen($prenom);
    	$nomlength = strlen($nom);
		if( $namelength <= 255 && $nomlength <= 255) {
			if($email == $email2) {
				if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$reqemail = $bdd->prepare("SELECT * FROM users WHERE email = ?");
					$reqemail->execute(array($email));
					$mailexist = $reqemail->rowCount();
					if($mailexist == 0) {
							if($password == $password2) {
								 $insertmbr = $bdd->prepare("INSERT INTO users(nom, prenom, password, email) VALUES(?, ?, ?, ?)");
								 $insertmbr->execute(array($nom, $prenom, $password, $email));
								 $success = "Votre compte a été crée avec succés !";
							} else {
                $erreur = "les mots de passes sont different !";
              }
					} else {
						$erreur = "l'adresse email saisis est deja utilisé";
					}
				} else {
					$erreur = "Votre addresse email n'est pas valide !";
				}
			} else {
				$erreur = "les adresses email rentré ne correspondent pas !";
			}
		} else {
			$erreur = "Votre pseudonyme doit faire moins de 255 characteres !";
		}
	} else {
		$erreur = "Les champs sont incomplet !";
	}
}


?>
<br/><br/>
	<div class="container">
		<div class="input-lg">
			<div class="card">
				<div class="card-header">
					<h1 class= "text-center"> Inscription </h1>
				</div>
				<div class="card-body">
				<form method="POST">
					<div class="row text-center">
					<?php if(isset($erreur)) {
						echo '<div class="col-md-12 container"><div class="alert alert-danger" role="alert"> Une erreur est survenu lors de votre inscription :' .$erreur.'</div></div>';
					}?>
					<?php if(isset($success)) {
						echo '<div class="col-md-12 container"><div class="alert alert-success" role="alert">' .$success.'<a href="/login"> Connectez vous</a></div></div>';
					}?>
						<div class="col-md-6 container">
							<input type="text" id="nom" class="form-control rounded" name="nom" placeholder="Nom" required /><br/><br/>
							<input type="email" class="form-control rounded" id="email" name="email" placeholder="Adresse email" required /> <br/><br/>
							<input type="email" class="form-control rounded" id="email2" name="email2" placeholder="Confirmation de votre adresse email" required /><br/><br/>
						</div>
						<div class="col-md-6 container">
              <input type="text" id="prenom" class="form-control rounded" name="prenom" placeholder="Prenom" required /><br/><br/>
							<input type="password" class="form-control rounded" id="password" name="password" placeholder="Mot de passe" required /><br/><br/>
							<input type="password" class="form-control rounded" id="password2" name="password2" placeholder="Confirmation de mot de passe" required />
						</div>
						<div class="container-fluid">
							<button type="submit" name="forminscription" class="btn btn-success">S'inscrire </button>
							<a type="button" class="btn btn-primary" href="./login.php"> Se Connecter </a>
							<button type="reset" class="btn btn-danger"> Restaurez les champs </button><br/>


						</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div><br/><br/>

<?php include './includes/footer.php'; } ?>
