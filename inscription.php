<?php
require_once("inc/init.inc.php");
require_once("inc/haut.inc.php");
?>

<h1>Inscription</h1>

<form action="" method="POST">
	
	<div class="form-group">
		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo" class="form-control" placeholder="Pseudo" required="required">
	</div>
	<div class="form-group">
		<label for="mdp">Mot de passe :</label>
		<input type="password" id="mdp" name="mdp" class="form-control" placeholder="Mot de passe">
	</div>

	<div class="form-group">
		<label for="nom">Nom :</label>
		<input type="text" id="nom" name="nom" class="form-control" pattern="[a-zA-Z0-9-_.]{3,20}" title="Caractères acceptés : a-zA-Z0-9-_." placeholder="Nom"> <!-- pattern => expression régulière (RegEx)  -->
	</div>

	<div class="form-group">
		<label for="prenom">Prénom :</label>
		<input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prénom">
	</div>

	<div class="form-group">
		<label for="telephone">Téléphone :</label>
		<input type="telephone" id="telephone" name="telephone" class="form-control" placeholder="Téléphone">
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