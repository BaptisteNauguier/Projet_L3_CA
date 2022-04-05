<!DOCTYPE html>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="css/style.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->	

        <title> Commerces Alimentaires </title> <!-- Titre de la page -->

        <?php
        	session_start();

            include('bd.php');  #importation de la base de donnée
            $bdd = getBD();     
        ?>
    
    </head>

    <body>
        <header class="head-index">
        <h1 id="t-index">    
            Bienvenue ! 
        </h1>
        
        <!-- MENU -->
    <nav class="navbar row">
			<div class="col-1">
				<ul class="navbar-ul">
					<li class="nav-item">
						<a class="nav-link active" href="#"><i class="fa fa-home"></i></a>
					</li>
				</ul>
			</div>
			<div class="col-2 text-center">
				<ul class="navbar-ul">
					<li class="nav-item">
						<a class="nav-link" href="trouve/">Trouve ton commerce</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="forum/">Forum</a>
					</li>
					<?php if(isset($_SESSION['utilisateur'])) { ?>
					<li class="nav-item">
						<a class="nav-link" href="historique/historique.php">Historique</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="favori/">Favori</a>
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
								<a href='session/profil.php'>Mon profil</a>
								<a href='session/deconnexion.php'>Se deconnecter</a>
						</div>
					</li>
					<?php }else{ ?>
					<li class="nav-item">
						<a class="nav-link" href="session/connexion.php">Se connecter</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="compte/inscription.php">S'inscrire</a>
					</li>
				<?php } ?>
				</ul>
			</div>
    </nav>
	<!-- FIN MENU -->
	
        </header>                    
        <h2 id="t2-index">
            Les plus populaires:
        </h2>

        <section class="main-index">
                <?php

                    $id = $bdd -> query('Select id_commerce FROM historique GROUP BY id_commerce ORDER BY COUNT(id_commerce) DESC LIMIT 3'); /* importation de l'id des commerces populaires */

                    while ($r_id = $id -> fetch()) {

                        $donnee = $bdd -> query('Select DISTINCT commerce_alimentaire.id_commerce, commerce_alimentaire.nom_etablissement, commerce_alimentaire.coordonnee, commerce_alimentaire.niveau_sanitaire, lien_map.lien
												FROM commerce_alimentaire, lien_map
												WHERE lien_map.id_commerce=commerce_alimentaire.id_commerce
												AND commerce_alimentaire.id_commerce='.$r_id['id_commerce'].'
                                                '); /* importation des données */


                        while ($r_donnee = $donnee -> fetch()) {
							$commentaire = $bdd -> query('SELECT * FROM commerce_alimentaire ca
													INNER JOIN forum_ca fo ON fo.id_commerce = ca.id_commerce
													INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = fo.id_UI
													WHERE ca.id_commerce='.$r_donnee['id_commerce'].'
													ORDER BY id_forum DESC LIMIT 1');
							$r_commentaire = $commentaire -> fetch();
							
							$c_commentaire = $commentaire->rowCount();
                            echo 
                            '
                            <div class="plus-pop"><h3>'.$r_donnee['nom_etablissement'].'</h3>
                            <p> Page du commerce :
                            <a href="page_commerce/page_commerce.php?id_commerce='.$r_donnee['id_commerce'].'">Voir le commerce</a> </p>
                            '.$r_donnee['lien'].'
                            <div class="block">
                            <div class="avis">
                            <p> <span class="underline"> Dernière avis client</span><br><br>';
							if($c_commentaire > 0){ ?>
								<span class="nom-date"> <?php echo $r_commentaire['pseudo'] ?></span> </br>
                            <?php echo $r_commentaire['avis'] ?></p>
							<?php }else echo "Pas encore d'avis" ?>
                            </div>
							<div class="line"></div>
                            <div class="etat">
                            <p> <span class="underline"> Etat sanitaire </span><br><br>
							<b><?php echo $r_donnee['niveau_sanitaire'] ?></b></p>
                            </div>
                            </div>
                            </div>
					<?php
                        }
                        $donnee -> closeCursor();

                    }
                    $id -> closeCursor();
                
                ?>

    </section>
    </body>

</html>