<!DOCTYPE html>

<html>

    <head>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>
        <title> Inscription </title>
    
    </head>
<?php 
	include('../bd.php');
	$bdd = getBD();

	session_start();

	?>

    <body>
	
		<!-- MENU -->
    <nav class="navbar row">
			<div class="col-1">
				<ul class="navbar-ul">
					<li class="nav-item">
						<a class="nav-link" href="../"><i class="fa fa-home"></i></a>
					</li>
				</ul>
			</div>
			<div class="col-2 text-center">
				<ul class="navbar-ul">
					<li class="nav-item">
						<a class="nav-link" href="../trouve/">Trouve ton commerce</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../forum/">Forum</a>
					</li>
					<?php if(isset($_SESSION['utilisateur'])) { ?>
					<li class="nav-item">
						<a class="nav-link" href="../historique/historique.php">Historique</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../favori/">Favori</a>
					</li>
					<?php  } ?>
				</ul>
			</div>
			<div class="col-3">
				<ul class="navbar-ul menu-right">
				<?php if(isset($_SESSION['utilisateur'])) { ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
						<div class="dropdown-content">
								<a href='./deconnexion.php'>Se deconnecter</a>
						</div>
					</li>
					<?php }else{ ?>
					<li class="nav-item">
						<a class="nav-link" href="../session/connexion.php">Se connecter</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="#">S'inscrire</a>
					</li>
				<?php } ?>
				</ul>
			</div>
    </nav>
	<!-- FIN MENU -->
	
	<main>
	
		<h2 class="text-center">Inscription</h2>
		<p class="alert erreur text-center"><?php if(isset($_GET['message'])) echo $_GET['message'] ?></p>
		<?php if(isset($_SESSION['utilisateur'])) { ?>
			<p>Vous êtes déjà connecté! <a href="../trouve/">Commencez votre recherche</a></p>
		<?php } else{ ?>
			<section class="frm-connexion">	
                
			<form action="enregistrement.php" method="post" autocomplete="off">
				<div class="d-flex">
					<div class="col">
						<span class="text-light">Nom</span>
						<div class="con-input">
							<i class="fa fa-user-o ml-3" aria-hidden="true"></i>	
							<input type="text" required name="n" value="<?php if(isset($_GET['n'])) echo $_GET['n'] ?>" placeholder="Pierre"/>
						</div>
					</div>
					<div class="col ml-3">
						<span class="text-light">Prénom</span>
						<div class="con-input">
							<i class="fa fa-user-o ml-3" aria-hidden="true"></i>	
							<input type="text" required name="p" value="<?php if(isset($_GET['p'])) echo $_GET['p'] ?>" placeholder="Jacques"/>
						</div>
					</div>
				</div>
				

				<span class="text-light">Nom d'utilisateur</span><br>
				<div class="con-input">
					<i class="fa fa-smile-o ml-3" aria-hidden="true"></i>						
					<input type="text" required name="pseudo" value="<?php if(isset($_GET['pseudo'])) echo $_GET['pseudo'] ?>" placeholder="Soyez créatifs!"/>
				</div>

				<span class="text-light">Adresse email</span><br>
				<div class="con-input">
					<i class="fa fa-envelope-o ml-3" aria-hidden="true"></i>						
					<input type="mail" required name="mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="L'adresse mail n'est pas valide" value="<?php if(isset($_GET['mail'])) echo $_GET['mail'] ?>" placeholder="nom@mail.com"/>
				</div>

				<span class="text-light">Mot de passe</span><br>
				<div class="con-input">
					<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
					<input type="password" required name="mdp1" value=""/>
				</div>
				

				<span class="text-light">Confirmation mot de passe	</span><br>
				<div class="con-input">
					<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
					<input type="password" required name="mdp2" value=""/>
				</div>

				<div class="submit-input">
					<input type="submit" name="submit" value="S'incrire">
				</div>
			</form>
			
				<p class="text-center">
					Vous avez déjà un compte? <a class="s-inscrire" href="../session/connexion.php">Se connecter</a>
				</p>
			</section>
		<?php }?>
	</main>
	
	 <script>
   
   $(document).ready( function() {
			 if ($('.erreur').is(':empty')) {
				$(".erreur").hide();
			 }else{
				$(".erreur").show().delay(4000).fadeOut(); 
			 }
		
    });
	
</script>
	
    </body>

</html>