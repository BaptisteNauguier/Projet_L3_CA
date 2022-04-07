<!DOCTYPE html>

<html>

    <head>

        <title> Changement mot de passe</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
		<script type="text/javascript" src="../js/location.js"></script>
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>

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
						<a class="nav-link" href="../session/connexion.php">Se connecter</a>
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
		<h2 class="text-center">Changement de mot de passe</h2>
        <p class="alert erreur text-center"><?php if(isset($_GET['message'])) echo $_GET['message'] ?></p>
		<p class="alert verification text-center"><?php if(isset($_GET['verification'])) echo $_GET['verification'] ?></p>	
        <form action="mdp.php" method="post" autocomplete="off">

            <span class="text-light">Nouveau mot de passe</span><br>
            <div class="con-input">
                <i class="fa fa-lock ml-3" aria-hidden="true"></i>	
                <input type="password" name="mdp1" value=""/>
            </div>
            

            <span class="text-light">Réécrire le nouveau mot de passe</span><br>
            <div class="con-input">
                <i class="fa fa-lock ml-3" aria-hidden="true"></i>	
                <input type="password" name="mdp2" value=""/>
            </div>

			<input type="hidden" name="hidden-id" value="<? echo $_GET['id']; ?>"/>

            <div class="submit-input mb-4">
                <input type="submit" name="submit" id="modifier" value="Modifier mon profil">
            </div>
		</form>
    
    </main>

    </body>

	<script>
   
   $(document).ready( function() {
	    navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});

			if($(".alert").text() == "Le mot de passe a été modifié"){			
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