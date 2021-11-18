<?php
$page_titre = "Login";
 include "./includes/header.php";
 if (isset($_SESSION['email'])) {
 	header("Location: ./profil.php");
 }
 if(isset($_POST['formconnexion'])) {
 	$email = htmlspecialchars($_POST['email']);
 	$password = sha1($_POST['password']);
 	if(!empty($email) AND !empty($password)) {
 		$requser = $bdd->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
 		$requser->execute(array($email, $password));
 		$userexist = $requser->rowCount();
 		if($userexist == 1) {
 			$userinfo = $requser->fetch();
 			$_SESSION['id'] = $userinfo['id'];
 			$_SESSION['email'] = $userinfo['email'];
 			header("Location: ./profil.php");
 		} else {
 			$erreur = "Votre email et/ou votre mot de passe sont incorrect !";
 		}
 	} else {
 		$erreur = "Tout les champs doivent être complété ! ";
 	}
 }





  ?>

<br/><br/>
<div class="container connection">
		<div class="input-lg">
			<div class="card">
				<div class="card-header">
					<h1 class= "text-center"> Connection </h1>
				</div>
				<div class="card-body">
					<div class="container text-center">
				<?php if(isset($erreur)) {
				echo '<div class="alert alert-danger" role="alert"> Une erreur est survenu lors de la connection a votre compte :' .$erreur.'</div>';
				} ?>
					<form method="POST" class="form-row col-lg-offset-4">
            <div class="row text-center">
						<div class="col-md-6 container">
							<input type="email" id="email" class="form-control rounded" name="email" placeholder="Email" required />
						</div>
            <br/>
						<div class="col-md-6 container">
							<input type="password" class="form-control rounded" id="password" name="password" placeholder="Mot de passe" required />
						<br/>
						</div>
						<div class="container-fluid">
							<button type="submit" class="btn btn-success" name="formconnexion">Se connecter </button>
							<a type="button" class="btn btn-primary" href="./register.php"> S'inscrire </a> <br/>
						</div>
          </div>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div><br/><br/>

<?php include "./includes/footer.php"; ?>
