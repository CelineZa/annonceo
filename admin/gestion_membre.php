<?php
require_once("../inc/init.inc.php");
require_once("../inc/haut.inc.php");

//--------SUPPRESSION MEMBRE--------

if(isset($_GET['action']) && $_GET['action'] == 'suppression')
{
	$resultat = $bdd->exec("DELETE FROM membre WHERE id_membre = '$_GET[id_membre]'");
	$content .= "<div class='validation'>Le membre n°" . $_GET['id_membre'] . " a été supprimée </div>";
	$_GET['action'] ='affichage';
}


/***************ENREGISTREMENT DES MEMBRES*******************/

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

		$req = "REPLACE INTO membre (id_membre,pseudo,nom,prenom,telephone,email,civilite,statut) VALUES(:id_membre,:pseudo,:nom,:prenom,:telephone,:email,:civilite,:statut)";

		$r = $bdd->prepare($req);

		$r->bindParam(':id_membre',$_POST['id_membre'],PDO::PARAM_STR);
		$r->bindParam(':pseudo',$_POST['pseudo'],PDO::PARAM_STR);
		$r->bindParam('nom',$_POST['nom'], PDO::PARAM_STR);
		$r->bindParam('prenom',$_POST['prenom'], PDO::PARAM_STR);
		$r->bindParam('telephone',$_POST['telephone'], PDO::PARAM_INT);
		$r->bindParam('email', $_POST['email'], PDO::PARAM_STR);
		$r->bindParam('civilite', $_POST['civilite'], PDO::PARAM_STR);
		$r->bindParam('statut', $_POST['statut'], PDO::PARAM_INT);

		$r->execute();

	}
}

//----------------------------- Liens ---------------------------------//

$content .= '<a href="?action=affichage"><u>Affichage des membres</u></a><br>';
$content .= '<a href="?action=ajout"><u>Ajouter un membre</u></a><br><br><hr>';


/****************AFFICHAGE DES MEMBRES*****************/
if(isset($_GET['action']) && $_GET['action'] == 'affichage')
{
	$r = $bdd->query("SELECT * FROM membre");
	$content .= "<h1> Affichage des " . $r->rowCount() . " membre(s)</h1>";
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
		$content .= "<td><a href=\"?action=zoom&id_membre=$ligne[id_membre]\"><img src=\"../image/zoom.png\" class=\"icon\" alt=\"zoom\"></a>";

		$content .= "<a href=\"?action=modification&id_membre=$ligne[id_membre]\"><img src=\"../image/edit.png\" class=\"icon\" alt=\"modification\"></a>";

		$content .= "<a href=\"?action=suppression&id_membre=$ligne[id_membre]\" OnClick=\"return(confirm('En êtes vous certain?'));\"><img src=\"../image/delete.png\" class =\"icon\" alt=\"suppression\"></a></td>";
		$content .="</tr>";
	}
	$content .= '</table>';
}

echo $content;

/**********************AFFICHAGE ZOOM ****************************/


/**********************AFFICHAGE MEMBRE DANS FORMULAIRE si click sur icone********************/
if($_GET)
{
	if(isset($_GET['action']) && $_GET['action'] == 'ajout' || $_GET['action'] == 'modification')
	{
		if(isset($_GET['id_membre']))
		{
			$resultat = $bdd->query("SELECT * FROM membre WHERE id_membre = $_GET[id_membre]");
			$membre_actuel = $resultat->fetch(PDO::FETCH_ASSOC);
		}
		$id_membre= (isset($membre_actuel['id_membre'])) ? $membre_actuel['id_membre'] :"";
		$pseudo = (isset($membre_actuel['pseudo'])) ? $membre_actuel['pseudo'] :"";
		$mdp = (isset($membre_actuel['mdp'])) ? $membre_actuel['mdp'] :"";
		$nom = (isset($membre_actuel['nom'])) ? $membre_actuel['nom'] :"";
		$prenom = (isset($membre_actuel['prenom'])) ? $membre_actuel['prenom'] :"";
		$telephone = (isset($membre_actuel['telephone'])) ? $membre_actuel['telephone'] :"";
		$email = (isset($membre_actuel['email'])) ? $membre_actuel['email'] :"";
		$civilite = (isset($membre_actuel['civilite'])) ? $membre_actuel['civilite'] :"";
		$statut = (isset($membre_actuel['statut'])) ? $membre_actuel['statut'] :"";

?>

<!--FORMULAIRE DE MODIFICATION DES MEMBRES-->

<h1>Formulaire modification des Membres</h1><br>

<form action="#" method="post">

		<div class="form-group">		
				<input type="hidden" name="id_membre" class="form-control"  id="id_membre" value="<?php echo $id_membre;?>">
		</div>

		<div class="form-group">
			<label for="pseudo">PSEUDO</label>
				<input type="text" name="pseudo" id="pseudo"  placeholder="pseudo à modifier" value="<?php echo $pseudo?>"">	
		</div>

		<div class="form-group">
			<label for="nom">NOM</label>
				<input type="text" name="nom" id="nom"  placeholder="Nom à modifier" value="<?php echo $nom?>"">	
		</div>

		<div class="form-group">
			<label for="prenom">PRENOM</label>
				<input type="text" name="prenom" id="prenom"  placeholder="Prénom à modifier" value="<?php echo $prenom?>"">	
		</div>

		<div class="form-group">
			<label for="telephone">TELEPHONE</label>
				<input type="value" name="telephone" id="telephone"  placeholder="Téléphone à modifier" value="<?php echo $telephone?>"">	
		</div>

		<div class="form-group">
			<label for="email">EMAIL</label>
				<input type="text" name="email" id="email"  placeholder="Email à modifier" value="<?php echo $email?>"">	
		</div>

			<div class="form-group">
			<label for="civilite">CIVILITE</label>
				<select name="civilite" class="form-control">
		  			<option value="f"'; if($civilite == 'f') { echo 'selected';} echo'>FEMME</option>
					<option value="h"'; if($civilite == 'h') { echo 'selected';} echo'>HOMME</option>
				</select>
		</div>

		<div class="form-group">
			<label for="email">EMAIL</label>
				<input type="text" name="email" id="email"  placeholder="Email à modifier" value="<?php echo $email?>"">	
		</div>

		<div class="form-group">
			<label for="statut">STATUT</label>
				<select name="statut" class="form-control">
		  			<option value="1"'; if($statut == '1') { echo 'selected';} echo'>ADMIN</option>
					<option value="0"'; if($statut == '0') { echo 'selected';} echo'>MEMBRE</option>
				</select>
		</div>
			
		<button type="submit" class ="btn btn-default">Envoyer les modifications</button>
</form>

<?php
	}
}
require_once("../inc/bas.inc.php");

?>










