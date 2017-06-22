<?php 
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");



//------------------------- Suppression d'une annonce ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$bdd->exec("DELETE FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");
	$content .= "<div class='validation'>L'annonce n°" . $_GET['id_annonce'] . " a été supprimée </div>";
	$_GET['action']='affichage';
}



//---------------------- Ajouter une annonce via formulaire ---------------------------//


if(!empty($_POST))
{
	if(isset($_GET['action']) && $_GET['action'] == 'modification' ||  $_GET['action'] == 'ajout' )
	{
		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars(addslashes($valeur));
		}
	}
	if(strlen($_POST['titre'])<3 || strlen($_POST['titre'])>30)
	{
		$content .= '<div class="erreur">Le titre doit comporter entre 3 et 30 caractères</div>';
	}
	if(strlen($_POST['description'])<3 || strlen($_POST['description'])>200)
	{
		$content .= '<div class="erreur">Merci de renseigner une description entre 15 et 200 caractères</div>';
	}
	if(!is_numeric($_POST['prix']))
	{
		$content .= '<div class="erreur">Le format du prix est incorrect, veuillez recommencer</div>';
	}
	if(strlen($_POST['ville'])<3 || strlen($_POST['ville'])>30)
	{
		$content .= '<div class="erreur">Merci de renseigner une ville entre 3 et 30 caractères</div>';
	}	
	if(!is_numeric($_POST['cp']))
	{
		$content .= '<div class="erreur">Le format du code postal est incorrect, veuillez recommencer</div>';
	}
	if (filter_var($_POST['photo'], FILTER_VALIDATE_URL)) 
	{
    	$content .='';
	} 
	else 
	{
   		$content .= '<div class="erreur">Ce format d\'url est invalide, veuillez recommencer</div>';
	}
	if(empty($content)){ 

		$content .= '<div class="validation">L\'annonce a été enregistrée avec succès !</div>';

		$req = "REPLACE INTO annonce(id_annonce, titre, description, prix, photo, pays, ville, adresse, cp, membre_id, photo_id, categorie_id, date_enregistrement)VALUES(:id_annonce, :titre, :description, :prix, :photo, :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, :date_enregistrement)";

		$r = $bdd->prepare($req);

		$r->bindValue(':id_annonce', $_POST['id_annonce'], PDO::PARAM_STR);
		$r->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
		$r->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$r->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
		$r->bindValue(':photo', $_POST['photo'], PDO::PARAM_STR);
		$r->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
		$r->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$r->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		$r->bindValue(':cp', $_POST['cp'], PDO::PARAM_STR);
		$r->bindValue(':membre_id', $_POST['membre_id'], PDO::PARAM_STR);
		$r->bindValue(':photo_id', $_POST['photo_id'], PDO::PARAM_STR);
		$r->bindValue(':categorie_id', $_POST['categorie_id'], PDO::PARAM_STR);
		$r->bindValue(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_STR);

		$r->execute();

	}
}
		


//----------------------------- Liens annonces ---------------------------------//


$content .= '<a href="?action=affichage"><u>Affichage des annonces</u></a><br>';
$content .= '<a href="?action=ajout"><u>Ajouter une annonce</u></a><br><br><hr>';



//--------------------------- Affichage des annonces ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{

$r = $bdd->query("SELECT * FROM annonce");
$content .= "<h1>Affichage des " . $r->rowCount() . " annonces</h1>";
$content .= "<table border='1' style='border-collapse:collapse;'><tr>";

for($i=0; $i< $r->columnCount(); $i++)
{
	$colonne = $r->getColumnMeta($i);
	$content .= "<th>$colonne[name]</th>";
}
$content .= "<th>Action</th>";
$content .= "</tr>";

while($ligne = $r->fetch(PDO::FETCH_ASSOC))
{
	$content .= '<tr>';
	foreach($ligne as $indice => $valeur)
	{
		if($indice == 'photo')
		{
			$content .= '<td><img src="' . $valeur . '" class="miniature" width="200px"></td>';
		}
		else
		{
			$content .= '<td>' . $valeur . '</td>';
		}
	}
	$content .= "<td><a href=\"?action=details&id_annonce=$ligne[id_annonce]\"><img class=\"icon\" src='../image/zoom.png'></a>";
	$content .= "<a href=\"?action=modification&id_annonce=$ligne[id_annonce]\"><img class=\"icon\" src='../image/edit.png'></a>";
	$content .= "<a href=\"?action=suppression&id_annonce=$ligne[id_annonce]\" OnClick=\"return(confirm('Confirmer la suppression ?'))\";><img class=\"icon\"  src='../image/delete.png'></a></td>";
	$content .= '</tr>';
}
$content .= "</table>";
}

echo $content;


//----------------------------- Modifier une annonce --------------------------------//


