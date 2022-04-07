<!DOCTYPE html>

<html>

    <head>
        <link rel="stylesheet" href="css/style_mdp_oublie.css" type="text/css" media="screen" />
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
        <title> Mot de passe oublié </title>

        <?php

            include('../bd.php');
            $bdd = getBD();

            session_start();
    
            if ($_GET['q'] == ""){
            }
            else {
                echo '<script> alert("'.$_GET['q'].'"); </script>';
            }  
        ?>
    
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
            <h2 class="text-center"> Vous avez oublié votre mot de passe ? </h2>
            
            <form action="mail.php" method="get" autocomplete="off">
                <span class="text-light">
                    Adresse mail :
                </span>
                <div class="con-input">
                <input type="text" name="mail" value=""/>
                </div>
            
                <span>
                Nous allons envoyer un mail avec un lien pour réinitialiser votre mot de passe.
                </span>
                <div class="submit-input mb-4">
                <input type="submit" value="Envoyer">
                </div>

            </form>
        </main>
            
    </body>

</html>