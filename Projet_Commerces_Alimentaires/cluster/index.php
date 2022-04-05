<!DOCTYPE html>
<html>
<head>
	<title>EX knearest neighbors</title>
</head>
<body>

<?php

require_once __DIR__ . '/vendor/autoload.php';

// Import library
use Phpml\Clustering\KMeans;
use Phpml\Dataset\CsvDataset;

// Our data set
$dataset = new CsvDataset('recommandation.csv', 4, true);

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

include('../bd.php');
$bdd = getBD();

session_start();

$j=0;
$trouve = false;
while($trouve == false && $j < count($tabkmean)){
	$tab_id = array();
	for($i = 0;  $i < count($tabkmean[$j]); $i++){
		if($tabkmean[$j][$i][0] == $_SESSION['utilisateur']['id']){
			$trouve =true;
			echo "Vous faites partie du groupe ".$j;
		}
		array_push($tab_id, $tabkmean[$j][$i][1]);
	}
	echo "<br>";
	$j++;
}

$List = implode(', ', $tab_id);

print_r($List);
  
$rep = $bdd->query("select * from favori fa 
INNER JOIN utilisateurs_inscrit ui ON ui.id_UI = fa.id_UI 
INNER JOIN commerce_alimentaire ca ON ca.id_commerce = fa.id_commerce 
INNER JOIN lieux li ON ca.id_lieux = li.id_lieux
INNER JOIN activite ac ON ac.id_activite = ca.id_activite
WHERE ca.id_commerce IN ({$List})"); 	
while ($mat = $rep->fetch()) { 
?>
<header>
					<div class="text-fixed">
						<h2><?php echo $mat["nom_etablissement"]?></h2>
						<b><?php echo ucwords($mat["Adresse"]).", ".$mat["Code_postal"].", ".$mat["commune"] ?></b>
					</div>	
					
				</header> 

<?php }
?>

</body>
</html>

