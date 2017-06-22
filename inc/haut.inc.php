<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<meta charset="UTF-8">
		<title>Annonceo</title>

		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="/annonceo/css/style.css">

		<!-- BOOTSTRAP JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body>
		<header>
			<nav>
				<a class="navbar-brand" href="#" title="Annonceo">Annonceo</a>
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" >
			    	<ul class="nav navbar-nav">
						<?php
						if(internauteEstConnecteEtEstAdmin())
						{ // BackOffice
							echo '<li><a href="' . URL . 'admin/gestion_annonce.php">Gestion des annonces</a></li>';
							echo '<li><a href="' . URL . 'admin/gestion_categorie.php">Gestion des catégories</a></li>';
							echo '<li><a href="' . URL . 'admin/gestion_commentaire.php">Gestion des commentaires</a></li>';
							echo '<li><a href="' . URL . 'admin/gestion_membre.php">Gestion des membres</a></li>';
							echo '<li><a href="' . URL . 'admin/gestion_note.php">Gestion des note</a></li>';
							echo '<li><a href="' . URL . 'admin/statistiques.php">Statistiques</a></li>';
						}
						if(internauteEstConnecte())// membre du site ayant un compte
						{
							echo '<li><a href="' . URL . 'qui_sommes_nous.php">Qui Sommes Nous</a></li>';
							echo '<li><a href="' . URL . 'contact.php">Contact</a></li>';
						}
						else// visiteur
						{
							echo '<li><a href="' . URL . 'qui_sommes_nous.php">Qui Sommes Nous</a></li>';
							echo '<li><a href="' . URL . 'contact.php">Contact</a></li>';
						}
						?>
			    	</ul>

				    <form class="navbar-form navbar-left">
				    	<div class="form-group">
				    		<input type="text" class="form-control" placeholder="Recherche...">
				    	</div>
				        <button type="submit" class="btn btn-default">Rechercher</button>
				    </form>

				    <ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Espace Membre <span class="caret"></span></a>
						    <ul>
							<?php
							if(internauteEstConnecteEtEstAdmin())
							{ // BackOffice

							}
							if(internauteEstConnecte())// membre du site ayant un compte
							{
								echo '<li><a href="' . URL . 'membre/profil.php">Voir votre profil</a></li>';
								echo '<li><a href="' . URL . 'membre/ajouter_annonce.php">Ajouter une annonce</a></li>';
								echo '<li><a href="' . URL . 'connexion.php?action=deconnexion">Se déconnecter</a></li>';
							}
							else// visiteur
							{
								echo '<li><a href="' . URL . 'inscription.php">Inscription</a></li>';
								echo '<li><a href="' . URL . 'connexion.php">Connexion</a></li>';
							}
							?>
							</ul>
						</li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>
		<section>
			<div class="container">
