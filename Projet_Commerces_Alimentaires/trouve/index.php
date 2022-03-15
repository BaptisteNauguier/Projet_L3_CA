<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style_trouve.css" rel="stylesheet">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simbole de searchbar -->
	<script type="text/javascript" src="../js/location.js"></script>
	<title>Trouve ton commerce</title>

<?php 
include('../bd.php');
$bdd = getBD();

session_start();

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
			<?php if(isset($_SESSION['utilisateur'])) { ?>
			<li class="nav-item dropdown">
                <a class="nav-link dropbtn" href="#">Bienvenue <?php echo $_SESSION['utilisateur']['pseudo'] ?> ▼</a>
                <div class="dropdown-content">
                        <a href='../session/deconnexion.php'>Se deconnecter</a>
                </div>
            </li>
			<?php }else{ ?>
			<li class="nav-item">
                <a class="nav-link" href="../session/connexion.php">Connecte-toi</a>
            </li>
			<?php } ?>
        </ul>
    </nav>
	<!-- FIN MENU -->
	<main>
		<h2 class="text-center titre">Trouve ton commerce</h2>
		<div class="search-container">
			<form action="search.php" method="GET">
				<button type="submit"><i class="fa fa-search"></i></button>
				<input type="text" id="s" placeholder="Recherchez votre commerce" name="s">							
				<input type="hidden" name="lat" class="lat" /> 
				<input type="hidden" name="lng" class="lng" />
				<input type="hidden" name="filtre" id="filtre" value="distance" />
			</form>		
		</div>
		<div class="d-flex">
            <?php			
				$i=1;				
				while ($ligne = $rep ->fetch()) { ?>	
					<?php echo "<div class='col'>
					<form action='search.php' method='GET'>
						<button type='submit' class='circleBase type".$i."'>
							<input type='hidden' name='s' value='".$ligne['Activite_etablissement']."' >							
							<input type='hidden' name='lat' class='lat' /> 
							<input type='hidden' name='lng' class='lng' />
							<input type='hidden' name='filtre' id='filtre' value='distance' />							
							<p class='text-cercle'>".$ligne['Activite_etablissement']."</p>
						</button>
					</form>
					</div>";
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
	</script>
	
</body>
</html>