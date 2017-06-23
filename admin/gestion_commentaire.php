<?php
require_once("../inc/init.inc.php");

if(!internauteEstConnecteEtEstAdmin())
{
	header("location:../connexion.php");
	exit(); 
}

//------------------------- Suppression d'un commentaire ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$bdd->exec("DELETE FROM commentaire WHERE id_commentaire = '$_GET[id_commentaire]'");
	$content .= "<div class='alert alert-success'>Le commentaire n°" . $_GET['id_commentaire'] . " a été supprimé ! </div>";
	$_GET['action']='affichage';
}

//---------------------- Modifier un commentaire via formulaire ---------------------------//
if(!empty($_POST))
{
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		foreach ($_POST as $indice => $valeur) {
			$_POST[$indice] = htmlspecialchars(addslashes($valeur)); 
		}
	}

	if(empty($content))
	{
		$req = "UPDATE commentaire SET statut = :statut WHERE id_commentaire = :id_commentaire";

		$r = $bdd->prepare($req);

		$r->bindParam(':id_commentaire', $_POST['id_commentaire'], PDO::PARAM_INT);
		$r->bindParam(':statut', $_POST['statut'], PDO::PARAM_INT);

		$r->execute();

		$content .= '<div class="alert alert-success">Le commentaire a été publié avec succès !</div>';
	}
}

//------------------------------ Liens commentaires ----------------------------------//

$content .= '<a href="?action=affichage"><u>Affichage des commentaires</u></a>';

//--------------------------- Affichage des commentaires ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	$r = $bdd->query("SELECT * FROM commentaire");

	$content .= "<h1>Affichage des " . $r->rowCount() . " commentaires</h1>";

	$content .= "<table border='1' style='border-collapse:collapse;'>";

	$content .= "<tr>";
	for($i=0; $i < $r->columnCount(); $i++)
	{
		$colonne = $r->getColumnMeta($i);
		$content .= "<th>$colonne[name]</th>";
	}
	$content .= "<th>Action</th>";
	$content .= "</tr>";

	

	while($ligne = $r->fetch(PDO::FETCH_ASSOC))
	{
		$content .= "<tr>";
			foreach ($ligne as $indice => $valeur) {
				if($indice != 'statut')
				{
					if($indice == 'membre_id')
					{
						//On fait une requête pour récupérer l'id et l'email du membre qui a posté le commentaire
						$reqMembre = $bdd->query("SELECT id_membre, email FROM membre WHERE id_membre = $valeur");
						$membre = $reqMembre->fetch(PDO::FETCH_ASSOC);
						$content .= '<td>' . $membre['id_membre'] . ' - ' . $membre['email'] . '</td>';
						//debug($reqMembre->fetch(PDO::FETCH_ASSOC));
					}
					elseif($indice == 'annonce_id')
					{
						//On fait une requête pour récupérer l'id et le titre de l'annonce
						$reqAnnonce = $bdd->query("SELECT id_annonce, titre FROM annonce WHERE id_annonce = $valeur");
						$annonce = $reqAnnonce->fetch(PDO::FETCH_ASSOC);
						$content .= '<td>' . $annonce['id_annonce'] . ' - ' . $annonce['titre'] . '</td>';
						//debug($reqAnnonce->fetch(PDO::FETCH_ASSOC));
					}
					else
					{
						$content .= '<td>' . $valeur . '</td>';
					}
					
				}				
			}

			// Si le statut est égal à 1 cela signifie qu'il est validé et qu'on peut l'afficher sur le site.
			if($ligne['statut'] == 1)
			{
				$content .= '<td>Validé</td>';
			}
			// Sinon on le met en attente.
			else
			{
				$content .= '<td>En attente de validation</td>';
			}

			$content .= "<td>";
			$content .= "<a href=\"?action=details&id_commentaire=$ligne[id_commentaire]\"><img class=\"icon\" src='../image/zoom.png'></a>";
			$content .= "<a href=\"?action=modification&id_commentaire=$ligne[id_commentaire]\"><img class=\"icon\" src='../image/edit.png'></a>";
			$content .= "<a href=\"?action=suppression&id_commentaire=$ligne[id_commentaire]\" OnClick=\"return(confirm('Confirmer la suppression ?'))\";><img class=\"icon\"  src='../image/delete.png'></a>";
			$content .= "</td>";
		$content .= "</tr>";
	}

	$content .= "</table>";
}

require_once("../inc/haut.inc.php");

echo $content;

//----------------------------- Modifier un commentaire --------------------------------//

if($_GET)
{
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		if(isset($_GET['id_commentaire']))
		{
			$resultat = $bdd->query("SELECT * FROM commentaire WHERE id_commentaire = $_GET[id_commentaire]");
			$commentaire_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		}

		$id_commentaire = (isset($commentaire_actuel['id_commentaire'])) ? $commentaire_actuel['id_commentaire'] : '';
		$statut = (isset($commentaire_actuel['statut'])) ? $commentaire_actuel['statut'] : '';
?>
<h1>Modifier un commentaire</h1>

<form action="" method="post">
	<input type="hidden" id="id_commentaire" name="id_commentaire" value="<?php echo $id_commentaire; ?>">
	<div class="form-group">
		<label for="statut">Changer le statut du commentaire</label>
		<select name="statut" id="statut" class="form-control">
			<option value='0' <?php if($statut == 0) { echo 'selected'; } ?> >Commentaire en attente de validation</option>
			<option value='1' <?php if($statut == 1) { echo 'selected'; } ?> >Commentaire validé</option>
		</select>
	</div>
	<button type="submit" class="btn btn-primary">Modifier</button>
</form>

<?php
	}
}
require_once("../inc/bas.inc.php");
?>