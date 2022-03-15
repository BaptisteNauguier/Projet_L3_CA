<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style_forum.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->

        <title>Se connecter</title>
        <meta charset="utf-8">

    </head> 
	
	<?php 
	include('../bd.php');
	$bdd = getBD();

	session_start();

	?>

    <body>
	
		<!-- MENU -->
		<nav class="navbar">
			<ul class="navbar-ul">
				<li class="nav-item">
					<a class="nav-link" href="../">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../trouve/index.php">Trouve ton commerce</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../forum/">Forum</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../historique/historique.php">Historique</a>
				</li>
				<?php if(isset($_SESSION['utilisateur'])) { ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
					<div class="dropdown-content">
							<a href='../session/deconnexion.php'>Se deconnecter</a>
					</div>
				</li>
				<?php }else{ ?>
				<li class="nav-item">
					<a class="nav-link active" href="#">Connecte-toi</a>
				</li>
				<?php } ?>
			</ul>
		</nav>
		<!-- FIN MENU -->

        <main> 
		<h2 class="text-center">Connexion</h2>
		<?php if(isset($_SESSION['utilisateur'])) { ?>
			<p>Vous êtes déjà connecté! <a href="../trouve/">Commencez votre recherche</a></p>
		<?php } else{ ?>
			<section class="frm-connexion">			
				<form action="connecter.php" method="post" autocomplete="off">
					
					<span class="text-light">Adresse e-mail</span><br>
					<div class="con-input">
						<i class="fa fa-envelope-o ml-3" aria-hidden="true"></i>	
						<input type="text" name="mail" value=""/>
					</div>
					<span class="text-light">Mot de passe</span><br>					
					<div class="con-input">
						<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
						<input type="password" name="mdp" value=""/>
					</div>
					<div class="submit-input">
						<input type="submit" name="submit" value="Se connecter">
					</div>

				</form>				
				<p class="text-center">
					Pas encore inscrit? <a class="s-inscrire" href="inscription.php">S'inscrire</a>
				</p>
			</section>
			<?php }?>
		</main>
    
    </body>

</html>