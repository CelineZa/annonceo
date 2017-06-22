<?php
require_once("inc/init.inc.php");

// Si l'internaute clique sur "Déconnexion", on "détruit" sa session.
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
	unset($_SESSION['membre']);
}

// Si l'internaute est connecté, on le redirige vers sa page profil.
if(internauteEstConnecte())
{
	header('location:membre/profil.php');
}

if($_POST)
{
	//debug($_POST);

	$req = $bdd->query("SELECT * FROM membre WHERE pseudo = '$_POST[pseudo]'");

	// Si la requête renvoie un résultat cela veut dire que le pseudo est bien présent dans la BDD.
	if($req->rowCount() == 1) 
	{
		$membre = $req->fetch(PDO::FETCH_ASSOC);

		// Si le mot de passe du membre correspond bien au mot de passe qui lui est associé dans la BDD.
		if($_POST['mdp'] == $membre['mdp'])
		{
			// On crée la session du membre.
			$_SESSION['membre']['pseudo'] = $membre['pseudo'];
			$_SESSION['membre']['nom'] = $membre['nom'];
			$_SESSION['membre']['prenom'] = $membre['prenom'];
			$_SESSION['membre']['telephone'] = $membre['telephone'];
			$_SESSION['membre']['email'] = $membre['email'];
			$_SESSION['membre']['civilite'] = $membre['civilite'];
			$_SESSION['membre']['statut'] = $membre['statut'];
			$_SESSION['membre']['date_enregistrement'] = $membre['date_enregistrement'];
			$_SESSION['membre']['moyenne_note'] = $membre['moyenne_note'];

			header('location:membre/profil.php'); // Si tout est bon, on redirige l'internaute vers la page profil.php.
		}
		else
		{
			$content .= "<div class='alert alert-danger'>Votre mot de passe n'est pas bon !</div>";
		}
	}
	else
	{
		$content .= "<div class='alert alert-danger'>Votre pseudo n'est pas bon !</div>";
	}
}

require_once("inc/haut.inc.php");

echo $content;
?>

<h1>Connexion</h1>

<form action="" method="POST" class="form-connexion">
	<div class="form-group">
		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo">
	</div>
	<div class="form-group">
		<label for="mdp">Mot de passe :</label>
		<input type="password" id="mdp" name="mdp" class="form-control" placeholder="Mot de passe">
	</div>
	<button type="submit" class="btn btn-primary">Connexion</button>
</form>

<?php
require_once("inc/bas.inc.php");
?>