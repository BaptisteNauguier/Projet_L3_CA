<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8">
        <link href="../css/style.css" rel="stylesheet">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->	

        <title> Historique </title> <!-- Titre de la page -->
        
        <?php
            session_start();

            include('../bd.php');  #importation de la base de donnée
            $bdd = getBD();     
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
						<a class="nav-link active" href="../historique/historique.php">Historique</a>
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
								<a href='../session/profil.php'>Mon profil</a>
								<a href='../session/deconnexion.php'>Se deconnecter</a>
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
        <section class="hist">
		<h2 class="text-center titre">Historique des commerces visités</h2>	
		<?php
		
		if(isset($_SESSION['utilisateur'])){

            $hist = $bdd -> query('select commerce_alimentaire.*, historique.date FROM commerce_alimentaire, historique WHERE commerce_alimentaire.id_commerce=historique.id_commerce and id_UI='.$_SESSION['utilisateur']['id'].''); /*'.$_SESSION['client']['id'].'*/
			$row = $hist->rowCount();
			
			if($row>0){ ?>
        <div class="div_hist">
        <table class="t_hist">    <!-- création tableau -->
            <tr>
                <th class="t_hist">Nom établissement</th>
                <th class="t_hist">Adresse</th>
                <th class="t_hist">Code postal</th>
                <th class="t_hist">Etat sanitaire</th>
                <th class="t_hist">Coordonnée</th>
                <th class="t_hist">Date</th>
            </tr>

            
			<?php
            while ($r_hist = $hist -> fetch()) {

                echo  /* affichage des données sous forme de tableau*/
                '<tr>
                <td class="t_hist">'.$r_hist['nom_etablissement'].'</td>
                <td class="t_hist">'.$r_hist['Adresse'].'</td>
                <td class="t_hist">'.$r_hist['Code_postal'].'</td>
                <td class="t_hist">'.$r_hist['niveau_sanitaire'].'</td>
                <td class="t_hist">'.$r_hist['coordonnee'].'</td>
                <td class="t_hist">'.$r_hist['date'].'</td>
                </tr>';

            }

            $hist -> closeCursor();

            ?>

        </table>
        </div>
		<?php }else echo "Vous n'avez pas encore visité un commerce"; 
		}else echo "Vous devez <a href='../session/connexion.php'>vous connecter</a> pour acceder a votre historique."?>
        </section>
    </body>

</html>