<?php 
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

if(!internauteEstConnecte())
{
	header("location:../connexion.php");
	exit(); 
}


//------------------------- Suppression d'une annonce ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$bdd->exec("DELETE FROM annonce WHERE id_annonce = '$_GET[id_annonce]'");
	$content .= "<div class='alert alert-success'>L'annonce n°" . $_GET['id_annonce'] . " a été supprimée </div>";
	$_GET['action']='affichage';
}



//---------------------- Ajouter une annonce via formulaire ---------------------------//


if(!empty($_POST))
{

	$photo_bdd ='';
	$photo1_bdd ='';
	$photo2_bdd ='';
	$photo3_bdd ='';
	$photo4_bdd ='';
	$photo5_bdd ='';


	if(isset($_GET['action']) && $_GET['action'] == 'modification' || $_GET['action'] == 'ajout' )
	{
		$photo_bdd = $_POST['photo_actuelle'];
	}

	if(!empty($_FILES['photo']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo']['name'];
		$photo_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}

	if(!empty($_FILES['photo1']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo1']['name'];
		$photo1_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo1']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}

	if(!empty($_FILES['photo2']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo2']['name'];
		$photo2_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo2']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}

	if(!empty($_FILES['photo3']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo3']['name'];
		$photo3_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo3']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}

	if(!empty($_FILES['photo4']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo4']['name'];
		$photo4_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo4']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}

	if(!empty($_FILES['photo5']['name']))
	{
		$nom_photo = $_POST['membre_id'] . '_' . $_FILES['photo5']['name'];
		$photo5_bdd = URL . "photo/$nom_photo";
		$photo_dossier = RACINE_SITE . "photo/$nom_photo";
		copy($_FILES['photo5']['tmp_name'], $photo_dossier);
		//echo '<pre>'; print_r($_POST); echo '</pre>';
	}


	
	if(isset($_GET['action']) && $_GET['action'] == 'modification' ||  $_GET['action'] == 'ajout' )
	{
		foreach($_POST as $indice => $valeur)
		{
			$_POST[$indice] = htmlspecialchars(addslashes($valeur));
		}
	}
	if(strlen($_POST['titre'])<3 || strlen($_POST['titre'])>30)
	{
		$content .= '<div class="alert alert-danger">Le titre doit comporter entre 3 et 30 caractères</div>';
	}
	if(strlen($_POST['description'])<3 || strlen($_POST['description'])>200)
	{
		$content .= '<div class="alert alert-danger">Merci de renseigner une description entre 15 et 200 caractères</div>';
	}
	if(!is_numeric($_POST['prix']))
	{
		$content .= '<div class="alert alert-danger">Le format du prix est incorrect, veuillez recommencer</div>';
	}
	if(strlen($_POST['ville'])<3 || strlen($_POST['ville'])>30)
	{
		$content .= '<div class="alert alert-danger">Merci de renseigner une ville entre 3 et 30 caractères</div>';
	}	
	if(!is_numeric($_POST['cp']))
	{
		$content .= '<div class="alert alert-danger">Le format du code postal est incorrect, veuillez recommencer</div>';
	}
	/*if (filter_var($_POST['photo'], FILTER_VALIDATE_URL)) 
	{
    	$content .='';
	} 
	else 
	{
   		$content .= '<div class="alert alert-danger">Ce format d\'url est invalide, veuillez recommencer</div>';
	}*/


	if(empty($content)){ 

		$content .= '<div class="alert alert-success">L\'annonce a été enregistrée avec succès !</div>';

		$request = "REPLACE INTO photo(photo1, photo2, photo3, photo4, photo5)VALUES(:photo1, :photo2, :photo3, :photo4, :photo5)";

		$re = $bdd->prepare($request);

		$re->bindValue(':photo1', $photo1_bdd, PDO::PARAM_STR);
		$re->bindValue(':photo2', $photo2_bdd, PDO::PARAM_STR);
		$re->bindValue(':photo3', $photo3_bdd, PDO::PARAM_STR);
		$re->bindValue(':photo4', $photo4_bdd, PDO::PARAM_STR);
		$re->bindValue(':photo5', $photo5_bdd, PDO::PARAM_STR);

		$re->execute();


		

		$req = "REPLACE INTO annonce(id_annonce, titre, description, prix, photo, pays, ville, adresse, cp, membre_id, photo_id, categorie_id, date_enregistrement)VALUES(:id_annonce, :titre, :description, :prix, :photo, :pays, :ville, :adresse, :cp, :membre_id, :photo_id, :categorie_id, :date_enregistrement)";

		$r = $bdd->prepare($req);

		$r->bindValue(':id_annonce', $_POST['id_annonce'], PDO::PARAM_STR);
		$r->bindValue(':titre', $_POST['titre'], PDO::PARAM_STR);
		$r->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$r->bindValue(':prix', $_POST['prix'], PDO::PARAM_STR);
		$r->bindValue(':photo', $photo_bdd, PDO::PARAM_STR);
		$r->bindValue(':pays', $_POST['pays'], PDO::PARAM_STR);
		$r->bindValue(':ville', $_POST['ville'], PDO::PARAM_STR);
		$r->bindValue(':adresse', $_POST['adresse'], PDO::PARAM_STR);
		$r->bindValue(':cp', $_POST['cp'], PDO::PARAM_STR);
		$r->bindValue(':membre_id', $_POST['membre_id'], PDO::PARAM_STR);
		$r->bindValue(':photo_id', $_POST['photo_id'], PDO::PARAM_STR);
		$r->bindValue(':categorie_id', $_POST['categorie_id'], PDO::PARAM_STR);
		$r->bindValue(':date_enregistrement', $_POST['date_enregistrement'], PDO::PARAM_STR);

		$r->execute();


		$_GET['action']='affichage';



		}

}
		


//----------------------------- Liens annonces ---------------------------------//


//$content .= '<a href="?action=affichage"><u>Afficher mes annonces</u></a><br>';
//$content .= '<a href="?action=ajout"><u>Déposer une annonce</u></a><br><br>';



//--------------------------- Affichage des annonces ---------------------------//

if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{

//echo '<pre>'; print_r($_SESSION); echo '</pre>';
//echo '<pre> id_membre = '; print_r($_SESSION['membre']['id_membre']); echo '</pre>';

$id_membre_connecte = $_SESSION['membre']['id_membre'];

$r = $bdd->query("SELECT * FROM annonce WHERE membre_id = $id_membre_connecte ");
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
		elseif($indice == 'membre_id')
		{
			//On fait une requête pour récupérer l'id et le nom du membre
			$reqMembre = $bdd->query("SELECT id_membre, prenom, nom FROM membre WHERE id_membre = $valeur");
			$membre = $reqMembre->fetch(PDO::FETCH_ASSOC);
			$content .= '<td>' . $membre['id_membre'] . ' - ' . $membre['prenom'] . ' ' . $membre['nom'] . '</td>';
			//debug($reqMembre->fetch(PDO::FETCH_ASSOC));
		}
		elseif($indice == 'categorie_id')
		{
			//On fait une requête pour récupérer l'id et le nom de la catégorie
			$reqCategorie = $bdd->query("SELECT id_categorie, titre FROM categorie WHERE id_categorie = $valeur");
			$categorie = $reqCategorie->fetch(PDO::FETCH_ASSOC);
			$content .= '<td>' . $categorie['id_categorie'] . ' - ' . $categorie['titre']. '</td>';
			//debug($reqMembre->fetch(PDO::FETCH_ASSOC));
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


//----------------------------- Modifier ou Ajouter une annonce --------------------------------//


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
	$membre_id = (isset($annonce_actuel['membre_id'])) ? $annonce_actuel['membre_id'] : $_SESSION['membre']['id_membre'];
	$photo_id = (isset($annonce_actuel['photo_id'])) ? $annonce_actuel['photo_id'] : '';
	$categorie_id = (isset($annonce_actuel['categorie_id'])) ? $annonce_actuel['categorie_id'] : '';
	$date_enregistrement = (isset($annonce_actuel['date_enregistrement'])) ? $annonce_actuel['date_enregistrement'] : '';



	if(isset($_GET['id_annonce']))
	{
		$result = $bdd->query("SELECT * FROM photo WHERE id_photo = $photo_id"); 

		$annonc_actuel = $result->fetch(PDO::FETCH_ASSOC); 
	}

	//$id_photo = (isset($annonc_actuel['id_photo'])) ? $annonc_actuel['id_photo'] : '';
	$photo1 = (isset($annonc_actuel['photo1'])) ? $annonc_actuel['photo1'] : '';
	$photo2 = (isset($annonc_actuel['photo2'])) ? $annonc_actuel['photo2'] : '';
	$photo3 = (isset($annonc_actuel['photo3'])) ? $annonc_actuel['photo3'] : '';
	$photo4 = (isset($annonc_actuel['photo4'])) ? $annonc_actuel['photo4'] : '';
	$photo5 = (isset($annonc_actuel['photo5'])) ? $annonc_actuel['photo5'] : '';



?>

<a href="?action=affichage"><u>Retour vers mes annonces</u></a><hr>
<h1>Ajouter ou modifier une annonce</h1>

<form action="" method="post" enctype="multipart/form-data">

<div class="row">
  <div class="col-md-6">

	<input type="hidden" id="id_annonce" name="id_annonce" value="<?php echo $id_annonce; ?>">
	<input type="hidden" id="membre_id" name="membre_id" value="<?php echo $membre_id; ?>">
	<input type="hidden" id="date_enregistrement" name="date_enregistrement" value="<?php echo $date_enregistrement; ?>">

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
	<label for="categorie_id">Categorie</label>
	<select id="categorie_id" name="categorie_id"  class="form-control">
	<option> <?php echo $categorie_id; ?> </option>
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

</div>

<div class="col-md-6">

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

</div>

	<input type="hidden" name="photo_actuelle" value="<?php echo $photo; ?>">

	<div class="form-group">
	<label for="photo">Photo principale</label>
	<input type="file" name="photo" id="photo" > <?php if(empty($photo)) {echo '<img src="../image/photo.png" width="250"><br>';} else {echo'<i>Vous pouvez uploader une nouvelle photo si vous souhaitez la modifier</i><br>'; echo '<img src="'. $photo .'" width="250"><br>';} ?>

	<div class="form-group">
	<label for="photo_id">photo_id</label>
	<input type="text" id="photo_id" name="photo_id" value="<?php echo $photo_id; ?>">
	</div>

	<label for="photo1">Photo 1</label>
	<input type="file" name="photo1" id="photo1"> <?php if(empty($photo1)) echo '<img src="../image/photo.png" width="100"><br>'; else echo '<img src="'. $photo1 .'" width="250"><br>'; ?>

	<label for="photo2">Photo 2</label>
	<input type="file" name="photo2" id="photo2"> <?php if(empty($photo2)) echo '<img src="../image/photo.png" width="100"><br>'; else echo '<img src="'. $photo2 .'" width="250"><br>'; ?>

	<label for="photo3">Photo 3</label>
	<input type="file" name="photo3" id="photo3"> <?php if(empty($photo3)) echo '<img src="../image/photo.png" width="100"><br>'; else echo '<img src="'. $photo3 .'" width="250"><br>'; ?>

	<label for="photo4">Photo 4</label>
	<input type="file" name="photo4" id="photo4"> <?php if(empty($photo4)) echo '<img src="../image/photo.png" width="100"><br>'; else echo '<img src="'. $photo4 .'" width="250"><br>'; ?>

	<label for="photo5">Photo 5</label>
	<input type="file" name="photo5" id="photo5"> <?php if(empty($photo5)) echo '<img src="../image/photo.png" width="100"><br>'; else echo '<img src="'. $photo5 .'" width="250"><br>'; ?>
	</div>
	
	<input type="submit" class="btn primary-btn" value="Enregistrer">

</form>


<?php

}}

require_once("../inc/bas.inc.php");
?>