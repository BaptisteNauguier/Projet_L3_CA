<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>

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
								<a href='./profil.php'>Mon profil</a>
								<a href='./deconnexion.php'>Se deconnecter</a>
						</div>
					</li>
					<?php }else{ ?>
					<li class="nav-item">
						<a class="nav-link active" href="#">Se connecter</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../compte/inscription.php">S'inscrire</a>
					</li>
				<?php } ?>
				</ul>
			</div>
    </nav>
	<!-- FIN MENU -->

        <main> 
		<h2 class="text-center">Connexion</h2>
		<p class="alert erreur text-center"><?php if(isset($_GET['message'])) echo $_GET['message'] ?></p>
		<?php if(isset($_SESSION['utilisateur'])) { ?>
			<p>Vous êtes déjà connecté! <a href="../trouve/">Commencez votre recherche</a></p>
		<?php } else{ ?>
			<section class="frm-connexion">			
				<form action="connecter.php" method="post" autocomplete="off">
					
					<span class="text-light">Adresse e-mail</span><br>
					<div class="con-input">
						<i class="fa fa-envelope-o ml-3" aria-hidden="true"></i>	
						<input type="text" required name="mail" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="L'adresse mail n'est pas valide" name="mail" value="" placeholder="nom@mail.com"/>
					</div>
					<span class="text-light">Mot de passe</span><br>					
					<div class="con-input">
						<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
						<input type="password" required name="mdp" value=""/>
					</div>
					<input type="hidden" name="lat" class="lat" /> 
					<input type="hidden" name="lng" class="lng" />
					<div class="submit-input">
						<input type="submit" name="submit" value="Se connecter">
					</div>

				</form>				
				<p class="text-center">
					Pas encore inscrit? <a class="s-inscrire" href="../compte/inscription.php">S'inscrire</a>
				</p>
			</section>
			<?php }?>
		</main>
    
    </body>
   
   <script>
   
   $(document).ready( function() {
	    navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});
		
		if($(".alert").is(':empty')){			
			$(".erreur").hide();
		}else{
			$(".erreur").show().delay(4000).fadeOut();
		}
    });
	
</script>
</html>