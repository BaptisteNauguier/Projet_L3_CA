<?php
include('../bd.php');

/* ---------- Ajouter un commentaire  ---------- */

$commentaire = trim($_GET['commentaire']); // Pour eviter des commentaires avec juste des espaces

if(isset($_GET['status']) && $_GET['status'] == "add_commentaire" && $commentaire != ""){
		add_commentaire($_GET['id_ui'], $_GET['commentaire']);
		header('Location: index.php');
		exit;
}else{
	header('Location: index.php'); 
}


function add_commentaire ($id_UI, $commentaire)
{	
	$bdd = getBD();	
	$sql_commentaire = "INSERT INTO forum_ca (id_UI, id_commerce, avis) VALUES (?, ?, ?)"; 	
	$stmt_commentaire = $bdd->prepare($sql_commentaire);	
	$stmt_commentaire->execute([$id_UI, 0, $commentaire]) or die(print_r($stmt_commentaire->errorInfo(), true));
}

/* ---------- FIN Ajouter un commentaire  ---------- */

/* ---------- Supprimer un commentaire  ---------- */

if(isset($_GET['status']) && $_GET['status'] == "delete_commentaire"){
		remove_commentaire($_GET['id_forum']);
		header('Location: index.php');
		exit;
}else{
	echo "ERREUR"; 
}


function remove_commentaire ($id_forum)
{
	$bdd = getBD();
	$sql = "DELETE FROM forum_ca WHERE id_forum = ?"; 
	$stmt = $bdd->prepare($sql);	
	$stmt->execute([$id_forum]) or die(print_r($stmt->errorInfo(), true));
}

/* ---------- FIN Supprimer un commentaire  ---------- */
?>