<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/style.css" rel="stylesheet">	
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->		
		<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>
		<title>Trouve ton commerce</title>
		<?php
			session_start();
					

			require('../bd.php');  #importation de la base de donnee
            $bdd = getBD();
		
			//variables
			
			$search = trim($_GET["s"]); //on recupere le texte de la bar de recherche (trim c'est pour enlever les espaces initiales et eviter des recherches vides)			
			$filtre = $_GET['filtre']; //on recupere le filtre (par defaut c'est la distance)
			if(isset($_GET['lat'])){
				$lat_utilisateur = $_GET['lat']; //latitude de l'utilisateur
				$lng_utilisateur = $_GET['lng']; //longitude de l'utilisateur
			}
		
			$word = explode(" ",$search); //On divise les differents mots recherchez qui sont separées par un espace

			$query_parts = array(); //On creer un tableau pour stocker les mots 
			
			foreach ($word as $val) { //Pour chaque mot on va la stocker dans le tableau avec la partie SQL
				$query_parts[] = "(Activite_etablissement LIKE '%".$val."%'
							OR nom_etablissement LIKE '%".$val."%'
							OR Code_postal  LIKE '%".$val."%'
							OR commune  LIKE '%".$val."%')";
			}

			$string = implode(' AND ' , $query_parts); //On divise chaque partie sql créé pour chaque mot avec AND
		
		
		
			if(isset($_GET['filtre']) && $search != ""){
				// la variable distance est la distance entre les coodonées de l'utilisateur et celle du commerce
				// {$string} est la variable créé pour stocker le WHERE 
				if($filtre == "distance"){
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance FROM commerce_alimentaire ca
						inner join activite ac ON ac.id_activite = ca.id_activite 
						inner join lieux li ON li.id_lieux = ca.id_lieux
						where {$string} ORDER BY ".$filtre." ASC");
				}else{
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance FROM commerce_alimentaire ca
						inner join activite ac ON ac.id_activite = ca.id_activite 
						inner join lieux li ON li.id_lieux = ca.id_lieux
						where {$string} ORDER BY ".$filtre." DESC,distance ASC");	
				}	
			}else{
				if($filtre == "distance"){
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance FROM commerce_alimentaire ca
						inner join activite ac ON ac.id_activite = ca.id_activite 
						inner join lieux li ON li.id_lieux = ca.id_lieux
						ORDER BY ".$filtre." ASC LIMIT 20");}

				elseif($filtre == "50km"){
					
					
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
					sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance 
					FROM commerce_alimentaire ca
					inner join activite ac ON ac.id_activite = ca.id_activite 
					inner join lieux li ON li.id_lieux = ca.id_lieux
					where (3959*acos(cos(radians({$lat_utilisateur})) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
					sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) <= 50 ORDER BY `distance` ASC ");
				}
				elseif($filtre == "50p"){
					
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance FROM commerce_alimentaire ca
						inner join activite ac ON ac.id_activite = ca.id_activite 
						inner join lieux li ON li.id_lieux = ca.id_lieux
						ORDER BY distance ASC LIMIT 50");
				}
				elseif($filtre == "traiteur" or $filtre == "restaurant" or $filtre == "glacier" or $filtre == "fromagerie" or $filtre == "chocolatier" or $filtre == "charcuterie" 
				or $filtre == "patisserie" or $filtre == "boulangerie" or $filtre == "poissonnerie" or $filtre == "boucherie"){
					$rep = $bdd->query("SELECT DISTINCT *, (3959*acos(cos(radians({$lat_utilisateur})) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
					sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance
					from commerce_alimentaire 
					inner join activite on commerce_alimentaire.id_activite = activite.id_activite
					inner join lieux li ON li.id_lieux = commerce_alimentaire.id_lieux
					where commerce_alimentaire.id_activite in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%".$filtre."%')
					ORDER BY distance ASC");
				}
				elseif($filtre == "autre"){
					$rep = $bdd->query("SELECT DISTINCT *, (3959*acos(cos(radians({$lat_utilisateur})) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
					cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
					sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance
					from commerce_alimentaire 
					inner join activite on commerce_alimentaire.id_activite = activite.id_activite
					inner join lieux li ON li.id_lieux = commerce_alimentaire.id_lieux
					where commerce_alimentaire.id_activite not in (SELECT activite.id_activite from activite where activite.Activite_etablissement LIKE '%boucherie%' 
					or activite.Activite_etablissement LIKE '%poissonnerie%' or activite.Activite_etablissement LIKE '%boulangerie%' or activite.Activite_etablissement LIKE '%patisserie%'
					or activite.Activite_etablissement LIKE '%charcuterie%' or activite.Activite_etablissement LIKE '%chocolatier%' or activite.Activite_etablissement LIKE '%fromagerie%'
					or activite.Activite_etablissement LIKE '%glacier%' or activite.Activite_etablissement LIKE '%restaurant%' or activite.Activite_etablissement LIKE '%traiteur%')
					ORDER BY distance ASC ");
				}
				else{
					$rep = $bdd->query("SELECT DISTINCT *,(3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance FROM commerce_alimentaire ca
						inner join activite ac ON ac.id_activite = ca.id_activite 
						inner join lieux li ON li.id_lieux = ca.id_lieux
						ORDER BY ".$filtre." DESC,distance ASC LIMIT 20");	
				}	
			}
			$row = $rep->rowCount();

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
						<a class="nav-link active" href="./">Trouve ton commerce</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../forum/index.php">Forum</a>
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
		<main class="mt-4">
		<!-- ------ FORMULAIRE DE RECHERCHE ------ -->
		<form action="search.php" method="GET">
			<div class="search-container">
				<button type="submit"><i class="fa fa-search"></i></button>
				<input type="text" id="s" placeholder="Recherchez votre commerce" value="<?php echo $search ?>" name="s">
				<a class="decorationNone" href="../recherche_restaurant/filtrer1.php"><i class="fa fa-sliders" aria-hidden="true"></i> Filtre</a>				
				<?php if(isset($_SESSION['utilisateur'])){ ?>
						<input type="hidden" name="lat" class="lat" value="<?php echo $_SESSION['utilisateur']['lat'] ?>" /> 
						<input type="hidden" name="lng" class="lng" value="<?php echo $_SESSION['utilisateur']['lng'] ?>"/>
					<?php }else{?>
						<input type="hidden" name="lat" class="lat"  /> 
						<input type="hidden" name="lng" class="lng" />
					<?php }?>
			</div>
			<!-- ------ FIN FORMULAIRE DE RECHERCHE ------ -->
			
			<div class="d-flex mt-4">
				<div class="col">
				<?php echo "<span class='ml-4'>".$row." résultat(s) pour \"".$search."\"</span>"; ?>
				</div>
				<div class="col filtrer">
					<div class="right">
						<i class="fa fa-sliders" aria-hidden="true"></i>
						<select id="filtre" name="filtre">
							<?php if($filtre == "niveau_sanitaire"){ ?>
							<option value="distance" >Commerces les plus proches</option>
							<option value="niveau_sanitaire" selected>Etat sanitaire</option>
							<?php }else{ ?>
							<option value="distance" selected>Commerces les plus proches</option>
							<option value="niveau_sanitaire">Etat sanitaire</option>
							<?php } ?>
							
						</select>
					</div>
				</div>
			</div>
		</form>	
		<?php
		if($row > 0){
		?>
		<div class='cards'>
			<?php while ($mat = $rep->fetch()) { 
				$str_arr = explode (",", $mat["coordonnee"]); 
				$lat = $str_arr[0];
				$lng = $str_arr[1];
				$adresse = mb_strtolower($mat["Adresse"],"UTF-8");
				if(isset($_SESSION['utilisateur'])){
					$query_favori = $bdd->query("SELECT * FROM favori fa WHERE fa.id_UI = {$_SESSION['utilisateur']['id']} AND fa.id_commerce = {$mat["id_commerce"]} ");
					$favori = $query_favori->fetch();
					$row_favori = $query_favori->rowCount();
				}
			?> 			
			<article class="card">
				
					<div class="overlay">

						<?php if(isset($_SESSION['utilisateur'])){ ?>				
						<div class="heart">
							<input type="hidden" value="<?php echo $_SESSION['utilisateur']['id'] ?>"  name="id_ui" id="id_ui" >
							<input type="hidden" value="<?php echo $mat["id_commerce"] ?>"  name="id_commerce" id="id_commerce" >
							<?php if($row_favori == 1){ ?>
								<i class="fa fa-heart" aria-hidden="true"></i><br>
							<?php }else{ ?>
								<i class="fa fa-heart-o" aria-hidden="true"></i><br>
							<?php } ?>
							<b>Favori</b>
						</div>					
						<div class="line"></div>
						<a class="a-none" href="../page_commerce/page_commerce.php?id_commerce=<?php echo $mat['id_commerce']?>">
							<div class="plus">						
								<i class="fa fa-plus" aria-hidden="true"></i><br>
								<b>Voir plus</b>
							</div>
						</a>
						<?php }else{ ?>
						<a class="a-none" href="../page_commerce/page_commerce.php?id_commerce=<?php echo $mat['id_commerce']?>">
							<div class="plus alone">						
								<i class="fa fa-plus" aria-hidden="true"></i><br>
								<b>Voir plus</b>
							</div>
						</a>
						<?php } ?>

					</div>
				<?php $str= $mat["Activite_etablissement"]; ?>
				<header>
					<div class="text-fixed">
						<h2><?php echo $mat["nom_etablissement"]?></h2>
						<b><?php echo ucwords($adresse).", ".$mat["Code_postal"].", ".$mat["commune"] ?></b>
					</div>	
					
				</header>    
				<div class="content">
					<div class="col">
						<b>
							<?php 
							if(strlen($str)==62){
								echo substr($str, 0, 31). ' ' . substr($str, 31);
							}else echo $str;
							?>
						</b>
						<?php 
						$distance_utilisateur_commerce = round($mat["distance"],2);
						$temps = 340*$distance_utilisateur_commerce/60;
						echo "<div class='di-te'>";
						if($temps<60){
							echo round($temps,0)."-".round($temps+2,0). " min | ";
						}else if($temps>1440){
							$temps = $temps/60/24;
							echo round($temps,0)."-".round($temps+2,0). " jours | ";
						}else{
							$temps = $temps/60;
							echo round($temps,0)."-".round($temps+2,0). " hs | ";
						}
						echo $distance_utilisateur_commerce." km</div>"; ?>
					</div>
					<div class="line-grey"></div>
				<div class="col sani">
					<b>Evaluation sanitaire</b>
					<span class="text-grey"><?php echo $mat["niveau_sanitaire"] ?></span>
				</div>
				</div>
					
			</article>
		 <?php 
        }
		echo '</div>';
		}else{
			echo '<p>Pas de resultats</p>';
		}
		'</main>';
        $rep ->closeCursor();
        ?>

   </body>
   
   <script>
   
   $(document).ready( function() {
	    navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});
		$(".d-none").css("display", "none");

		 $(function() {
			$('#filtre').change(function() {
			this.form.submit();
			});
		});
		
		$(function () {
			$('.heart').on('click', function () {	
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
							$(this).find(".fa").addClass("fa-heart");
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
							$(this).find(".fa").addClass("fa-heart-o");
							$(this).find(".fa").removeClass("fa-heart");
						});
				}
			});
		});
			
    });
	
</script>
	
</html>