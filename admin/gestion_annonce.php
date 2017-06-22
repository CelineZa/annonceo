<?php 


//--------------------------- Affichage des annonces ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{

$r = $pdo->query("SELECT * FROM annonce");
$content .= "<h1>Affichage des " . $r->rowCount() . " annonces</h1>";
$content .= "<table border='1' style='border-collapse:collapse;'><tr>";

for($i=0; $i< $r->columnCount(); $i++)
{
	$colonne = $r->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
$content .= "<th>Détails</th>";
$content .= "<th>Modification</th>";
$content .= "<th>Suppression</th>";
$content .= "</tr>";

while($ligne = $r->fetch(PDO::FETCH_ASSOC))
{
	$content .= '<tr>';
	foreach($ligne as $indice => $valeur)
	{
		if($indice == 'photo')
		{
			$content .= '<td><img src="' . $valeur . '" class="miniature"></td>';
		}
		else
		{
			$content .= '<td>' . $valeur . '</td>';
		}
	}
	$content .= "<td><a href=\"?action=details&id_annonce=$ligne[id_annonce]\"><img class=\"icon\" src='../image/zoom.png'></a></td>";
	$content .= "<td><a href=\"?action=modification&id_annonce=$ligne[id_annonce]\"><img class=\"icon\" src='../image/edit.png'></a></td>";
	$content .= "<td><a href=\"?action=suppression&id_annonce=$ligne[id_annonce]\" OnClick=\"return(confirm('Confirmer la suppression ?'))\";><img class=\"icon\"  src='../image/delete.png'></a></td>";
	$content .= '</tr>';
}
$content .= "</table>";
}


?>