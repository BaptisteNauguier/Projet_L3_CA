<!DOCTYPE html>
<html lang = "fr">
	<head>
		<link rel="stylesheet" href="../css/style_trouve.css" />
		<title> page commerce </title>
		<?php
			$id = $_GET['id_commerce'];
			include('../bd.php');
			$bdd = getBD();
		?>
	</head>

	<body>
		<?
			$donnee = $bdd -> query('Select DISTINCT commerce_alimentaire.nom_etablissement, commerce_alimentaire.coordonnee, commerce_alimentaire.niveau_sanitaire, forum_ca.avis, lien_map.lien, utilisateurs_inscrit.pseudo
			FROM forum_ca, commerce_alimentaire, lien_map, utilisateurs_inscrit
			WHERE forum_ca.id_commerce=commerce_alimentaire.id_commerce
			AND lien_map.id_commerce=commerce_alimentaire.id_commerce
			AND utilisateurs_inscrit.id_UI=forum_ca.id_UI
			AND commerce_alimentaire.id_commerce='.$id.''); /* importation des données */

			$r_donnee = $donnee -> fetch();

			echo 
			'<h1>'.$r_donnee['nom_etablissement'].'</h1></br>
			<div>
			<p> Site internet : 
			<a href="page_commerce.php?id_commerce='.$id.'"> lien site internet </a> </br>
			</div>
			<div class=col1>
			Localisation : </br>
			'.$r_donnee['lien'].'
			</br>
			</div>
			<div class=col1>
			Avis clients :'
			.$r_donnee['pseudo'].' :'
			.$r_donnee['avis'].'</br>
			</div>
			<div class=col1>
			Etat sanitaire :'
			.$r_donnee['niveau_sanitaire'].'</br> </p>
			</div>
			'
			;

			$donnee -> closeCursor();

		?>
	</body>
</html>