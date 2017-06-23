<?php

require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

/***************SUPPRESSION NOTE*******************/

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$resultat = $bdd->exec("DELETE FROM note WHERE id_note = '$_GET[id_note]'");
	$content .= "<div class='alert alert-success'>La note n°" . $_GET['id_note'] . " a été supprimée </div>";
	$_GET['action'] ='affichage';
}

/****************AFFICHAGE DES NOTES****************/

$r = $bdd->query("SELECT id_note,membre_id1,membre_id2,note,avis,date_enregistrement FROM note");
$content .= "<h1> Affichage des " . $r->rowCount() . " commentaire(s)</h1>";
$content .= "<table border='1' style='border-collapse:collapse;'><tr>";
	for ($i= 0; $i< $r->columnCount(); $i++)
	{
		$colonne = $r->getColumnMeta($i);
		$content .= "<th>$colonne[name]</th>";
	}
	$content .="<th> actions </th>";

	$content .="</tr>";

	while($ligne = $r->fetch(PDO::FETCH_ASSOC))
	{
		$content .= '<tr>';

		foreach($ligne as $indice => $valeur)
		{
			$content .= "<td>$valeur</td>";
		}
		$content .= "<td><a href=\"?action=zoom&id_note=$ligne[id_note]\"><img src=\"../image/zoom.png\" class=\"icon\" alt=\"zoom\"></a>";

		$content .= "<a href=\"?action=modification&id_note=$ligne[id_note]\"><img src=\"../image/edit.png\" class=\"icon\" alt=\"modification\"></a>";

		$content .= "<a href=\"?action=suppression&id_note=$ligne[id_note]\" OnClick=\"return(confirm('En êtes vous certain?'));\"><img src=\"../image/delete.png\" class =\"icon\" alt=\"suppression\"></a></td>";
		$content .="</tr>";
	}
	$content .= '</table>';


echo $content;



