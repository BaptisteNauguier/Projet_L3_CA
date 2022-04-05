<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>

        <title>Mon profil</title>
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
						<a class="nav-link active dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
						<div class="dropdown-content">
								<a href='#'>Mon profil</a>
								<a href='./deconnexion.php'>Se deconnecter</a>
						</div>
					</li>
					<?php }else{ ?>
					<li class="nav-item">
						<a class="nav-link" href="#">Se connecter</a>
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
		<h2 class="text-center">Mes informations</h2>
		<?php if(isset($_SESSION['utilisateur'])) { 
			$profil = $bdd->query("SELECT * FROM utilisateurs_inscrit WHERE id_UI = {$_SESSION['utilisateur']['id']}");	
			$row = $profil->fetch();
		?>
			<p class="alert erreur text-center"><?php if(isset($_GET['message'])) echo $_GET['message'] ?></p>
			<p class="alert verification text-center"><?php if(isset($_GET['verification'])) echo $_GET['verification'] ?></p>		
			<b class="important">*Seul le pseudo et le mot de passe peuvent être modifié</b>
			<form action="modification.php" method="post" autocomplete="off">
					<div class="d-flex">
						<div class="col">
							<span class="text-light">Nom</span>
							<div class="con-input">
								<i class="fa fa-user-o ml-3" aria-hidden="true"></i>	
								<input type="text" name="n" disabled value="<?php echo $row['nom'] ?>" placeholder="Pierre"/>
							</div>
						</div>
						<div class="col ml-3">
							<span class="text-light">Prénom</span>
							<div class="con-input">
								<i class="fa fa-user-o ml-3" aria-hidden="true"></i>	
								<input type="text" name="p" disabled value="<?php echo $row['prenom'] ?>" placeholder="Jacques"/>
							</div>
						</div>
					</div>
					

					<span class="text-light">Nom d'utilisateur</span><br>
					<div class="con-input">
						<i class="fa fa-smile-o ml-3" aria-hidden="true"></i>						
						<input type="text" name="pseudo" value="<?php echo $row['pseudo'] ?>" placeholder="Soyez créatifs!"/>
					</div>

					<span class="text-light">Adresse email</span><br>
					<div class="con-input">
						<i class="fa fa-envelope-o ml-3" aria-hidden="true"></i>						
						<input type="mail" name="mail" disabled value="<?php echo $row['mail'] ?>" placeholder="nom@mail.com"/>
					</div>

					<span class="text-light">Ancien mot de passe</span><br>
					<div class="con-input">
						<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
						<input type="password" name="mdp1" value=""/>
					</div>
					

					<span class="text-light">Nouveau mot de passe	</span><br>
					<div class="con-input">
						<i class="fa fa-lock ml-3" aria-hidden="true"></i>	
						<input type="password" name="mdp2" value=""/>
					</div>

					<div class="submit-input mb-4">
						<input type="submit" name="submit" id="modifier" value="Modifier mon profil">
					</div>
				</form>
		<?php } else{ ?>
			<p>Vous n'êtes pas connecté! <a href="./connexion.php">Se connecter</a> ou  <a href="../compte/inscription.php">s'incrire</a></p>
		<?php } ?>
		</main>
    
    </body>
   
   <script>
   
   $(document).ready( function() {
	    navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});

			if($(".alert").text() == "Le profil a été modifié"){			
				$(".verification").show().delay(4000).fadeOut();
			}else{
				$(".erreur").show().delay(4000).fadeOut();
			}
		
			 if ($('.erreur').is(':empty')) {
				$(".erreur").hide();
			 }
		
    });
	
</script>
</html>