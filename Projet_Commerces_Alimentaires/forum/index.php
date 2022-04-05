<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style.css" rel="stylesheet">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simboles -->
	<title>Forum</title>

<?php 
include('../bd.php');
$bdd = getBD();

session_start();


//id_commerce = 0, c'est pour differencier les avis "site" et les avis "commerces"
$rep = $bdd->query('select * from forum_ca ca INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = ca.id_UI  WHERE ca.id_commerce = 0'); 

$count = $rep ->rowCount(); //compter s'il y en a des resultats



?>
</head>
<body class="forum">

	<div class="img-background">

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
						<a class="nav-link active" href="#">Forum</a>
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
	<main>
		<h2 class="text-center titre">Forum</h2>
		<div class="avis">
			<h3 class="col">Votre avis nous intéresse !</h3>
			<?php if(isset($_SESSION['utilisateur'])) { ?> 
				<div class="col">
					<button id="open" class="ouvrir-fermer">
						<i class="fa fa-plus" aria-hidden="true"></i>
						Ajouter un commentaire
					</button>
					<button id="close" class="ouvrir-fermer">
						<i class="fa fa-minus" aria-hidden="true"></i>
						Fermer ajouter un commentaire
					</button> 
				</div>
			<?php } ?>
		</div>
		<b>Une remarque sur l'application? Echangez avec les utilisateur de EzFood</b>
		
		<!-- SI L'UTILISATEUR EST CONNECTE ON PEUT AJOUTER UN COMMENTAIRE -->
		<?php if(isset($_SESSION['utilisateur'])) { ?>
			<section class="frm-commentaire">
				<form action="commentaire.php" method="get" autocomplete="off">
					<div class="d-flex">
						<span class="text-light">Commentaire</span>
						<div class="col">
							<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
							<input type="hidden" value="add_commentaire"  name="status" id="status" >
							<div class="commen-textarea">
								<textarea id="commentaire" required name="commentaire" rows="4" cols="50"></textarea>
							</div>
							<div class="submit-input">
								<input type="submit" name="submit" value="Ajouter le commentaire">
							</div>
						</div>
					</div>		
				</form>
			</section>
		<?php } ?>
		<!-- ----------------------------------- -->
		
		<div class="avis mt-4">
            <?php 
				if($count > 0){ //si on a un commentaire afficher
					while ($ligne = $rep ->fetch()) {	
						?>					
						<div class="col-forum mb-4">
							<div class="avis">
								<div class="p-photo"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
								<p class="nom-date"><?php echo $ligne['pseudo']." " ?><small class="text-light"><?php echo date('d/m/Y H:i:s', strtotime($ligne['date'])); ?></small></p>
							</div> 
							<p><?php echo $ligne['avis'] ?></p>
							<?php if(isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['id'] == $ligne["id_UI"]){ ?>	
															
									<div class="supp-comm">		
										<form action="commentaire.php" method="get" autocomplete="off">										
											<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
											<input type="hidden" value="<?php echo $ligne["id_forum"] ?>"  name="id_forum" id="id_forum" >	
											<button type="submit" class="remove"><i class="fa fa-trash"></i></button>
											<input type="hidden" value="delete_commentaire" name="status" id="status" >
										</form>
									</div>								
							<?php } ?>
						</div>
			<?php
					}
				}else{ //si on a pas des commentaires
					echo "<p>Pas encore de commentaire! <a class='s-inscrire' href='inscription.php'>Soyez le premier</a></p>";
                }
                $rep ->closeCursor();  
            ?>
		</div>	
			
	</main>
	</div>
	<script>
	$(document).ready(function() {
		$("#close").css({"display": "none"});
		
        $("#open").click(function(){
			$(".frm-commentaire").css({"display": "block"});
			$("#close").css({"display": "block"});
			$("#open").css({"display": "none"});
		});
		
		$("#close").click(function(){
			$(".frm-commentaire").css({"display": "none"});
			$("#open").css({"display": "block"});
			$("#close").css({"display": "none"});
		});
	});
	</script>
</body>
</html>
