<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style.css" rel="stylesheet">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->	
	<script src="https://d3js.org/d3.v7.min.js"></script>
	<script type="text/javascript" src="../js/location.js"></script>
	<title>Trouve ton commerce</title>

<?php 
include('../bd.php');
$bdd = getBD();

session_start();

$rep = $bdd->query('select ca.id_activite, ac.Activite_etablissement, count(*) as populaires 
from commerce_alimentaire ca 
INNER JOIN activite ac ON ac.id_activite = ca.id_activite 
group by Activite_etablissement order by populaires DESC limit 13');


?>
</head>
<body class="trouve">

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
						<a class="nav-link active" href="#">Trouve ton commerce</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../forum/index.php">Forum</a>
					</li>
					<?php if(isset($_SESSION['utilisateur'])) { ?>
					<li class="nav-item">
						<a class="nav-link" href="../historique/historique.php">Historique</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../historique/historique.php">Favori</a>
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
			<h2 class="text-center titre mt-4">Trouve ton commerce</h2>
			<div class="search-container">
				<form action="search.php" method="GET">
					<button type="submit"><i class="fa fa-search"></i></button>
					<input type="text" id="s" placeholder="Recherchez votre commerce" name="s">							
					<input type="hidden" name="lat" class="lat" id="lat" /> 
					<input type="hidden" name="lng" class="lng" id="lng"/>
					<input type="hidden" name="filtre" id="filtre" value="distance" />
				</form>		
			</div>
			<div id="d3-container"></div>
		</main>
	</div>
	
	   <script>
   
   $(document).ready(function() {
        navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true});	
	});
		const lat = document.getElementById("lat").value;
		const lng = document.getElementById("lng").value;

		d3.csv('./ocurrences.csv')
		.then(data => {
			
			BubbleChart(data, {
			  label: d => [d.Activite, d.populaires].join("\n"),
			  value: d => d.populaires,
			  group: d => d.categorie,
			  title: d => [d.Activite, d.populaires].join("\n"),
			  link: d => `../trouve/search.php?s=${d.Activite}&lat=46.7111&lng=1.7191&filtre=distance`,
			  width: 950
			})
		})
		.catch(error => {
			console.error('Error loading the data');
		});
	
	</script>
	
</body>
</html>