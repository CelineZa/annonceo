<?php
require_once("inc/init.inc.php");

if($_POST)
{
	//debug($_POST);

	if(strlen($_POST['pseudo']) < 3 || strlen($_POST['pseudo']) > 20) 
	{
		$content .= "<div class='erreur'>Merci de renseigner un pseudo entre 3 et 20 caractères.</div>";
	}
	if(!preg_match('#^[a-zA-Z-0-9._-]+$#', $_POST['pseudo']))
	{
		$content .= "<div class='erreur'>Erreur de format/caractères pour le pseudo.</div>";
	}
	if(!preg_match('#^[0-9]+$#', $_POST['telephone']))
	{
		$content .= "<div class='erreur'>Il ne doit y avoir que des chiffres dans votre code postal.</div>";
	}
	if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		$content .= "<div class='erreur'>Votre mail n'est pas valide !</div>";
	}

	// Contôler les champs du formulaire afin d'ajouter des antislash lorsqu'on saisie un champs avec une apostrophe
	foreach($_POST as $indice => $valeur)
	{
		$_POST[$indice] = addslashes($valeur);
	}
	
	// Contrôler la disponibilité du pseudo

	$r = $bdd->query("SELECT pseudo FROM membre WHERE pseudo = '$_POST[pseudo]'");

	// Si la requête renvoi un résultat cela veut dire que le pseudo existe déjà.
	if($r->rowCount() >= 1)
	{
		$content .= "<div class='erreur'>Ce pseudo est déjà utilisé !</div>";
	}

	if(empty($content)) // S'il n'y a pas de message(s) d'erreur, on insère les données dans la table membre.
	{
		$req = $bdd->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, telephone, email, civilite, statut, date_enregistrement, moyenne_note) VALUES(:pseudo, :mdp, :nom, :prenom, :telephone, :email, :civilite, 0, NOW(), 0)");

		$req->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$req->bindParam(':mdp', $_POST['mdp'], PDO::PARAM_STR);
		$req->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
		$req->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$req->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
		$req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$req->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);

		$req->execute();

		$content .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href='connexion.php'><u>Cliquez-ici pour vous connecter</u></a></div>";
	}
}

require_once("inc/haut.inc.php");

echo $content;
?>

<h1>Inscription</h1>

<form action="" method="POST">
	
	<div class="form-group">
		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo" class="form-control" pattern="[a-zA-Zéèàê0-9-_.]{3,20}" placeholder="Pseudo" required="required">
	</div>
	<div class="form-group">
		<label for="mdp">Mot de passe :</label>
		<input type="password" id="mdp" name="mdp" class="form-control" placeholder="Mot de passe">
	</div>

	<div class="form-group">
		<label for="nom">Nom :</label>
		<input type="text" id="nom" name="nom" class="form-control" pattern="[a-zA-Zéèàê0-9-_.]{3,20}" title="Caractères acceptés : a-zA-Z0-9-_." placeholder="Nom"> <!-- pattern => expression régulière (RegEx)  -->
	</div>

	<div class="form-group">
		<label for="prenom">Prénom :</label>
		<input type="text" id="prenom" name="prenom" class="form-control" pattern="[a-zA-Zéèàê0-9-_.]{3,20}" title="Caractères acceptés : a-zA-Zéèàê0-9-_." placeholder="Prénom">
	</div>

	<div class="form-group">
		<label for="telephone">Téléphone :</label>
		<input type="telephone" id="telephone" name="telephone" class="form-control" pattern="[0-9]{10}" title="Caractères acceptés : 0-9" placeholder="Téléphone">
	</div>

	<div class="form-group">
		<label for="email">E-mail :</label>
		<input type="email" id="email" name="email" class="form-control" placeholder="E-mail">
	</div>

	<div class="form-group">
		<label for="civilite">Civilité :</label>
		<input type="radio" name="civilite" value="m" id="m" checked> Homme
		<input type="radio" name="civilite" value="f" id="f"> Femme
	</div>

	<button type="submit" class="btn btn-default">Inscription</button>
</form>

<?php
require_once("inc/bas.inc.php");
?>