if($_GET)
{

if(isset($_GET['action']) && $_GET['action'] == 'ajout' || $_GET['action'] == 'modification') 
{
	if(isset($_GET['id_annonce']))
	{
		$resultat = $bdd->query("SELECT * FROM annonce WHERE id_annonce = $_GET[id_annonce]"); 

		$annonce_actuel = $resultat->fetch(PDO::FETCH_ASSOC); 
	}

	$id_annonce = (isset($annonce_actuel['id_annonce'])) ? $annonce_actuel['id_annonce'] : ''; 
	$titre = (isset($annonce_actuel['titre'])) ? $annonce_actuel['titre'] : '';
	$description = (isset($annonce_actuel['description'])) ? $annonce_actuel['description'] : '';
	$prix = (isset($annonce_actuel['prix'])) ? $annonce_actuel['prix'] : '';
	$photo = (isset($annonce_actuel['photo'])) ? $annonce_actuel['photo'] : '';
	$pays = (isset($annonce_actuel['pays'])) ? $annonce_actuel['pays'] : '';
	$ville = (isset($annonce_actuel['ville'])) ? $annonce_actuel['ville'] : '';
	$adresse = (isset($annonce_actuel['adresse'])) ? $annonce_actuel['adresse'] : '';
	$cp = (isset($annonce_actuel['cp'])) ? $annonce_actuel['cp'] : '';
	$membre_id = (isset($annonce_actuel['membre_id'])) ? $annonce_actuel['membre_id'] : '';
	$photo_id = (isset($annonce_actuel['photo_id'])) ? $annonce_actuel['photo_id'] : '';
	$categorie_id = (isset($annonce_actuel['categorie_id'])) ? $annonce_actuel['categorie_id'] : '';
	$date_enregistrement = (isset($annonce_actuel['date_enregistrement'])) ? $annonce_actuel['date_enregistrement'] : '';

?>

<h1>Ajouter ou modifier une annonce</h1>

<form action="" method="post" enctype="multipart/form-data">

	<input type="hidden" id="id_annonce" name="id_annonce" value="<?php echo $id_annonce; ?>">

	<div class="form-group">
	<label for="titre">Titre</label>
	<input class="form-control" type="text" name="titre" id="titre" placeholder="titre" required="required" value="<?php echo $titre;?>" >
	</div>

	<div class="form-group">
	<label for="description">Description</label>
	<textarea class="form-control" type="text" name="description" id="description" placeholder="description" rows="2"><?php echo $description; ?></textarea>
	</div>

	<div class="form-group">
	<label for="titre">Prix</label>
	<input class="form-control" type="text" name="prix" id="prix" placeholder="prix" required="required" value="<?php echo $prix; ?>">
	</div>

	<div class="form-group">
	<label for="photo">Photo url</label>
	<input class="form-control" type="text" name="photo" id="photo" placeholder="Collez l'url de la photo" required="required" value="<?php echo $photo; ?>">
	</div>

	<div class="form-group">
	<label for="pays">Pays</label>
	<select class="form-control" type="text" name="pays" id="pays" required="required">
	<option><?php echo $pays; ?></option>
	<option value="france">France</option>
	<option value="belgique">Belgique</option>
	<option value="luxembourg">Luxembourg</option>
	<option value="suisse">Suisse</option>
	</select>
	</div>

	<div class="form-group">
	<label for="ville">Ville</label>
	<input class="form-control" type="text" name="ville" id="ville" placeholder="ville" required="required" value="<?php echo $ville; ?>">
	</div>

	<div class="form-group">
	<label for="adresse">Adresse</label>
	<input class="form-control" type="text" name="adresse" id="adresse" placeholder="adresse" required="required" value="<?php echo $adresse; ?>">
	</div>

	<div class="form-group">
	<label for="cp">CP</label>
	<input class="form-control" type="text" name="cp" id="cp" placeholder="cp" required="required" value="<?php echo $cp; ?>">
	</div>

	<div class="form-group">
	<label for="membre_id">Membre id</label>
	<input class="form-control" type="text" name="membre_id" id="membre_id" placeholder="membre_id" required="required" value="<?php echo $membre_id; ?>">
	</div>
	
	<div class="form-group">
	<label for="photo_id">Photo id</label>
	<input class="form-control" type="text" name="photo_id" id="photo_id" placeholder="photo_id" required="required" value="<?php echo $photo_id; ?>">
	</div>

	<div class="form-group">
	<label for="categorie_id">Categorie id</label>
	<select id="categorie_id" name="categorie_id"  class="form-control">
	<option><?php echo $categorie_id; ?></option>
	<option value="1">1-Emploi</option>
	<option value="2">2-Véhicule</option>
	<option value="3">3-Immobilier</option>
	<option value="4">4-Vacances</option>
	<option value="5">5-Multimedia</option>
	<option value="6">6-Loisirs</option>
	<option value="7">7-Matériel</option>
	<option value="8">8-Services</option>
	<option value="9">9-Maison</option>
	<option value="10">10-Vêtements</option>
	<option value="11">11-Autre</option>
	</select>
	</div>

	<div class="form-group">
	<label for="date_enregistrement">Date d'enregistrement</label>
	<input class="form-control" type="date" name="date_enregistrement" id="date_enregistrement" placeholder="date_enregistrement" required="required" value="<?php echo $date_enregistrement; ?>">
	</div>

	<input type="submit" class="btn primary-btn" value="Enregistrer">

</form>


<?php

/*
$requete = $bdd->query("SELECT * FROM categorie");

while($ligne = $requete->fetch(PDO::FETCH_ASSOC))
{
	echo '<option>';
	foreach($ligne as $indice => $valeur)
	{
		if($indice == "id_categorie")
		{
			echo $valeur .' - ';
		}
		if($indice == "titre")
		{
			echo $valeur . '<option>';
		}
	}
}*/


}}

require_once("../inc/bas.inc.php");
?>