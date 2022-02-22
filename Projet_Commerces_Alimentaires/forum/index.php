<!DOCTYPE html>
<html lang="fr">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="../css/style_forum.css" rel="stylesheet">
	<title>Forum</title>

<?php 
include('../bd.php');
$bdd = getBD();

$rep = $bdd->query('select * from commentaire_site cs INNER JOIN donner do ON do.id_site = cs.id_site INNER JOIN utilisateurs_inscrit ui ON ui.id_ui = do.id_ui');
$count = $rep ->rowCount(); //compter s'il y en a des resultats


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
                <a class="nav-link" href="../trouve/index.php">Trouve ton commerce</a>
            </li>
			<li class="nav-item">
                <a class="nav-link active" href="#">Forum</a>
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
		<h2 class="text-center titre">Forum</h2>
		<h3>Votre avis nous intéresse !</h3>
		<p><b>Une remarque sur l'application, un commerce en particulier? Echangez avec les utilisateur de EzFood</b></p>
            <?php 
				if($count > 0){ //si on a un commentaire afficher
					while ($ligne = $rep ->fetch()) {	
					//<a href="https://www.flaticon.com/fr/icones-gratuites/defaut" title="défaut icônes">Défaut icônes créées par Ilham Fitrotul Hayat - Flaticon</a>?>					
						<div class="d-flex">
							<div class="p-photo"><img src="../img/utilisateur.png" width="20" height="20"></div>
							<p class="nom-date"><?php echo $ligne['pseudo']." " ?><small class="text-light"><?php echo date('d/m/Y H:i:s', strtotime($ligne['date'])); ?></small></p>
						</div> 
						<p><?php echo $ligne['commentaire'] ?></p>
			<?php
					}
				}else{ //si on a pas des commentaires
					echo "Pas encore de commentaire! Soyez le premier.";
                }
                $rep ->closeCursor();  
            ?>
			
		
	</main>
</body>
</html>