<!DOCTYPE html>
<html lang = "fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simboles -->
		<?php
			include('../bd.php');
			$bdd = getBD();
			session_start();
			
			
			if(isset($_GET['id_commerce'])){
				$id = $_GET['id_commerce'];	
				
				if(isset($_SESSION['utilisateur'])){
					$historique = $bdd->query("INSERT INTO historique (id_UI, id_commerce) VALUES ({$_SESSION['utilisateur']['id']}, {$id})");
				}else{
					$historique = $bdd->query("INSERT INTO historique (id_UI, id_commerce) VALUES (0, {$id})");
				}
			}else{                                                                                                                                    
				echo '<meta http-equiv="Refresh" content="0; URL=../index.php">';
			}
				$donnee = $bdd -> query('Select DISTINCT *
				FROM commerce_alimentaire ca
				INNER JOIN activite ac ON ac.id_activite = ca.id_activite
				INNER JOIN lieux li ON li.id_lieux = ca.id_lieux
				INNER JOIN lien_map lm ON ca.id_commerce = lm.id_commerce
				WHERE ca.id_commerce='.$id.''); /* importation des données */

				$r_donnee = $donnee -> fetch();
				
				$avis = $bdd->query("SELECT * FROM forum_ca fo INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = fo.id_UI WHERE id_commerce = {$r_donnee['id_commerce']}"); 
			
		?>
		<title><?php echo ucwords(mb_strtolower($r_donnee['nom_etablissement'])) ?></title>
		
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
			
			<div class="d-flex">
				<div class="col">
					<h1><?php echo ucwords(mb_strtolower($r_donnee['nom_etablissement']))?> </h1>
				</div>	
				<?php if(isset($_SESSION['utilisateur'])){ 
					$query_favori = $bdd->query("SELECT * FROM favori fa WHERE fa.id_UI = {$_SESSION['utilisateur']['id']} AND fa.id_commerce = {$r_donnee["id_commerce"]} ");
					$favori = $query_favori->fetch();
					$row_favori = $query_favori->rowCount();
				?> 
					<div class="col like">				
						<?php if($row_favori == 1){ ?>
							<button class="btn-delete-favori btn">							
								<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
								<input type="hidden" value="<?php echo $r_donnee["id_commerce"] ?>"  name="id_commerce" id="id_commerce" >	
								<i class="fa fa-heart" aria-hidden="true"></i><span> Supprimer des favoris </span>
							</button>
						<?php }else{ ?>
							<button class="btn-favori btn">							
								<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
								<input type="hidden" value="<?php echo $r_donnee["id_commerce"] ?>"  name="id_commerce" id="id_commerce" >	
								<i class="fa fa-heart-o" aria-hidden="true"></i><span> Ajouter aux favoris </span>
							</button>
						<?php } ?>
					</div>	
				<?php } ?>				
			</div>
			<div class="d-flex">
				<div class="col">
				<?php echo $r_donnee['lien'] ?>
				</div>
				<div class="col">
				<p> <?php echo $r_donnee['Activite_etablissement']?></p>
				<p>	<?php echo ucwords(mb_strtolower($r_donnee["Adresse"])).", ".$r_donnee["Code_postal"].", ".$r_donnee["commune"] ?></p>
				<p> <b>Site internet : </b>
				<a href="https://www.google.com/search?q=<?php echo str_replace(array(':', '-', '/', '*', '"'), '', $r_donnee['nom_etablissement']); ?>+<?php echo $r_donnee['Adresse']?>"> lien site internet </a>  </p>
				<p><b>Etat sanitaire : </b>
				<?php echo $r_donnee['niveau_sanitaire']?></br></p>
				</div>
			</div>
			
			<?php if($avis->rowCount() > 0){ ?>
			<h3>Avis clients</h3>
			<div class="avis mt-4">
			<?php while($mat = $avis->fetch()){ ?>
				<div class="col-forum mb-4">
							<div class="avis">
								<div class="p-photo"><i class="fa fa-user-circle-o" aria-hidden="true"></i></div>
								<p class="nom-date"><?php echo $mat['pseudo']." " ?><small class="text-light"><?php echo date('d/m/Y H:i:s', strtotime($mat['date'])); ?></small></p>
							</div> 
							<p><?php echo $mat['avis'] ?></p>
							<?php if(isset($_SESSION['utilisateur']) && $_SESSION['utilisateur']['id'] == $mat["id_UI"]){ ?>	
															
									<div class="supp-comm">		
										<form action="commentaire.php" method="get" autocomplete="off">										
											<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
											<input type="hidden" value="<?php echo $r_donnee["id_commerce"] ?>"  name="id_commerce" id="id_commerce" >
											<input type="hidden" value="<?php echo $mat["id_forum"] ?>"  name="id_forum" id="id_forum" >	
											<button type="submit" class="remove"><i class="fa fa-trash"></i></button>
											<input type="hidden" value="delete_commentaire" name="status" id="status" >
										</form>
									</div>								
							<?php } ?>
						</div>
			<?php
			}
				}else{ //si on a pas des commentaires
					echo "<p>Pas encore de commentaire!</p>";
                }
                $avis ->closeCursor(); ?>
			</div>
							
		<!-- SI L'UTILISATEUR EST CONNECTE ON PEUT AJOUTER UN COMMENTAIRE -->
		<?php if(isset($_SESSION['utilisateur'])) { ?>
			<section class="commentaire mb-4">
				<form action="commentaire.php" method="get" autocomplete="off">
					<span class="text-light">Ajouter un avis</span>
					<div class="col">
						<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
						<input type="hidden" value="<?php echo $r_donnee["id_commerce"] ?>"  name="id_commerce" id="id_commerce" >
						<input type="hidden" value="add_commentaire"  name="status" id="status" >
						<div class="commen-textarea">
							<textarea id="commentaire" required name="commentaire" rows="4" cols="100"></textarea>
						</div>
						<div class="submit-input">
							<input type="submit" name="submit" value="Ajouter le commentaire">
						</div>
					</div>	
				</form>
			</section>
		<?php } ?>
		<!-- ----------------------------------- -->
		</main>
		
		<script>
			$(document).ready(function() {
				$(function () {
					$('.btn').on('click', function () {	
						var id_ui = $(this).find("#id_ui").val();
						var id_commerce = $(this).find("#id_commerce").val();
						if($(this).find(".fa").hasClass('fa-heart-o')){
							var status = "add_favori";
							$.ajax({
								type: "GET",
								url: "favori.php",
								context : this,
								data: {
									id_ui: id_ui,
									id_commerce: id_commerce,
									status: status
								},
								cache: false
								}).done(function(response) {
									$(this).addClass("btn-delete-favori");
									$(this).find(".fa").addClass("fa-heart");
									var text = $(this).find("span").text();
									$(this).find("span").text(text.replace("Ajouter aux", "Supprimer des")); 							
									$(this).removeClass("btn-favori");
									$(this).find(".fa").removeClass("fa-heart-o");
								});
						}else{
							var status = "remove_favori";
							$.ajax({
								type: "GET",
								url: "favori.php",
								context : this,
								data: {
									id_ui: id_ui,
									id_commerce: id_commerce,
									status: status
								},
								cache: false
								}).done(function(response) {
									$(this).addClass("btn-favori");
									$(this).find(".fa").addClass("fa-heart-o");
									var text = $(this).find("span").text();
									$(this).find("span").text(text.replace("Supprimer des", "Ajouter aux")); 
									$(this).removeClass("btn-delete-favori");
									$(this).find(".fa").removeClass("fa-heart");
								});
						}
					});
				});
			});
		</script>
	</body>
</html>