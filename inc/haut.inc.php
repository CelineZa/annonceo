<!DOCTYPE html>
<html lang="FR-fr">
	<head>
		<meta charset="UTF-8">
		<title>Annonceo</title>
		
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="/annonceo/css/style.css">

		<!-- BOOTSTRAP JS -->
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
	</head>
	<body>
		<header>
			<nav class="container-fluid">
				<a class="navbar-brand" href=<?php echo URL."index.php"; ?> title="Annonceo">Annonceo</a>
			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" >
					<?php 
					if(internauteEstConnecteEtEstAdmin())
					{
					?>
			    	<ul class="nav navbar-nav">
						<?php
								echo '<li><a href="' . URL . 'admin/gestion_annonce.php?action=affichage">Annonces</a></li>';
								echo '<li><a href="' . URL . 'admin/gestion_categorie.php">Catégories</a></li>';
								echo '<li><a href="' . URL . 'admin/gestion_commentaire.php">Commentaires</a></li>';
								echo '<li><a href="' . URL . 'admin/gestion_membre.php">Membres</a></li>';
								echo '<li><a href="' . URL . 'admin/gestion_note.php">Notes</a></li>';
								echo '<li><a href="' . URL . 'admin/statistiques.php">Statistiques</a></li>';
						?>
			    	</ul>
					<?php
					} // Fermerture du if(!internauteEstConnecteEtEstAdmin())

					else{
					?>
			    	<ul class="nav navbar-nav">
						<?php
							if(internauteEstConnecte())
							{
								echo '<li><a href="' . URL . 'membre/profil.php">Mon profil</a></li>';
								echo '<li><a href="' . URL . 'membre/gestion_annonce_membre.php?action=affichage">Mes annonces</a></li>';
								echo '<li><a href="' . URL . 'membre/gestion_annonce_membre.php?action=ajout">Déposer une annonce</a></li>';
							}
							echo '<li><a href="' . URL . 'qui_sommes_nous.php">Qui Sommes Nous</a></li>';
							echo '<li><a href="' . URL . 'contact.php">Contact</a></li>';
						?>
			    	</ul>
					
				    <form class="navbar-form navbar-left">
				    	<div class="form-group">
				    		<input type="text" class="form-control" placeholder="Recherche...">
				    	</div>
				        <button type="submit" class="btn btn-default">Rechercher</button>
				    </form>
				    <?php
					} // Fermerture du else
				    ?>

				    <ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								<?php
								if(internauteEstConnecteEtEstAdmin())
								{
									echo "Espace admin";
								}
								elseif(internauteEstConnecte())
								{
									echo '<i class="fa fa-user" aria-hidden="true"></i> ' . $_SESSION['membre']['pseudo'];
								}
								else
								{
									echo "Espace membre";
								} 
								?>
							    <span class="caret"></span>
						    </a>

						    <ul>
							<?php
							if(internauteEstConnecte())// membre du site ayant un compte
							{
								echo '<li><a href="' . URL . 'connexion.php?action=deconnexion">Déconnexion</a></li>';
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
