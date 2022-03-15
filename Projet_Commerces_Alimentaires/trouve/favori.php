<?php
include('../bd.php');


if(isset($_GET['status']) && $_GET['status'] == "add_favori"){
		add_favori($_GET['id_ui'], $_GET['id_commerce']);
}

if(isset($_GET['status']) && $_GET['status'] == "remove_favori"){
		remove_favori($_GET['id_ui'], $_GET['id_commerce']);		
}

function add_favori ($id_ui, $id_commerce)
{	
	$bdd = getBD();	
	$sql = "INSERT INTO favori (id_UI, id_commerce) VALUES (?,?)"; 	
	$stmt = $bdd->prepare($sql);	
	$stmt->execute([$id_ui, $id_commerce]) or die(print_r($stmt->errorInfo(), true));	
}

function remove_favori ($id_ui, $id_commerce)
{
	$bdd = getBD();
	$sql = "DELETE FROM favori WHERE id_UI = ? AND id_commerce = ?"; 
	$stmt = $bdd->prepare($sql);	
	$stmt->execute([$id_ui, $id_commerce]) or die(print_r($stmt->errorInfo(), true));
}
?>