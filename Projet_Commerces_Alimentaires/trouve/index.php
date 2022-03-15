<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style_trouve.css" rel="stylesheet">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
	<title>Trouve ton commerce</title>

<?php 
include('../bd.php');
$bdd = getBD();

$rep = $bdd->query('select ca.id_activite, ac.Activite_etablissement, count(*) as populaires from commerce_alimentaire ca INNER JOIN activite ac ON ac.id_activite = ca.id_activite group by Activite_etablissement order by populaires DESC limit 13');


?>
</head>
<body>

	<!-- MENU -->
    <nav class="navbar">
        <ul class="navbar-ul">
            <li class="nav-item">
                <a class="nav-link" href="../">Home</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" href="#">Trouve ton commerce</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../forum/index.php">Forum</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../historique/historique.php">Historique</a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="../connecte_toi.php">Connecte-toi</a>
            </li>
        </ul>
    </nav>
	<!-- FIN MENU -->
	<main>
		<h2 class="text-center titre">Trouve ton commerce</h2>
		<div class="search-container">
			<form action="search.php" method="GET">
				<button type="submit"><i class="fa fa-search"></i></button>
				<input type="text" id="s" placeholder="Recherchez votre commerce" name="s">							
				<input type="hidden" name="lat" id="lat" /> 
				<input type="hidden" name="lng" id="lng" />
				<div id="infoposition"></div>
			</form>		
		</div>
		<div class="d-flex">
            <?php			
				$i=1;				
				while ($ligne = $rep ->fetch()) {	
					echo "<div class='col'><a href='../recherche_restaurant/Activite.php?activite=".$ligne['Activite_etablissement']."' class='circleBase type".$i."'><p class='text-cercle'>".$ligne['Activite_etablissement']."</p></a></div>";
					$i=$i + 1;
					if($i == 14)
						$i = 1;
				}
                $rep ->closeCursor();  
            ?>
		</div>
	
		
	</main>
	
	   <script>
   
   $(document).ready(function() {
        navigator.geolocation.getCurrentPosition(maPosition, erreurPosition,{maximumAge:600000,enableHighAccuracy:true})	
    });
		
	function maPosition(position) {
		var infopos = "Position déterminée :\n";
		infopos += "Latitude : "+position.coords.latitude +"\n";
		infopos += "Longitude: "+position.coords.longitude+"\n";
		infopos += "Altitude : "+position.coords.altitude +"\n";
		$("#lat").val(position.coords.latitude);
		$("#lng").val(position.coords.longitude);
	}
	
	// Fonction de callback en cas d’erreur
	function erreurPosition(error) {
		var info = "Erreur lors de la géolocalisation : ";
		switch(error.code) {
		case error.TIMEOUT:
			info += "Timeout !";
		break;
		case error.PERMISSION_DENIED:
		info += "Vous n’avez pas donné la permission";
		break;
		case error.POSITION_UNAVAILABLE:
			info += "La position n’a pu être déterminée";
		break;
		case error.UNKNOWN_ERROR:
			info += "Erreur inconnue";
		break;
		}		
		document.getElementById("infoposition").innerHTML = info;	
	}
	</script>
	
</body>
</html>