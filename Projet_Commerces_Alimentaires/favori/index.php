<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style.css" rel="stylesheet">
	<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- simboles -->
	<title>Mes favoris</title>

<?php 
include('../bd.php');
$bdd = getBD();

session_start();


require_once __DIR__ . '/../cluster/vendor/autoload.php';

// Import library
use Phpml\Clustering\KMeans;
use Phpml\Dataset\CsvDataset;

// Our data set
$dataset = new CsvDataset('../cluster/recommandation.csv', 4, true);

$sample = array();
foreach ($dataset->getSamples() as $samples) {
	$id_ui = $samples[0];
	$id_commerce = $samples[1];
	$id_activite = $samples[2];
	$id_lieux = $samples[3];
	$new = array($id_ui, $id_commerce, $id_activite, $id_lieux);
    array_push($sample, $new);
}

// Initialize clustering with parameter `n`
$kmeans = new KMeans(3);
$tabkmean = $kmeans->cluster($sample);



if(isset($_SESSION['utilisateur'])) {

$lat_utilisateur = $_SESSION['utilisateur']['lat']; //latitude de l'utilisateur
$lng_utilisateur = $_SESSION['utilisateur']['lng']; //longitude de l'utilisateur	
	
//id_commerce = 0, c'est pour differencier les avis "site" et les avis "commerces"
$rep = $bdd->query("select *, (3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance from favori fa 
INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = fa.id_UI 
INNER JOIN commerce_alimentaire ca ON ca.id_commerce = fa.id_commerce 
INNER JOIN lieux li ON ca.id_lieux = li.id_lieux
INNER JOIN activite ac ON ac.id_activite = ca.id_activite
WHERE fa.id_UI = {$_SESSION['utilisateur']['id']}
ORDER BY distance ASC"); 

$row = $rep ->rowCount(); //compter s'il y en a des resultats
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
						<a class="nav-link active" href="../favori/">Favori</a>
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
		<h2 class="text-center titre">Mes favoris</h2>	
		<?php if(isset($_SESSION['utilisateur'])) { ?> 
			<?php
		if($row > 0){
		?>
		<div class='cards'>
			<?php while ($mat = $rep->fetch()) { 
				$query_favori = $bdd->query("SELECT * FROM favori fa WHERE fa.id_UI = {$_SESSION['utilisateur']['id']} AND fa.id_commerce = {$mat["id_commerce"]} ");
				$favori = $query_favori->fetch();
				$row_favori = $query_favori->rowCount();
			?> 			
			<article class="card">
				
					<div class="overlay">			
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
					</div>
				<?php $str= $mat["Activite_etablissement"]; ?>
				<header>
					<div class="text-fixed">
						<h2><?php echo $mat["nom_etablissement"]?></h2>
						<b><?php echo ucwords($mat["Adresse"]).", ".$mat["Code_postal"].", ".$mat["commune"] ?></b>
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
							echo round($temps,0). " jours | ";
						}else{
							$temps = $temps/60;
							echo round($temps,0). " hs | ";
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
        }?>
		</div>
		<?php
		$j=0;
$trouve = false;
while($trouve == false && $j < count($tabkmean)){
	$tab_id = array();
	for($i = 0;  $i < count($tabkmean[$j]); $i++){
		if($tabkmean[$j][$i][0] == $_SESSION['utilisateur']['id']){
			$trouve =true;
		}else{
			array_push($tab_id, $tabkmean[$j][$i][1]);
		}
	}
	$j++;
}


$list_idco = implode(', ', $tab_id);
  
$query_recommendation = $bdd->query("select *, (3959*acos(cos(radians({$lat_utilisateur})) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', 1))) * 
						cos(radians(SUBSTRING_INDEX(coordonnee, ',', -1)) - radians({$lng_utilisateur})) + 
						sin(radians({$lat_utilisateur})) * sin(radians(SUBSTRING_INDEX(coordonnee, ',', 1))))) AS distance from favori fa  
INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = fa.id_UI 
INNER JOIN commerce_alimentaire ca ON ca.id_commerce = fa.id_commerce 
INNER JOIN lieux li ON ca.id_lieux = li.id_lieux
INNER JOIN activite ac ON ac.id_activite = ca.id_activite
WHERE ca.id_commerce IN ({$list_idco})
ORDER BY distance ASC
LIMIT 8"); 

echo "<h2>Plus de commerces à découvrir</h2>";
echo "<div class='cards-recom'>";	
while ($row_recommendation = $query_recommendation->fetch()) { 
$str_arr = explode (",", $row_recommendation["coordonnee"]); 
				$lat = $str_arr[0];
				$lng = $str_arr[1];
				$adresse = mb_strtolower($row_recommendation["Adresse"],"UTF-8");
				if(isset($_SESSION['utilisateur'])){
					$query_favori = $bdd->query("SELECT * FROM favori fa WHERE fa.id_UI = {$_SESSION['utilisateur']['id']} AND fa.id_commerce = {$row_recommendation["id_commerce"]} ");
					$favori = $query_favori->fetch();
					$row_favori = $query_favori->rowCount();
				}
?>
				<article class="card-recom">
				
					<div class="overlay">
						<a class="a-none" href="../page_commerce/page_commerce.php?id_commerce=<?php echo $row_recommendation['id_commerce']?>">
							<div class="plus alone">						
								<i class="fa fa-plus" aria-hidden="true"></i><br>
								<b>Voir plus</b>
							</div>
						</a>
					</div>
				<?php $str= $row_recommendation["Activite_etablissement"]; ?>
				<header>
					<div class="text-fixed">
						<h2><?php echo $row_recommendation["nom_etablissement"]?></h2>
						<b><?php echo ucwords($adresse).", ".$row_recommendation["Code_postal"].", ".$row_recommendation["commune"] ?></b>
					</div>	
					
				</header>    
				<div class="content">
					<div class="">
						<b>
							<?php 
							if(strlen($str)==62){
								echo substr($str, 0, 31). ' ' . substr($str, 31);
							}else echo $str;
							?>
						</b>
						<?php 
						$distance_utilisateur_commerce = round($row_recommendation["distance"],2);
						$temps = 340*$distance_utilisateur_commerce/60;
						echo "<div class='di-te'>";
						if($temps<60){
							echo round($temps,0)."-".round($temps+2,0). " min | ";
						}else if($temps>1440){
							$temps = $temps/60/24;
							echo round($temps,0). " jours | ";
						}else{
							$temps = $temps/60;
							echo round($temps,0)."-".round($temps+0.5,1). " hs | ";
						}
						echo $distance_utilisateur_commerce." km</div>"; ?>
					</div>
					<div class="sani">
						<b>Evaluation sanitaire</b>
						<span class="text-grey"><?php echo $row_recommendation["niveau_sanitaire"] ?></span>
					</div>
				</div>
					
			</article>
<?php }
?>
</div>
		<?php }else{
			echo '<p>Vous n\'avez pas encore ajouter des commercer dans vos favoris</p>';
		}
		}else{ //else si l'utilisateur n'est pas connecté ?>
			<b>Vous devez <a href="../session/connexion.php">vous connecter</a> pour acceder aux favoris</b>
		<?php } ?>	
	</main>
	<script>
	
	$(document).ready( function() {		 
		 $(function () {
			$('.heart').on('click', function () {	
				var id_ui = $(this).find("#id_ui").val();
				var id_commerce = $(this).find("#id_commerce").val();
				if($(this).find(".fa").hasClass('fa-heart-o')){
					var status = "add_favori";
					$.ajax({
						type: "GET",
						url: "../trouve/favori.php",
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
						url: "../trouve/favori.php",
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
</body>
</html>
