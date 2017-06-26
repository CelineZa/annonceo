<?php
require_once("inc/init.inc.php");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	$stmt = $bdd->prepare("SELECT id_categorie, titre FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");

	$stmt->execute();
	//echo "<pre>"; var_dump($stmt->fetchAll()); echo "</pre>";
	echo json_encode($stmt->fetch(PDO::FETCH_ASSOC)); // Transforme notre tableau PHP en JSON.
}