<!DOCTYPE html>
<html lang = "fr">
	<head>
		<link rel="stylesheet" href="../css/style_trouve.css" />
		<title> page commerce </title>
		<?php
			# $id_page = (id du commerce)
			include('../bd.php');
			$bdd = getBD();
		?>
	</head>
	<body>
		<?php $titre = $bdd -> query('select 'nom_etablissement' from 'commerce_alimentaire' where 'Id_commerce' = id_page') 
			echo '<p id = 'titre'> $titre </p>'
		?>
		</br>
		<p> Site internet : </p>
		<p> <a href="lien commerce"> lien du site internet </a></p>
		
		<div class = "col1">
			<p> Localisation : </p>
			<p> <a href="lien localisation"> localisation </a></p>
		</div>
		
		<div class = "col2">
			<p> Avis Clients : </p>
			<?php
				$pseudo = $bdd -> query('select pseudo from utilisateur_inscrit where ')
				echo '<p> $pseudo </p>'
				$avis = $bdd -> query('select forum_ca.avis from forum_ca, utilisateur_inscrit where forum_ca.id_UI = utilisateur_inscrit.id_UI')
				echo '<p> $avis </p>'
			?>
			
			<img id = "img" src="photo de profil client" alt="Profil client">
			<img id = "img" src="image étoiles" alt="Etoiles">
			<p> avis du client </p>
		</div>
		
		<div class = "col3">
			<p> Etat sanitaire : </p>
			<?php
				if ("Très satisfaisant" = $bdd->query('select 'niveau_sanitaire' from 'commerce_alimentaire' where 'Id_commerce' = id_page')
					echo "X  Très satisfaisant"
					}
				else {
					echo "   Très satisfaisant"
				}
			
				if ("Satisfaisant" = $bdd->query('select 'niveau_sanitaire' from 'commerce_alimentaire' where 'Id_commerce' = id_page')
					echo "X  Satisfaisant"
				}
				else {
					echo "   Satisfaisant"
				}
			
				if ("A améliorer" = $bdd->query('select 'niveau_sanitaire' from 'commerce_alimentaire' where 'Id_commerce' = id_page')
					echo "X  A améliorer"
				}
				else {
					echo "   A améliorer"
				}
			
				if ("A corriger de manière urgente" = $bdd->query('select 'niveau_sanitaire' from 'commerce_alimentaire' where 'Id_commerce' = id_page')
					echo "X  A corriger de manière urgente"
				}
				else {
					echo "   A corriger de manière urgente"
				}
			?>
		</div>
		
	</body>
</html>