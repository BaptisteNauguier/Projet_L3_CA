<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style_trouve.css" rel="stylesheet">
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
			<button type="submit"><i class="fa fa-search"></i></button>
			<input type="text" placeholder="Recherchez votre commerce" name="search">				
		</div>
		<div class="d-flex">
            <?php			
				$i=1;				
				while ($ligne = $rep ->fetch()) {	
					echo "<div class='col'><div class='circleBase type".$i."'><p class='text-cercle'>".$ligne['Activite_etablissement']."</p></div></div>";
					$i=$i + 1;
					if($i == 14)
						$i = 1;
				}
                $rep ->closeCursor();  
            ?>
		</div>
		
	</main>
</body>
</html>