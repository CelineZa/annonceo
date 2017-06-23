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




echo $content;




