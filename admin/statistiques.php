<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");



//----------------------------- Liens ---------------------------------//

$content .= '<a href="?action=top_note"><u>Membres les mieux notés</u></a><br>';
$content .= '<a href="?action=top_actif"><u>Membres les plus actifs</u></a><br>';
$content .= '<a href="?action=top_annonce_old"><u>Annonces les plus anciennes</u></a><br>';
$content .= '<a href="?action=top_cat"><u>Catégories contenant le plus d\'annonces</u></a><br>';

/****************AFFICHAGE Membres les mieux notés*****************/

/*Ordre Prenom Nom + Moyenne note*/

/* savoir combien de fois membre_id2 a été noté + récupérer la moyenne des notes*/
/*

if(isset($_GET['action']) && $_GET['action'] == 'top_note')
{
	$r = $bdd->query("SELECT      FROM ");
	$content .= "<table border='1' style='border-collapse:collapse;'>";
	
	for ($i= 0; $i< $r->columnCount(); $i++)
	{
		$colonne = $r->getColumnMeta($i);
	}
	$content .="</tr>";


	while($ligne = $r->fetch(PDO::FETCH_ASSOC))
	{
		$content .= '<tr>';

		foreach($ligne as $indice => $valeur)
		{
			$content .= "<td>$valeur</td>";
		}
	
		$content .="</tr>";
	}
	$content .= '</table>';
}


*/



if(isset($_GET['action']) && $_GET['action'] == 'top_actif')
{

	$r = $bdd->query("SELECT * FROM annonce");
	$content .= "<h2>Nombre total d'annonces sur le site : " . $r->rowCount() . "</h2>";



	$z = $bdd->query("SELECT membre_id, COUNT(*) FROM annonce GROUP BY membre_id ORDER BY COUNT(*) DESC LIMIT 0,1");
	$topActif = $z->fetch(PDO::FETCH_ASSOC);
	echo '<pre>'; print_r($topActif); echo '</pre>';
	$idMembre = $topActif['membre_id'];

	$reqMembre = $bdd->query("SELECT id_membre, prenom, nom FROM membre WHERE id_membre = $idMembre");
	$membre = $reqMembre->fetch(PDO::FETCH_ASSOC);
	echo '<pre>'; print_r($reqMembre); echo '</pre>';

	$content .= "<h2>Le membre le plus actif est " . $membre['prenom'] . ' ' . $membre['nom'] . " et possède " . $topActif['COUNT(*)'] . " annonces";


	$w = $bdd->query("SELECT * FROM annonce ORDER BY date_enregistrement DESC LIMIT 0,1");


	/*
	while($ligne = $z->fetch(PDO::FETCH_ASSOC))
	{
		foreach($ligne as $indice => $valeur)
		{
			$reqMembre = $bdd->query("SELECT id_membre, prenom, nom FROM membre WHERE id_membre = $valeur");
			$membre = $reqMembre->fetch(PDO::FETCH_ASSOC);
			//$content .= '<h2>Membre le plus actif  : ' . $membre['prenom'] . ' ' . $membre['nom'] . ' (id : ' . $membre['id_membre'] . ') avec ' . $valeur . ' annonces <h2>';
			$content .= $indice . ' : ' . $valeur . '<br>';
		}
	}*/
}

echo $content;




