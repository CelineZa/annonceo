<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

/**********SUPPRESSION CATEGORIE******************/

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$resultat = $bdd->exec("DELETE FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");
	$_GET['action'] ='affichage';
	$content .= '<div class="alert alert-success"><strong>Catégorie bien supprimée !</strong></div>';
}

/************ AFFICHAGE DES CATEGORIES ***********/

$r = $bdd->query("SELECT * FROM categorie");
$content .="<table border='2' style='border-collapse:collapse;'><tr>";
	for($i = 0; $i < $r->columnCount();$i++)
	{
		$colonne= $r->getColumnMeta($i);
		$content .="<th>$colonne[name]</th>";
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
		$content .= "<td><a href=\"?action=zoom&id_categorie=$ligne[id_categorie]\"><img src=\"../image/zoom.png\" class=\"icon\" alt=\"zoom\"></a>";

		$content .= "<a href=\"?action=modification&id_categorie=$ligne[id_categorie]\"><img src=\"../image/edit.png\" class=\"icon\" alt=\"modification\"></a>";

		$content .= "<a href=\"?action=suppression&id_categorie=$ligne[id_categorie]\" OnClick=\"return(confirm('En êtes vous certain?'));\"><img src=\"../image/delete.png\" class =\"icon\" alt=\"suppression\"></a></td>";
		$content .="</tr>";
	}
	$content .= '</table>';


echo $content;


/**********************AFFICHAGE ZOOM ****************************/

/**********************MODIFICATION CATEGORIE********************/

if(isset($_GET['action']) && $_GET['action'] == 'modification')
{
	if(isset($_GET['id_categorie']))
	{
		$resultat = $bdd->query("SELECT * FROM categorie WHERE id_categorie = $_GET[id_categorie]");
		$categorie_actuelle = $resultat->fetch(PDO::FETCH_ASSOC);
	}
	$id_categorie = (isset($categorie_actuelle['id_categorie'])) ? $categorie_actuelle['id_categorie'] :"";
	$titre = (isset($categorie_actuelle['titre'])) ? $categorie_actuelle['titre'] : "";
	$motscles = (isset($categorie_actuelle['motscles'])) ? $categorie_actuelle['motscles'] : "";


?>

<!--FORMULAIRE DE MODIFICATION DES CATEGORIES-->

<h1>Formulaire catégorie</h1><br>

<form action="#" method="post">

		<div class="form-group">		
				<input type="hidden" name="id_categorie" class="form-control"  id="id_categorie" value="<?php echo $id_categorie;?>">
		</div>

		<div class="form-group">
			<label for="titre">TITRE DE LA CATEGORIE</label>
				<select class="form-control">
		  			<option value="vehicule"'; if($categorie == 'vehicule') { echo 'selected';} echo'>Vehicule</option>
					<option value="immobilier"'; if($categorie == 'immobilier') { echo 'selected';} echo'>Immobilier</option>
					<option value="vacances"'; if($categorie == 'vacances') { echo 'selected';} echo'>Vacances</option>
					<option value="multimedia"'; if($categorie == 'multimedia') { echo 'selected';} echo'>Multimédia</option>
					<option value="loisirs"'; if($categorie == 'loisirs') { echo 'selected';} echo'>Loisirs</option>
					<option value="materiel"'; if($categorie == 'materiel') { echo 'selected';} echo'>Matériel</option>
					<option value="services"'; if($categorie == 'services') { echo 'selected';} echo'>Services</option>
					<option value="maison"'; if($categorie == 'vetements') { echo 'selected';} echo'>Vêtements</option>
				</select>
		</div>

		<div class="form-group">
			<label for="motscles">MOTS CLES</label>
				<input type="text" name="motscles" id="motscles"  placeholder="Mots cles à modifier" value="<?php echo $motscles?>"">	
		</div>		
			
			<button type="submit" class ="btn btn-default">Envoyer les modifications"</button>
</form>

<?php
}
require_once("../inc/bas.inc.php");

?>