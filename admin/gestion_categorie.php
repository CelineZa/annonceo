<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

/**********SUPPRESSION CATEGORIE******************/

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$resultat = $bdd->exec("DELETE FROM categorie WHERE id_categorie = '$_GET[id_categorie]'");
	$content .= '<div class="alert alert-success"><strong>Catégorie bien supprimée !</strong></div>';
	$_GET['action'] ='affichage';
}



/***************ENREGISTREMENT D'UNE CATEGORIE*******************/

if(!empty($_POST))
{
	foreach ($_POST as $indice => $valeurs)
	{
		$_POST[$indice] = strip_tags($valeurs);
		$_POST[$indice] = htmlentities($valeurs);
		$_POST[$indice] = addslashes($valeurs);
		$_POST[$indice] = htmlentities($valeurs);
		$_POST[$indice] = htmlspecialchars($valeurs);
	}

	if(empty($content))
	{
		$content .= '<div class="alert alert-success"> ok !</div>';

		$req = "REPLACE INTO categorie(id_categorie,titre,motscles)VALUES(:id_categorie, :titre,:motscles)";

		$r = $bdd->prepare($req);

		$r->bindParam(':id_categorie', $_POST['id_categorie'],PDO::PARAM_INT);
		$r->bindParam(':titre', $_POST['titre'],PDO::PARAM_STR);
		$r->bindParam(':motscles', $_POST['motscles'], PDO::PARAM_STR);

		$r->execute();

	}
}

//----------------------------- Liens ---------------------------------//


$content .= '<a href="?action=affichage"><u>Affichage une catégorie</u></a><br>';
$content .= '<a href="?action=ajout"><u>Ajouter une catégorie</u></a><br><br><hr>';

/****************AFFICHAGE DES CATEGORIES*****************/

$r = $bdd->query("SELECT * FROM categorie");
	$content .= "<h1> Affichage des " . $r->rowCount() . " categories(s)</h1>";
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
		$content .= "<td><a href=\"?action=zoom&id_categorie=$ligne[id_categorie]\"><img src=\"../image/zoom.png\" class=\"icon\" alt=\"zoom\"></a>";

		$content .= "<a href=\"?action=modification&id_categorie=$ligne[id_categorie]\"><img src=\"../image/edit.png\" class=\"icon\" alt=\"modification\"></a>";

		$content .= "<a href=\"?action=suppression&id_categorie=$ligne[id_categorie]\" OnClick=\"return(confirm('En êtes vous certain?'));\"><img src=\"../image/delete.png\" class =\"icon\" alt=\"suppression\"></a></td>";
		$content .="</tr>";
	}
	$content .= '</table>';





echo $content;
/**********************AFFICHAGE ZOOM ****************************/

/**********************AFFICHAGE CATEGORIE DANS FORMULAIRE si click sur icone********************/
if($_GET)
{
	if(isset($_GET['action']) && $_GET['action'] == 'ajout' || $_GET['action'] == 'modification' )
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
				<input type="text" name="titre" id="titre" class="form-control" placeholder="renseigner un titre de catégorie " value="<?php echo $titre;?>">		
		</div>

		<div class="form-group">
			<label for="motscles">MOTS CLES</label>
				<textarea name="motscles" for="motscles" placeholder="Rajouter des mots cles" id="motscles" class="form-control" rows="3"> <?php echo $motscles;?></textarea>
		</div>		
			
			<button type="submit" class ="btn btn-default">Envoyer les modifications</button>
</form>

<?php
}
}
require_once("../inc/bas.inc.php");

?>