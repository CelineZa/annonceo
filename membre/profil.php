<?php
require_once("../inc/init.inc.php");

$idMembreConnecte = $_SESSION['membre']['id_membre']; // On stocke l'id du membre connecté dans une variable.


if($_POST)
{
	//debug($_POST);
	if(empty($content))
	{
		$req = "UPDATE membre SET pseudo = :pseudo, nom = :nom, prenom = :prenom, telephone = :telephone, email = :email, civilite = :civilite WHERE id_membre = :id_membre";
		$r= $bdd->prepare($req);

		$r->bindParam(':id_membre', $idMembreConnecte, PDO::PARAM_INT);
		$r->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
		$r->bindParam(':nom', $_POST['nom'], PDO::PARAM_STR);
		$r->bindParam(':prenom', $_POST['prenom'], PDO::PARAM_STR);
		$r->bindParam(':telephone', $_POST['telephone'], PDO::PARAM_STR);
		$r->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$r->bindParam(':civilite', $_POST['civilite'], PDO::PARAM_STR);

		$r->execute();

		$content .= '<div class="alert alert-success">Vos informations personnelles ont bien été mises à jour !</div>';
	}
}

require_once("../inc/haut.inc.php");
echo $content;
?>

<h1>Mon profil</h1>

<div class="bloc-profil">
	<h2>Mes informations personnelles</h2>
	
	<?php
	if(isset($_GET['action']) && $_GET['action'] == 'modification')
	{
		$req = $bdd->query("SELECT * FROM membre WHERE id_membre = $idMembreConnecte");
		$membre_connecte = $req->fetch(PDO::FETCH_ASSOC);

		$pseudo = (isset($membre_connecte['pseudo'])) ? $membre_connecte['pseudo'] : '';
		$nom = (isset($membre_connecte['nom'])) ? $membre_connecte['nom'] : '';
		$prenom = (isset($membre_connecte['prenom'])) ? $membre_connecte['prenom'] : '';
		$telephone = (isset($membre_connecte['telephone'])) ? $membre_connecte['telephone'] : '';
		$email = (isset($membre_connecte['email'])) ? $membre_connecte['email'] : '';
		$civilite = (isset($membre_connecte['civilite'])) ? $membre_connecte['civilite'] : '';
	?>
		<form action="profil.php" method="post">

			<input type="hidden" id="id_membre" name="id_membre" class="form-control" value="<?php echo $idMembreConnecte; ?>">

			<div class="form-group">
				<label for="pseudo">Pseudo</label>
				<input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo" value="<?php echo $pseudo; ?>">
			</div>
			<div class="form-group">
				<label for="nom">Nom</label>
				<input type="text" id="nom" name="nom" class="form-control" placeholder="Nom" value="<?php echo $nom; ?>">
			</div>
			<div class="form-group">
				<label for="prenom">Prénom</label>
				<input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $prenom; ?>">
			</div>
			<div class="form-group">
				<label for="telephone">Téléphone</label>
				<input type="text" id="telephone" name="telephone" class="form-control" placeholder="Téléphone" value="<?php echo $telephone; ?>">
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>">
			</div>
			<div class="form-group">
				<label for="civilite">Civilité</label>
				<select name="civilite" id="civilite" class="form-control">
					<option value="m" <?php if($civilite == "m") { echo 'selected'; } ?> >Homme</option>
					<option value="f" <?php if($civilite == "f") { echo 'selected'; } ?> >Femme</option>
				</select>
			</div>

			<button type="submit" class="btn btn-info">Modifier</button>
			<a href="profil.php" class="btn btn-danger">Annuler</a>
		</form>
	<?php 
	}
	else
	{
		$req = "SELECT pseudo, nom, prenom, telephone, email, civilite, date_enregistrement FROM membre WHERE id_membre = $idMembreConnecte";
		$r = $bdd->query($req);
		$membre = $r->fetch(PDO::FETCH_ASSOC);

		echo "<table  class='table table-striped'>";
		foreach($membre as $indice => $valeur) {
			//debug($valeur);
			echo "<tr>";
				echo "<th>". $indice ."</th>";
				echo "<td>". $valeur ."</td>";
			echo "</tr>";
		}
		echo '</table>';

		echo '<a href="?action=modification" class="btn btn-info">Modifier mes infos personnelles</a>';
	}
	?>
</div>


<div class="bloc-profil">
	<h2>Mes annonces</h2>
	<?php
	$req = "SELECT id_annonce, titre, prix, photo, description FROM annonce WHERE membre_id = $idMembreConnecte";
	$r = $bdd->query($req);

	while($annonce = $r->fetch(PDO::FETCH_ASSOC))
	{
		//debug($annonce);
	?>

	<div class="col-md-8 col-md-offset-2 bloc_annonce">
		<div class="photo_annonce">
			<img src="<?php echo $annonce['photo']; ?>" alt="photo">
		</div>
		<div class="texte_annonce">
			<h3><?php echo $annonce['titre']; ?></h3>
			<p><?php echo $annonce['description']; ?></p>
		
			<p><span><?php echo $annonce['prix']; ?>€</span></p>
		</div>
		<a href="gestion_annonce_membre.php?action=modification&id_annonce=<?php echo $annonce['id_annonce']; ?>">Modifier cette annonce</a>
	</div>
	
	<?php
	}
	?>
	
	<div class="clearfix"></div>
</div>

<div class="bloc-profil">
	<h2>Mes commentaires</h2>

	<?php
	$req = "SELECT * FROM commentaire WHERE membre_id = $idMembreConnecte";
	$r = $bdd->query($req);

	while($commentaire = $r->fetch(PDO::FETCH_ASSOC))
	{
		//debug($commentaire);
		echo '<div class="col-md-8 col-md-offset-2 commentaire-membre">';
			echo '<p>Annonce n°' . $commentaire['annonce_id'] . ' - <span>' . $commentaire['date_enregistrement'] . '</span></p>';
			echo '<p>' . $commentaire['commentaire'] . '</p>';
		echo '</div>';
	}
	?>
</div>

<?php
require_once("../inc/bas.inc.php");
?>